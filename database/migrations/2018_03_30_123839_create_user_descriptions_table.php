<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_descriptions', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index('usrd_id');
            $table->bigInteger('user_id')->unsigned()->index('usrd_user_id');            
            $table->string('country_code', 3)->nullable()->index('usrd_country_code');
            $table->integer('gender_id')->nullable()->unsigned()->index('usrd_gender_id');
            $table->bigInteger('city_id')->nullable()->unsigned()->index('usrdjjjj_city_id');			
            $table->string('username',16)->nullable();
            $table->string('nickname',12)->nullable();			
            $table->date('date_birth')->nullable();
            $table->string('profession', 255)->nullable();			
            $table->longtext('about')->nullable();			
            $table->string('phone_code', 5)->nullable();			
            $table->string('phone', 60)->nullable();
            $table->string('fax', 60)->nullable();			
            $table->string('facebook', 255)->nullable();
            $table->string('google', 255)->nullable();
            $table->string('twitter', 255)->nullable();
            $table->string('linkedin', 255)->nullable();
            $table->string('instagram', 255)->nullable();
            $table->string('pinterest', 255)->nullable();
            $table->string('website', 255)->nullable();
            $table->string('address', 255)->nullable();		
            $table->string('postal_code', 191)->nullable();
            $table->string('photo', 255)->nullable();
            $table->string('cover', 255)->nullable();			
            $table->string('resume', 255)->nullable();
            $table->string('jun_school_name', 100)->nullable();
			$table->year('jun_school_start')->nullable();
			$table->year('jun_school_last')->nullable();			
            $table->string('sen_school_name', 100)->nullable();
            $table->string('sen_school_major', 100)->nullable();
			$table->year('sen_school_start')->nullable();
			$table->year('sen_school_last')->nullable();				
            $table->enum('comments_enabled',['0','1'])->nullable();
            $table->enum('receive_newsletter',['0','1'])->nullable();
            $table->enum('receive_advice',['0','1'])->nullable();
            $table->string('ip_addr', 50)->nullable();
            $table->string('provider', 50)->nullable();
            $table->integer('provider_id')->unsigned()->nullable();
			$table->enum('closed', ['0', '1'])->default('0');			
            $table->dateTime('last_login_at')->nullable();
            $table->date('resume_at')->nullable();
            $table->bigInteger('visits')->unsigned()->nullable()->default(0);				
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
            $table->foreign('gender_id')->references('id')->on('genders')->onDelete('no action');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('no action');			
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
        Schema::dropIfExists('user_descriptions');
    }
}
