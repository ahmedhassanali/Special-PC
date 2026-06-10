<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
            'ar_name' => 'required|string',
            'en_name' => 'required|string',
            'ar_description' => 'nullable|string',
            'en_description' => 'nullable|string',
            'photo' => 'nullable',
            'category_id'=>'required',
        ];
    }
}
