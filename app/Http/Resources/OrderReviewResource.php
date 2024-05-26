<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderReviewResource extends JsonResource
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
            'product' => ProductResource::make($this->product),
            'rating' => $this->rating,
            'comment' => $this->comment,
            'date' => $this->created_at->format('d M Y h:i A'),
            'time_ago' => $this->created_at->diffForHumans(),
            'user' => UserResource::make($this->user),
            'images' => $this->images->map(function ($image) {
                return [
                    'id' => $image->id,
                    'image' => $image->image,
                ];
            }),
        ];
    }
}
