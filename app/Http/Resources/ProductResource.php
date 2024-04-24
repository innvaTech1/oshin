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
            'name' => $this->product_name,
            'slug' => $this->slug,
            'badge' => $this->badge,
            // 'description' => $this->short_description,
            'price' => $this->price,
            'actual_price' => $this->actual_price,
            'discount' => $this->discount,
            'discount_type' => $this->discount_type,
            'discount_percentage' => $this->discount_type == 'fixed'? calculateDiscountPercentage($this->price, $this->actual_price): $this->discount,

            'status' => $this->status ? 'Active' : 'Inactive',
            'brand' => $this->brand?->name,
            'categories' => CategoryResource::collection($this->categories),
            'thumbnail' => asset($this->image_url),
        ];
    }

    // for single product
    public function singleProduct(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->product_name,
            'slug' => $this->slug,
            'badge' => $this->badge,
            'description' => $this->description,
            'price' => $this->price,
            'actual_price' => $this->actual_price,
            'discount' => $this->discount,
            'discount_type' => $this->discount_type,
            'discount_percentage' => $this->discount_type == 'fixed'? calculateDiscountPercentage($this->price, $this->actual_price): $this->discount,
            'status' => $this->status ? 'Active' : 'Inactive',
            'brand' => $this->brand?->name,
            'categories' => CategoryResource::collection($this->categories),
            'thumbnail' => asset($this->image_url),
            'attributes' => $this->attributeAndValues,
            // 'reviews' => ProductReviewResource::collection($this->reviews),
            'related_products' => ProductResource::collection($this->relatedProducts),
        ];
    }
}
