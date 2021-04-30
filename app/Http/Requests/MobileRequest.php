<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MobileRequest extends FormRequest
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
        $user = User::current();

        if (!$user->mobile) {
            return [
                'mobile' => 'required|numeric|digits:10',
            ];
        }

        return [
            'old_mobile' => 'required|numeric|digits:10|exists:users,mobile',
            'mobile' => 'required|numeric|digits:10',
        ];

    }

    public function messages()
    {
        return [
            'mobile.required' => 'Mobile number is required',
            'mobile.numeric' => 'Mobile must be 10 digit number',
            'mobile.digits' => 'Mobile must be 10 digit number',
        ];
    }

    public function attributes()
    {
        return [
            'mobile' => 'Mobile number',
        ];
    }
}
