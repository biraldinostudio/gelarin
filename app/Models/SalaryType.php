<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryType extends Model
{
    //
	protected $primaryKey = 'translation_of';
    protected $table = 'salary_types';
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

	public function vacancy()
	{
        return $this->hasMany(Vacancy::class);
	}
    public function scopeSSalaryType() {
		$salary_types = SalaryType::select('name','translation_of','translation_lang')->where('translation_lang', app()->getLocale())->where('active',1)->orderBy('translation_of','ASC')->get();
        return $salary_types;
    } 	
}
