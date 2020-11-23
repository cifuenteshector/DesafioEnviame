<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WsApiEnviame extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey= 'id';

    protected $table = 'ws_api_enviame';

    protected $fillable = array(
        'http_response',
        'response',
        'url_consumo',
        'created_at',
        'updated_at',
        'deleted_at',    
        'identifier',        
        'imported_id',       
        'tracking_number',   
        'customer',          
        'shipping_address',  
        'carrier',           
        'service',           
        'country',          
        'status'            
    );
}
