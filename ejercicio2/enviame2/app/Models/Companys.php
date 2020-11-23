<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Companys extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='companys';
    protected $primaryKey = 'id';

    protected $fillable = [
        'rut_company',
        'dv_company',
        'business_name',
        'fantasy_name',
        'address',
        'deleted_at'
    ];
}
