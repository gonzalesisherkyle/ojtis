<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $primaryKey='student_id';
    protected $table='tbl_students';
    protected $fillable = [

        'course_id',
        'adviser_id',
        'first_name',
        'middle_name',
        'last_name',
        'contact_number',
        'student_number',
        'year_and_section',
        'email',
        'password',
        'date_of_birth',
        'suffix',
        'address',
        'status',
    ];
    protected $hidden = [
        'password', 
    ];
}
