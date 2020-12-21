<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table = 'tb_regis_template';
    protected $primaryKey = 'rgt_id';
    protected $fillable = [
        'rgt_label','rgt_title_name', 'rgt_title_id','rgt_type_input','rgt_pj_id'
    ];


    public $timestamps = false;
}
