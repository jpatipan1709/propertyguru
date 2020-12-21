<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Urls extends Model
{
    protected $table = 'tb_urls';
    protected $primaryKey = 'url_id';
    protected $fillable = [
       'url_name','url_code'
    ];


    // public $timestamps = 'false';
}
