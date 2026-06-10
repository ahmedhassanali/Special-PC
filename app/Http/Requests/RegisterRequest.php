<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string',
            'phone'=>'string|unique:customers',
            'email'=>'required|email|unique:customers',
            'password'=>'required|string|min:6',
            'password_confirmation' => 'same:password|min:6',
            'photo' => 'nullable',
            'gender'=>'nullable|integer',
            'age'=>'nullable|integer',
        ];
    }
}
