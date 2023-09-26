<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcements extends Model
{
    use HasFactory;
    protected $primaryKey='announcement_id';
    protected $table='tbl_announcements';
    protected $fillable = [

        'room_id',
        'title',
        'body',
        'file_name',
        'file_path',
        'from',
        'to',
      
    ];
    

}
