<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'phone'=>'string|unique:users',
            'email'=>'required|email|unique:users',
            'password'=>'required|string|min:6',
            'role_id'=>'nullable|integer|exists:roles,id',
            'agent_id'=>'nullable|integer|exists:agents,id',
            'status' => 'required|integer',
            'gender'=>'nullable|integer',
            'age'=>'nullable|integer',
            'photo' => 'nullable',
        ];
    }
}
