<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    //
    protected $primaryKey = 'translation_of';   
    protected $table = 'educations';
    //protected $appends = ['tid'];
    public $timestamps = false;
    protected $guarded = ['id'];	
    protected $fillable = [
        'name',
        'active',
        'lft',
        'rgt',
        'depth',
        'translation_lang',
        'translation_of',
    ];
    public $translatable = ['name'];

   /* public function vacancyeducation()
    {
        return $this->hasMany('App\Models\VacancyEducation', 'education_id');
    }*/
	
    public function vacancy(){
    	return $this->belongsToMany(Vacancy::class,'vacancy_educations');
    }	
	
	public function vacancyeducation(){
        return $this->hasMany(Vacancy::class);
    }	
	
   public function usereducation()
    {
        return $this->hasMany('App\Models\UserEducation','user_id');          
    }	
    public function scopeSEducation() {
		return Education::select('name','translation_of','translation_lang')->where('translation_lang', app()->getLocale())->where('active',1);
    }	
}
