<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckTypeperson extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                return $this->getPostRules();
            case 'PUT':
                return $this->getPutRules();
        }
    }

    private function getPostRules()
    {
        $rules["typepersonal_name"]        = "required|unique:tb_typepersonal,tps_name";
        return $rules;
    }

    private function getPutRules()
    {
        $rules['typepersonal_name']        =  "required|unique:tb_typepersonal,tps_name,".$this->typepersonal_id.",tps_id";
        return $rules;
    }

    public function messages()
    {
        return [
            'typepersonal_name.required'           => 'Please Enter Type of person Name',
        ];
    }
}
