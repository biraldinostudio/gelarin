<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::insert([
            [
              //'id'  => '1',			
              'name'  => 'Administrator Gelarin',
              'email' => 'admin@gelarin.com',
              'password'=> bcrypt('123456'),
              'type'=> 'Superadmin',
              'api_token'=> 'null',			  
              'active'=> '1',
			  'verified'=>'1',
			  'blocked'=>'0',			  
              'created_at'=> \Carbon\Carbon::now('Asia/Jakarta')
            ],			
        ]);
    }
}
