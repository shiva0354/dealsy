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
        ];
    }
}
