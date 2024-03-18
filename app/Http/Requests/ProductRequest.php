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
            'product_type' => 'required',
            'category_ids' => 'required|array',
            'minimum_order_qty' => 'required',
            'tags' => 'required',
            'discount' => 'required',
            'weight' => 'nullable',
            'length' => 'nullable',
            'height' => 'nullable',
            'auction_product' => 'nullable',
            'date_range' => 'nullable',
            'variant_sku_prefix' => 'nullable|required_if:product_type,==,variant',
        ];
    }
}
