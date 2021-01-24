<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->bigIncrements('id')->index('ads__id');
            $table->bigInteger('user_id')->unsigned()->index('ads_user_id');
			$table->date('date')->default(null);
            $table->time('hours')->default(null);
			$table->string('number',132)->default(null)->index('ads_number');			
			$table->string('title',132)->nullable()->default(null)->index('ads_title');
            $table->string('banner', 255)->nullable()->default(null);
            $table->string('link', 255)->nullable()->default(null);			
			$table->enum('section', ['frontend', 'companies'])->default(null);
			$table->enum('position', ['application', 'vacancy_saves','vacancy_recommendation','article_manages','vacancy_manages','application_manages'])->default(null);
            $table->enum('type', ['text', 'banner'])->default(null);
			$table->date('end_date')->default(null);
            $table->enum('currency_code', ['IDR', 'USD'])->default('IDR');			
            $table->float('rates',13,2)->default(null);
            $table->enum('payment_status', ['0', '1'])->default('0');
            $table->enum('active', ['0', '1'])->default('0');			
            $table->string('activation_token', 32)->nullable();			
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');		
            $table->timestamps();			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
