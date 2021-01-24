<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_types', function (Blueprint $table) {
            $table->increments('id')->unsigned()->index('artt_id');
            $table->string('translation_lang', 3)->index('artt_translation_lang');
            $table->integer('translation_of')->unsigned()->index('artt_translation_of');
            $table->string('name', 191)->default('');
			$table->enum('active', ['1', '0'])->default('0');	
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_types');
    }
}
