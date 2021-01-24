<?php

use Illuminate\Database\Seeder;

class WorkingLevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\Models\WorkingLevel::insert([
            [
              'translation_lang'  => 'id',
              'translation_of' => '1',
              'name'=> 'CEO/GM/Direktur/Manajer Senior',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'id',
              'translation_of' => '2',
              'name'=> 'Manajer / Asisten Manajer',
              'active'=> '1'
            ],	
            [
              'translation_lang'  => 'id',
              'translation_of' => '3',
              'name'=> 'Supervisor / Koordinator',
              'active'=> '1'
            ],	
            [
              'translation_lang'  => 'id',
              'translation_of' => '4',
              'name'=> 'Staf (non manajemen & non supervisor)',
              'active'=> '1'
            ],	
            [
              'translation_lang'  => 'id',
              'translation_of' => '5',
              'name'=> 'Baru Lulus',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '1',
              'name'=> 'CEO/GM/Director/Senior Manager',
              'active'=> '1'
            ],
            [
              'translation_lang'  => 'en',
              'translation_of' => '2',
              'name'=> 'Manager/Assistant Manager',
              'active'=> '1'
            ],	
            [
              'translation_lang'  => 'en',
              'translation_of' => '3',
              'name'=> 'Supervisor/Coordinator',
              'active'=> '1'
            ],	
            [
              'translation_lang'  => 'en',
              'translation_of' => '4',
              'name'=> 'Staff(non management & non supervisor)',
              'active'=> '1'
            ],	
            [
              'translation_lang'  => 'en',
              'translation_of' => '5',
              'name'=> 'Fresh Graduate',
              'active'=> '1'
            ],
        ]);
    }
}
