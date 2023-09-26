<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Roles;
use App\Models\Course;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey='user_id';
    protected $table='users';
    protected $fillable = [

        'course_id',
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
        'applying_as',
        'status',
        'password_token',
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   /**
     * The roles that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function roles()
    {
        return $this->belongsToMany(Roles::class, 'tbl_role_user', 'user_id', 'role_id');
    }
    
    public function hasAnyRole(String $role){

        return null !== $this->roles()->where('role', $role)->first();
    }
    // public function getOrgType(String $type){

    //     return null !== $this->roles()->where('organization_type_id', $type)->first();
    // }
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
