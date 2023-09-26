<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OJTInfo extends Model
{
    use HasFactory;
    protected $guarded=[ ];
    protected $primaryKey='info_id';
    protected $table='o_j_t_infos';
    protected $fillable = [
       'student_id',
       'company_name',
       'company_address',
       'nature_of_bus',
       'nature_of_link',
       'level',
       'start_date',
       'finish_date',
       'report_time',
       'contact_name',
       'contact_position',
       'contact_number',

    ];
}
