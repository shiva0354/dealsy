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
            'category_id' => 'required|numeric',
            'title' => 'required|string|min:20|max:60',
            'detail' => 'required|string|min:30|max:1000',
            'ad_type' => 'required|string',
            'expected_price' => 'required|nullable|numeric',
            'is_price_negotiable' => 'nullable|string',
            'locality' => 'required|string|min:3|max:255',
            'location_id' => 'required|numeric',
            'state_id' => 'required|numeric',
            'images' => 'required',
            'images.*' => 'image|mimes:png,jpg,jpeg|max:2000',
        ];
    }
}
