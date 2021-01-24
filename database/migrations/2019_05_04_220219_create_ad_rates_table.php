<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_rates', function (Blueprint $table) {
            $table->bigIncrements('id')->index('adsr_id');
            $table->bigInteger('user_id')->unsigned()->index('adsr_user_id');
			$table->enum('section', ['frontend', 'companies'])->default(null);
			$table->enum('position', ['application', 'vacancy_saves','vacancy_recommendation','article_manages','vacancy_manages','application_manages'])->default(null);			
			$table->enum('type', ['text', 'USD'])->default(null);			
            $table->integer('long_days')->default(null);
			$table->enum('currency_code', ['IDR', 'USD'])->default('IDR');			
            $table->float('rates',13,2)->nullable()->default(null);			
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');		
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('ad_rates');
    }
}
