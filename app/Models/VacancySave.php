<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VacancySave extends Model
{
    protected $table = 'vacancy_saves';	
	public $timestamps = true;
	protected $primaryKey = ['user_id','vacancy_id'];
	public $incrementing = false;	
    protected $fillable = [
		'user_id',
		'vacancy_id'		
    ];
    public function vacancy(){
        return $this->belongsTo(Vacancy::class);           
    }
    public function user(){
        return $this->belongsTo(User::class);           
    }
	//FRONTEND: Bagian manage lowongan tersimpan
    public function scopeSVacancySaveList($query)
    {
		return $query->join('vacancies', 'vacancies.id', '=', 'vacancy_saves.vacancy_id')
            ->join('users', 'users.id', '=', 'vacancies.user_id')                   
            ->join('cities', 'vacancies.city_id', '=', 'cities.id')
            ->join('working_types', function ($join) {
                $join->on('vacancies.working_type_id', '=', 'working_types.translation_of')->where('working_types.translation_lang','=',app()->getLocale());
            })
            ->join('user_descriptions', 'users.id', '=', 'user_descriptions.user_id')                                        
            ->join('sub_admin1s', 'sub_admin1s.code', '=', 'cities.subadmin1_code')                                         
            ->join('company_officers', 'users.id', '=', 'company_officers.user_id')		
			->join('countries', 'vacancies.country_code', '=', 'countries.code')		
            ->join('companies', function ($join) {
                $join->on('company_officers.company_id', '=', 'companies.id');
            })
				->select(
					'vacancies.id as vacancy_id',
					'vacancies.slug',
					'vacancies.title','vacancies.created_at',
					'countries.date_format',
					'companies.logo',
					//'applications.application_status',
					'companies.name as company',
					'working_types.name as vacancy_type',
					'cities.name as city'
				)
				->groupBy(
					'vacancies.id',
					'vacancies.slug',
					'vacancies.title','vacancies.created_at',
					'countries.date_format',
					'companies.logo',
					//'applications.application_status',
					'companies.name',
					'working_types.name',
					'cities.name'
				)				
			->orderBy('vacancies.date','desc');
	}
	
    public function scopeSVacancySaveCount($query)
    {
		return $query->join('vacancies', 'vacancies.id', '=', 'vacancy_saves.vacancy_id')
            ->join('users', 'users.id', '=', 'vacancies.user_id')                              
            ->join('user_descriptions', 'users.id', '=', 'user_descriptions.user_id')                                                                                
            ->join('company_officers', 'users.id', '=', 'company_officers.user_id')		
			->join('countries', 'vacancies.country_code', '=', 'countries.code')	
            ->join('companies', function ($join) {
                $join->on('company_officers.company_id', '=', 'companies.id');
            });
	}		
}
