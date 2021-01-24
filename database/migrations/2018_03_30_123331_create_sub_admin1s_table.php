<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubAdmin1sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_admin1s', function (Blueprint $table) {
            $table->increments('id')->index('adm1_id');
            $table->string('code', 20)->unique('adm1_code')->index('adm1_code');
            $table->string('country_code', 2)->default('')->index('adm1_country_code');	
            $table->string('name', 53)->index('adm1_name');
            $table->string('asciiname', 53)->index('adm1_asciiname');
			$table->enum('active', ['0', '1'])->default('0');
            $table->foreign('country_code')->references('code')->on('countries')->onDelete('no action');			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_admin1s');
    }
}
