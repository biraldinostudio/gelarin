<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id')->index('lng_id');
            $table->string('abbr', 10)->unique('abbr');
            $table->string('locale', 20)->nullable();
            $table->string('name', 100);
            $table->string('native', 20)->nullable();
            $table->string('flag', 100)->nullable();
            $table->string('app_name', 100);
            $table->string('script', 20)->nullable();
            $table->enum('direction',['ltr','rtl']);
			$table->enum('russian_pluralization', ['0', '1'])->default('0');			
			$table->enum('active', ['0', '1'])->default('0');
			$table->enum('default', ['0', '1'])->default('0');
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
        Schema::dropIfExists('languages');
    }
}
