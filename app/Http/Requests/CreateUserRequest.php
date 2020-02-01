<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'email'       => 'required|string|email|max:255|unique:users,email,'.$this->user_id,
            'password'    => 'required_with:password_confirmation|confirmed',
            'permissions' => 'required_without:is_admin',
            'projects'    => 'required_without:is_admin',
            'setup'       => 'required_without:is_admin'
        ];
    }
}
