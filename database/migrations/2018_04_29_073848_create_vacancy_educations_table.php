<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacancyEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancy_educations', function (Blueprint $table) {
            $table->bigInteger('vacancy_id')->unsigned()->index('vcye_vacancy_id');			
            $table->Integer('education_id')->unsigned()->index('vcye_education_id');
            $table->foreign('vacancy_id')->references('id')->on('vacancies')->onDelete('no action');				
            $table->foreign('education_id')->references('id')->on('educations')->onDelete('no action');						
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacancy_educations');
    }
}
