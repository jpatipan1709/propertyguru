<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registered extends Model
{
    protected $table = 'tb_register';
    protected $primaryKey = 'rg_id';
    protected $fillable = [
        'rg_name','rg_lastname','rg_email','rg_cc_email','rg_phone','rg_company','rg_address','rg_country','rg_other','rg_job_title','rg_dietary','rg_event_id','rg_pj_id','rg_type_id','rg_type_personal','rg_event','rg_remark1','rg_remark2','rg_ticket','rg_status','rg_resend','rg_read','rg_qr_code','rg_seat','rg_cc_status'
    ];


    // public $timestamps = false;
}
