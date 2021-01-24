<?php

use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Currency::insert([
            [
              'code'  => 'IDR',
              'name'=> 'Indonesian Rupiah',
              'active'=> '1'
            ],
            [
              'code'  => 'USD',
              'name'=> 'United State Dollar',
              'active'=> '0'
            ],
            [
              'code'  => 'JPY',
              'name'=> 'Japan Yen',
              'active'=> '0'
            ],
            [
              'code'  => 'AUD',
              'name'=> 'Australia Dollar',
              'active'=> '0'
            ],
            [
              'code'  => 'EUR',
              'name'=> 'Euro',
              'active'=> '0'
            ],
		]);
    }
}
