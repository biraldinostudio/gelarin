<?php

use Illuminate\Database\Seeder;

class SalaryTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\SalaryType::insert([
            [
              'translation_lang'  => 'id',
              'translation_of' => '1',
              'name'=> 'Bulan',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '2',
              'name'=> 'Minggu',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '3',
              'name'=> 'Hari',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '4',
              'name'=> 'Jam',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '5',
              'name'=> 'Tahun',
              'active'=> '1'
            ],
            [//English
              'translation_lang'  => 'en',
              'translation_of' => '1',
              'name'=> 'Month',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '2',
              'name'=> 'Week',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '3',
              'name'=> 'Day',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '4',
              'name'=> 'Hours',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '5',
              'name'=> 'Year',
              'active'=> '1'
            ],			
        ]);
    }
}
