<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkShifts extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='work_shifts';
    protected $primaryKey = 'id';

    protected $fillable = [
        'work_shift',
    ];
}
