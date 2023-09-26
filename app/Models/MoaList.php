<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoaList extends Model
{
    use HasFactory;
    protected $primaryKey='company_id';
    protected $table='moa_lists';
    protected $fillable = [

        'company_name',
        'company_address',
        'company_contact_person',
        'company_contact_person_position',
    ];
}
