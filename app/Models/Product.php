<?php

namespace App\Models;

use App\Models\ChildCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ProductImage;
use App\Models\ProductVariantCombination;
use App\Models\ProductVariantCombinationImage;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use App\Models\UserReview;
use App\Models\ProductGraphics;
use App\Models\ProductVariantValue;

use DB;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = [
        "images",
        "color_options"

    ];

    public function product_main_images()
    {
        return $this->hasMany(ProductGraphics::class, 'product_id', 'id');
    }

    public function getImagesAttribute()
    {
        $imgs = $this->product_main_images;

        $front = null;
        $back = null;

        foreach ($imgs as $img) {
            if ($img->is_front && !$front) $front = $img->graphic;
            if ($img->is_back && !$back) $back = $img->graphic;
            if ($front && $back) break;
        }

        $fallback = $imgs->pluck('graphic');
        $first = $front ?? $fallback->get(0);
        $second = $back ?? $fallback->get(1) ?? $first;

        return [
            'first'  => Config('constant.PRODUCT_IMAGE_URL') . $first,
            'second' => Config('constant.PRODUCT_IMAGE_URL') . $second
        ];
    }


    public function getColorOptionsAttribute()
    {
        $colors = collect();

        foreach ($this->productVariants as $productVariant) {
            foreach ($productVariant->variantValues as $variantValue) {
                if ($variantValue->variant_value && $variantValue->variant_value->variant_id == 1) {
                    $colors->push($variantValue->variant_value);
                }
            }
        }

        return $colors->unique('id')->values();
    }



    public function category()
    {
        return $this->belongsTo(Category::class, "category_id")->with('parentcategory');
    }

    public function subCategory()
    {
        return $this->belongsTo(Category::class, 'sub_category_id');
    }


    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    public function ProductVariantCombination()
    {
        return $this->hasMany(ProductVariantCombination::class, 'product_id');
    }

    public function reviews()
    {
        return $this->hasMany(UserReview::class, 'product_id')
            ->where('is_active', 1);
    }

    public function getWishlists()
    {
        return $this->hasMany(Wishlist::class, 'product_id');
    }

    public function getProductVariantValue()
    {
        return $this->hasMany(ProductVariantValue::class, 'product_id');
    }

    public function getProductAttributeValue()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }
}
