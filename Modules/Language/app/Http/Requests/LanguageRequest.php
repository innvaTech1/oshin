<?php

namespace Modules\Language\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LanguageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::guard('admin')->check() ? true : false;
    }

    public function rules(): array
    {
        $rules = [
            'direction' => 'required|string|max:3',
        ];

        if ($this->isMethod('put')) {
            $rules['icon'] = 'nullable|image|max:512';
            $rules['name'] = 'required|string|max:255|unique:languages,name,'.$this->language->id;
            $rules['code'] = 'required|string|max:4|unique:languages,code,'.$this->language->id;
        }

        if ($this->isMethod('post')) {
            $rules = [
                'name' => 'required|string|max:255|unique:languages,name',
                'code' => 'required|string|max:4|unique:languages,code',
            ];
            $rules['icon'] = 'nullable|image|max:512';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => __('The language name is required.'),
            'name.string' => __('The name must be a string.'),
            'name.unique' => __('The name must be unique.'),
            'name.max' => __('The name may not be greater than 255 characters.'),
            'code.required' => __('The language code is required.'),
            'direction.required' => __('The language direction is required.'),
            'code.string' => __('The code must be a string.'),
            'code.unique' => __('The code must be unique.'),
            'code.max' => __('The language code may not be greater than 4 characters.'),
            'icon.required' => __('The icon is required.'),
            'icon.image' => __('The icon must be a valid image file.'),
            'icon.max' => __('The icon may not be greater than 512 kilobytes in size.'),
        ];
    }
}
