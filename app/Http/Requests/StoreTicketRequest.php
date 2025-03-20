<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        dd(auth()->check());
        return auth()->check() && auth()->user()->hasRole('customer');
        // return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'subject' => 'required|string|max:255', 
            'description' => 'required|string',
            'category' => 'required|in:Technical,Billing,General',
            'priority' => 'required|in:Low,Medium,High',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
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
            'subject.required' => 'The ticket subject is required.',
            'subject.max' => 'The ticket subject must not exceed 255 characters.',
            'description.required' => 'The ticket description is required.',
            'category.required' => 'The ticket category is required.',
            'category.in' => 'The ticket category must be one of: Technical, Billing, General.',
            'priority.required' => 'The ticket priority is required.',
            'priority.in' => 'The ticket priority must be one of: Low, Medium, High.',
            'attachment.file' => 'The attachment must be a valid file.',
            'attachment.mimes' => 'The attachment must be a file of type: jpg, jpeg, png, pdf, doc, docx.',
            'attachment.max' => 'The attachment must not exceed 2MB in size.',
        ];
    }
}