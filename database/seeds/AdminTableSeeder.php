<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::insert([
            [
              //'id'  => '1',			
              'user_id'  => '1',			
              'name'  => 'Administrator Gelarin',
              'email' => 'admin@gelarin.com',
              'password'=> bcrypt('tugumonas'),
              'type'=> 'Superadmin',
              'active'=> '1',
			  'verified'=>'1',			  
              'created_at'=> \Carbon\Carbon::now('Asia/Jakarta')
            ],
        ]);
    }
}
