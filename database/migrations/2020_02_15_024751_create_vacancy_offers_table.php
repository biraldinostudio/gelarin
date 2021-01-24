<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacancyOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancy_offers', function (Blueprint $table) {			
            $table->bigInteger('vacancy_id')->unsigned()->index('voff_vacancy_id');
            $table->bigInteger('user_id')->unsigned()->index('voff_user_id');
            $table->foreign('vacancy_id')->references('id')->on('vacancies')->onDelete('no action');			
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacancy_offers');
    }
}
