<?php

use Illuminate\Database\Seeder;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Gender::insert([
            [
              'translation_lang'  => 'id',
              'translation_of' => '1',
              'name'=> 'Laki-laki',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '2',
              'name'=> 'Perempuan',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '1',
              'name'=> 'Male',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '2',
              'name'=> 'Female',
              'active'=> '1'
            ],
			
            [
              'translation_lang'  => 'id',
              'translation_of' => '3',
              'name'=> 'Laki/Perempuan',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '3',
              'name'=> 'Male/Female',
              'active'=> '1'
            ],
        ]);
    }
}
