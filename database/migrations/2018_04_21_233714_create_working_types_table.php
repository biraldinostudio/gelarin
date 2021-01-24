<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkingTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_types', function (Blueprint $table) {
            $table->increments('id')->index('wrktp_id');
            $table->string('translation_lang', 3)->index('wrktp_translation_lang');
            $table->integer('translation_of')->unsigned()->index('wrktp_translation_of');
            $table->string('name', 53)->index('wrktp_name');
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
        Schema::dropIfExists('working_types');
    }
}
