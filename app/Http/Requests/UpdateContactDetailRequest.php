<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateContactDetailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // We need ID for unique validation
        $id = $this->route('id');

        return [
            'first_name'          => 'sometimes|required|string|max:255',
            'last_name'           => 'sometimes|required|string|max:255',
            'email'               => 'sometimes|required|email|unique:contact_details,email,' . $id,
            'company'             => 'nullable|string|max:255',
            'phone_number'        => 'nullable|string|max:20',
            'service_id'          => 'sometimes|required|uuid|exists:services,id',
            'budget'              => 'nullable|string|max:255',
            'service_description' => 'sometimes|required|string',
        ];
    }
}
