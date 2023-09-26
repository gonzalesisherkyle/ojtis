<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;

    protected $guarded=[ ];
    protected $primaryKey='file_id';
    protected $table='tbl_files';
    protected $fillable = [
       'category_id',
       'file_name',
       'file_path',
       'uploaded_by',
       'date_uploaded'
    ];
  
}
