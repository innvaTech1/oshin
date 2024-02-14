<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoeryRequest extends FormRequest
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
            'name' => 'required|unique:categories,name,' . $this->category_id,
            'slug' => 'required|unique:categories,slug,' . $this->category_id,
            'status' => 'required',
            'searchable' => 'required',
            'commission_rate' => 'nullable|numeric',
            'category_image' => 'nullable',
        ];

    }
    public function messages()
    {
        return [
            'name.required' => 'The category name is required',
            'name.unique' => 'The category name has already been taken',
        ];
    }
}
