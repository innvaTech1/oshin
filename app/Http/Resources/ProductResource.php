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
            "rating" => random_int(1, 5),
            'description' => $this->description,
            'short_description' => $this->short_description,
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
            'related_products' => ProductResource::collection($this->relatedProducts),
            "images_url" => $this->images_url,
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
