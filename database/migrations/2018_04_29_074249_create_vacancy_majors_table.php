<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacancyMajorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancy_majors', function (Blueprint $table) {
            $table->bigInteger('vacancy_id')->unsigned()->index('vcym_vacancy_id');			
            $table->Integer('major_id')->unsigned()->index('vcym_major_id');
            $table->foreign('vacancy_id')->references('id')->on('vacancies')->onDelete('no action');				
            $table->foreign('major_id')->references('id')->on('majors')->onDelete('no action');				
        });
    }

    /**
     * Reverse the migrations.->unsigned()->default(0)->primary();
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacancy_majors');
    }
}
