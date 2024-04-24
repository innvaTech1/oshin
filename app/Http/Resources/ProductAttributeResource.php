<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductAttributeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return $this->variants->map(function ($variant) {
                return [
                    'id' => $variant->id,
                    'price' => $variant->price,
                    'compare_at_price' => $variant->compare_at_price,
                    'cost_per_item' => $variant->cost_per_item,
                    'taxable' => $variant->taxable,
                    'track_inventory' => $variant->track_inventory,
                    'out_of_stock_track_inventory' => $variant->out_of_stock_track_inventory,
                    'sku' => $variant->sku,
                    'weight' => $variant->weight,
                    'weight_unit' => $variant->weight_unit,
                    'origin' => $variant->origin,
                    'barcode' => $variant->barcode,
                    'is_default' => $variant->is_default,
                    'media_id' => $variant->media_id,
                    'options' => $variant->options->map(function ($option) {
                        return [
                            'id' => $option->id,
                            'attribute_id' => $option->attributeValue->attribute_id,
                            'attribute' => $option->attributeValue->attribute->name,
                            'attribute_value_id' => $option->attribute_value_id,
                            'attribute_value' => $option->attributeValue->name,
                        ];
                    }),
                ];
            });
    }
}
