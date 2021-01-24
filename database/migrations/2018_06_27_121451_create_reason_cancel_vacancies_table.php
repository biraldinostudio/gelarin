<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReasonCancelVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reason_cancel_vacancies', function (Blueprint $table) {
            $table->increments('id')->index('rsncv_id');
            $table->string('translation_lang', 3)->index('rsnvc_translation_lang');
            $table->integer('translation_of')->unsigned()->index('rsnvc_translation_of');
            $table->string('name', 30)->index('rscnv_name');
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
        Schema::dropIfExists('reason_cancel_vacancies');
    }
}
