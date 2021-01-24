<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyOfficersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_officers', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index('cmpo_id');
            $table->bigInteger('user_id')->unsigned()->index('cmpo_user_id');
            $table->bigInteger('company_id')->unsigned()->index('cmpo_company_id');
            $table->enum('type',['Creator','Staff'])->default('Staff');
            $table->string('position')->nullable();		
            $table->enum('vacancy_access',['0','1'])->nullable();
            $table->enum('vacancy_posting',['0','1'])->nullable();
            $table->enum('talent_search',['0','1'])->nullable();
            $table->enum('user_management',['0','1'])->nullable();
            $table->enum('credit_management',['0','1'])->nullable();
            $table->enum('receive_candidate_email',['0','1'])->nullable();
            $table->enum('add_articles',['0','1'])->nullable();
			$table->enum('active', ['0', '1'])->default('0');			
            $table->text('cancel_reason')->nullable();
            $table->string('cancel_user')->nullable();			
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('no action');			
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
        Schema::dropIfExists('company_officers');
    }
}
