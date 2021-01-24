<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            //$table->increments('id');
            $table->bigIncrements('id')->index('usr_id');			
            $table->string('name',35);
            $table->string('email',53)->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();			
            $table->enum('type',['Superadmin','Admin','Company','Member','Partner','Content','Editor','Publisher','School','Student','Finance','Intelligence','Government','Developer'])->default('Member');
			$table->string('api_token', 255)->unique()->nullable()->default(null);			
			$table->enum('active', ['0', '1','2'])->default('0');
			$table->enum('verified', ['0', '1'])->default('0');			
			$table->enum('blocked', ['0', '1'])->default('0');			
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
