<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'district' => $this->district?->name,
            'district_id' => $this->state,
            'thana_id' => $this->city,
            'thana' => $this->thana?->name,
            'is_default' => $this->is_default,
            'type' => $this->type,
        ];
    }
}
