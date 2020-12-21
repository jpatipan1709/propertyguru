<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendeeDetail extends Model
{
    protected $table = 'tb_attendee_details';
    protected $primaryKey = 'atdt_id';
    protected $fillable = [
        'atdt_agd_id','atdt_date','atdt_time_from','atdt_time_to'
    ];


    public $timestamps = false;
}
