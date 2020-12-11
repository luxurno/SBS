<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            'name' => 'new york',
            'created_at' => new DateTime('now')
        ]);
        DB::table('cities')->insert([
            'name' => 'washington',
            'created_at' => new DateTime('now')
        ]);
        DB::table('cities')->insert([
            'name' => 'london',
            'created_at' => new DateTime('now')
        ]);
    }
}
