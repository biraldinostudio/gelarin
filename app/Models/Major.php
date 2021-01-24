<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    //
    protected $table = 'majors';
	//protected $primaryKey = 'translation_of';
    
     //protected $appends = ['tid'];
    //protected $appends = ['translation_of'];
    public $timestamps = false;
    protected $guarded = ['id'];	
    protected $fillable = [
        'parent_id',
        'name',
        'lft',
        'rgt',
        'depth',
        'translation_lang',
        'translation_of',
        'active',		
    ];
    public $translatable = ['name'];	
	
	/*public function major()
	{
        return $this->hasMany('App\Models\Vacancy','major_id');
	}*/
	
    public function vacancy(){
    	return $this->belongsToMany(Vacancy::class,'vacancy_majors');
    }	
	
	public function vacancymajor(){
        return $this->hasMany(Vacancy::class);
    }		

    public function scopeSMajorParent() {
		$majorparents = Major::select('name','translation_of','translation_lang')->where('translation_lang', app()->getLocale())->where('parent_id',0)->where('active',1)->get();
        return $majorparents;
    }    
    public function scopeSMajorChild() {
        $majorchild = Major::select('name','translation_of','translation_lang','parent_id')->where('parent_id','!=',0)->where('translation_lang', app()->getLocale())->where('active',1)->get();
        return $majorchild;
    }
    /*public function scopeSVacancyMajor() {
		$vacancymajors=VacancyMajor::select('major_id','vacancy_id','id')->get();
        return $vacancymajors;
    }*/
	
}
