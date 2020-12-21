<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Checkcountry extends FormRequest
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
        $rules["country_name"]        = "required|unique:tb_country,ct_name";
        return $rules;
    }

    private function getPutRules()
    {
        $rules['country_name']        =  "required|unique:tb_events,ev_name,".$this->event_id.",ev_id";
        return $rules;
    }

    public function messages()
    {
        return [
            'country_name.required'           => 'Please Enter Country Name',
            'event_name.unique'             => 'Cannot use this name',
        ];
    }
}
