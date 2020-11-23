<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('rut_person')->unique();
            $table->string('dv_verif_person');
            $table->bigInteger('fkid_civil_status')->unsigned();
            $table->bigInteger('fkid_gender')->unsigned();
            $table->bigInteger('fkid_nationality')->unsigned();
            $table->string('passport')->unique();
            $table->date('birthday');
            $table->string('first_name');
            $table->string('last_name');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('persons', function (Blueprint $table) {
            $table->foreign('fkid_civil_status')->references('id')->on('civil_status');
            $table->foreign('fkid_gender')->references('id')->on('genders');
            $table->foreign('fkid_nationality')->references('id')->on('nationalitys');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona');
    }
}
