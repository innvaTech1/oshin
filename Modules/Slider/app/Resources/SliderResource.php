<?php

namespace Modules\Slider\app\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'button_text' => $this->button_text,
            'button_link' => $this->button_link,
            'image' => asset($this->image_url),
            'status' => $this->status ? 'Active' : 'Inactive',
        ];
    }
}
