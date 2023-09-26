<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;
    protected $primaryKey='room_id';
    protected $table='tbl_rooms';
    protected $fillable = [

        'room_name',
        'adviser_id',
        'course_id',
        'student_id',
        'room_status'
      
    ];
    

}
