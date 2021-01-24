<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {			
            $table->increments('id')->index('pge_id');
            $table->enum('type', array('page', 'aboutme','terms','privacy','help'))->nullable()->index('pge_type');			
            $table->string('translation_lang', 2)->nullable()->index('pge_translation_lang');
			$table->integer('translation_of')->unsigned()->index('pge_translation_of');			
            $table->integer('parent_id')->unsigned()->nullable()->default(0)->index('pge_parent_id');
            $table->string('name', 191)->default('');
            $table->string('description',255)->default(null);
            $table->string('keyword',255)->default(null);
            $table->string('title',255)->default(null);		
            $table->longText('content')->default(null);			
            $table->string('slug', 250);
            $table->string('link', 255)->nullable()->default(null);
            $table->string('target_blank', 200)->nullable();			
            $table->string('picture')->nullable();
			$table->enum('position', ['nav', 'lsidebar','rsidebar','footer'])->default(null);			
            $table->string('css_class', 191)->nullable();		
			$table->integer('lft')->unsigned()->nullable();
			$table->integer('rgt')->unsigned()->nullable();
			$table->integer('depth')->unsigned()->nullable();			
			$table->enum('active', ['1', '0'])->default('0');			
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
        Schema::dropIfExists('pages');
    }
}
