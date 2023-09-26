<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_Approval extends Model
{
    use HasFactory;
    protected $primaryKey='approval_id';
    protected $table='tbl_students_approval';
    protected $fillable = [

        'room_id',
        'student_id',
        'approval_status',
      
    ];
}
