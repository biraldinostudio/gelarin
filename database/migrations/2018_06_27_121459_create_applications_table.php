<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index('apl_id');
            $table->bigInteger('user_id')->unsigned()->index('apl_user_id');
            $table->bigInteger('vacancy_id')->unsigned()->index('apl_vacancy_id');
            //$table->Integer('reason_cancel_id')->unsigned()->index('apl_reason_cancel_id');
            $table->Integer('reason_cancel_id')->unsigned()->nullable()->index('apl_reason_cancel_id');			
            $table->longText('description', 1000)->nullable();
			$table->enum('application_status', ['Unprocessed', 'Shortlist','Interview','MCU','Theory Test','Practice Test','Not Suitable','Pass','Cancel'])->default('Unprocessed');			
			$table->enum('active', ['1', '0'])->default('0');		
			$table->date('read_date')->nullable();
			$table->time('read_time')->nullable();			
			$table->date('shortlist_date')->nullable();
			$table->date('interview_date')->nullable();
			$table->date('not_suitable_date')->nullable();
			$table->date('pass_date')->nullable();
            $table->text('reason_cancel')->nullable();			
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
            $table->foreign('vacancy_id')->references('id')->on('vacancies')->onDelete('no action');
            $table->foreign('reason_cancel_id')->references('id')->on('reason_cancel_vacancies')->onDelete('no action');			
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
        Schema::dropIfExists('applications');
    }
}
