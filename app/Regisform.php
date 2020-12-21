<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regisform extends Model
{
    protected $table = 'tb_regis_form';
    protected $primaryKey = 'rgf_id';
    protected $fillable = [
        'rgf_rgt_id','rgf_pj_id','rgf_ev_id'
    ];


    public $timestamps = false;
}
