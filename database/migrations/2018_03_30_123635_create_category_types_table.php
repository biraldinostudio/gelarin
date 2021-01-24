<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_types', function (Blueprint $table) {
            $table->increments('id')->unsigned()->index('ctgt_id');
            $table->string('translation_lang', 3)->index('ctgt_translation_lang');
            $table->integer('translation_of')->unsigned()->index('ctgt_translation_of');
            $table->string('name', 191)->default('')->index('ctgt_name');
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
        Schema::dropIfExists('category_types');
    }
}
