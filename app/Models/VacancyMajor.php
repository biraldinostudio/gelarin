<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VacancyMajor extends Model
{
    //
     protected $table = 'vacancy_majors';
	//protected $primaryKey = 'id';	
    protected $fillable = [
        'major_id',
        'vacancy_id',
    ];   
   /* public function vacancy()
    {
        return $this->belongsTo('App\Models\Vacancy', 'id');
    }
    public function major()
    {
        return $this->belongsTo('App\Models\Major', 'translation_of');
    }*/
	
    public function vacancy(){
        return $this->belongsTo(Vacancy::class);           
    }
	
    public function scopeSVacancyMajor() {
		$vacancymajors=VacancyMajor::select('major_id','vacancy_id')->get();
        return $vacancymajors;
    } 	
}
