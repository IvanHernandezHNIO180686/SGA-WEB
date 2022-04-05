<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditarReunion extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'NombreReunion' => 'required',
            'FechaReunion' => 'after:today'
        ];
    }

    public function messages()
    {
        return [
            'FechaReunion.after' => 'La fecha de cumplimiento debe de ser mayor a la de hoy'
        ];
    }
}
