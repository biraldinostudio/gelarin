<?php

use Illuminate\Database\Seeder;

class EducationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Education::insert([
            [
              'translation_lang'  => 'id',
              'translation_of' => '1',
              'name'=> 'SLTP',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '2',
              'name'=> 'SLTA',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '3',
              'name'=> 'Diploma',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '4',
              'name'=> 'Gelar Sarjana',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '5',
              'name'=> 'Gelar Master / Pasca Sarjana',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '6',
              'name'=> 'Doktor',
              'active'=> '1'
            ],			
            [ // English
              'translation_lang'  => 'en',
              'translation_of' => '1',
              'name'=> 'Junior high school',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '2',
              'name'=> 'High School',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '3',
              'name'=> 'Diploma',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '4',
              'name'=> 'Bachelor\'s Degree',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '5',
              'name'=> 'Master\'s Degree / Post-Graduate',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '6',
              'name'=> 'Doctorate',
              'active'=> '1'
            ],				
        ]);
    }
}
