<?php

namespace App\Repositories;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Color;
use App\Models\ProductVariations;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AttributeRepository
{
    public function getAll()
    {
        return Attribute::latest()->get();
    }
    public function getActiveAll()
    {
        return Attribute::with('values')->latest()->Active()->get();
    }
    public function getActiveAllWithoutColor()
    {
        return Attribute::with('values')->where('id', '!=', 1)->latest()->Active()->get();
    }
    public function getColorAttr()
    {
        return Attribute::with('values')->where('id', 1)->first();
    }
    public function create(array $data)
    {
        DB::beginTransaction();
        $attribute = new Attribute();
        $attribute->name = $data['name'];
        $attribute->description = $data['description'];
        $attribute->status = $data['status'];
        $attribute->save();
        $variant_values = [];
        if ($data['variant_values']) {
            foreach ($data['variant_values'] as $value) {
                if ($value) {
                    $variant_values[] = [
                        "value" => $value,
                        "attribute_id" => $attribute->id,
                        "created_at" => Carbon::now(),
                    ];
                }
            }
            AttributeValue::insert($variant_values);
        }
        DB::commit();
    }
    public function find($id)
    {
        return Attribute::with('values', 'values.color')->findOrFail($id);
    }
    public function update(array $data, $id)
    {
        DB::beginTransaction();
        $attribute = Attribute::findOrFail($id);
        $attribute->fill($data)->save();
        if ($attribute->id != 1 && $data['edit_variant_values']) {
            $collection1 = collect($data['edit_variant_values']);
            $collection2 = collect($attribute->values->pluck('value', 'id'));
            $newDifferentItems = $collection1->diff($collection2);
            $new_variant_values = $newDifferentItems->all();
            if (count($new_variant_values) > 0) {
                foreach ($new_variant_values as $key => $new_variant_value) {
                    if ($data['value_id'][$key] != 'null') {
                        $attri_value = AttributeValue::find($data['value_id'][$key]);
                        if ($attri_value) {
                            $attri_value->update([
                                'value' => $new_variant_value,
                            ]);
                        }
                    } else {
                        AttributeValue::create([
                            'value' => $new_variant_value,
                            "attribute_id" => $attribute->id,
                        ]);
                    }
                }
            } else {
                $differentItems = $collection2->diff($collection1);
                $old_variant_values = $differentItems->all();
                if (count($old_variant_values) > 0) {
                    foreach ($old_variant_values as $key => $old_variant_value) {
                        $exixt_product = ProductVariations::where('attribute_value_id', $key)->first();
                        if ($exixt_product == null) {
                            AttributeValue::find($key)->delete();
                        }
                    }
                }
            }
        } else {
            $collection1 = collect($data['edit_variant_c_name']);
            $collection2 = collect($attribute->colors->pluck('name', 'id'));
            $newDifferentItems = $collection1->diff($collection2);
            $new_variant_values = $newDifferentItems->all();
            $differentItems = $collection2->diff($collection1);
            $old_variant_values = $differentItems->all();
            if (count($new_variant_values) > 0) {
                foreach ($new_variant_values as $key => $new_variant_value) {
                    $check = $data['color_with_id'][$key];
                    if ($check == 'null') {
                        $attribute_val = new AttributeValue;
                        $attribute_val->value = $new_variant_value;
                        $attribute_val->attribute_id = $attribute->id;
                        $attribute_val->created_at = Carbon::now();
                        $attribute_val->updated_at = Carbon::now();
                        $attribute_val->save();
                        $color = new Color();
                        $color->attribute_value_id = $attribute_val->id;
                        $color->name = $data['edit_variant_c_name'][$key];
                        $color->save();
                    } else {
                        $check_data = explode('-', $check);
                        $attribute_value = AttributeValue::find($check_data[1]);
                        $attribute_value->color->update([
                            'name' => $data['edit_variant_c_name'][$key],
                        ]);
                    }
                }
            }
            if (count($old_variant_values) > 0) {
                foreach ($old_variant_values as $key => $old_variant_value) {
                    $col = Color::find($key);
                    $exixt_product = ProductVariations::where('attribute_value_id', $col->attribute_value_id)->first();
                    if ($exixt_product == null) {
                        AttributeValue::find($col->attribute_value_id)->delete();
                        $col->delete();
                    }
                }
            }
            foreach ($collection1 as $k => $val) {
                $col = Color::with('attribute_value')->where('name', $val)->first();
                if ($col) {
                    $col->attribute_value->update([
                        'value' => $data['edit_variant_values'][$k],
                    ]);
                }
            }
        }
        DB::commit();
    }
    public function delete($id)
    {
        $attribute = Attribute::findOrFail($id);
        if (ProductVariations::where('attribute_id', $id)->first() == null) {
            $attribute->values()->delete();
            $attribute->delete();
        } else {
            return "not_possible";
        }
    }
    public function getAttributesByAjax($search)
    {
        if ($search == '') {
            $attribute = Attribute::select('id', 'name')->where('status', 1)->orderBy('id', 'DESC')->paginate(10);
        } else {
            $attribute = Attribute::select('id', 'name')->where('status', 1)
                ->where('name', 'LIKE', "%{$search}%")
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }
        $response = [];
        foreach ($attribute as $attributes) {
            $response[] = [
                'id' => $attributes->id,
                'text' => $attributes->name,
            ];
        }
        return $response;
    }
}