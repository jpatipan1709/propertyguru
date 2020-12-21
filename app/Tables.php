<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tables extends Model
{
    protected $table = 'tb_tables';
    protected $primaryKey = 'tb_id';
    protected $fillable = [
        'tb_pj_id','tb_no','tb_name','tb_position_x','tb_position_y','tb_person'
    ];


    public $timestamps = false;
}
