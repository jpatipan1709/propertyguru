<?php

namespace App\Imports;

use App\Registered;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
use Session;
class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // config(['excel.import.startRow' = 2]);
        return new Registered([
            'rg_name'           => $row['name'],
            'rg_lastname'       => $row['lastname'],
            'rg_email'          => $row['email'],
            'rg_phone'          => $row['phone'],
            'rg_company'        => $row['company'],
            'rg_address'        => $row['address'],
            'rg_country'        => $row['country'],
            'rg_job_title'      => $row['jobtitle'],
            'rg_dietary'        => $row['dietary'],
            'rg_type_id'        => 1,
            'rg_pj_id'          => Session::get('id_project'),
            'rg_event_id'       => $row['event'],
            'rg_type_personal'  => $row['typepersonal'],
            
        ]);
    }


}
