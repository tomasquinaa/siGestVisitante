<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitaRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'document_number' => 'required|max:16',
            'contact' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Campo nome é obrigatório!',
            'document_number.max' => 'O valor só pode ter no máximo 15 números',
            'contact.required' => 'Campo contact é obrigatório!',
        ];
    }


}
