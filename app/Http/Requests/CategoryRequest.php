<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('category');
        $except = $id ? "$id,id" : "";
        return [
            'name' => 'required|string|min:3|max:100',
            'slug' => "required|string|min:3|max:100|unique:categories,slug,$except",
            'icon' => 'nullable|string',
            'parent_id' => 'nullable|numeric|exists:categories,id',
            'seo_title' => 'string|min:10|max:150',
            'seo_description' => 'string|min:60|max:255'
        ];
    }

    public function attributes()
    {
        return [
            'seo_description' => 'Seo Description',
            'seo_title' => 'Seo Title',
        ];
    }

    public function messages()
    {
        return [
            'seo_title.min' => 'Minimum of 10 characters is required',
            'seo_title.max' => 'Maximum of 150 characters is allowed',
        ];
    }
}
