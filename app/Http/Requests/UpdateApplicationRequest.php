<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\ApplicationStatusEnum;

class UpdateApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_name' => ['sometimes', 'string', 'max:255'],
            'company_phone' => ['sometimes', 'nullable', 'string', 'max:255'],
            'job_title' => ['sometimes', 'string', 'max:255'],
            'apply_link' => ['sometimes', 'nullable', 'string', 'max:255'],
            'applied_at' => ['sometimes', 'date'],
            'cv_sent' => ['sometimes', 'boolean'],
            'status' => ['sometimes', Rule::in(array_map(fn($case) => $case->value, ApplicationStatusEnum::cases()))],
            'contact_person' => ['sometimes', 'nullable', 'string', 'max:255'],
            'notes' => ['sometimes', 'nullable', 'string'],
        ];
    }
}
