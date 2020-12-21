<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Badges extends Model
{
    protected $table = 'tb_badge';
    protected $primaryKey = 'b_id';
    protected $fillable = [
        'b_pj_id','b_name_x','b_name_y','b_lastname_x','b_lastname_y', 'b_company_x','b_company_y','b_department_x', 'b_department_y','b_images_x','b_images_y','b_width','b_height','b_images','b_images_size','b_color','b_size'
    ];
}
