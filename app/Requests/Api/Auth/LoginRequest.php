<?php

namespace App\Requests\Api\Auth;

use App\Requests\APIRequest;

class LoginRequest extends APIRequest{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'email.required' => 'Please enter user email',
            'email.string' => 'Email must be a string',
            'email.email' => 'Invalide user email',
            'password.required' => 'Please enter user password',
            'password.string' => 'Password must be a string'
        ];
    }
}