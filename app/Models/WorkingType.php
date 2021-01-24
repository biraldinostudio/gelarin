<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkingType extends Model
{
    //
	//protected $primaryKey = 'translation_of';
    protected $table = 'working_types';
    //protected $appends = ['tid'];
    public $timestamps = false;
   protected $guarded = ['id'];	
    protected $fillable = [
        'id',
        'name',
        'active',
        'lft',
        'rgt',
        'depth',
        'translation_lang',
        'translation_of',
    ];
    public $translatable = ['name'];
        protected $dates = ['created_at', 'updated_at'];

        protected $appends = ['tid'];

    public function vacancy()
    {
		return $this->hasMany(Vacancy::class);
    }
	

    public function getTidAttribute()
    {
        $translationOf = (isset($this->attributes['translation_of'])) ? $this->attributes['translation_of'] : null;
        $entityId = (isset($this->attributes['id'])) ? $this->attributes['id'] : $translationOf;
        
        if (!empty($translationOf)) {
            if ($this->attributes['translation_lang'] ==  'id') {
                return $entityId;
            } else {
                return $translationOf;
            }
        } else {
            return $entityId;
        }
    }
	//Bagian company
    public function scopeSCompWorkType() {
        $working_types = WorkingType::select('name','translation_of','translation_lang')->where('translation_lang', app()->getLocale())->where('active',1)->orderBy('translation_of','ASC')->get();
        return $working_types;
    }  	
	
	//Vacancy Type FrontEnd
    public function scopeSWorkingType($query)
    {
        return $query->join('vacancies', function($join)
            {
                $join->on('working_types.translation_of', '=', 'vacancies.working_type_id')->where('working_types.translation_lang','=',app()->getLocale());
            })
			->select('working_types.translation_of','working_types.name')
			->where('vacancies.working_type_id','!=',null)			
			->groupBy('working_types.translation_of','working_types.name');
	}

    public function scopeSWorkingTypeOnly() {
		return WorkingType::select('name','translation_of','translation_lang')->where('translation_lang', app()->getLocale())->where('active',1)->orderBy('translation_of','ASC');
    }		


 
}
