<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom_entreprise' => 'nullable|string|max:255',
            'adresse' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'telephone' => 'required|string|regex:/^[0-9\-\+\s]*$/|max:15', // Ajustez le regex selon vos besoins
            'secteur_activite' => 'nullable|string|max:255',
        ];
    }
}

