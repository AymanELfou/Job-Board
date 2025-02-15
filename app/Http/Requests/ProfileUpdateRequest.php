<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'fullName' => 'required|string|max:255',
            'contact_information' => 'required|string|max:255',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'competences' => 'nullable|string',
            'experience' => 'nullable|string',
            'education' => 'nullable|string',
        ];
    }
}
