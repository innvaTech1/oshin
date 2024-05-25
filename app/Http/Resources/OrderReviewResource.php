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
        ];
    }
}
