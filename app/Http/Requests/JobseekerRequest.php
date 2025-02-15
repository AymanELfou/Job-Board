<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobseekerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'competences' => 'nullable|string',
            'experience' => 'nullable|string',
            'education' => 'nullable|string',
            'fullName' => 'required|string|max:255',
            'contact_information' => 'nullable|string|max:255',
        ];
    }
}
