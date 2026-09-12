<?php

namespace App\Http\Controllers\Front;

use App\Models\VariantValue;
use Exception;
use App\Models\Faq;
use App\Models\Blog;
use App\Models\Cart;
use App\Models\City;
use App\Models\User;
use App\Models\Order;
use App\Models\State;
use App\Models\Banner;
use App\Models\Coupon;
use App\Models\Slider;
use App\Models\Country;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\Attribute;
use App\Models\Subscriber;
use App\Models\CategoryTax;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\FooterCategory;
use App\Models\InvoiceSetting;
use App\Models\ProductVariant;
use App\Models\ProductGraphics;
use App\Models\CategoryAttribute;
use App\Models\FooterSubcategory;
use App\Models\ProductCollection;
use App\Models\RecentlyViewed;
use App\Models\ProductVariantSpecialization; 
use App\Models\ProductVariantValue;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Crypt;
use App\Models\{UserAddress, Variant};
use Illuminate\Support\Facades\Cookie;
// use Illuminate\Support\Facades\Storage;
use App\Models\ProductVariantCombination;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use DB;
use App\Models\ProductDetailManager; 

// use App\Service\SpecificationCombination; 
class HomeController extends Controller
{
    // public $specification; 
    // public function __construct(SpecificationCombination $specificationCombination){

    //     $this->specification = $specificationCombination; 
    // }
    public function index()
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

        $isWishlisteddata = [];
        $MainCategory = Category::select('id','slug','description','name','image','image2','image3','thumbnail_image')
        ->whereNull('parent_id')
        ->where('is_active', 1)
        ->where('is_deleted', 0)
        ->with([
            'subCategory' => function ($query) {
                $query->select('id','parent_id','slug','name','image','image2','image3','thumbnail_image')->where('is_active', 1)->where('is_deleted', 0);
            }
        ])->get();
        foreach ($MainCategory as $category) {
            $category->url = route('category.show', ['path'=>$category->slug]);
        }
        
        $categoryId = $MainCategory->pluck('id'); 
        $featureSubCategory=Category::with('parentcategory:id,slug')->select('id','slug','name','image','parent_id')->where('is_featured',1)->whereIn('parent_id',$categoryId)->where('is_active',1)->get(); 
        
        $modernLiving1 = $MainCategory->take(2);
        $modernLiving2 = $MainCategory->skip(2)->take(2);  
        $modernLiving3 = $MainCategory->skip(4)->take(2); 
        
        $refreshYourRoom = Category::with('parentcategory:id,slug')->select('id','slug','name','image','parent_id')->where('parent_id',2)->where('is_active',1)->get();
        $parentCategoryId = $MainCategory->whereNull('parent_id')->pluck('id');
        
        $subCategory = Category::select('id')->whereIn('parent_id',$parentCategoryId)->where('is_active',1)->where('is_deleted',0)->get(); 
        $subCategoryId = $subCategory->pluck('id'); 
        
        $livingProduct = []; 

        $childCategory = Category::with(['parentcategory:id,parent_id,slug,name', 'parentcategory.parentcategory:id,slug,name'])->select('id','slug','name','image','image2','image3','thumbnail_image','parent_id')->whereIn('parent_id',$subCategoryId)->where('is_active',1)->where('is_deleted',0)->get();

        foreach($childCategory as $ch){
            $livingProduct[$ch->id] = Product::select('name','selling_price','sku')->where('main_child_category_id',$ch->id)->where('is_active',1)->where('is_deleted',0)->get(); 
            $ch->lowest_selling_price = $livingProduct[$ch->id]->min('selling_price');
            $lowestProduct = $livingProduct[$ch->id]
                ->sortBy('selling_price')
                ->first();

            $ch->product_sku = $lowestProduct?->sku; 
            $ch->productName = $lowestProduct?->name; 
        }  

        $productGallery = Category::with('parentcategory:id,slug')->select('id','name','image','slug','parent_id')->where('parent_id',1)->where('is_active',1)->where('is_deleted',0)->get();
        $allProduct = [];
     
        $testimonials = Testimonial::where(['is_active' => 1])->get();
        $new_arrivals_product = Product::where('is_new_arrivals', 1)->where("is_deleted",  0)->where(['is_active' => 1])->where(['is_new_arrivals' => true, 'draf' => false])->orderBy('id', 'desc')->get();   
        $trendingProduct = Product::where('trending', 1)->where("is_deleted",  0)->where(['is_active' => 1])->where(['trending' => true, 'draf' => false])->orderBy('id', 'desc')->get();   

        $user = Auth::guard('customer')->user();
        if ($user) {
            $isWishlisteddata = Wishlist::where('user_id', $user->id)
                ->pluck('product_id')
                ->toArray();
        }
        
        $referralCode = '';
        if(request()->referral){
            $r = refCodeExist(request()->referral, true);
            if($r){
                $referralCode = request()->referral;
            }
        }

