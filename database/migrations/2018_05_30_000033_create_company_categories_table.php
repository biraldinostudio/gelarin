<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_categories', function (Blueprint $table) {
            $table->bigInteger('company_id')->unsigned()->index('cmpt_company_id');			
            $table->Integer('category_id')->unsigned()->index('cmpc_category_id');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('no action');				
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('no action');						
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_categories');
    }
}
