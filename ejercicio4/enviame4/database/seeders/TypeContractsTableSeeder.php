<?php

namespace Database\Seeders;

use App\Models\TypesContract;
use Illuminate\Database\Seeder;

class TypeContractsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypesContract::insert(array(
            array("type_contract" => "Contrato Indefinido"),
            array("type_contract" => "Plazo Fijo"),
            array("type_contract" => "Por Obra o Faena"),	
            array("type_contract" => "Honorarios"),
        ));
    }
}
