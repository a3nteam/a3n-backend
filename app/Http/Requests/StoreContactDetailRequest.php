<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreContactDetailRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name'          => 'required|string|max:255',
            'last_name'           => 'required|string|max:255',
            'email'               => 'required|email|unique:contact_details,email',
            'company'             => 'nullable|string|max:255',
            'phone_number'        => 'nullable|string|max:20',
            'service_id'          => 'required|uuid|exists:services,id',
            'budget'              => 'nullable|string|max:255',
            'service_description' => 'required|string',
        ];
    }
}
