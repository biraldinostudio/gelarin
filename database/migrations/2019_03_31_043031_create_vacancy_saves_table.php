<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacancySavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancy_saves', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned()->index('vcys_user_id');
            $table->bigInteger('vacancy_id')->unsigned()->index('vcys_vacancy_id');			
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
            $table->foreign('vacancy_id')->references('id')->on('vacancies')->onDelete('no action');		
            $table->timestamps();			
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacancy_saves');
    }
}
