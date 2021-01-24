<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->bigIncrements('id')->index('faq_id');
            $table->enum('type', array('Superadmin','Admin','Company','Member','Partner','Content','Editor','Publisher','School','Student','Finance','Intelligence','Government','Developer'))->nullable()->index('faq_type');			
            $table->string('translation_lang', 2)->nullable()->index('faq_translation_lang');
			$table->integer('translation_of')->unsigned()->index('faq_translation_of');
            $table->string('name', 191)->default('');
            $table->string('title',255)->default(null);		
            $table->longText('content')->default(null);			
            $table->string('slug', 250);			
            $table->string('picture')->nullable();						
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
        Schema::dropIfExists('faqs');
    }
}
