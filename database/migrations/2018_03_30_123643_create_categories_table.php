<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id')->index('ctg_id');
            $table->integer('category_type_id')->unsigned()->index('ctg_category_type_id');
            $table->string('translation_lang', 2)->nullable()->index('ctg_translation_lang');
			$table->integer('translation_of')->unsigned()->index('ctg_translation_of');			
            $table->integer('parent_id')->unsigned()->nullable()->default(0)->index('ctg_parent_id');
            $table->string('name', 191)->default('')->index('ctg_name');			
            $table->string('slug', 200);
            $table->string('description', 191)->default('');				
            $table->string('picture', 191)->nullable();
            $table->string('css_class', 191)->nullable();		
			$table->integer('lft')->unsigned()->nullable();
			$table->integer('rgt')->unsigned()->nullable();
			$table->integer('depth')->unsigned()->nullable();
            $table->string('type', 191)->nullable();			
			$table->enum('active', ['0', '1'])->default('0');
            $table->foreign('category_type_id')->references('id')->on('category_types')->onDelete('no action');			
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
        Schema::dropIfExists('categories');
    }
}
