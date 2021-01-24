<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VacancyEducation extends Model
{
    //
    protected $table = 'vacancy_educations';
	
    public function vacancy(){
        return $this->belongsTo(Vacancy::class);           
    }

    public function scopeSVacancyEducation() {
		$vacancyeducations=VacancyEducation::select('education_id','vacancy_id')->get();
        return $vacancyeducations;
    }  	
}
