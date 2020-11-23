<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Companys;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Companys::insert(array(
            "rut_company" => "11111111",
            "dv_company" => "k",	
            "business_name" => "Enviame Test",
            "fantasy_name" => "Enviame",	
            "address" => "Testing"
        ));
        Companys::insert(array(
            "rut_company" => "12345254",
            "dv_company" => "k",	
            "business_name" => "Desafio S.A",
            "fantasy_name" => "Desafio",	
            "address" => "Testing 1"
        ));
        Companys::insert(array(
            "rut_company" => "98546547",
            "dv_company" => "k",	
            "business_name" => "Fibonacci S.A",
            "fantasy_name" => "Fibo",	
            "address" => "Testing 2"
        ));
    }
}
