<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckregisterForm extends FormRequest
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
        $rules["event_sel"]        = "required";
        $rules["email"]        = "unique:tb_register,rg_email";
        return $rules;
    }

    private function getPutRules()
    {
        // dd($this->rg_id);
        $rules["event_sel"]    = "required";
        // $rules['email']        =  "unique:tb_register,rg_email,".$this->rg_id.",rg_id";
        $rules['email']        =  "required|unique:tb_register,rg_email,".$this->rg_id.",rg_id";
        return $rules;
    }

    public function messages()
    {
        return [
            'email.unique'           => 'The E-mail has already been taken. ',
            'event_sel.required'           => 'Please Select Event at least 1 option ',
        ];
    }
}
