<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index('art_id');
            $table->string('country_code', 3)->index('art_country_code');			
            $table->bigInteger('user_id')->unsigned()->index('art_user_id');
			$table->integer('category_id')->unsigned()->index('art_category_id');
			$table->integer('article_type_id')->unsigned()->index('art_article_type_id');					
			$table->date('date')->default(null);
            $table->time('hours')->default(null);
			$table->string('title',255)->default('')->index('art_title');			
            $table->string('description',255)->default(null);
            $table->string('keyword',255)->default(null);			
            $table->longText('content')->default(null);
            $table->string('slug',255)->default(null);
            $table->string('cover', 255)->default(null);
			$table->string('cover_description',100)->default('')->index('art_cover_description');			
            $table->string('language', 3)->default(null);			
            $table->string('reference_link', 255)->nullable()->default(null);			
            $table->ipAddress('ip_addr', 50)->nullable();			
            $table->integer('visits')->unsigned()->nullable()->default(0);
            $table->string('activation_token', 32)->nullable();
			$table->enum('active', ['1', '0'])->default('0');
			$table->enum('reviewed', ['1', '0'])->default('0');
			$table->enum('featured', ['1', '0'])->default('0');
			$table->enum('archived', ['1', '0'])->default('0');
			$table->enum('partner', ['1', '0'])->default('0');			
            $table->foreign('country_code')->references('code')->on('countries')->onDelete('no action');			
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('no action');			
            $table->foreign('article_type_id')->references('id')->on('article_types')->onDelete('no action');		
            $table->timestamps();
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
        Schema::dropIfExists('articles');
    }
}
