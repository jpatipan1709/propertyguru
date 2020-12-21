<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'tb_events';
    protected $primaryKey = 'ev_id';
    protected $fillable = [
        'ev_pj_id','ev_status','ev_name','ev_date_start','ev_time_start','ev_time_end'
    ];


    // public $timestamps = false;
}
