<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypesContract extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='types_contract';
    protected $primaryKey = 'id';

    protected $fillable = [
        'tipe_contract',
    ];
}
