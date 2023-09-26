<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File_Categories extends Model
{
    use HasFactory;
    protected $guarded=[ ];
    protected $primaryKey='category_id';
    protected $table='tbl_file_categories';
    protected $fillable = [
       'category_id',
       'category_name',
       
    ];
}
