<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMajorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('majors', function (Blueprint $table) {
            $table->increments('id')->index('mjr_id');
            $table->string('translation_lang', 3)->index('mjr_translation_lang');
            $table->integer('translation_of')->unsigned()->nullable()->index('mjr_translation_of');
            $table->integer('parent_id')->unsigned()->index('mjr_parent_id');			
            $table->string('name', 53)->default('')->index('mjr_name');
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
        Schema::dropIfExists('majors');
    }
}
