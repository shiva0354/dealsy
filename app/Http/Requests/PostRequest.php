<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        return [
            'category' => 'required|numeric|exists:categories,id',
            'sub_category' => 'nullable|numeric|exists:categories,id',
            'title' => 'required|string|min:10|max:60',
            'detail' => 'required|string|min:30|max:1000',
            'price' => 'required|nullable|numeric',
            'locality' => 'required|string|min:3|max:255',
            'city_id' => 'required|numeric|exists:locations,id',
            'state_id' => 'required|numeric|exists:locations,id',
            'images' => 'required',
            'images.*' => 'image|mimes:png,jpg,jpeg|max:2000',
        ];
    }

    public function messages()
    {
        return [

        ];
    }

    public function attributes()
    {
        return [
            'category' => 'Category',
            'sub_category' => 'Sub Category',
            'title' => 'Post title',
            'detail' => 'Post description',
            'price' => 'Price',
            'locality' => 'Locality',
            'city_id' => 'City',
            'state_id' => 'State',
            'images' => 'Post Images',
        ];
    }
}
