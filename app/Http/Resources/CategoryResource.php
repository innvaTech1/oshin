<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'image' => $this->image_url,
            'parent_id' => $this->parent_id,
            'depth_level' => $this->depth_level,
            'icon' => $this->icon,
            'searchable' => $this->searchable,
            'status' => $this->status,
            "children" => CategoryResource::collection($this->children),
        ];
    }
}
