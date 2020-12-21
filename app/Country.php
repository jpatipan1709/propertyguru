<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'tb_country';
    protected $primaryKey = 'ct_id';
    protected $fillable = [
        'ct_name'
    ];


    public $timestamps = false;
}
