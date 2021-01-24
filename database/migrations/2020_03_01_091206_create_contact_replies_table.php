<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_replies', function (Blueprint $table) {
            $table->bigIncrements('id')->index('ctcr_id');
            $table->bigInteger('contact_id')->unsigned()->index('ctcr_contact_id');
            $table->bigInteger('user_id')->unsigned()->index('ctcr_user_id');			
            $table->bigInteger('parent_id')->unsigned()->nullable()->default(0)->index('ctcr_parent_id');			
            $table->text('message')->default(null);		
			$table->enum('active', ['1', '0'])->default('0');		
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('no action');
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
        Schema::dropIfExists('contact_replies');
    }
}
