<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genders extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='genders';
    protected $primaryKey = 'id';

    protected $fillable = [
        'gender',
    ];
}
