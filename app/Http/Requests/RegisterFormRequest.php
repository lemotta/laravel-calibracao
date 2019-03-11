<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest {

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
            'department_id' => 'required',
            'number' => 'required',
            'serialnumber' => 'required|min:3|max:20',
            'modelofequipament_id' => 'required',
            'period_id' => 'required',
            'report_id' => 'required'
        ];
    }

}
