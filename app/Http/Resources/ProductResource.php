<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'description' => $this->description,
            'price' => $this->price,
            'actual_price' => $this->actual_price,
            'discount' => $this->discount,
            'discount_type' => $this->discount_type,

            'status' => $this->status ? 'Active' : 'Inactive',
            'brand' => $this->brand?->name,
            'categories' => CategoryResource::collection($this->categoriesList),
            // 'thumbnail' => $this->thumbnail,
        ];
    }
}
