<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $table = 'tb_logs';
    protected $primaryKey = 'l_id';
    protected $fillable = [
        'l_u_id',
        'l_action',
        'l_after',
        'l_before',
        'l_type',
    ];


    // public $timestamps = false;
}
