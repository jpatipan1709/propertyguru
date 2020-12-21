<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectDetail extends Model
{
    protected $table = 'tb_project_details';
    protected $primaryKey = 'pjd_id';
    protected $fillable = [
        'pjd_pj_id','pjd_ev_id'
    ];


    public $timestamps = false;  
}
