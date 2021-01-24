<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {		
            $table->string('title',255);
            $table->text('description')->nullable();
            $table->string('keyword',255)->nullable();
            $table->string('welcome',255)->nullable();			
            $table->string('favicon',255)->nullable();		
            $table->string('logo_hdr1',255)->nullable();
            $table->string('logo_hdr2',255)->nullable();
            $table->string('logo_hdr1_mbl',255)->nullable();
            $table->string('logo_hdr2_mbl',255)->nullable();			
            $table->string('logo_ftr1',255)->nullable();
            $table->string('logo_ftr2',255)->nullable();
            $table->string('logo_ftr1_mbl',255)->nullable();
            $table->string('logo_ftr2_mbl',255)->nullable();			
            $table->string('mail_driver',20)->nullable();			
            $table->string('mail_host',255)->nullable();
            $table->string('mail_port',10)->nullable();
            $table->string('mail_username',50)->nullable();			
            $table->string('mail_address',50)->nullable();
            $table->string('mail_name',50)->nullable();			
            $table->string('mail_password',255)->nullable();
            $table->string('mail_encryption',25)->nullable();
            $table->string('phone_driver',20)->nullable();			
            $table->string('phone_host',255)->nullable();
            $table->string('phone_port',10)->nullable();
            $table->string('phone_username',50)->nullable();			
            $table->string('phone_number',50)->nullable();
            $table->string('phone_name',50)->nullable();			
            $table->string('phone_password',255)->nullable();
            $table->string('phone_encryption',25)->nullable();			
            $table->string('footer',50)->nullable();
            $table->string('footer_mbl',50)->nullable();
			$table->enum('lang', ['id', 'en'])->default('id');			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
