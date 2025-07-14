<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\ApplicationStatusEnum;

class StoreApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_name' => ['required', 'string', 'max:255'],
            'company_phone' => ['nullable', 'string', 'max:255'],
            'job_title' => ['required', 'string', 'max:255'],
            'apply_link' => ['nullable', 'string', 'max:255'],
            'applied_at' => ['required', 'date'],
            'cv_sent' => ['required', 'boolean'],
            'status' => ['required', Rule::in(array_map(fn($case) => $case->value, ApplicationStatusEnum::cases()))],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
