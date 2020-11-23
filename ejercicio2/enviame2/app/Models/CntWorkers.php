<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CntWorkers extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='cnt_workers';
    protected $primaryKey = 'id';

    protected $fillable = [
        'contract_code',
        'fkid_company',
        'fkid_person',
        'fkid_position',
        'fkid_work_shift',
        'fkid_type_contract',
        'contract_start_date',
        'contract_end_date',

    ];
}
