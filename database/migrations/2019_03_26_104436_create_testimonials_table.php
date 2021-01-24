<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->bigIncrements('id')->index('tsm_id');			
            $table->bigInteger('user_id')->unsigned()->index('tsm_user_id');			
            $table->text('comment')->default(null);
			$table->enum('value', ['1', '2','3','4','5'])->default(null);			
			$table->enum('active', ['1', '0'])->default('0');			
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
        Schema::dropIfExists('testimonials');
    }
}
