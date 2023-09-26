<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moa_Files extends Model
{
    use HasFactory;

    protected $guarded=[ ];
    protected $primaryKey='file_id';
    protected $table='tbl_moa_files';
    protected $fillable = [
      
       'file_name',
       'file_path',
       'uploaded_by',
       'date_uploaded',
       'adviser_approval',
       'ojt_coordinator_approval'
    ];
  
}
