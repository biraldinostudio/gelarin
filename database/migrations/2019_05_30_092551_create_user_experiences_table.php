<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_experiences', function (Blueprint $table) {
            $table->bigincrements('id')->unsigned()->index('usrex_id');
            $table->bigInteger('user_id')->unsigned()->index('usrex_user_id');			
			$table->String('job_position')->default(null);
			$table->String('company')->default(null);
            $table->date('start_working')->default(null)->index('usrex_start_working');
            $table->date('last_working')->default(null)->index('usrex_last_working');				
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');				
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
        Schema::dropIfExists('user_experiences');
    }
}
