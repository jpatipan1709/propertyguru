<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $table = 'tb_projects';
    protected $primaryKey = 'pj_id';
    protected $fillable = [
        'pj_name',
        'pj_status',
        'pj_image',
    ];


    // public $timestamps = false;
}
