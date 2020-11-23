<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nationalitys extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='nationalitys';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nationality',
    ];
}
