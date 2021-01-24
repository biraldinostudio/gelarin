<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Setting::insert([
            [		
              'title'  => '- Job Portal, Freelancer, Business HUB, Travel HUB, Link & Matcm',			
              'description'  => 'Gelarin - Job Portal, Freelancer, Travel Hub, Busines Hub, UMKM',
              'keyword' => 'gelarin.com, gelarin, job portal, freelancer, travel hub, business hub, umkm',
              'mail_driver'=> 'smtp',
              'mail_host'=> 'mail.gelarin.com',
			  'mail_port'=>'465',			  
              'mail_username'=> 'noreply@gelarin.com',
              'mail_address'  => 'noreply@gelarin.com',			
              'mail_name'  => 'Noreply Gelarin',
              'mail_password' => 'tugumonas',
              'mail_encryption'=> 'ssl'			  
            ],
        ]);
    }
}
