<?php 
namespace App\Models; 
use App\Models\ProductGraphics ;
use Eloquent;
/**
 * Review Model
 */
class ProductVariantValue extends Eloquent {
    protected $table = 'product_variant_values';

    protected $fillable = [
        'product_variant_id',
        'variant_value_id',
        'product_id',
    ];
    
	public function variant_value() {
        return $this->belongsTo(VariantValue::class, 'variant_value_id')->select(['id', 'variant_id','name']);
    }

 
    public function first_image()
    {
        return $this->hasOne(ProductGraphics::class, 'variant_id', 'variant_value_id')
                    ->where('graphic_type', 'image')
                    ->where('status', 1)
                    ->orderBy('id'); // or created_at if preferred
    }
    
    
    // public function variantValue()
    // {
    //     return $this->belongsTo(VariantValue::class, 'variant_value_id');
    // }

    // public function productVariant()
    // {
    //     return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    // }
}
