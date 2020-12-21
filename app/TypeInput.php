<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeInput extends Model
{
    protected $table = 'tb_type_input';
    protected $primaryKey = 'tip_id';
    protected $fillable = [
       'tip_input'
    ];


    public $timestamps = 'false';
}
