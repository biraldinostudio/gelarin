<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_comments', function (Blueprint $table) {
            $table->bigIncrements('id')->index('artc_id');
            $table->bigInteger('parent_id')->unsigned()->nullable()->default(0)->index('artc_parent_id');			
            $table->bigInteger('article_id')->unsigned()->index('artc_article_id');			
            $table->bigInteger('user_id')->unsigned()->index('artc_user_id');			
            $table->text('comment')->default(null);
			$table->enum('value', ['1', '2','3','4','5'])->default(null);			
			$table->enum('active', ['1', '0'])->default('0');			
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('no action');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');			
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
        Schema::dropIfExists('article_comments');
    }
}
