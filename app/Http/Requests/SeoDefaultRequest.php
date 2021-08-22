<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeoDefaultRequest extends FormRequest
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
            'meta_title' => 'required|string',

            'meta_description' => 'required|string',

            'og_url' => 'required|string',

            'og_title' => 'required|string',

            'og_description' => 'required|string',

            'og_sitename' => 'required|string',

            'fb_admins' => 'required|string',

            'fb_app_id' => 'required|string',

            'og_type' => 'required|string',

            'og_publisher' => 'required|string',

            'twitter_title' => 'required|string',

            'twitter_description' => 'required|string',

            'twitter_card' => 'required|string',

            'twitter_site' => 'required|string',

            'twitter_creator' => 'required|string',
        ];
    }
}
