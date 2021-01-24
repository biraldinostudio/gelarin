<?php

use Illuminate\Database\Seeder;

class CategoryTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\CategoryType::insert([
            [
              'translation_lang'  => 'id',
              'translation_of' => '1',
              'name'=> 'Pekerjaan',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '2',
              'name'=> 'Acara',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '3',
              'name'=> 'Artikel',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '4',
              'name'=> 'Forum',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '5',
              'name'=> 'Industri',
              'active'=> '1'
            ],			
            [//English
              'translation_lang'  => 'en',
              'translation_of' => '1',
              'name'=> 'Jobs',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '2',
              'name'=> 'Events',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '3',
              'name'=> 'Article',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '4',
              'name'=> 'Forum',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '5',
              'name'=> 'Industry',
              'active'=> '1'
            ],			
        ]);
    }
}
