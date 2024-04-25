<?php

namespace Modules\Product\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Media\app\Models\Media;
use Modules\Order\app\Models\OrderDetails;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'brand_id', 'slug', 'image', 'images', 'price', 'discount', 'discount_type', 'cost_per_item', 'stock', 'stock_status', 'tags', 'attributes', 'sku', 'status', 'has_variant', 'is_featured', 'is_bestseller', 'is_new', 'is_top', 'is_hot', 'is_warranty', 'warranty_duration', 'is_return', 'is_exchangeable', 'is_refundable', 'is_cod', 'is_emi', 'is_guest_checkout', 'badge', 'unit_id', 'qty', 'video_link', 'meta_title', 'meta_description', 'created_by', 'updated_by', 'deleted_by', 'viewed', 'is_partial', 'partial_amount', 'delivery_location', 'buyone_getone', 'is_wholesale', 'is_pre_order', 'release_date', 'max_product', 'is_undefine', 'is_flash_deal', 'offer_start_date', 'offer_end_date', 'is_verified', 'return_policy_id', 'show_homepage',
    ];


    protected $casts = [
        'images' => 'array',
        'attributes' => 'array',
    ];

    protected $appends = [
        'name', 'short_description', 'additional_information', 'description', 'tags', 'image_url', 'actual_price', 'stock_status', 'has_variant'
    ];

    public function getNameAttribute(): ?string
    {
        return $this->translation?->name;
    }

    public function getHasVariantAttribute(): bool
    {
        return $this->variants->count() > 0;
    }

    public function getShortDescriptionAttribute(): ?string
    {
        return $this->translation?->short_description;
    }
    public function getAdditionalInformationAttribute(): ?string
    {
        return $this->translation?->additional_information;
    }
    public function getDescriptionAttribute(): ?string
    {
        return $this->translation?->description;
    }
    public function getMetaTitleAttribute(): ?string
    {
        return $this->translation?->meta_title;
    }
    public function getMetaKeywordsAttribute(): ?string
    {
        return $this->translation?->meta_keywords;
    }
    public function getMetaDescriptionAttribute(): ?string
    {
        return $this->translation?->meta_description;
    }
    public function getTagsAttribute(): ?string
    {
        return $this->translation?->tags;
    }

    public function translation(): ?HasOne
    {
        return $this->hasOne(ProductTranslation::class)->where('lang_code', getSessionLanguage());
    }

    public function getTranslation($code): ?ProductTranslation
    {
        return $this->hasOne(ProductTranslation::class)->where('lang_code', $code)->first();
    }

    public function translations(): ?HasMany
    {
        return $this->hasMany(ProductTranslation::class, 'product_id');
    }

    public function productCategories()
    {
        return $this->hasMany(ProductCategory::class, 'product_id', 'id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function brand()
    {
        return $this->belongsTo(ProductBrand::class, 'brand_id', 'id');
    }

    public function getImagesAttribute($value)
    {
        return json_decode($value);
    }

    public function setImagesAttribute($value)
    {
        $this->attributes['images'] = json_encode($value);
    }

    public function setTagsAttribute($value)
    {
        $this->attributes['tags'] = json_encode($value);
    }

    public function mediaImage()
    {
        return $this->belongsTo(Media::class, 'image', 'id');
    }

    public function getImageUrlAttribute()
    {
        return $this->mediaImage?->path;
    }

    public function setAttributesAttribute($value)
    {
        $this->attributes['attributes'] = json_encode($value);
    }

    public function getPriceAttribute($value)
    {
        return number_format($value, 2);
    }

    public function getDiscountAttribute($value)
    {
        return number_format($value, 2);
    }

    public function getCostPerItemAttribute($value)
    {
        return number_format($value, 2);
    }

    public function getStockAttribute($value)
    {
        return number_format($value, 0);
    }

    public function getActualPriceAttribute()
    {
        $price = str_replace(',', '', $this->price);
        dd(floatval($price));
        if ($this->discount_type == 'fixed') {
            return number_format($this->price - $this->discount, 2);
        } else {
            return number_format($this->price - ($this->price * $this->discount / 100), 2);
        }
    }

    public function orders()
    {
        return $this->hasMany(OrderDetails::class, 'product_id', 'id');
    }
    public function relatedProducts()
    {
        return $this->hasMany(RelatedProduct::class, 'product_id', 'id');
    }

    public function getStockStatusAttribute($value)
    {
        return $value == 'in_stock' ? 'In Stock' : 'Out of Stock';
    }

    // variations section

    public function variants()
    {
        return $this->hasMany(Variant::class, 'product_id', 'id');
    }

    public function getAttributeAndValuesAttribute()
    {
        $attr = $this->variants->flatMap(function ($variant) {
            return $variant->options->map(function ($option) {
                return [
                    'attribute_id' => $option->attribute_id,
                    'attribute_value_id' => $option->attribute_value_id,
                    'attribute' => $option->attribute->name,
                    'attribute_value' => $option->attributeValue->name,
                ];
            });
        });

        $uniqueAttributes = $attr->unique('attribute')->values();

        $uniqueAttrWithValue = $uniqueAttributes->map(function ($uniqueAttr) use ($attr) {
            $values = $attr->filter(function ($item) use ($uniqueAttr) {
                return $item['attribute'] === $uniqueAttr['attribute'];
            })->map(function ($item) {
                return [
                    'id' => $item['attribute_value_id'],
                    'value' => $item['attribute_value']
                ];
            })->unique('id')->values()->toArray();

            return [
                'attribute_id' => $uniqueAttr['attribute_id'],
                'attribute' => $uniqueAttr['attribute'],
                'attribute_values' => $values,
            ];
        });

        return $uniqueAttrWithValue;
    }

    // get all variants price and sku with attribute value ids
    public function getVariantsPriceAndSkuAttribute()
    {
        $this->load('variants.variantOptions.attributeValue');

        $variantsPriceAndSku = [];

        foreach ($this->variants as $variant) {
            $variantsPriceAndSku[$variant->id] = [
                'price' => $variant->price,
                'currency_price' => currency($variant->price),
                'sku' => $variant->sku,
                'attribute_value_ids' => $variant->options->pluck('attribute_value_id')->toArray(),
            ];
        }

        return $variantsPriceAndSku;
    }

    public function getVariantsWithAttributes()
    {
        $this->load('variants.variantOptions.attributeValue.attribute');

        $variantsWithAttributes = [];

        foreach ($this->variants as $variant) {

            foreach ($variant->variantOptions as $variantOption) {
                $attributeValue = $variantOption->attributeValue;
                $attribute = $attributeValue->attribute;

                $variantsWithAttributes[$variant->id][] = [
                    'attribute' => $attribute->name,
                    'value' => $attributeValue->name,
                    'value_id' => $attributeValue->id,
                ];
            }
        }
        return $variantsWithAttributes;
    }
}
