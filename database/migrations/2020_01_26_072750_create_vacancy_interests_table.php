<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacancyInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancy_interests', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned()->index('vacint_user_id');			
            $table->Integer('category_id')->unsigned()->index('vacint_category_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');				
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('no action');				
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
        Schema::dropIfExists('vacancy_interests');
    }
}
