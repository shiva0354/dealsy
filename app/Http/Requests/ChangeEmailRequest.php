<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class ChangeEmailRequest extends FormRequest
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
    {$user = User::current();
        $except = "$user->id,id";

        return [
            'email' => 'required|email|max:255|exists:users,email',
            'new_email' => "required|email|max:255|unique:users,email, $except",
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'Current Email',
            'new_email' => 'New Email',
        ];
    }
}
