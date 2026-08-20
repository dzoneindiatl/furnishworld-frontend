<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\{Cart, VariantValue, ProductVariantCombination};

class SocialAuthController extends Controller
{
    public function redirect(Request $request, $provider)
    {        
        if (request()->has('redirect_to')) {
            session(['url.intended' => request()->get('redirect_to')]);
            session(['url.itm' => request()->get('itm')]);
        }
        if (request()->has('itm')) {
            session(['url.itm' => request()->get('itm')]);
        }
        return Socialite::driver($provider)->redirect();
    }

    public function callback(Request $request,$provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Something went wrong!');
        }        
        // Find user
        $user = User::where('email',$socialUser->getEmail())->first();
        if(!empty($user)) {
            if(!$user->is_active) {
                return redirect('/')->with('error', 'Your account is not active. Please contact to Admin.');
            } else if($user->user_role_id != 3) {
                return redirect('/')->with('error', 'Your email is associated with a different role. Please try using another email address.');
            }
        } else {
            $user = User::create([
                'email' => $socialUser->getEmail(),
                'name' => ucwords($socialUser->getName()),
                'user_role_id'=>3,
                'is_verified'=>1,
                'is_active'=>1,
                'login_type' => $provider,
                'social_id' => $socialUser->getId(),
            ]);
            $referralCode = 'vas' .
                str_pad($user->id, 2, '0', STR_PAD_LEFT) .
                substr($request->namr, 0, 3); 
            $user->update(['user_referral_code'=>$referralCode]);
        }
        
        Auth::guard('customer')->login($user);

        // Handle cart items if present
        $cItems = session('url.itm');
        if($cItems){
            $cartItems = base64_decode($cItems);
            $cartItemsArr = !empty($cartItems)?json_decode($cartItems,true):[];
            $this->cartItems($cartItemsArr);
        }

        return redirect()->intended('/');
    }


    private function cartItems($cartItems)
    {
        $insertData = [];
        if(!empty($cartItems)){
            foreach ($cartItems as $item) {
                $variantValueNames = array_values($item["selectedVariants"]);
                $nameToId = VariantValue::whereIn('name', $variantValueNames)
                    ->get()
                    ->pluck('id', 'name');

                $variantValueIds = collect($variantValueNames)
                    ->map(fn($name) => (int) ($nameToId[$name] ?? null))
                    ->toArray();
                $valueIds = array_map('intval', $variantValueIds);
                $jsonCombo = json_encode($valueIds);

                $combination = ProductVariantCombination::where('product_id', $item['productId'])
                    ->where('combination_id', $jsonCombo)
                    ->first();

                if ($combination) {
                    $alreadyExists = Cart::where('user_id', Auth::guard('customer')->id())
                        ->where('product_id', $item['productId'])
                        ->where('product_variant_combination_id', $combination->id)
                        ->exists();

                    if (!$alreadyExists) {
                        $insertData[] = [
                            'user_id'                        => Auth::guard('customer')->id(),
                            'product_id'                     => $item['productId'],
                            'product_variant_combination_id' => $combination->id,
                            'quantity'                       => $item['quantity'],
                        ];
                    }
                }
            }
        }


        if (!empty($insertData)) {
            Cart::insert($insertData);
        }
    }
    
}

