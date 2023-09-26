<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;
    protected $guarded=[ ];
    protected $primaryKey='reg_id';
    protected $table='registers';
    protected $fillable = [
       'adviser_id',
       'course_id',
       'last_name',
       'first_name',
       'email',
       'year_and_section',
       'status',
    ];
}
