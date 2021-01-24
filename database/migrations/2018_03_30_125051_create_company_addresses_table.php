<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_addresses', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index('cmpa_id');
            $table->bigInteger('company_id')->unsigned()->index('cmpa_company_id');			
			$table->bigInteger('city_id')->unsigned()->index('cmpa_city_id');			
            $table->string('address',50)->nullable();
            $table->string('postal_code',50)->nullable();
			$table->enum('active', ['0', '1'])->default('0');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('no action');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('no action');		
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
        Schema::dropIfExists('company_addresses');
    }
}
