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
            'post_title' => 'required|string|min:30|max:255',
            'post_detail' => 'required|string|min:30|max:1000',
            'category_id' => 'required|numeric',
            'sub_category_id' => 'nullable|numeric',
            'ad_type' => 'required|string',
            'expected_price' => 'required|nullable|numeric',
            'is_negotiable' => 'nullable|string',
            'locality' => 'required|string|min:3|max:255',
            'city' => 'required|string|min:3|max:255',
            'state' => 'required|string|min:2|max:255',
            'images' => 'required',
            'images.*' => 'image|mimes:png,jpg,jpeg|max:1000',
        ];
    }
}