        $homeSlider =  Slider::where('is_active', 1)->get();
        $ActiveCoupon =  Coupon::where('is_active', 1)->first();
        $best_seller_products = Product::where('best_seller', 1)->where('is_active',1)->orderBy('id', 'desc')->get();
        return view('front.modules.home.index', compact('best_seller_products','ActiveCoupon','homeSlider','MainCategory','testimonials',  'new_arrivals_product','allProduct', 'isWishlisteddata', 'referralCode','featureSubCategory','refreshYourRoom','modernLiving1','modernLiving2','modernLiving3','productGallery','childCategory','subCategory','trendingProduct'));
    }
    public function indexNew()
    {
       
        if (!Auth::guard('customer')->check()) {
            $cookie = Cookie::get('auto_login');
            if ($cookie) {
                try {
                    $userId = decrypt($cookie);
                    if ($user = User::find($userId)) {
                        Auth::guard('customer')->login($user);
                    }
                } catch (\Exception $e) {
                    Cookie::queue(Cookie::forget('auto_login'));
                }
            }
        }


        $homeStatic = Cache::remember('home_static_data', 3600, function () {

            $collectionCategoryIds = Category::where('is_active', 1)
                ->where('is_deleted', 0)
                ->where('category_type_id', 1)
                ->pluck('id');

            return [

                'banners' => Banner::where('is_active', 1)
                    ->where('show_on_home_banner', 1)
                    ->get(),

                'offerbanners' => Banner::where('is_active', 1)
                    ->where('show_on_home_offer_banner', 1)
                    ->get(),

                'settings' => Setting::where('key', 'Homepage.seo')->first(),

                'category' => Category::where([
                        'is_active' => 1,
                        'show_on_menu' => 1,
                        'is_deleted' => 0
                    ])
                    ->whereNull('parent_id')
                    ->where('category_type_id', '!=', 1)
                    ->get(),

                'testimonials' => Testimonial::where('is_active', 1)->get(),

                'blogs' => Blog::where('is_active', 1)
                    ->where('show_home', 1)
                    ->limit(6)
                    ->get(),

                'collectionCat' => Category::select('id','name','image','url','slug')
                    ->where('is_active', 1)
                    ->where('is_deleted', 0)
                    ->where('category_type_id', 1)
                    ->orderByDesc('id')
                    ->get(),

                'collectionProd' => Product::where('is_active', 1)
                    ->where('is_deleted', 0)
                    ->whereIn('main_category_id', $collectionCategoryIds)
                    ->limit(24)
                    ->get(),

                'womencategory' => Category::select('name','image','url','slug')
                    ->where('is_active', 1)
                    ->where('is_deleted', 0)
                    ->where('parent_id', 1)
                    ->where('show_on_home', 1)
                    ->orderBy('priority')
                    ->limit(5)
                    ->get(),

                'mencategory' => Category::select('name','image','url','slug')
                    ->where('is_active', 1)
                    ->where('is_deleted', 0)
                    ->whereIn('parent_id', [2,3])
                    ->where('show_on_home', 1)
                    ->orderBy('priority')
                    ->limit(4)
                    ->get(),

                'twoCollection' => ProductCollection::where('collection_type', 'women')
                    ->limit(2)->get(),

                'thCollection' => ProductCollection::where('collection_type', 'women')
                    ->skip(2)->first(),

                'forCollection' => ProductCollection::where('collection_type', 'women')
                    ->skip(3)->limit(2)->get(),

                'tfCollection' => ProductCollection::where('collection_type', 'man')
                    ->limit(4)->get(),
            ];
        });

        $new_arrivals_product = Cache::remember('home_new_arrivals', 1800, function () {
            return Product::where('is_new_arrivals', 1)
                ->where('is_active', 1)
                ->where('is_deleted', 0)
                ->where('draf', false)
                ->orderByDesc('id')
                ->limit(12)
                ->get();
        });

        $bestproduct = Cache::remember('home_best_seller', 1800, function () {
            return Product::where('best_seller', 1)
                ->where('is_active', 1)
                ->where('is_deleted', 0)
                ->where('draf', false)
                ->orderByDesc('id')
                ->limit(12)
                ->get();
        });

        $isWishlisteddata = [];
        if ($user = Auth::guard('customer')->user()) {
            $isWishlisteddata = Wishlist::where('user_id', $user->id)
                ->pluck('product_id')
                ->toArray();
        }

        $referralCode = '';
        if (request()->referral && refCodeExist(request()->referral, true)) {
            $referralCode = request()->referral;
        }

        return view('front.modules.home.index', array_merge(
            $homeStatic,
            compact(
                'new_arrivals_product',
                'bestproduct',
                'isWishlisteddata',
                'referralCode'
            )
        ));
    }

    public function filterNewArrivals($categoryId)
    {
        $new_arrivals_product = Product::where('is_new_arrivals', 1)
            ->where("is_deleted", 0)
            ->where(['is_new_arrivals' => true, 'draf' => false])
            ->where('main_category_id', $categoryId)
            ->with(['product_main_images', 'productVariants.variantValues.variant_value', 'productVariants.variantValues.first_image'])->orderBy('id', 'desc')
            ->get();
        // Wishlist array agar required hai to pass karein
        $isWishlisted = auth()->check() ? auth()->user()->wishlist->pluck('product_id')->toArray() : [];

        return view('front.modules.partials.new_arrivals_slider', compact('new_arrivals_product', 'isWishlisted'));
    }

    public function bestSellerFilter(Request $request)
    {
        $products = Product::where('best_seller', 1)
            ->where('main_category_id', $request->category_id)->orderBy('id', 'desc')
            ->get();
        $html = view('front.modules.partials.best_seller_products', compact('products'))->render();
        return response()->json(['html' => $html]);
    }

    public function storeLocator()
    {
        return view('front.modules.pages.our-store');
    }

    public function contactUs()
    {
        return view('front.modules.pages.contact');
    }

    public function franchiseEnquiry()
    {
        return view('front.modules.pages.franchise_enquiry');
    }

    public function wholesaleEnquiry()
    {
        return view('front.modules.pages.wholesale-enquiry');
    }

    public function setCurrency(Request $request)
    {
        // Retrieve the selected currency from the request
        $selectedCurrency = $request->input('currency');
        // Set the selected currency in the session
        $request->session()->put('currency', $selectedCurrency);

        // You can return a response if needed
        return back();
    }

    public function variantCombinationPrices(Request $request)
    {
        try {
            $data = $request->json()->all();
            $productId = $data['product_id'] ?? null;
            $skuIds    = $data['vsku'] ?? null;
            $variantId = $data['variant_id'] ?? null;

            if (!$productId || !$skuIds) {
                return response()->json(['error' => 'Missing required data'], 422);
            }

            $combination = ProductVariantCombination::select('price', 'selling_price', 'sku', 'discount', 'discount_type','qty')
                ->where('product_id', $productId)
                ->where('combination_id', json_encode($skuIds))
                ->first();

            if (!$combination) {
                return response()->json(['error' => 'Combination not found'], 404);
            }

            // $images = ProductGraphics::where([
            //     'product_id' => $productId,
            //     'variant_id' => $variantId
            // ])->orderBy('is_front', 'desc')->get(['graphic', 'graphic_type']);

            $images = ProductGraphics::where([
                'product_id' => $productId,
                'variant_id' => $variantId
            ])
            ->orderBy('is_front', 'desc')   // front first
            ->orderBy('is_back', 'desc')    // back second
            ->orderBy('updated_at', 'asc')  // optional: stable order for rest
            ->get(['graphic', 'graphic_type', 'is_front', 'is_back']);

            return response()->json([
                'combination'   => $combination,
                'images'        => $images->map(fn($img) => [
                    'graphic'      => asset('uploads/products/' . $img->graphic),
                    'graphic_type' => $img->graphic_type,
                ]),
            ]);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Something went wrong', 'message' => $e->getMessage()], 500);
        }
    }

    // public function productListing(Request $request, $slug)
    // {
    //     $isWishlisteddata = [];
    //     $parent = '';
    //     $grandParent = '';
    //     $DB = Product::where('is_deleted', 0)
    //         ->where('is_active', 1)
    //         ->where('draf', false);
        
    //     if ($request->filled('sub_category_id')) {
    //         $category = Category::where('id', $request->sub_category_id)
    //         ->firstOrFail();

    //     } elseif ($request->filled('category_id')) {

    //         $category = Category::where('id', $request->category_id)
    //             ->firstOrFail();

    //     } else {

    //         $category = Category::where('slug', $slug)
    //             ->firstOrFail();
    //     }

       
    //     $categoryType = "category";


    //     $AllMainCategory = Category::select('id','name','slug','parent_id')->whereNull('parent_id')->where('is_active',1)->where('is_deleted',0)->get();
    //     $allSubCategory =  Category::select('id','name','slug','parent_id')->where('is_active',1)->where('is_deleted',0)->whereIn('parent_id',$AllMainCategory->pluck('id'))->get();

    //     $variants = Variant::where('is_active',1)->get(); 
    //     $variantColor = VariantValue::whereIn('variant_id',$variants->pluck('id'))->get();  
        
    //     if (is_null($category->parent_id)) {
    //         $DB->where('main_category_id', $category->id);
    //         $categoriesData = Category::where("is_active", 1)->where("is_deleted", 0)->where('parent_id', $category->id)->get();
    //     } 
    //     else {
    //         $parent = Category::find($category->parent_id);
    //         if ($parent && is_null($parent->parent_id)) {
    //             $DB->where(function ($q) use ($category) {
    //                 $q->where('main_sub_category_id', $category->id)
    //                 ->orWhere(function ($query) use ($category) {
    //                     $query->whereNotNull('sub_category_id')
    //                             ->whereRaw('JSON_VALID(sub_category_id)')
    //                             ->whereJsonContains('sub_category_id', (string) $category->id);
    //                 });
    //             });

    //             $categoriesData = Category::where("is_active", 1)->where("is_deleted", 0)->where('parent_id', $category->id)->get();
    //         } else {
    //             $grandParent = $parent ? Category::find($parent->parent_id) : null;
                
    //             $DB->where(function ($q) use ($category, $parent, $grandParent) {

    //                 // Child category
    //                 $q->where('main_child_category_id', $category->id)
    //                 ->orWhere(function ($query) use ($category) {
    //                     $query->whereNotNull('child_category_id')
    //                             ->whereRaw('JSON_VALID(child_category_id)')
    //                             ->whereJsonContains('child_category_id', (string) $category->id);
    //                 });

    //                 // Sub category constraint
    //                 if ($parent) {
    //                     $q->where(function ($qq) use ($parent) {
    //                         $qq->where('main_sub_category_id', $parent->id)
    //                         ->orWhereJsonContains('sub_category_id', (string) $parent->id);
    //                     });
    //                 }

    //                 // Main category constraint
    //                 if ($grandParent) {
    //                     $q->where('main_category_id', $grandParent->id);
    //                 }
    //             });

    //             $categoriesData = collect();
    //         }
    //     }


    //     if($request->has('category_id')){
    //         $DB->where('main_category_id',$request->category_id); 
    //     }
    //     if($request->has('sub_category_id')){
    //         $DB->where('main_sub_category_id',$request->sub_category_id); 
    //     }
    //     if ($request->has('price_range')) {
    //         if ($request->filled('price_range')) {
    //             [$min, $max] = explode('-', $request->price_range);
    //             $DB->whereBetween('selling_price', [
    //                 (int) $min,
    //                 (int) $max
    //             ]);
    //         }
    //     }
    //     if ($request->has('variantValuesColor')) {
    //         $selectedVariantValuesColor = $request->input('variantValuesColor');
    //         // Assuming you have a relation like getProductVariantValue() returning variant_value_ids
    //         $DB->whereHas('getProductVariantValue', function ($query) use ($selectedVariantValuesColor) {
    //             $query->where('variant_value_id', $selectedVariantValuesColor);
    //         });
    //     }
    //     switch ($request->sortBy) 
    //     {
    //         case 'new_arrivals':
    //             $DB->where('is_new_arrivals',1);
    //             break;

    //         case 'best_seller':
    //             $DB->where('best_seller', 1);
    //             break;

    //         case 'featured':
    //             $DB->where('is_featured', 1);
    //             break;

    //         case 'trending':
    //             $DB->where('trending',1); 
    //             break;

    //         case 'high_low':
    //             $DB->orderBy('selling_price', 'desc');
    //             break;

    //         default:
    //             $DB->orderBy('product_order', 'ASC');
    //             break;
    //     }

    //     // Pagination
    //     $offset = $request->input('offset', 0);
    //     $limit = $request->input('limit', config('Reading.records_per_page'));
    //     $totalResults = (clone $DB)->count();
    //     $results = $DB->take($limit)->offset($offset)->get();
    //     $hasMore = ($offset + $results->count()) < $totalResults;
    //     $variants = Variant::where("is_active", 1)->where("is_deleted", 0)->get();
    //     if ($category->parent_id !== null) {
    //         $parent = Category::find($category->parent_id);
    //         $grandParent = $parent ? Category::find($parent->parent_id) : null;
    //         $catAttributeIds = CategoryAttribute::where('category_id', $category->parent_id);
    //         if ($grandParent) {
    //             $catAttributeIds->orWhere('category_id', $grandParent->id);
    //         }
    //         $catAttributeIds = $catAttributeIds->pluck('attribute_id');
    //     } else {
    //         $catAttributeIds = CategoryAttribute::where('category_id', $category->id)
    //             ->pluck('attribute_id');
    //     }

    //     $attributes = Attribute::whereIn('id', $catAttributeIds)
    //         ->where('is_active', 1)
    //         ->where('is_deleted', 0)
    //         ->get();

    //     $user = Auth::guard('customer')->user();
    //     if ($user) {
    //         $isWishlisteddata = Wishlist::where('user_id', $user->id)
    //             ->pluck('product_id')
    //             ->toArray();
    //     }

    //     if ($request->ajax()) {
    //         return response()->json([
    //             'html' => view("front.modules.shop.load_more_data", compact('results', 'isWishlisteddata', 'totalResults','category','grandParent','parent','categoryType','categoriesData','slug','variants','attributes','limit','allSubCategory','AllMainCategory','variantColor'))->render(),
    //             'totalResults' => $totalResults,
    //             'hasMore' => $hasMore,
    //             'nextOffset' => $offset + $results->count(),
    //         ]);
    //     }
        
    //     // First page full response
    //     return view("front.modules.shop.index", compact(
    //         'results',
    //         'categoriesData',
    //         'totalResults',
    //         'slug',
    //         "variants",
    //         'attributes',
    //         'limit',
    //         'category',
    //         'categoryType',
    //         'isWishlisteddata',
    //         'parent',
    //         'grandParent',
    //         'AllMainCategory',
    //         'allSubCategory',
    //         'variantColor'
    //     ));
    // }



    public function productListing(Request $request, $path)
    {   
        $segments = array_values(array_filter(explode('/', $path)));
    
        $category = null;
        $subCategory = null;
        $subChildCategory = null;
        
        if(count($segments) === 1){
            $category = Category::whereNull('parent_id')->where('slug', $segments[0])->firstOrFail();
        }
        elseif (count($segments) === 2) {
            $category = Category::whereNull('parent_id')->where('slug', $segments[0])->firstOrFail();
            $subCategory = Category::where('parent_id', $category->id)->where('slug', $segments[1])->firstOrFail();

        } 
        elseif (count($segments) === 3) {
            $category = Category::whereNull('parent_id')->where('slug', $segments[0])->firstOrFail();
            $subCategory = Category::where('parent_id', $category->id)->where('slug', $segments[1])->firstOrFail();
            $subChildCategory = Category::where('parent_id', $subCategory->id)->where('slug', $segments[2])->firstOrFail();

        } else {
            abort(404);
        }

        $isWishlisteddata = [];
        $parent = '';
        $grandParent = '';

        $DB = Product::select('id','name','slug','buying_price','selling_price','discount','discount_type','sku')->where('is_deleted', 0)
            ->where('is_active', 1)
            ->where('draf', false);
        $hasCategoryFilter = $request->filled('category_id') || $request->filled('sub_category_id') ||  $request->filled('sub_child_category_id');
        if (!$hasCategoryFilter) {

            // Main Category
            if (count($segments) === 1) {
                $DB->where('main_category_id', $category->id);
                $categoriesData = Category::where('is_active', 1)
                    ->where('is_deleted', 0)
                    ->where('parent_id', $category->id)
                    ->get();
            }

                // Sub Category
            elseif (count($segments) === 2) {

                $DB->where(function ($q) use ($subCategory) {
                    $q->where('main_sub_category_id', $subCategory->id)
                        ->orWhere(function ($query) use ($subCategory) {
                            $query->whereNotNull('sub_category_id')
                                ->whereRaw('JSON_VALID(sub_category_id)')
                                ->whereJsonContains('sub_category_id', (string) $subCategory->id);
                        });
                });

                $categoriesData = Category::where('is_active', 1)
                    ->where('is_deleted', 0)
                    ->where('parent_id', $subCategory->id)
                    ->get();
            }

            // Sub Child Category
            elseif (count($segments) === 3) {

                $DB->where(function ($q) use ($subChildCategory) {
                    $q->where('main_child_category_id', $subChildCategory->id)
                        ->orWhere(function ($query) use ($subChildCategory) {
                            $query->whereNotNull('child_category_id')
                                ->whereRaw('JSON_VALID(child_category_id)')
                                ->whereJsonContains('child_category_id', (string) $subChildCategory->id);
                        });
                });

                $categoriesData = collect();
            }

        } else {

            $categoriesData = collect();
        }
        $categoryIds = (array) $request->input('category_id', []);

        if (!empty($categoryIds)) {
            $DB->whereIn('main_category_id', $categoryIds);
        }

        $subCategoryIds = (array) $request->input('sub_category_id', []);
        if (!empty($subCategoryIds)) {
            $DB->where(function ($q) use ($subCategoryIds) {
                $q->whereIn('main_sub_category_id',$subCategoryIds);
                foreach ($subCategoryIds as $id) {
                    $q->orWhereJsonContains('sub_category_id',(string) $id);
                }
            });
        }

        $subChildCategoryIds = (array) $request->input('sub_child_category_id',[]);
        if (!empty($subChildCategoryIds)) {
            $DB->where(function ($q) use ($subChildCategoryIds) {
                $q->whereIn('main_child_category_id',$subChildCategoryIds);
                foreach ($subChildCategoryIds as $id) {
                    $q->orWhereJsonContains('child_category_id',(string) $id);
                }
            });
        }
        $selectedVariantValuesColor = (array) $request->input('variantValuesColor',[]);
        if (!empty($selectedVariantValuesColor)) {
            $DB->whereHas('getProductVariantValue',function ($query) use ($selectedVariantValuesColor) {
                    $query->whereIn('variant_value_id',$selectedVariantValuesColor);
                }
            );
        }
        if ($request->filled('price_range')) {

            $range = explode('-',$request->input('price_range'));
            if (count($range) === 2) {

                $min = (int) $range[0];
                $max = (int) $range[1];

                if ($min <= $max) {
                    $DB->whereBetween('selling_price',[$min, $max]);
                }
            }
        }
        switch ($request->input('sortBy')) {

            case 'new_arrivals':
                $DB->where('is_new_arrivals', 1);
                break;

            case 'best_seller':
                $DB->where('best_seller', 1);
                break;

            case 'featured':
                $DB->where('is_featured', 1);
                break;

            case 'trending':
                $DB->where('trending', 1);
                break;
            case 'low_high':
                $DB->orderBy('selling_price','asc');
                break;

            case 'high_low':
                $DB->orderBy('selling_price','desc');
                break;

            default:
                $DB->orderBy('product_order','asc');
                break;
        }

        $offset = (int) $request->input('offset', 0);
        $limit = (int) $request->input('limit',config('Reading.records_per_page'));
        $totalResults = (clone $DB)->count();
        $results = $DB->offset($offset)->limit($limit)->get();
        $hasMore = ($offset + $results->count()) < $totalResults;
        
        if ($category->parent_id !== null) {
            $parent = Category::find($category->parent_id);
            $grandParent = $parent ? Category::find($parent->parent_id): null;
            $catAttributeIds = CategoryAttribute::where( 'category_id', $category->parent_id);
            if ($grandParent) {
                $catAttributeIds->orWhere('category_id',$grandParent->id);
            }
            $catAttributeIds = $catAttributeIds->pluck('attribute_id');
        } else {
            $catAttributeIds = CategoryAttribute::where('category_id',$category->id)->pluck('attribute_id');
        }

        $attributes = Attribute::whereIn('id',$catAttributeIds)->where('is_active', 1)->where('is_deleted', 0)->get();
        $AllMainCategory = Category::select('id','name','slug','parent_id')->whereNull('parent_id')->where('is_active', 1)->where('is_deleted', 0)->get();
        $allSubCategory = Category::select('id','name','slug','parent_id')->where('is_active', 1)->where('is_deleted', 0)->whereIn('parent_id',$AllMainCategory->pluck('id'))->get();
        $allChildCategory = Category::select('id','name','slug','parent_id')->where('is_active',1)->where('is_deleted',0)->whereIn('parent_id',$allSubCategory->pluck('id'))->get(); 

        $variants = Variant::where('is_active', 1)
            ->where('is_deleted', 0)
            ->get();
        $variantColor = VariantValue::whereIn('variant_id',$variants->pluck('id'))->get();
        $user = Auth::guard('customer')->user();

        if ($user) {
            $isWishlisteddata =Wishlist::where('user_id',$user->id)->pluck('product_id')->toArray();
        }
         
        if ($request->ajax()) {
            return response()->json([
                'html' => view('front.modules.shop.load_more_data',compact('results','isWishlisteddata','totalResults','category','grandParent','parent','categoriesData','variants','attributes','limit','allSubCategory','AllMainCategory','variantColor','path'))->render(),
                'totalResults' => $totalResults,
                'hasMore' => $hasMore,
                'nextOffset' => $offset + $results->count(),
            ]);
        } 
        return view('front.modules.shop.index',compact('results','categoriesData','totalResults','variants','attributes','limit','category','isWishlisteddata','parent','grandParent','AllMainCategory','allSubCategory','variantColor','hasMore','allChildCategory','path'));
    }

    public function collectionListing(Request $request, $slug)
    {
        $isWishlisteddata = [];
        $category= '';
        $DB = Product::where('is_deleted', 0)
            ->where('is_active', 1)
            ->where('draf', false);

        $category = Category::where('slug', $slug)->where('category_type_id', 1)->firstOrFail();
        
        if (empty($category)) {
            abort('404');
            // return redirect()->route('/');
        }
        $categoryType = "collection";
        $collectionId = $category->id;

        $colorArr = $request->input('colorArr');
        $sizeArr = $request->input('sizeArr');
        // Category filter logic

        if (is_null($category->parent_id)) {

            // $DB->where('main_category_id', $collectionId);
            //$DB->whereJsonContains('category_id', "$collectionId");
           $DB->where(function ($query) use ($collectionId) {
                   $query->whereNotNull('category_id')
                         ->where('category_id', '!=', '')
                         ->whereRaw('JSON_VALID(`category_id`) = 1')
                         ->whereJsonContains('category_id', (string) $collectionId);
               });
            $categoriesData = Category::where("is_active", 1)
                ->where('id', $collectionId)
                ->get();
        }
        if ($request->has('colors') && is_array($request->colors)) {
            $DB->whereIn('color', $request->colors);
        }
        if ($request->has('sizes') && is_array($request->sizes)) {
            $DB->whereHas('sizes', function ($q) use ($request) {
                $q->whereIn('size_value', $request->sizes);
            });
        }
        if ($request->has('price_range')) {
            $DB->where(function ($q) use ($request) {
                foreach ($request->price_range as $range) {
                    [$min, $max] = explode('-', $range);
                    $q->orWhereBetween('selling_price', [(int) $min, (int) $max]);
                }
            });
        }

        if ($request->has('variantValuesColor')) {
            $selectedVariantValuesColor = $request->input('variantValuesColor');
            // Assuming you have a relation like getProductVariantValue() returning variant_value_ids
            $DB->whereHas('getProductVariantValue', function ($query) use ($selectedVariantValuesColor) {
                $query->whereIn('variant_value_id', $selectedVariantValuesColor);
            });
        }

        if ($request->has('variantValuesSize')) {
            $selectedVariantValuesSize = $request->input('variantValuesSize');
            // Assuming you have a relation like getProductVariantValue() returning variant_value_ids
            $DB->whereHas('getProductVariantValue', function ($query) use ($selectedVariantValuesSize) {
                $query->whereIn('variant_value_id', $selectedVariantValuesSize);
            });
        }
        // dd($DB->toSql());

        // if ($request->has('variantValues')) {
        //     $selectedVariantValues = $request->input('variantValues');
        //     // Assuming you have a relation like getProductVariantValue() returning variant_value_ids
        //     $DB->whereHas('getProductVariantValue', function ($query) use ($selectedVariantValues) {
        //         $query->whereIn('variant_value_id', $selectedVariantValues);
        //     });
        // }
        if ($request->has('attributeValues')) {
            $selectedAttributeValues = $request->input('attributeValues');
            // Assuming you have a relation like getProductVariantValue() returning variant_value_ids
            $DB->whereHas('getProductAttributeValue', function ($query) use ($selectedAttributeValues) {
                $query->whereIn('attribute_value_id', $selectedAttributeValues);
            });
        }

        // Sorting
        switch ($request->sortBy) {
            case 'a_z':
                $DB->orderBy('name', 'asc');
                break;
            case 'z_a':
                $DB->orderBy('name', 'desc');
                break;
            case 'low_high':
                $DB->orderBy('selling_price', 'asc');
                break;
            case 'high_low':
                $DB->orderBy('selling_price', 'desc');
                break;
            default:
                $DB->orderBy('created_at', 'desc');
                break;
        }

        // Pagination
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', config('Reading.records_per_page'));

        $totalResults = (clone $DB)->count();
        $results = $DB->offset($offset)->limit($limit)->get();

        $variants = Variant::where("is_active", 1)->where("is_deleted", 0)->get();

        if ($category->parent_id !== null) {
            $parent = Category::find($category->parent_id);
            $grandParent = $parent ? Category::find($parent->parent_id) : null;

            $catAttributeIds = CategoryAttribute::where('category_id', $category->parent_id);

            if ($grandParent) {
                $catAttributeIds->orWhere('category_id', $grandParent->id);
            }

            $catAttributeIds = $catAttributeIds->pluck('attribute_id');
        } else {
            $catAttributeIds = CategoryAttribute::where('category_id', $category->id)
                ->pluck('attribute_id');
        }

        $attributes = Attribute::whereIn('id', $catAttributeIds)
            ->where('is_active', 1)
            ->where('is_deleted', 0)
            ->get();
        $user = Auth::guard('customer')->user();
        if ($user) {
            $isWishlisteddata = Wishlist::where('user_id', $user->id)
                ->pluck('product_id')
                ->toArray();
        }
        if ($request->ajax()) {
            return response()->json([
                'html' => view("front.modules.shop.load_more_data", compact('results', 'isWishlisteddata', 'totalResults', 'colorArr', 'sizeArr'))->render(),
                'totalResults' => $totalResults,
            ]);
        }

        // First page full response
        return view("front.modules.shop.index", compact(
            'results',
            'categoriesData',
            'totalResults',
            'slug',
            "variants",
            'attributes',
            'limit',
            'category',
            'categoryType',
            'isWishlisteddata',
            'colorArr',
            'sizeArr'
        ));
    }

    function getFrontBackImages($product_id)
    {
        $graphics = ProductGraphics::where('product_id', $product_id)->where('status', 1)->get();

        $frontImage = $graphics->firstWhere('is_front', 1);
        $backImage = $graphics->firstWhere('is_back', 1);
        $fallbackImages = $graphics->pluck('graphic')->take(2);

        return [
            !empty($frontImage) ? config('constant.PRODUCT_IMAGE_URL') . $frontImage->graphic : (!empty($fallbackImages[0]) ? config('constant.PRODUCT_IMAGE_URL') . $fallbackImages[0] : config('constant.IMAGE_URL') . 'noimage.png'),
            !empty($backImage)  ? config('constant.PRODUCT_IMAGE_URL') . $backImage->graphic  : (!empty($fallbackImages[1]) ? config('constant.PRODUCT_IMAGE_URL') . $fallbackImages[1] : config('constant.IMAGE_URL') . 'noimage.png')
        ];
    }

    public function productDetail(Request $request, $product, $title, $sku)
    {
        $isWishlisted = null;
        $isWishlisteddata = [];
        $productcat = '';
        $productSubCat = '';
        $productChildCat = '';
        $user = Auth::guard('customer')->user();
        $product = Product::where('sku', $sku)->first();
        if ($user) {

            RecentlyViewed::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'product_id' => $product->id
                ],
                [
                    'updated_at' => now()
                ]
            );

        } else {
            $recent = session()->get('recently_viewed', []);
            if (($key = array_search($product->id, $recent)) !== false) {
                unset($recent[$key]);
            }
            array_unshift($recent, $product->id);
            // keep only last 50
            $recent = array_slice($recent, 0, 50);
            session(['recently_viewed' => $recent]);
        }

        $productcat = Category::where('id', $product->main_category_id)->first();

        $productDetailId = explode(',',$productcat->product_detail_manager); 
        $productDetailManager = ProductDetailManager::whereIn('id',$productDetailId)->select('id','section_name','content','order')->orderBy('order','asc')->get(); 
        $productSubCat = Category::where('id', $product->main_sub_category_id)->first(); 
        
        $productChildCat = Category::where('id', $product->main_child_category_id)->first();
        
        $productreview = Product::with(['reviews.user'])->where('sku', $sku)->where('is_active', 1)->first();
        $reviews = $productreview->reviews()->latest()->get();
        $productVariantSpecification = ProductVariantSpecialization::where('product_id',$product->id)->get(); 

        $productvariants = ProductVariant::with([
            'variant:id,name,type',
            'variantValues.variant_value:id,name,color_code',
            'variantValues.first_image' => function ($q) use ($product) {
                $q->where('product_id', $product->id);
            }
        ])
            ->select('id', 'variant_id', 'product_id')
            ->where('product_id', $product->id)
            ->get()
        
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'variant_id' => $item->variant_id,
                    'product_id' => $item->product_id,
                    'variant_name' => $item->variant->name ?? null,
                    'variant_type' => $item->variant->type ?? null,
                    'variant_values' => $item->variantValues->map(function ($v) {
                        return [
                            'id' => $v->id,
                            'product_variant_id' => $v->product_variant_id,
                            'is_main' => $v->is_main,
                            'variant_value_id' => $v->variant_value_id,
                            'name' => $v->variant_value->name ?? null,
                            'color_code' => $v->variant_value->color_code ?? null,
                            'image' => $v->first_image?->graphic ?? null,
                        ];
                    })->toArray()
                ];
            })->toArray();
        // @dd($productvariants);
        $related_product_ids = Product::where('id', $product->id)->value('related_products');
        $related_ids_array = array_filter(explode(',', $related_product_ids));
        $related_products = Product::leftJoin('product_graphics', 'products.id', '=', 'product_graphics.product_id')
            ->whereIn('products.id', $related_ids_array)
            ->select(
                'products.id',
                'products.selling_price',
                'products.discount_type',
                'products.discount',
                'products.buying_price',
                'products.name',
                'products.sku',
                'products.short_description',
                'product_graphics.graphic as image'
            )
            ->groupBy('products.id')
            ->get();

        $productVarientCom = ProductVariantCombination::where('product_id', $product->id)->get();
        $bestproduct = Product::where('best_seller', 1)->where('is_active', 1)->where("is_deleted",  0)->where(['best_seller' => true, 'draf' => false])->orderBy('id', 'desc')->get();
        $releatedProduct = Product::with(['productVariants.variantValues.first_image'])->where('is_active', 1)->whereIn('id', [$product->related_products])->get();
        
        $returnexchangeProduct = Setting::where('id', 28)->first();
        $contactDetails = Setting::whereIn('key', ['Contact.contact_email', 'Contact.contact_number', 'Contact.whatsapp_number'])->get();
        $productCategoryId = Product::where('id', $product->id ?? 0)->pluck('main_category_id')->first();
        $categoryTaxes = CategoryTax::where('category_taxes.category_id', $productCategoryId ?? 0)
            ->leftJoin('taxes', 'taxes.id', '=', 'category_taxes.tax_id')
            ->select(
                'category_taxes.id',
                'category_taxes.category_id',
                'taxes.tax_type',
                'taxes.tax_option',
                'taxes.tax_from',
                'taxes.tax_to',
                'taxes.tax_rate'
            )
            ->get()->toArray();

        $recentlyViewedProducts = collect();

        if ($user) {

            $recentlyViewedProducts = Product::with(['productVariants.variantValues.first_image'])->where('is_active', 1)->whereIn(
                'id',
                RecentlyViewed::where('user_id', $user->id)
                    ->orderBy('updated_at', 'desc')
                    ->pluck('product_id')
            )->where('id', '!=', $product->id)->get();

        } else {

            $recentIds = session()->get('recently_viewed', []);

            $recentlyViewedProducts = Product::with(['productVariants.variantValues.first_image'])->where('is_active', 1)->whereIn('id', $recentIds)->where('id', '!=', $product->id)->get();
        } 

        if ($user) {
            $isWishlisted = Wishlist::where('user_id', $user->id)
                ->where('product_id', $product->id)
                ->exists();

            $isWishlisteddata = Wishlist::where('user_id', $user->id)
                ->pluck('product_id')
                ->toArray();
        }
        $best_seller_products = Product::where('best_seller', 1)->where('is_active', 1)->orderBy('id', 'desc')->get();

        $facebook = Setting::select('id','value')->where('key','Social.facebook')->first();
        $instagram = Setting::select('id','value')->where('key','Social.instagram')->first(); 
        $pinterst = Setting::select('id','value')->where('key','Social.pinterest')->first(); 
        $youtube = Setting::select('id','value')->where('key','Social.youtube')->first(); 
        $twitter = Setting::select('id','value')->where('key','Social.twitter')->first();        

        return view('front.modules.shop.product-detail', compact('product','productChildCat', 'productcat', 'productSubCat', 'productvariants', 'related_products', 'bestproduct', 'releatedProduct', 'returnexchangeProduct', 'contactDetails', 'productVarientCom', 'isWishlisted', 'isWishlisteddata', 'categoryTaxes', 'reviews', 'productreview', 'recentlyViewedProducts','productVariantSpecification','facebook','instagram','pinterst','youtube','twitter','productDetailManager', 'best_seller_products'));
    }

    public function viewBag()
    {       
        try {
            $isWishlisted = [];
            $cartItems = [];

            if (auth()->guard('customer')->check()) {
                $userId = auth()->guard('customer')->user()->id;
                $cartRecords = Cart::where('user_id', $userId)->get();
                 
                foreach ($cartRecords as $cart) {
                    $product = Product::select('id','name','slug','buying_price','selling_price')->where('id',$cart->product_id)->first();
                    if ($product) {
                        $cartItems[] = [
                            'product' => $product,
                            'quantity' => $cart->quantity,
                            'card_id' => $cart->id 
                        ];
                    }
                }
            }
            $user = Auth::guard('customer')->user();
            if ($user) {
                $isWishlisted = Wishlist::where('user_id', $user->id)
                    ->pluck('product_id')
                    ->toArray();
            }
        
             $bestproduct = Product::where('best_seller', 1)->where("is_deleted",  0)->where(['best_seller' => true, 'draf' => false])->orderBy('id', 'desc')->get();
             $recentViewproduct = RecentlyViewed::with('product')->get(); 
     
            $cart = Cart::with('product')
                    ->where('user_id', Auth::guard('customer')->id())
                    ->get();

                $cart->each(function ($cartItem) {

                $combination = ProductVariantCombination::find(
                    $cartItem->product_variant_combination_id
                );

                info("----combination----", [$combination]);

                $selectedVariants = [];

                if ($combination && $combination->primary_variant_value_id) {

                    $variantValue = VariantValue::with('variant')
                        ->find($combination->primary_variant_value_id);

                    info("---------variantValue---------", [
                        $variantValue
                    ]);

                    if ($variantValue && $variantValue->variant) {

                        $selectedVariants[
                            strtolower($variantValue->variant->name)
                        ] = $variantValue->name;
                    }
                }

                $cartItem->selectedVariants = $selectedVariants;
                $cartItem->sku = $combination->sku ; 
                $cartItem->productType = $cartItem->product_type; 
                $cartItem->sellingPrice = $combination->selling_price ?? 0;
                $cartItem->discountAmount = $combination->discount ?? 0;
                $cartItem->discountType = $combination->discount_type ?? '';
                $cartItem->quantity = $cartItem->quantity ?? 1;
                $cartItem->price = $combination->price ?? 0; 
                $cartItem->name = $cartItem->product->name; 
                $productCategoryId = $cartItem->product->main_category_id ?? 0;

                $categoryTaxes = CategoryTax::where(
                    'category_taxes.category_id',
                    $productCategoryId
                )->get();

                $cartItem->rawTaxArr = $categoryTaxes->toJson();
               
            });

            return view('front.modules.products.viewbag', compact('cartItems', 'bestproduct', 'isWishlisted','recentViewproduct','cart'));
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->with(['error' => 'Unable to load cart', 'error_msg' => $e->getMessage()]);
        }
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        Subscriber::create([
            'email' => $request->email,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Thank you for subscribing!'
        ]);
    }

    /*public function giftStore(Request $request)
    {
        $request->validate([
            'resiver_name' => 'required|string|max:100',
            'message'      => 'nullable|string|max:255',
            'sender_name'  => 'required|string|max:100',
        ]);

        GiftWrap::create([
            'receiver_name' => $request->resiver_name,
            'message'       => $request->message,
            'sender_name'   => $request->sender_name,
        ]);

        return back()->with('success', 'Gift details saved successfully!');
    }*/

    public function checkoutBag()
    {
        try {

            $cartItems = [];
            $userBillingAddress = [];
            $usershippingAddress = [];
            $userRecord = null;
            $userId = null;

            if (auth()->guard('customer')->check()) {

                $userId = auth()->guard('customer')->user()->id;

                $buyNow = session('buy_now');

                if (!empty($buyNow)) {

                    $product = Product::select(
                        'id',
                        'name',
                        'slug',
                        'buying_price',
                        'selling_price'
                    )
                        ->where('id', $buyNow['product_id'])
                        ->first();

                    if ($product) {

                        $cartItems[] = [
                            'product'  => $product,
                            'quantity' => $buyNow['quantity'],
                        ];
                    }

                } else {

                    $cartRecords = Cart::where(
                        'user_id',
                        $userId
                    )->get();

                    foreach ($cartRecords as $cart) {

                        $product = Product::select(
                            'id',
                            'name',
                            'slug',
                            'buying_price',
                            'selling_price'
                        )
                            ->where('id', $cart->product_id)
                            ->first();

                        if ($product) {

                            $cartItems[] = [
                                'product'  => $product,
                                'quantity' => $cart->quantity,
                                'card_id'  => $cart->id
                            ];
                        }
                    }
                }

                $userRecord = User::where(
                    'id',
                    $userId
                )->first();

                $userBillingAddress = UserAddress::with([
                    'country',
                    'state',
                    'city'
                ])
                    ->where([
                        'user_id' => $userId,
                        'type'    => 'billing'
                    ])
                    ->orderBy('id', 'desc')
                    ->get();

                $usershippingAddress = UserAddress::with([
                    'country',
                    'state',
                    'city'
                ])
                    ->where([
                        'user_id' => $userId,
                        'type'    => 'shipping'
                    ])
                    ->orderBy('id', 'desc')
                    ->get();
            }

            /*
            |--------------------------------------------------------------------------
            | User Wallet
            |--------------------------------------------------------------------------
            */

            $userwallet = User::where(
                'id',
                $userId
            )->first();

            /*
            |--------------------------------------------------------------------------
            | Countries
            |--------------------------------------------------------------------------
            */

            $countries = Country::where(
                'is_active',
                1
            )
                ->pluck(
                    'name',
                    'id'
                );

            /*
            |--------------------------------------------------------------------------
            | States
            |--------------------------------------------------------------------------
            */

            $states = State::where(
                'country_id',
                101
            )
                ->where(
                    'is_active',
                    1
                )
                ->pluck(
                    'name',
                    'id'
                );

            /*
            |--------------------------------------------------------------------------
            | Cities
            |--------------------------------------------------------------------------
            */

            $citys = City::where(
                'is_active',
                1
            )->get();

            /*
            |--------------------------------------------------------------------------
            | Invoice Setting
            |--------------------------------------------------------------------------
            */

            $invoiceSetting = InvoiceSetting::first();

            /*
            |--------------------------------------------------------------------------
            | Cart
            |--------------------------------------------------------------------------
            */

            $cart = Cart::with('product')
                ->where(
                    'user_id',
                    Auth::guard('customer')->id()
                )
                ->get();

            /*
            |--------------------------------------------------------------------------
            | Prepare Cart Items
            |--------------------------------------------------------------------------
            */

            $cart->each(function ($cartItem) {

                /*
                |--------------------------------------------------------------------------
                | Product Variant Combination
                |--------------------------------------------------------------------------
                */

                $combination = ProductVariantCombination::find(
                    $cartItem->product_variant_combination_id
                );

                info(
                    '----combination----',
                    [
                        $combination
                    ]
                );

                /*
                |--------------------------------------------------------------------------
                | Selected Variants
                |--------------------------------------------------------------------------
                */

                $selectedVariants = [];

                if (
                    $combination &&
                    $combination->primary_variant_value_id
                ) {

                    $variantValue = VariantValue::with('variant')
                        ->find(
                            $combination->primary_variant_value_id
                        );

                    info(
                        '---------variantValue---------',
                        [
                            $variantValue
                        ]
                    );

                    if (
                        $variantValue &&
                        $variantValue->variant
                    ) {

                        $selectedVariants[
                            strtolower(
                                $variantValue->variant->name
                            )
                        ] = $variantValue->name;
                    }
                }

                $cartItem->selectedVariants = $selectedVariants;

                /*
                |--------------------------------------------------------------------------
                | Product / Variant Details
                |--------------------------------------------------------------------------
                */

                $cartItem->sku = $combination?->sku ?? '';

                $cartItem->productType =
                    $cartItem->product_type;

                $cartItem->sellingPrice =
                    $combination?->selling_price ?? 0;

                $cartItem->discountAmount =
                    $combination?->discount ?? 0;

                $cartItem->discountType =
                    $combination?->discount_type ?? '';

                $cartItem->quantity =
                    $cartItem->quantity ?? 1;

                $cartItem->price =
                    $combination?->price ?? 0;

                $cartItem->name =
                    $cartItem->product?->name ?? '';

                /*
                |--------------------------------------------------------------------------
                | Product Category
                |--------------------------------------------------------------------------
                */

                $productCategoryId =
                    $cartItem->product?->main_category_id ?? 0;

                /*
                |--------------------------------------------------------------------------
                | Category Taxes
                |--------------------------------------------------------------------------
                */

                $categoryTaxes = CategoryTax::where(
                    'category_taxes.category_id',
                    $productCategoryId
                )->get();

                /*
                |--------------------------------------------------------------------------
                | Tax Variables
                |--------------------------------------------------------------------------
                */

                $taxPrice = 0;
                $taxOption = '';
                $taxType = '';

                /*
                |--------------------------------------------------------------------------
                | Calculate Tax
                |--------------------------------------------------------------------------
                |
                | tax_option = inclusive
                | tax_type   = flat
                |
                | Flat tax is calculated per quantity.
                |
                */

                foreach ($categoryTaxes as $tax) {

                    $taxOption = $tax->tax_option ?? '';

                    $taxType = $tax->tax_type ?? '';

                    $taxId = $tax->tax_id ?? ''; 

                    if (
                        $taxOption === 'inclusive' &&
                        $taxType === 'flat'
                    ) {

                        $flatTax = (float) (
                            $tax->tax ?? 0
                        );

                        $quantity = (int) (
                            $cartItem->quantity ?? 1
                        );

                        $taxPrice +=
                            $flatTax * $quantity;
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | Append Tax Details To Cart Item
                |--------------------------------------------------------------------------
                */

                $cartItem->tax_price = $taxPrice;

                $cartItem->tax_option = $taxOption;

                $cartItem->tax_type = $taxType;
                $cartItem->tax_id = $taxId; 

                /*
                |--------------------------------------------------------------------------
                | Raw Tax Array
                |--------------------------------------------------------------------------
                */

                $cartItem->rawTaxArr =
                    $categoryTaxes->toJson();
            });

            /*
            |--------------------------------------------------------------------------
            | Checkout View
            |--------------------------------------------------------------------------
            */

            return view(
                'front.modules.products.checkout',
                compact(
                    'cartItems',
                    'countries',
                    'userBillingAddress',
                    'usershippingAddress',
                    'states',
                    'userwallet',
                    'invoiceSetting',
                    'userRecord',
                    'cart'
                )
            );

        } catch (\Exception $e) {

            Log::error($e);

            return redirect()->back()->with([
                'error'     => 'Unable to load cart',
                'error_msg' => $e->getMessage()
            ]);
        }
    }

    public function dynamicPages(Request $request, $slug)
    {
        $page = FooterSubcategory::where('slug', $slug)->firstOrFail();
        $category = $page->footer_category_id;
        $pcategory = FooterCategory::where('id', $category)->firstOrFail();

        $relatedSubcategories = $pcategory->subcategories->sortBy('order_number');
        if ($page->type == 'url' && !empty($page->url)) {
            if ($slug == 'faq') {
                $faqs = Faq::where('is_active', '1')->orderBy('id', 'asc')->get();
                return view('front.modules.pages.faq', compact('faqs', 'relatedSubcategories', 'page'));
            }
            return redirect()->away($page->url);
        }

        return view('front.modules.pages.index', compact('page', 'relatedSubcategories'));
    }

    public function blog()
    {
        $blogs = Blog::where('is_active', '1')->orderBy('id', 'desc')->paginate(6);
        return view('front.modules.blog.blog', compact('blogs'));
    }

    public function blogList(Request $request)
    {
        $DB = Blog::where('is_active', 1)->orderBy('id', 'desc');
        // Pagination
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', Config("Reading.records_per_blog"));
        $totalResults = $DB->count();
        $results = $DB->offset($offset)->limit($limit)->get();
        // Return view
        if ($request->ajax()) {
            return response()->json([
                'html' => view("front.modules.blog.load-more-data", compact('results', 'totalResults', 'limit', 'offset'))->render(),
                'totalResults' => $totalResults,
            ]);
        } else {
            return view("front.modules.blog.blog-list", compact('results', 'totalResults', 'limit', 'offset'));
        }
    }

    public function blogDetails(Request $request, $slug)
    {
        $blogs = Blog::where('is_active', '1')->orderBy('id', 'desc')->paginate(6);
        $details = Blog::where('blog_slug', $slug)->firstOrFail();
        $bestproduct = Product::where('best_seller', 1)->where("is_deleted",  0)->where(['best_seller' => true, 'draf' => false])->get();
        return view('front.modules.blog.blog-detail', compact('details', 'bestproduct', 'blogs'));
    }

    public function getStates($countryId)
    {
        $states = State::where('country_id', $countryId)->where('is_active', 1)->pluck('name', 'id');
        return response()->json($states);
    }

    public function getCities($stateId)
    {
        $cities = City::where('state_id', $stateId)->pluck('name', 'id');
        return response()->json($cities);
    }

    public function order_confirm($id)
    {
        $PrdId = decrypt($id);

        $order = Order::find($PrdId);
        return view('front.order-confirm', compact('order'));
    }

    /*public function productSearch(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->take(6)
            ->get();
            
            $categorys = Category::where('name', 'LIKE', "%{$query}%")
            ->take(6)
            ->get();
        $html = view('front.modules.home.product-search', compact('products','categorys'))->render();

        return response()->json(['html' => $html]);
    }*/


    public function productSearch(Request $request)
    {
        $query = $request->input('query');
        $categoryId = $request->input('category_id');

        $products = Product::query();

        if ($query) {
            $products->where('name', 'LIKE', "%{$query}%");
        }

        if ($categoryId) {
            $products->where(function ($q) use ($categoryId) {
                $q->where('main_category_id', $categoryId)
                    ->orWhere('main_sub_category_id', $categoryId)
                    ->orWhere('main_child_category_id', $categoryId);
            });
        }

        $categorys = Category::where('name', 'LIKE', "%{$query}%")
            ->whereNotNull('parent_id')
            ->where('is_deleted', 0)
            ->where('is_active', 1)
            ->get();

        $products = $products->take(6)->orderBy('id', 'desc')->get();

        $html = view('front.modules.home.product-search', compact('products', 'categorys', 'query'))->render();

        return response()->json(['html' => $html]);
    }


    public function viewAll(Request $request)
    {
        $query = $request->get('q'); // jo keyword search hua tha
        $categoryId  = $request->get('categoryId');
        $categoryName = '';
        // Products search logic
        if(!empty($categoryId)){
            $categoryIds = Category::where('is_active', 1)->where('id', $categoryId)->where('is_deleted', 0)->where('category_type_id', '!=', 1)->pluck('id')->toArray();
            $categoryNameArr = Category::where('is_active', 1)->where('id', $categoryId)->where('is_deleted', 0)->first();
            if(!empty($categoryNameArr)){
                $categoryName = '/'.$categoryNameArr->name;
            }
        } else {
            $categoryIds = Category::where('is_active', 1)->where('is_deleted', 0)->where('category_type_id', '!=', 1)->pluck('id')->toArray();
        }
        $products = Product::where('name', 'LIKE', "%{$query}%")->whereIn('main_category_id', $categoryIds)->orderBy('id', 'desc')
            ->get(); // paginate karna best hai
        return view('front.modules.home.search-results', compact('products', 'query','categoryName'));
    }

    public function productSearchDefault(Request $request)
    {
        $query = $request->input('query');
        $categoryIds = Category::whereNull('parent_id')->where('category_type_id', 2)->pluck('id');

        $products = Product::query();
        if ($query) {
            $products->where('name', 'LIKE', "%{$query}%");
        }
        if ($categoryIds) {
            $products->where(function ($q) use ($categoryIds) {
                $q->whereIn('main_category_id', $categoryIds);
            });
        }
        $categorys = Category::whereIn('parent_id', $categoryIds)->get();
        $products = $products->where('is_active',1)->where('is_deleted',0)->take(6)->orderBy('id', 'desc')->get();
        $html = view('front.modules.home.product-search', compact('products', 'categorys', 'query'))->render();
        return response()->json(['html' => $html]);
    }


    public function variantStockCheck(Request $request)
    {
        $stock = ProductVariantCombination::where('product_id', $request->product_id)
            ->whereJsonContains('combination_id',  (int) $request->variant_value_id)->where('is_out_of_stock', 1)
            ->count();
        return response()->json([
            'out_of_stock' => $stock > 0
        ]);
    }

    public function getExactVariantComboQty(Request $request)
    {
        $product_id = $request->product_id;
        $sku = $request->sku;
        $getExactVariantComboQty = 0;
        if(!empty($product_id) && !empty($sku)){
            if(time() > Session::get($product_id.'_'.$sku.'_expire')){
                $qtyArr = ProductVariantCombination::where('product_id', $product_id)->where('sku', $sku)->where('status', '1')->select('qty')->first();
                if(!empty($qtyArr)){
                    $getExactVariantComboQty =  $qtyArr->qty;
                    Session::put($product_id.'_'.$sku , $getExactVariantComboQty);
                    Session::put($product_id.'_'.$sku.'_expire', time() + 600);
                    
                    //$_SESSION[$product_id][$sku] = $getExactVariantComboQty;
                   // $_SESSION[$product_id][$sku]['expire'] = time() + 120; // 120 = 2 minutes
                }
            } else {
                // $getExactVariantComboQty =  $_SESSION[$product_id][$sku];
                $getExactVariantComboQty =  Session::get($product_id.'_'.$sku);
            }
        }
        return $getExactVariantComboQty;
    }

    public function isOutOfStock(Request $request)
    {
        $variant_sku = $request->variant_sku;
        $product_id = $request->product_id;
        
        $isOutOfStock = false;
        if(!empty($product_id)){
            $productArr = Product::select('sku')->where('id', $product_id)->where('in_stock', 1)->first();
            if(empty($productArr)){
                $isOutOfStock = true;
            } else {
                if(!empty($variant_sku) && !empty($productArr->sku)){
                    $variant_sku =  strtolower($productArr->sku).'_'.$variant_sku;
                    $variantArr = ProductVariantCombination::where('sku', $variant_sku)->where('qty', 0)->first();
                    if(!empty($variantArr)){
                        $isOutOfStock = true;
                    }
                } 
            }
        }
        return $isOutOfStock;
    }

    public function storeNewsletterRecord(Request $request)
    {
        $email = $request->email;
        
        Subscriber::create([
            'email'=>$email
        ]); 
        
        return redirect()->back()->with('success', 'Your email is added');
    }

    public function headerProductSearch(Request $request)
    {
        $searchValue = $request->searchValue; 
        
        $products = Product::select('id','name','sku','slug','buying_price','selling_price')->where('is_active', 1)
                   ->where('is_deleted', 0)
                   ->where(function($query) use ($searchValue) {
                       $query->where('name', 'LIKE', '%' . $searchValue . '%')
                             ->orWhere('sku', 'LIKE', '%' . $searchValue . '%')
                             ->orWhere('slug', 'LIKE', '%' . $searchValue . '%');
                   })->take(12)
                   ->get();

        if(count($products) > 0){
            return response()->json([
                'success'=>true, 
                'data'=>$products->map(function($product){
                    return [
                        'name'=>$product->name,
                        'sku'=>$product->sku,
                        'images'=>$product->images,
                        'buying_price'=>$product->buying_price,
                        'selling_price'=>$product->selling_price,
                        'slug'=>productSlug($product->name)
                    ]; 
                }),
                
            ]); 
        }
        else{
            return response()->json([
                'success'=>false,
            ]); 
        }           
    }

    public function getSubAndChildCategory(Request $request){
        $parentId = $request->parentId; 
        $subcategories = Category::where('parent_id', $parentId)->where('is_active',1)->where('is_deleted',0)->get();
        return response()->json($subcategories);
    }

    public function removeCartProduct(Request $request)
    {
        $cart = Cart::where('id', $request->cartId)
            ->where('user_id', auth()->guard('customer')->id())
            ->first();

        if (!$cart) {
            return response()->json([
                'success' => false,
                'message' => 'Cart item not found'
            ], 404);
        }

        $cart->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product removed from cart'
        ]);
    }

    public function getProductVariantImages(Request $request)
    {
        $productId = $request->product_id; 
        $variantValueId = $request->variant_value_id;       
        $productVariant = ProductVariantValue::where('product_id', $productId)
        ->where('variant_value_id', $variantValueId)
        ->first();
        if (!$productVariant) {
            return response()->json([
                'first_image' => null,
                'second_image' => null,
            ]);
        }

        $graphics = ProductGraphics::where('product_id', $productId)
            ->where('variant_id', $productVariant->variant_value_id)
            ->where('graphic_type', 'image')
            ->where('is_front',1)
            ->get();

        $images = $graphics->pluck('graphic')->filter()->values();      
        return response()->json([
            'first_image' => isset($images[0])
                ? asset('uploads/products/' . $images[0])
                : null,
        ]);
    }
}
