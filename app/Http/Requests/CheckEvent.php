<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckEvent extends FormRequest
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
        $rules["event_name"]        = "required|unique:tb_events,ev_name";
        $rules["event_date"]        = "required";
        $rules["event_time_start"]  = "required";
        $rules["event_time_end"]    = "required";
        return $rules;
    }

    private function getPutRules()
    {
        $rules['event_name']        =  "required|unique:tb_events,ev_name,".$this->event_id.",ev_id";
        $rules["event_date"]        = "required";
        $rules["event_time_start"]  = "required";
        $rules["event_time_end"]    = "required";
        return $rules;
    }

    public function messages()
    {
        return [
            'event_name.required'           => 'Please Enter Event Name',
            'event_date.required'           => 'Please Enter Event Date',
            'event_time_start.required'     => 'Please Enter Event Time Start',
            'event_time_end.required'       => 'Please Enter Event Time End',
            'event_name.unique'             => 'Cannot use this name',
        ];
    }
}
