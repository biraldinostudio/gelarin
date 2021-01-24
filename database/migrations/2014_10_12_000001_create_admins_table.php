<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->Increments('id');
            $table->bigInteger('user_id')->unsigned()->index('usa_user_id');			
            $table->string('name',53);
            $table->string('email',53)->unique();
            $table->string('password',80);
			$table->enum('verified', ['0', '1'])->default('0');			
			$table->enum('type', ['Superadmin', 'Admin','Content','Editor','Finance','Intelligence','Government','Developer'])->default('');		
			$table->enum('login', ['0', '1'])->default('0');
			$table->datetime('last_login_at')->nullable();			
			$table->enum('active', ['0', '1'])->default('0');			
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
