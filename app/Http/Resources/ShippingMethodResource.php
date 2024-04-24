<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShippingMethodResource extends JsonResource
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
            'fee' => $this->fee,
            'status' => $this->status ? 'Active' : 'Inactive',
            'is_free' => $this->is_free,
            'minimum_order' => $this->minimum_order,
        ];
    }
}
