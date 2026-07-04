<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreRepairOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'request_type' => ['required', 'in:maintenance,pc_build'],
            'customer_name' => ['required', 'string', 'max:120'],
            'customer_phone' => ['required', 'string', 'max:30', 'regex:/^[0-9+ ]{8,20}$/'],
            'device_name' => ['nullable', 'required_if:request_type,maintenance', 'string', 'max:120'],
            'services' => ['array'],
            'services.*' => ['integer', 'exists:maintenance_services,id'],
            'problem' => ['nullable', 'string', 'max:2000'],
            'cpu_brand' => ['nullable', 'required_if:request_type,pc_build', 'in:Intel,AMD Ryzen'],
            'cpu' => ['nullable', 'required_if:request_type,pc_build', 'string', 'max:120'],
            'motherboard' => ['nullable', 'required_if:request_type,pc_build', 'string', 'max:120'],
            'gpu' => ['nullable', 'required_if:request_type,pc_build', 'string', 'max:120'],
            'ram' => ['nullable', 'required_if:request_type,pc_build', 'string', 'max:120'],
            'storage_primary' => ['nullable', 'required_if:request_type,pc_build', 'string', 'max:120'],
            'storage_secondary' => ['nullable', 'string', 'max:120'],
            'psu' => ['nullable', 'required_if:request_type,pc_build', 'string', 'max:120'],
            'case' => ['nullable', 'required_if:request_type,pc_build', 'string', 'max:120'],
            'cooling_type' => ['nullable', 'required_if:request_type,pc_build', 'in:air,water'],
            'usage' => ['nullable', 'required_if:request_type,pc_build', 'string', 'max:120'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            if ($this->input('request_type') === 'maintenance' && empty($this->input('services', []))) {
                $validator->errors()->add('services', 'اختر خدمة واحدة على الأقل.');
            }
        });
    }
}
