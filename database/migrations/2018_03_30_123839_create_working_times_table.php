<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkingTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_times', function (Blueprint $table) {
            $table->increments('id')->unsigned()->index('wrkt_id');
            $table->string('translation_lang', 3)->index('wrkt_translation_lang');
			$table->integer('translation_of')->unsigned()->index('wrkt_translation_of');
            $table->string('name', 80)->default('')->index('wrkt_name');
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
        Schema::dropIfExists('working_times');
    }
}
