<?php

namespace Database\Seeders;

use App\Models\CivilStatus;
use Illuminate\Database\Seeder;

class CivilStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CivilStatus::insert(array(
            array("civil_status" => "Soltero (a)"),
            array("civil_status" => "Casado (a)"),	
            array("civil_status" => "Viudo (a)"),
            array("civil_status" => "Separado (a)"),	
            array("civil_status" => "Divorciado (a)"),
        ));
    }
}
