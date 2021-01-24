<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index('cmp_id');
            $table->Integer('working_time_id')->nullable()->unsigned()->index('cmp_working_time_id');
            $table->Integer('working_uniform_id')->nullable()->unsigned()->index('cmp_working_uniform_id');
            $table->string('code', 5)->nullable()->index('cmp_code');			
            $table->string('name', 191)->index('cmp_name');			
            $table->text('description')->nullable();
            $table->string('slug',255)->default(null);
            $table->string('email1',255)->nullable();
            $table->string('email2',255)->nullable();			
            $table->string('phone1',255)->nullable();
            $table->string('phone2',255)->nullable();			
            $table->string('fax1',255)->nullable();
            $table->string('fax2',255)->nullable();			
            $table->string('size', 191)->nullable();
            $table->string('phone_code', 5)->nullable();			
            $table->string('logo', 255)->nullable();			
            $table->enum('partner', array('1', '0'))->nullable()->default('0');
            $table->Integer('rating')->nullable();			
			$table->enum('active', ['0', '1'])->default('0');
			$table->enum('hide_email', ['0', '1'])->default('0');
			$table->enum('hide_phone', ['0', '1'])->default('0');
			$table->enum('hide_address', ['0', '1'])->default('0');			
            $table->foreign('working_time_id')->references('id')->on('working_times')->onDelete('no action');
            $table->foreign('working_uniform_id')->references('id')->on('working_uniforms')->onDelete('no action');			
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
        Schema::dropIfExists('companies');
    }
}
