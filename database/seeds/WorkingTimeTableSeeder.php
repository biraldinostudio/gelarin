<?php

use Illuminate\Database\Seeder;

class WorkingTimeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\WorkingTime::insert([
            [
              'translation_lang'  => 'id',
              'translation_of' => '1',
              'name'=> 'Waktu kerja Reguler, Senin - Kamis',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '2',
              'name'=> 'Waktu Reguler, Senin - Jumat',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '3',
              'name'=> 'Waktu Reguler, Senin - Sabtu',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '4',
              'name'=> 'Waktu Reguler , Senin - Minggu',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '5',
              'name'=> 'Waktu Non Reguler',
              'active'=> '1'
            ],
            [//English
              'translation_lang'  => 'en',
              'translation_of' => '1',
              'name'=> 'Regular Time, Monday - Thursday',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '2',
              'name'=> 'Regular Time, Monday - Friday',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '3',
              'name'=> 'Regular Time, Monday - Saturday',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '4',
              'name'=> 'Regular Time, Monday - Sunday',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '5',
              'name'=> 'Non-Regular Time',
              'active'=> '1'
            ],
        ]);
    }
}
