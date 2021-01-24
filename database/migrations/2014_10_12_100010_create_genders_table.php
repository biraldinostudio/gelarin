<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genders', function (Blueprint $table) {
            $table->increments('id')->index('gdr_id');
            $table->string('translation_lang', 3)->index('gdr_translation_lang');
            $table->integer('translation_of')->unsigned()->index('gdr_translation_of');
            $table->string('name', 30)->index('gdr_name');
			$table->enum('active', ['0', '1'])->default('0');			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genders');
    }
	
}
