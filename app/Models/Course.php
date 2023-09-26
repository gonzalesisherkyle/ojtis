<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Course extends Model
{
    use HasFactory;

    protected $guarded=[ ];
    protected $primaryKey='course_id';
    protected $table='tbl_courses';
    protected $fillable = [
       'course_name',
       'course_abb',
    ];
  
    public function users()
    {
    	return $this->hasMany(User::class, 'course_id');
    }

}
