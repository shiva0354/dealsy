<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|min:4',
            'mobile' => 'nullable|numeric|digits:10',
            'role' => 'required|in:SUPER ADMIN,ADMIN,EMPLOYEE,SEO AGENT',
            'enabled' => 'required|boolean',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Admin Name',
            'email' => 'Admin Email',
            'mobile' => 'Admin Mobile',
            'role' => 'Admin Role',
            'enabled' => 'Admin Status',
        ];
    }
}
