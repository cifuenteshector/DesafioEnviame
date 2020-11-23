<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CivilStatus extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='civil_status';
    protected $primaryKey = 'id';

    protected $fillable = [
        'civil_status',
    ];
}
