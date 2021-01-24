<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyLegalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_legals', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index('cmpl_id');
            $table->bigInteger('company_id')->unsigned()->index('cmpl_company_id');				
            $table->string('name', 191)->default('');
            $table->string('number', 191)->default('');
            $table->date('expire')->nullable();
            $table->string('file', 255)->nullable();			
			$table->enum('active', ['0', '1'])->default('0');
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
        Schema::dropIfExists('company_legals');
    }
}
