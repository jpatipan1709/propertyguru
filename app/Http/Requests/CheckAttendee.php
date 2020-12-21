<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckAttendee extends FormRequest
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
        $rules["agenda_title"]          = "required";
        $rules["agenda_content"]        = "required";
        $rules["myselect"]              = "required";
        $rules["galadinner"]            = "required";
        $rules["venueofevent"]          = "required";
        $rules["border_agenda"]         = "required";
        // $rules["agenda_map"]            = "required";
        $rules["dateofeventstart.*"]    = "required";
        $rules["time_agenda1.*"]        = "required";
        $rules["time_agenda2.*"]        = "required";
        return $rules;
    }

    private function getPutRules()
    {
        $rules["agenda_title"]          = "required";
        $rules["agenda_content"]        = "required";
        $rules["myselect"]              = "required";
        $rules["galadinner"]            = "required";
        $rules["venueofevent"]          = "required";
        $rules["border_agenda"]         = "required";
        // $rules["agenda_map"]            = "required";
        $rules["dateofeventstart.*"]    = "required";
        $rules["time_agenda1.*"]        = "required";
        $rules["time_agenda2.*"]        = "required";
        return $rules;
    }

    public function messages()
    {
        return [
            'images_logo.required'          => 'Please Enter Images Logo',
            'agenda_title.required'         => 'Please Enter Event Title',
            'agenda_content.required'       => 'Please Enter Event Content',
            "myselect.required"             => "Please Select Event list",
            'galadinner.required'           => 'Please Enter Gala dinner & Awards Ceremony ',
            'venueofevent.required'         => 'Please Enter Venue of event',
            'border_agenda.required'        => 'Please Enter Border Color',
            // 'agenda_map.required'           => 'Please Enter Map',
            'dateofeventstart.*required'    => 'Please Enter Date of Event',
            'time_agenda1.*required'        => 'Please Enter Time Start',
            'time_agenda2.*required'        => 'Please Enter Time End',
        ];
    }

}
