<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BatchPreferenceRequest extends FormRequest
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
            '*.external_reference' => 'required',
            '*.name' => 'required',
            '*.surname' => 'required',
            '*.email' => 'required',
            '*.phone_number' => 'required',
            '*.identification_type' => 'required',
            '*.identification_number' => 'required',
            '*.title' => 'required',
            '*.unit_price' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'external_reference.required' => 'La referencia externa es obligatoria',
            'name.required' => 'El nombre del pagador es obligatorio',
            'surname.required' => 'El apellido del pagador es obligatorio',
            'email.required' => 'El E-Mail del pagador es obligatorio',
            'email.email' => 'El E-Mail del pagador tiene un formato incorrecto',
            'phone_number.required' => 'El número telefónico del pagador es obligatorio',
            'identification_type.required' => 'El tipo de documento del pagador es obligatorio',
            'identification_number.required' => 'El número de documento del pagador es obligatorio',
            'title.required' => 'Es necesario un título para el ítem a abonar',
            'unit_price.required' => 'Es necesario el monto del ítem a abonar',
        ];
    }
}
