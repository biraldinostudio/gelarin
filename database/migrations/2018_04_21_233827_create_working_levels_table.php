<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkingLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_levels', function (Blueprint $table) {
            $table->increments('id')->index('wrkl_id');
            $table->string('translation_lang', 3)->index('wrkl_translation_lang');
            $table->integer('translation_of')->unsigned()->index('wrkl_translation_of');
            $table->string('name', 53)->default('')->index('wrkl_name');
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
        Schema::dropIfExists('working_levels');
    }
}
