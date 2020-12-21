<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypePersonal extends Model
{
    protected $table = 'tb_typepersonal';
    protected $primaryKey = 'tps_id';
    protected $fillable = [
       'tps_name'
    ];


    // public $timestamps = 'false';
}
