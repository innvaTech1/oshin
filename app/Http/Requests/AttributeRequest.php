<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
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
            'name' => 'required|unique:attributes,name,' . $this->id,
            "status" => "required",
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The attribute name is required',
            'name.unique' => 'The attribute name has already been taken',
        ];

    }
}
