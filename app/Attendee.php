<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    protected $table = 'tb_attendee';
    protected $primaryKey = 'atd_id';
    protected $fillable = [
        'atd_ev_id','atd_pj_id','atd_ev_sel','atd_title','atd_content','atd_type','atd_venue','atd_image','atd_bg','atd_use_color','atd_border','atd_map'
    ];


    public $timestamps = false;
}
