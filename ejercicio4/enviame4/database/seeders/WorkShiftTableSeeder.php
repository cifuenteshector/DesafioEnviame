<?php

namespace Database\Seeders;
use App\Models\WorkShifts;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class WorkShiftTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('workshits')->truncate();
		WorkShifts::insert(array(
            array("work_shift" => "4X3"),
            array("work_shift" => "4X4"),      
            array("work_shift" => "5X2"),      
            array("work_shift" => "6X1"),      
            array("work_shift" => "7X7"),      
            array("work_shift" => "9X5"),      
            array("work_shift" => "10X5" ),       
            array("work_shift" => "10X10"),
            array("work_shift" => "12X12"),
            array("work_shift" => "14X7" ),
            array("work_shift" => "15X15"),
            array("work_shift" => "20X10"),
            array("work_shift" => "ART22"),
            array("work_shift" => "ART25")
        ));
	}
}
