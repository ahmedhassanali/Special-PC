<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRepairOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'in:waiting,working,done,delivered'],
            'delivery_date' => ['nullable', 'string', 'max:120'],
        ];
    }
}
