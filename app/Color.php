<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'tb_color';
    protected $primaryKey = 'cl_id';
    protected $fillable = [
        'cl_name'
    ];


    public $timestamps = false;
}
