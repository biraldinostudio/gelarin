<?php

use Illuminate\Database\Seeder;

class WorkingTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\Models\WorkingType::insert([
            [
              'translation_lang'  => 'id',
              'translation_of' => '1',
              'name'=> 'Purna Waktu',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '2',
              'name'=> 'Paruh Waktu',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '3',
              'name'=> 'Kontrak',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '4',
              'name'=> 'Pekerja Lepas',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '5',
              'name'=> 'Magang',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '6',
              'name'=> 'Sementara',
              'active'=> '1'
            ],
            [//English
              'translation_lang'  => 'en',
              'translation_of' => '1',
              'name'=> 'Full Time',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '2',
              'name'=> 'Part Time',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '3',
              'name'=> 'Contract',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '4',
              'name'=> 'Freelancer',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '5',
              'name'=> 'Internships',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '6',
              'name'=> 'Temporary',
              'active'=> '1'
            ],			

        ]);
    }
}
