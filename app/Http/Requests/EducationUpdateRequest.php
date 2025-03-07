<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationUpdateRequest extends FormRequest
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
            //
            'ecole' => 'required|max:255',
            'type_diplome' => 'required|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'description' => 'required',
            'id_adresse' => 'required|integer',
            'id_profil' => 'required|integer'
        ];
    }
}
