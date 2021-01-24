<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_bank_accounts', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index('cmpb_id');
            $table->bigInteger('company_id')->unsigned()->index('cmpb_company_id');		
            $table->string('number', 100)->nullable();
            $table->string('owner', 60)->nullable();
            $table->string('bank', 100)->nullable();			
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
        Schema::dropIfExists('company_bank_accounts');
    }
}
