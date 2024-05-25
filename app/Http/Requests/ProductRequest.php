<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'brand_id' => 'required',
            'unit_id' => 'required',
            'slug' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'discount_type' => 'required',
            'cost_per_item' => 'required',

        ];
    }
}
