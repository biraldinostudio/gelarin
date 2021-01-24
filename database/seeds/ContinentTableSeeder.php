<?php

use Illuminate\Database\Seeder;

class ContinentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Continent::insert([
            [
              'code'  => 'AF',
              'name' => 'Africa',
              'active'=> '1'
            ],
            [
              'code'  => 'AN',
              'name' => 'Antarctica',
              'active'=> '1'
            ],
            [
              'code'  => 'AS',
              'name' => 'Asia',
              'active'=> '1'
            ],
            [
              'code'  => 'EU',
              'name' => 'Europe',
              'active'=> '1'
            ],
            [
              'code'  => 'OC',
              'name' => 'Oceania',
              'active'=> '1'
            ],
            [
              'code'  => 'SA',
              'name' => 'South America',
              'active'=> '1'
            ],
            [
              'code'  => 'NA',
              'name' => 'North America',
              'active'=> '1'
            ]			
        ]);
    }
}
