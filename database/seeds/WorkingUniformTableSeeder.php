<?php

use Illuminate\Database\Seeder;

class WorkingUniformTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\WorkingUniform::insert([
            [
              'translation_lang'  => 'id',
              'translation_of' => '1',
              'name'=> 'Pakaian: Formal',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '2',
              'name'=> 'Pakaian: Seragam',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '3',
              'name'=> 'Pakaian: Bebas',
              'active'=> '1'
            ],			
            [//English
              'translation_lang'  => 'en',
              'translation_of' => '1',
              'name'=> 'Clothing: Formal',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '2',
              'name'=> 'Clothing: Uniform',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '3',
              'name'=> 'Clothing: Free',
              'active'=> '1'
            ],			
        ]);
    }
}
