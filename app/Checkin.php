<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    protected $table = 'tb_checkin';
    protected $primaryKey = 'chi_id';
    protected $fillable = [
        'chi_rg_id','chi_pj_id','chi_ev_id','chi_status'
    ];


    // public $timestamps = false;
}
