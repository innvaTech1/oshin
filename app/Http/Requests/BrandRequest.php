<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            "logo" => $this->brand ? "nullable|numeric" : "required|numeric",
            "name" => "required|string|max:255|unique:brands,name," . $this->brand,
            "description" => "nullable|string",
            "link" => "nullable|string|max:255",
            "status" => "required|in:1,0",
            "featured" => "nullable|in:1,0",
            "meta_title" => "nullable|string|max:255",
            "meta_description" => "nullable|string|max:255",
            "sort_id" => "nullable|numeric",
            "slug" => "required|string|max:255",
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */

    public function messages(): array
    {
        return [
            "name.required" => "Brand name is required",
            "name.string" => "Brand name must be a string",
            "name.max" => "Brand name should not be greater than 255 characters",
            "name.unique" => "Brand name already exists",
            "logo.required" => "Brand logo is required",
            "logo.numeric" => "Brand logo must be a number",
            "description.string" => "Brand description must be a string",
            "link.string" => "Brand link must be a string",
            "link.max" => "Brand link should not be greater than 255 characters",
            "status.required" => "Brand status is required",
            "status.in" => "Invalid brand status",
            "featured.in" => "Invalid brand featured",
            "meta_title.string" => "Brand meta title must be a string",
            "meta_title.max" => "Brand meta title should not be greater than 255 characters",
            "meta_description.string" => "Brand meta description must be a string",
            "meta_description.max" => "Brand meta description should not be greater than 255 characters",
            "sort_id.numeric" => "Brand sort id must be a number",
            "slug.required" => "Brand slug is required",
            "slug.string" => "Brand slug must be a string",
            "slug.max" => "Brand slug should not be greater than 255 characters",
        ];
    }

}
