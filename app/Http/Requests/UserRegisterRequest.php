<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email'=> 'required|email',
            'password'=> 'required|confirmed|min:8',
        ];
    }
    
    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.max' => 'Name is too long',
            'email.required' => 'Email addredd is required',
            'email.email' => 'Provide a valid email address',
            'password.required'=> 'Password is required',
            'password.confirmed'=> 'Confirmation password has to match',
            'password.min'=> 'Minimum of 8 characters long',
        ];
    }
}
