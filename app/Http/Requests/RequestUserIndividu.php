<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class RequestUserIndividu extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $oldPass = $this->oldpassword;
        $userId = $this->route("user");
        return [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('\App\User', 'email')->ignore($this->email, 'email')
            ],
            'oldpassword' => 'required_with:newpassword,renewpassword',
            'newpassword' => 'required_with:oldpassword,renewpassword',
            'renewpassword' => 'required_with:oldpassword,newpassword|same:newpassword'
        ];
    }
}
