<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seats extends Model
{
    protected $table = 'tb_seats';
    protected $primaryKey = 's_id';
    protected $fillable = [
        's_pj_id','s_stage_x','s_stage_y','s_width','s_height'
    ];


    // public $timestamps = false;
}
