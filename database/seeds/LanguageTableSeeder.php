<?php

use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Language::insert([
            [
              'abbr'  => 'id',
              'locale' => 'id_ID',
              'name'=> 'Indonesian',
			  'native'=>'Bahasa Indonesia',
			  'flag'=>'',
			  'app_name'=>'indonesia',
			  'script'=>'Latn',
			  'direction'=>'ltr',
			  'russian_pluralization'=>'0',
			  'active'=>'1',
			  'default'=>'1',
            ],
            [
              'abbr'  => 'en',
              'locale' => 'en_US',
              'name'=> 'English',
			  'native'=>'English',
			  'flag'=>'',
			  'app_name'=>'english',
			  'script'=>'Latn',
			  'direction'=>'ltr',
			  'russian_pluralization'=>'0',
			  'active'=>'0',
			  'default'=>'0',
            ],			
		
        ]);
    }
}
