<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModelOfEquipamentFormRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'manufacturer_id' => 'required',
            'typeofequipament_id' => 'required',
            'model' => 'required|min:3|max:20'
        ];
    }

}
