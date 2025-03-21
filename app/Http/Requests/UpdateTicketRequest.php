<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'subject' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'category' => 'sometimes|in:Technical,Billing,General',
            'priority' => 'sometimes|in:Low,Medium,High',
            'status' => 'sometimes|in:Open,In Progress,Resolved,Closed',
            'attachment' => 'sometimes|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ];
    }

    /**
     * Custom error messages for validation.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'subject.string' => 'The ticket subject must be a string.',
            'subject.max' => 'The ticket subject must not exceed 255 characters.',
            'description.string' => 'The ticket description must be a string.',
            'category.in' => 'The ticket category must be one of: Technical, Billing, General.',
            'priority.in' => 'The ticket priority must be one of: Low, Medium, High.',
            'status.in' => 'The ticket status must be one of: Open, In Progress, Resolved, Closed.',
            'attachment.file' => 'The attachment must be a valid file.',
            'attachment.mimes' => 'The attachment must be a file of type: jpg, jpeg, png, pdf, doc, docx.',
            'attachment.max' => 'The attachment must not exceed 2MB in size.',
        ];
    }
}