<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persons extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='persons';
    protected $primaryKey = 'id';

    protected $fillable = [
        'rut_person',
        'fkid_civil_status',
        'fkid_gender',
        'fkid_nationality',
        'dv_verif_person',
        'passport',
        'birthday',
        'first_name',
        'last_name',
    ];
}
