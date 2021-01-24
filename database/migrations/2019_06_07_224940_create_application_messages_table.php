<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_messages', function (Blueprint $table) {
            $table->bigIncrements('id')->index('aplm__id');
            $table->bigInteger('application_id')->unsigned()->index('aplm_application_id');			
            $table->bigInteger('user_id')->unsigned()->index('aplm_user_id');			
            $table->text('message')->default(null);			
			$table->enum('active', ['0', '1'])->default('0');			
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('no action');
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
        Schema::dropIfExists('application_messages');
    }
}
