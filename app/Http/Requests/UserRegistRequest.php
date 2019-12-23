<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRegistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->user()->role->role === 'user') {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('\App\User', 'email')->ignore($this->email, 'email')
            ],
            'password' => 'required|max:30|min:5',
            'repassword' => 'required|same:password',
            'role' => [
                'required',
                Rule::exists('\App\Models\Role', 'id')
            ]
        ];
    }
}
