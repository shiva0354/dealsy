<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
        $id = $this->route('location');
        $except = $id ? "$id,id" : "";
        return [
            'name' => 'required|string|min:3|max:255',
            'slug' => "required|string|unique:locations,slug,$except",
            'parent_id' => "nullable|numeric|exists:locations,id",
        ];
    }
}
