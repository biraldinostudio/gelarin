<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubAdmin2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_admin2s', function (Blueprint $table) {
            $table->increments('id')->index('adm2_id');
            $table->string('code', 20)->default('')->unique('adm2_code')->index('adm2_code');
            $table->string('country_code', 3)->index('adm2_country_code');
            $table->string('subadmin1_code', 20)->index('adm2_subadmin1_code');			
            $table->string('name',53)->index('adm2_name');
            $table->string('asciiname', 53)->index('adm2_asciiname');
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
        Schema::dropIfExists('sub_admin2s');
    }
}
