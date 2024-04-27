<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Product\app\Models\Product;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'sku' => $this->sku,
            'badge' => $this->badge,
            'quantity' => $this->stock,
            "rating" => random_int(1, 5),
            'description' => $this->description,
            'short_description' => $this->short_description,
            'additional_information' => $this->additional_information,
            'categories' => CategoryResource::collection($this->categories),
            "sold" => random_int(1, 100),
            'price' => $this->price,
            'actual_price' => $this->actual_price,
            'discount' => $this->discount,
            'discount_type' => $this->discount_type,
            'discount_percentage' => $this->discount_type == 'fixed' && $this->discount != 0? calculateDiscountPercentage($this->price, $this->actual_price): $this->discount,
            'status' => $this->status ? 'Active' : 'Inactive',
            'brand' => $this->brand?->name,
            'brand_slug' => $this->brand?->slug,
            'thumbnail' => asset($this->image_url),
            'attributes' => $this->attributeAndValues,
            'related_products' => $this->relatedProducts? ProductResource::collection($this->relatedProduct) : [],
            "images_url" => $this->images_url,
            'is_cod' => $this->is_cod ? 'Yes' : 'No',
            'unit' => $this->unit?->name,
            'unit_id' => $this->unit_id,
            'partial_amount' => $this->partial_amount,
            'min_delivery_days' => $this->min_delivery_days,
            'max_delivery_days' => $this->max_delivery_days,
            'min_delivery_date' => now()->addDays($this->min_delivery_days)->format('d F'),
            'max_delivery_date' => now()->addDays($this->max_delivery_days)->format('d F'),
        ];
    }
    public function singleProduct(): array
    {
        return [
            
            // 'reviews' => ProductReviewResource::collection($this->reviews),
            'related_products' => ProductResource::collection($this->relatedProducts),
        ];
    }
}
