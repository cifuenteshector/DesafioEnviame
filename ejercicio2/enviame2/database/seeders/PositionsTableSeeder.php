<?php

namespace Database\Seeders;

use App\Models\Positions;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()   
    {
        //DB::table('positions')->truncate();
        Positions::insert(array(
            array("position" => 'administrador'),
			array("position" => 'administrativo'),
			array("position" => 'alarife'),
			array("position" => 'alumno'),
			array("position" => 'antropologo'),
			array("position" => 'arqueologo'),
			array("position" => 'arquitecto'),
			array("position" => 'arriero'),
			array("position" => 'asesor'),
			array("position" => 'asistente'),
			array("position" => 'aspirante'),
			array("position" => 'auditor'),
			array("position" => 'auxiliar'),
			array("position" => 'ayudante'),
			array("position" => 'biologo'),
			array("position" => 'bodeguero'),
			array("position" => 'bombero'),
			array("position" => 'cadista'),
			array("position" => 'campamentero'),
			array("position" => 'cañonero'),
			array("position" => 'capacitador'),
			array("position" => 'capataz'),
			array("position" => 'card - check'),
			array("position" => 'carpintero'),
			array("position" => 'cartografo'),
			array("position" => 'ceramista'),
            array("position" => 'chofer'),
        ));
    }
}
