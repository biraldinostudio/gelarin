<?php    
    public function scopeSpremiumVacancy($query)
    {
		return $query->join('countries', 'vacancies.country_code', '=', 'countries.code')                  
            ->join('cities', 'vacancies.city_id', '=', 'cities.id')
            ->join('vacancy_types', function ($join) {
                $join->on('vacancies.vacancy_type_id', '=', 'vacancy_types.translation_of')->where('vacancy_types.translation_lang','=',app()->getLocale());
            })             
            ->join('salary_types', function ($join) {
                $join->on('vacancies.salary_type_id', '=', 'salary_types.translation_of')->where('salary_types.translation_lang','=',app()->getLocale());
            })

            ->join('genders', function ($join) {
                $join->on('vacancies.gender_id', '=', 'genders.translation_of')->where('genders.translation_lang','=',app()->getLocale());
            })                                      
            ->join('sub_admin1s', 'sub_admin1s.code', '=', 'cities.subadmin1_code')                                         
            ->join('companies', function ($join) {
                $join->on('vacancies.company_id', '=', 'companies.id');
            })          
            ->select('vacancies.id',
                    'countries.date_format','countries.currency_code as currency',
                    'cities.name as city','sub_admin1s.name as province',
                    'vacancy_types.translation_of as vacancy_type_id','vacancy_types.name as vacancy_type',
                    'vacancies.hide_salary','vacancies.min_salary','vacancies.max_salary','salary_types.name as salary_type',
                    'vacancies.gender_id','genders.name as gender',
                    'vacancies.date as created_at','vacancies.title','vacancies.slug','vacancies.visits','vacancies.reviewed','vacancies.active','vacancies.closing_date','vacancies.start_date','vacancies.years_experience','vacancies.partner')
					->orderBy('vacancies.date','desc') 
            ;
	}