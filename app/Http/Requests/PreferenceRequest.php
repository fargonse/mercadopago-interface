<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PreferenceRequest extends FormRequest
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
            'external_reference' => 'required',
            'payer.name' => 'required',
            'payer.surname' => 'required',
            'payer.email' => 'required|email',
            'payer.phone_number' => 'required',
            'payer.identification_type' => 'required',
            'payer.identification_number' => 'required',
            'item.title' => 'required',
            'item.unit_price' => 'required',
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
            'payer.name.required' => 'El nombre del pagador es obligatorio',
            'payer.surname.required' => 'El apellido del pagador es obligatorio',
            'payer.email.required' => 'El E-Mail del pagador es obligatorio',
            'payer.email.email' => 'El E-Mail del pagador tiene un formato incorrecto',
            'payer.phone_number.required' => 'El número telefónico del pagador es obligatorio',
            'payer.identification_type.required' => 'El tipo de documento del pagador es obligatorio',
            'payer.identification_number.required' => 'El nombrnúmero de documento del pagador es obligatorio',
            'item.title.required' => 'Es necesario un título para el ítem a abonar',
            'item.unit_price.required' => 'Es necesario el monto del ítem a abonar',
        ];
    }
}
