<?php

use Illuminate\Database\Seeder;

class UserDescriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\UserDescription::insert([
            [
              //'id'  => '1',				
              'user_id'  => '1',			  
              'username'  => 'admin',
              'nickname' => 'admin',
              'date_birth'=> '2050-01-01',
              'about'=> 'Super Administrator Gelarin'
            ],		
        ]);
    }
}
