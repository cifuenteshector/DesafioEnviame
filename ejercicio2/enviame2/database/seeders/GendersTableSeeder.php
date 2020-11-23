<?php

namespace Database\Seeders;

use App\Models\Genders;
use Illuminate\Database\Seeder;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genders::insert(array(
            array("gender" => "Masculino"),	
			array("gender" => "Femenina"),		
			array("gender" => "Otro"),		
        ));
    }
}
