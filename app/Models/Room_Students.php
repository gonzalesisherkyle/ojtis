<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room_Students extends Model
{
    use HasFactory;
    protected $primaryKey='room_stud_id';
    protected $table='tbl_room_students';
    protected $fillable = [

        'room_id',
        'student_id',
        'student_status',
      
    ];
}
