<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCntWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cnt_workers', function (Blueprint $table) {
            $table->id();
            $table->string('contract_code');
            $table->bigInteger('fkid_company')->unsigned();
            $table->bigInteger('fkid_persona')->unsigned();
            $table->bigInteger('fkid_position')->unsigned();
            $table->bigInteger('fkid_work_shift')->unsigned();
            $table->bigInteger('fkid_type_contract')->unsigned();
            $table->timestamp('contract_start_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('contract_end_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('cnt_workers', function (Blueprint $table) {
            $table->foreign('fkid_company')->references('id')->on('companys');
            $table->foreign('fkid_persona')->references('id')->on('persons');
            $table->foreign('fkid_position')->references('id')->on('positions');
            $table->foreign('fkid_work_shift')->references('id')->on('work_shifts');
            $table->foreign('fkid_type_contract')->references('id')->on('types_contract');
        });
    }
        
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cnt_workers');
    }
}
