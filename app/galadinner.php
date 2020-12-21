<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galadinner extends Model
{
    protected $table = 'tb_gala';
    protected $primaryKey = 'gl_id';
    protected $fillable = [
        'gl_pj_id',
        'gl_name_x',
        'gl_name_y',
        'gl_lastname_x',
        'gl_lastname_y',
         'gl_company_x',
         'gl_company_y',
         'gl_table_x', 
         'gl_table_y',
         'gl_text_x',
         'gl_text_y',
         'gl_image_x',
         'gl_image_y',
         'gl_text',
         'gl_images',
         'gl_size',
         'gl_color',
         
    ];
}
