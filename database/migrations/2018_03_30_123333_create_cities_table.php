<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->bigInteger('id')->unique('cty_id')->unsigned()->index('cty_id')->primary();
            $table->string('country_code', 3)->index('cty_country_code');
            $table->string('name', 53)->index('cty_name');
            $table->string('asciiname', 53)->index('cty_asciiname');
            $table->float('latitude', 10, 0)->nullable();
            $table->float('longitude', 10, 0)->nullable();
            $table->char('feature_class', 1)->nullable();
            $table->string('feature_code', 10)->nullable();
            $table->string('subadmin1_code', 80)->index('cty_subadmin1_code');
            $table->string('subadmin2_code', 20)->nullable()->index('cty_subadmin2_code');
            $table->bigInteger('population')->nullable();
            $table->string('time_zone', 100)->nullable();
			$table->enum('active', ['0', '1'])->default('0');
            $table->foreign('country_code')->references('code')->on('countries')->onDelete('no action');
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
        Schema::dropIfExists('cities');
    }
}
