<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeoToolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $seoToolId = $this->route('seo_tool');
        $ignoreId = $seoToolId ? ",$seoToolId,id" : '';

        return [
            'url' => "required|string|max:255|unique:seo_tools,url{$ignoreId}",
            'meta_title' => "nullable|string|max:255",
            'meta_description' => "nullable|string|max:255",
            'og_title' => "nullable|string|max:255",
            'og_description' => "nullable|string|max:255",
            'twitter_title' => "nullable|string|max:255",
            'twitter_description' => "nullable|string|max:255",
            'cannonical_url' => "nullable|string|max:255",
        ];
    }

    public function messages(): array
    {
        return [
            //'url' => '',
            //'meta_title' => '',
            //'meta_description' => '',
            //'og_title' => '',
            //'og_description' => '',
            //'twitter_title' => '',
            //'twitter_description' => '',
            //'cannonical_url' => '',
        ];
    }
}
