<?php

namespace App\View\Composers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\ProductCollection;
use Illuminate\View\View;
use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;
use App\Models\Product; 

Class HeaderComposer 
{
    public function compose(View $view): void 
    {    
        $cookie = Cookie::get('auto_login');
        if ($cookie) {
            $userId = decrypt($cookie); 
            $user = \App\Models\User::find($userId);
            if ($user) {
                Auth::guard('customer')->login($user);
            } else {
                Cookie::queue(Cookie::forget('auto_login'));
            }
        } 
        $cartCount = 0 ; 
            $cartCount = Cart::where('user_id', Auth::guard('customer')->id())
                ->sum('quantity');
        
        $cart = Cart::with('product')->where('user_id', Auth::guard('customer')->id())->get(); 
        $totalPrice = $cart->sum(function ($item) {
            return $item->product->selling_price * $item->quantity;
        });
        $popularProduct = Product::where('is_active',1)->where('is_deleted',0)->where('draf',0)->latest()->take(9)->get();  
        $allCategory = Category::where('is_active',1)->where('is_deleted',0)->get(); 
        $parentCategoryId = $allCategory->whereNull('parent_id')->pluck('id');
        $subCategory = Category::select('id','name','slug','thumbnail_image','parent_id','show_on_menu')->whereIn('parent_id',$parentCategoryId)->where('is_active',1)->where('is_deleted',0)->get(); 
        $subCategoryId = $subCategory->pluck('id'); 
        $childCategory = Category::select('id','name','slug','parent_id','show_on_menu')->whereIn('parent_id',$subCategoryId)->where('is_active',1)->where('is_deleted',0)->get();  
        $view->with([
            'categories'=>$allCategory,
            'cartTotal'=>$cartCount,
            'products'=>$popularProduct,
            'carts'=>$cart,
            'totalPrice'=>$totalPrice,
            'subCategories'=>$subCategory,
            'childCategories'=>$childCategory,
        ]); 
    }


}


//developerDzone@#123