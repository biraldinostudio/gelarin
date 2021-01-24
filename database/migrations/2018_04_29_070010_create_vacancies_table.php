<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index('vcy_id');	
            $table->string('country_code', 3)->index('vcy_country_code');
            $table->bigInteger('user_id')->unsigned()->index('vcy_user_id');
			$table->integer('category_id')->unsigned()->index('vcy_category_id');
			$table->bigInteger('city_id')->unsigned()->index('vcy_city_id');
			$table->integer('working_type_id')->unsigned()->index('vcy_working_type_id');
			$table->integer('working_level_id')->unsigned()->index('vcy_working_level_id');
			$table->integer('salary_type_id')->unsigned()->index('vcy_salary_type_id');
			$table->integer('gender_id')->unsigned()->index('vcy_gender_id');
			$table->integer('company_id')->unsigned()->index('vcy_company_id');			
			$table->date('date')->default(null);
            $table->time('hours')->default(null);
			$table->string('title')->default('')->index('vcy_title');
            $table->longText('description')->default(null);
            $table->string('slug',255)->default(null);			
            $table->date('start_date')->default(null)->index('vcy_start_date');
            $table->date('closing_date')->default(null)->index('vcy_closing_date');
            $table->integer('years_experience')->default(null);
            $table->integer('max_age')->default(null);			
            $table->float('min_salary', 13,2)->nullable()->default(null);
            $table->float('max_salary',13,2)->nullable()->default(null);
			$table->enum('negotiation', ['0', '1'])->nullable()->default('0');
			$table->enum('hide_salary', ['0', '1'])->nullable()->default('0');			
            $table->string('application_url', 200)->nullable()->default(null);			
            $table->string('postal_code')->nullable()->default(null);
            $table->string('address')->nullable()->default(null);			
            $table->float('lat', 10, 0)->nullable()->default(0);
            $table->float('lon', 10, 0)->nullable()->default(0);
            $table->ipAddress('ip_addr', 50)->nullable();			
            $table->bigInteger('visits')->unsigned()->nullable()->default(0);
            $table->string('activation_token', 32)->nullable();
			$table->enum('active', ['0', '1'])->default('0');
			$table->enum('reviewed', ['0', '1'])->default('0');
			$table->enum('featured', ['0', '1'])->default('0');			
			$table->enum('archived', ['0', '1'])->default('0');
			$table->enum('partner', ['0', '1'])->default('0');
            $table->text('cancel_reason')->nullable();
            $table->string('cancel_user')->nullable();
			$table->date('cancel_date')->nullable();		
            $table->foreign('country_code')->references('code')->on('countries')->onDelete('no action');			
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('no action');			
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('no action');
            $table->foreign('working_type_id')->references('id')->on('working_types')->onDelete('no action');
            $table->foreign('working_level_id')->references('id')->on('working_levels')->onDelete('no action');
            $table->foreign('salary_type_id')->references('id')->on('salary_types')->onDelete('no action');
            $table->foreign('gender_id')->references('id')->on('genders')->onDelete('no action');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('no action');			
            $table->timestamps();
            $table->softDeletes();
            $table->index(['lat', 'lon'], 'lat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacancies');
    }
}
