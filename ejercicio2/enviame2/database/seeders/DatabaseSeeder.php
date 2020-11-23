<?php

namespace Database\Seeders;

use App\Models\Genders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //$this->call(PositionsTableSeeder::class);
        //$this->call(WorkShiftTableSeeder::class);
        //$this->call(NationalityTableSeeder::class);
        //$this->call(GendersTableSeeder::class);
        //$this->call(TypeContractsTableSeeder::class);
        //$this->call(CivilStatusTableSeeder::class);
        $this->call(CompanySeeder::class);
    }
}
