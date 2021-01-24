<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_types', function (Blueprint $table) {
            $table->increments('id')->index('slr_id');
            $table->string('translation_lang', 3)->index('slr_translation_lang');
            $table->integer('translation_of')->unsigned()->index('slr_translation_of');
            $table->string('name', 30)->default('')->index('slr_name');
			$table->integer('lft')->unsigned()->nullable();
			$table->integer('rgt')->unsigned()->nullable();
			$table->integer('depth')->unsigned()->nullable();
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
        Schema::dropIfExists('salary_types');
    }
}
