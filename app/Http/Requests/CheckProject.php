<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Projects;
class CheckProject extends FormRequest
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
      
        $rules["project_name"]  = "required|unique:tb_projects,pj_name";
        // $rules["myselect"]  = "required";
        // dd($rules);
        return $rules;
    }

    private function getPutRules()
    { 
        
        $rules["project_name"]  = "required|unique:tb_projects,pj_name,".$this->project_id.",pj_id";
        // $rules["myselect"]  = "required";
        return $rules;
    }


    public function messages()
    {
        return [
            'project_name.required'    => 'Please Enter Project Name',
            'project_name.unique'    => 'Cannot use this name',
            'project_name.regex'    => 'Please Enter format A-Z or 0-9 or Symbol only',
            // 'myselect.required'    => 'Please Select Event Name 1 option',
        ];
    }
}
