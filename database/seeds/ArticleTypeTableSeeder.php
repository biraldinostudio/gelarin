<?php

use Illuminate\Database\Seeder;

class ArticleTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ArticleType::insert([
            [
              'translation_lang'  => 'id',
              'translation_of' => '1',
              'name'=> 'Narasi',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '2',
              'name'=> 'Deskripsi',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '3',
              'name'=> 'Eksposisi',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '4',
              'name'=> 'Argumentasi',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '5',
              'name'=> 'Persuasi',
              'active'=> '1'
            ],
            [ //English
              'translation_lang'  => 'en',
              'translation_of' => '1',
              'name'=> 'Narration',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '2',
              'name'=> 'Description',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '3',
              'name'=> 'Exposition',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '4',
              'name'=> 'Argumentation',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '5',
              'name'=> 'Persuasion',
              'active'=> '1'
            ],			
        ]);
    }
}
