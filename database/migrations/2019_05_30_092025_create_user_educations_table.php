<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_educations', function (Blueprint $table) {
            $table->bigincrements('id')->unsigned()->index('usredu_id');
            $table->bigInteger('user_id')->unsigned()->index('usredu_user_id');			
            $table->Integer('education_id')->unsigned()->index('usredu_education_id');
            $table->String('school',100)->default(null);			
            $table->String('major',100)->default(null);
            $table->String('degree',100)->nullable();			
			$table->year('start_year')->default(null);
			$table->year('last_year')->default(null);		
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');				
            $table->foreign('education_id')->references('id')->on('educations')->onDelete('no action');				
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
        Schema::dropIfExists('user_educations');
    }
}
