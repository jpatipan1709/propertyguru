<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mails extends Model
{
    protected $table = 'tb_mail';
    protected $primaryKey = 'tbm_id';
    protected $fillable = [
        'tbm_pj_id','tbm_ev_id','tbm_logo','tbm_content','tbm_color'
    ];


    // public $timestamps = false;
}
