<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    protected $table = 'tb_ticket';
    protected $primaryKey = 'tck_id';
    protected $fillable = [
        'tck_pj_id','tck_images','tck_agenda','tck_agenda2','tck_agenda3','tck_name_x','tck_name_y', 'tck_lastname_x','tck_lastname_y','tck_company_x', 'tck_company_y','tck_qr_x','tck_qr_y','tck_width','tck_height','tck_color','tck_size','tck_size_qr'
    ];


    // public $timestamps = false;
}
