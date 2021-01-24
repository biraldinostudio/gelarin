<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{ 
    protected $table = 'genders';
    //protected $appends = ['tid'];
    public $timestamps = true;
    //protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'active',
        'translation_lang',
        'translation_of'
    ];
    //public $translatable = ['name'];

    public function vacancy()
    {
        return $this->hasMany('App\Models\Vacancy','gender_id');
    }
	
    public function userdescription()
    {
        return $this->hasMany(UserDescription::class);
    }	

    public function scopeSGender() {
        $genders = Gender::select('name','translation_of','translation_lang')->where('translation_lang', app()->getLocale())->where('active',1)->get();
        return $genders;
    }
	
    public function scopeSGenderAccount() {
    	$selectionGender = [1,2];
        $genders = Gender::select('name','translation_of','translation_lang')->where('translation_lang', app()->getLocale())->whereIn('translation_of',$selectionGender)->where('active',1);
        return $genders;
    }
	
    public function scopeSGenderMyAccount() {
    	$selectionGender = [1,2];
        $genders = Gender::select('name','translation_of','translation_lang')->where('translation_lang', app()->getLocale())->whereIn('translation_of',$selectionGender)->where('active',1);
        return $genders;
    }	
}
