<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsApiEnviameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_api_enviame', function (Blueprint $table) {
            $table->id();
            $table->string('http_response');     
            $table->string('identifier');   
            $table->string('imported_id'); 
            $table->string('tracking_number');
            $table->string('customer');
            $table->string('shipping_address');
            $table->string('carrier');
            $table->string('service');
            $table->string('country');
            $table->string('url_consumo');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_api_enviame');
    }
}
