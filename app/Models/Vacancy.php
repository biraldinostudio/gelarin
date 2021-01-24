<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\UserDescription;
use App\Models\Category;
use App\Models\CompanyOfficer;
use App\Models\WorkingType;
use Illuminate\Database\Eloquent\SoftDeletes; // Untuk hapus data sementara dan permanen
class Vacancy extends Model
{
    //
	use SoftDeletes;//Untuk hapus data sementara dan permanen	
    protected $table = 'vacancies';	
	protected $primaryKey = 'id';
    //protected $with = 'cities';
	protected $dates = ['deleted_at'];//Untuk hapus data sementara dan permanen	
	public $timestamps = true;
    protected $fillable = [
        'country_code',
        'user_id',
		'category_id',
        'city_id',
		'working_type_id',
		'working_level_id',
		'salary_type_id',
        'gender_id', 
        'company_id',		
		'date',
		'hours',
        'title',
        'description',
		'slug',
		'start_date',
		'closing_date',
		'years_experience',
		'max_age',		
		'min_salary',
		'max_salary',
		'negotiation',
		'hide_salary',		
		'application_url',
        'postal_code',
		'address',
        'lat',
        'lon',
        'ip_addr',
        'visits',
		'activation_token',
		'active',
        'reviewed',
        'featured',
        'archived',
        'partner',
		'cancel_reason',
		'cancel_user',
		'cancel_date',		
        'created_at',
    ];
	
	public function scopeSFrontVacColumn($query){
		if(auth()->check()){
			return $query->select(
				'vacancies.id',
				'vacancies.id as idx',
				'vacancies.country_code',
				'vacancies.city_id',
				'vacancies.working_type_id',		
				'vacancies.company_id',		
				'vacancies.title',
				'vacancies.slug',		
				'vacancies.hide_salary',
				'vacancies.active',		
				'vacancies.closing_date',
				'vacancies.partner',		
				'vacancies.date as created_at',		
				'a.name as type',
				'f.date_format',
				'd.name as city',	
				'e.name as province',
				'c.slug as company_slug',
				'c.logo',		
				'c.name as company',
				'g.vacancy_id',
				'g.user_id',
				'h.vacancy_id as vacancy_id_save',
				'h.user_id as user_id_save'
			);
		}else{
			return $query->select(
				'vacancies.id',
				'vacancies.id as idx',				
				'vacancies.country_code',
				'vacancies.city_id',
				'vacancies.working_type_id',		
				'vacancies.company_id',		
				'vacancies.title',
				'vacancies.slug',		
				'vacancies.hide_salary',
				'vacancies.active',		
				'vacancies.closing_date',
				'vacancies.partner',		
				'vacancies.date as created_at',		
				'a.name as type',
				'f.date_format',
				'd.name as city',	
				'e.name as province',
				'c.slug as company_slug',
				'c.logo',		
				'c.name as company'
			);			
		}
	}
	
	// Kolom yang akan ditampilkan
	public function scopeSCompVacColumn($query){
		return $query->select(
			'vacancies.id',
			'vacancies.title',
			'vacancies.closing_date',
			'vacancies.category_id',
			'vacancies.working_type_id',			
			'categories.name as category',
			'vacancies.country_code',
			'countries.date_format',
			'countries.currency_code as currency',			
			'vacancies.city_id',
			'cities.name as city',
			'companies.name as company',
			'companies.logo as logo',
			'working_types.name as type',
			'vacancies.min_salary',
			'vacancies.max_salary',
			'vacancies.active',
			'vacancies.description',
			'vacancies.slug',
			'vacancies.partner',
			'vacancies.created_at'
		);
	}
	
    public function scopeSOrder($query){
        return $query->orderBy('vacancies.created_at','DESC');
    }	
	
    public function scopeSCompVacCountColumn($query){
        return $query->select(
            'vacancies.id'
        );
    }    
	// Where contry
    public function scopeSRegion($query,$region){
        return $query->where('vacancies.country_code',$region);
    }
	//Lowongan yang aktif
    public function scopeSActive($query){
        return $query->where('vacancies.closing_date','>',date("Y-m-d"))        
           ->where('vacancies.active','=','1');
    }
	//Lowongan yang expire
    public function scopeSExpire($query){
        return $query->where('vacancies.closing_date','<',date("Y-m-d"))        
           ->where('vacancies.active','=','1');
    }

	//Lowongan terbaru
    public function scopeSLatest($query){
        return $query->where('vacancies.start_date','<',date("Y-m-d"))        
           ->where('vacancies.active','=','1');
    }
	
	//Lowongan yang aktif
    public function scopeSInActive($query){
        return $query->where('vacancies.active','=','0');
    }
	//Lowongan yang sudah sudah aktif tapi belum direview oleh admin gelarin
    public function scopeSUnReviewed($query){
        return $query->where('vacancies.reviewed','=','0');
    }
	//Lowongan yang sudah sudah aktif dan sudah direview oleh admin gelarin
    public function scopeSReviewed($query){
        return $query->where('vacancies.reviewed','=','1');
    }	
	//Keyword pencarian lowongan
    public function scopeSKeyword($query, $keyword) {
        return $query->where(function($q) use($keyword)
            {
                $q->where('vacancies.title','ILIKE', '%'.trim($keyword).'%')
                ->orWhere('vacancies.title','=',$keyword);
            });   
    }    
	//filter by kategori
    public function scopeSKeyCategory($query,$keycategory){
        return $query->where(function($q) use($keycategory)
            {
                $q->where('category_id','LIKE','%'.$keycategory.'%')
                ->orWhere('category_id','=',$keycategory);
            });
    }
	//Get Email staff perusahaan penerima email pelamar
    public function scopeSColumnCandidateEmailRecipients($query){
        return $query->select('users.email');
    }	
	//Get Id lowongan
    public function scopeSVacancyId($query,$id){
        return $query->where('vacancies.id',$id);
    }	
	//Get Email hanya staff perusahaan yang punya akses terima email pelamar
    public function scopeSAccessRecipients($query,$satu){
        return $query->where('company_officers.receive_candidate_email',$satu);
    }	
	
	//Halaman Company - Khusus Staff yang punya Akses Lowongan Kerja
    public function scopeSCompAllStaffVac($query)
    {
        return $query->join('categories', function($join)
            {
                $join->on('vacancies.category_id', '=', 'categories.translation_of')->where('categories.translation_lang','=',app()->getLocale());
            })
			->join('cities', 'vacancies.city_id', '=', 'cities.id')
			->join('users', 'users.id', '=', 'vacancies.user_id')
            ->join('user_descriptions', 'users.id', '=', 'user_descriptions.user_id')
            ->join('countries', 'vacancies.country_code', '=', 'countries.code')
            ->join('company_officers', 'users.id', '=', 'company_officers.user_id')
			->join('working_types', function($join){
				$join->on('vacancies.working_type_id', '=', 'working_types.translation_of')->where('working_types.translation_lang','=',app()->getLocale());
			}) 			
            ->join('companies', function ($join) {
                $join->on('company_officers.company_id', '=', 'companies.id')->where('companies.id','=',auth()->user()->companyofficer->company->id);
            })		
			;
    }	
	//Halaman Company - Khusus Staff yang punya Akses Lowongan Kerja
    public function scopeSCompMyVacPost($query){
        return $query->join('categories', function($join){
                $join->on('vacancies.category_id', '=', 'categories.translation_of')->where('categories.translation_lang','=',app()->getLocale());
            })
			->join('cities', 'vacancies.city_id', '=', 'cities.id')
			->join('users', 'users.id', '=', 'vacancies.user_id')
			->join('companies', 'companies.id', '=', 'vacancies.company_id')			
			->join('working_types', function($join){
				$join->on('vacancies.working_type_id', '=', 'working_types.translation_of')->where('working_types.translation_lang','=',app()->getLocale());
			})            
			->join('countries', 'vacancies.country_code', '=', 'countries.code');
    }

    public function scopeSCandidateEmailRecipients($query){
		 return $query->join('companies', function($join)
            {
                $join->on('vacancies.company_id', '=', 'companies.id');
            })
		->join('company_officers', 'company_officers.company_id','=','companies.id')
		->join('users', 'users.id', '=', 'company_officers.user_id')
		;
    }	
	
	/*---HALAMAn DEPAN-------------------------------------------*/
    public function scopeSFrontVacancy($query){
        if(auth()->check()){
			return $query->join('working_types as a', function($join)
				{
					$join->on('vacancies.working_type_id', '=', 'a.translation_of')->where('a.translation_lang','=',app()->getLocale());
				})		
				->join('companies as c', 'c.id', '=', 'vacancies.company_id')
				->join('cities as d', 'vacancies.city_id', '=', 'd.id')
				->join('sub_admin1s as e', 'd.subadmin1_code', '=', 'e.code')
				->join('countries as f', 'vacancies.country_code', '=', 'f.code')
				->leftjoin('applications as g', function($join){
					$join->on('vacancies.id', '=', 'g.vacancy_id')->where('g.user_id',auth()->user()->id);
				})
				->leftjoin('vacancy_saves as h', function($join){
					$join->on('vacancies.id', '=', 'h.vacancy_id')->where('h.user_id',auth()->user()->id);
				})
			
				;		
		}
		else{
			return $query->join('working_types as a', function($join)
				{
					$join->on('vacancies.working_type_id', '=', 'a.translation_of')->where('a.translation_lang','=',app()->getLocale());
				})		
				->join('companies as c', 'c.id', '=', 'vacancies.company_id')
				->join('cities as d', 'vacancies.city_id', '=', 'd.id')
				->join('sub_admin1s as e', 'd.subadmin1_code', '=', 'e.code')
				->join('countries as f', 'vacancies.country_code', '=', 'f.code');	
		}
    }
	

    public function scopeSListVacancy($query)
    {
		return $query->join('countries', 'vacancies.country_code', '=', 'countries.code')
            ->join('users', 'users.id', '=', 'vacancies.user_id')                   
            ->join('categories', function ($join) {
                $join->on('vacancies.category_id', '=', 'categories.translation_of')->where('categories.translation_lang','=',app()->getLocale());
            })
            ->join('cities', 'vacancies.city_id', '=', 'cities.id')
            ->join('working_types', function ($join) {
                $join->on('vacancies.working_type_id', '=', 'working_types.translation_of')->where('working_types.translation_lang','=',app()->getLocale());
            })             
            ->join('salary_types', function ($join) {
                $join->on('vacancies.salary_type_id', '=', 'salary_types.translation_of')->where('salary_types.translation_lang','=',app()->getLocale());
            })

            ->join('genders', function ($join) {
                $join->on('vacancies.gender_id', '=', 'genders.translation_of')->where('genders.translation_lang','=',app()->getLocale());
            })
            ->join('user_descriptions', 'users.id', '=', 'user_descriptions.user_id')                                        
            ->join('sub_admin1s', 'sub_admin1s.code', '=', 'cities.subadmin1_code')                                         
            ->join('company_officers', 'users.id', '=', 'company_officers.user_id')
            ->join('companies', function ($join) {
                $join->on('company_officers.company_id', '=', 'companies.id');
            })          
            ->select('vacancies.id','vacancies.company_id',//'vacancies.country_code','vacancies.user_id','vacancies.category_id','vacancies.city_id',
                    'countries.date_format','countries.currency_code as currency',
                    'company_officers.type as user_type','users.name as creator','companies.name as company','companies.slug as company_slug','companies.logo',
                    'categories.translation_lang','categories.translation_of as category_trans','categories.name as category',
                    'cities.name as city','sub_admin1s.name as province',
                    'working_types.translation_of as working_type_id','working_types.name as vacancy_type',
                    'vacancies.hide_salary','vacancies.min_salary','vacancies.max_salary','salary_types.name as salary_type',
                    'vacancies.gender_id','genders.name as gender',
                    'vacancies.date as created_at','vacancies.title','vacancies.slug','vacancies.visits','vacancies.reviewed','vacancies.active','vacancies.closing_date','vacancies.start_date','vacancies.years_experience','vacancies.partner')
            //->groupBy('vacancies.reviewed','vacancies.active','vacancies.closing_date','vacancies.start_date','vacancies.title','vacancies.city_id','vacancies.category_id','vacancies.user_id','vacancies.country_code','vacancies.id','categories.translation_lang','categories.translation_of','categories.name', 'cities.name', 'countries.date_format','company_officers.type','users.name')
            ->orderBy('vacancies.date','desc') 
            ;
	}
	public function scopeSJobDetail($query){
		return $query->join('countries as a', function ($join) {
			$join->on('vacancies.country_code', '=', 'a.code');
		})
		->join('categories as c', function ($join) {
			$join->on('vacancies.category_id', '=', 'c.translation_of')->where('c.translation_lang','=',app()->getLocale());
		})		
        ->join('cities as d', 'd.id', '=', 'vacancies.city_id')
        ->join('working_types as e', function ($join) {
                $join->on('vacancies.working_type_id', '=', 'e.translation_of')->where('e.translation_lang','=',app()->getLocale());
            })
         ->join('working_levels as f', function ($join) {
                $join->on('vacancies.working_level_id', '=', 'f.translation_of')->where('f.translation_lang',app()->getLocale());
           })
		
        ->join('sub_admin1s as l', 'l.code', '=', 'd.subadmin1_code')
		->join('genders as h', function ($join) {
			$join->on('vacancies.gender_id', '=', 'h.translation_of')->where('h.translation_lang','=',app()->getLocale());
		})		
        ->join('companies as i', 'i.id', '=', 'vacancies.company_id')
        ->join('company_addresses as j', 'j.company_id', '=', 'i.id')->where('j.active','1')		
        ->join('cities as e1', 'e1.id', '=', 'j.city_id')
        ->join('sub_admin1s as f1', 'f1.code', '=', 'e1.subadmin1_code')		
        //->join('countries as a1', 'a1.code', '=', 'e1.country_code')
        ->join('company_categories as k', 'k.company_id', '=', 'i.id')		
		->join('categories as d1', function ($join) {
			$join->on('k.category_id', '=', 'd1.translation_of')->where('d1.translation_lang','=',app()->getLocale());
		})
        ->join('vacancy_educations as m', 'm.vacancy_id', '=', 'vacancies.id')
		->join('educations as n', function ($join) {
			$join->on('m.education_id', '=', 'n.translation_of')->where('n.translation_lang','=',app()->getLocale());
		})		
		->select(
			'vacancies.id',
			'a.name as country',
			'c.translation_of as category_id',
			'c.name as category',
			'd.name as city',
			'e.name as type',
			'f.name as level',
			'l.name as province',
			'h.name as gender',
			'i.name as company',
			'j.address as company_address',
			'e1.name as cityCompany',
			'f1.name as provinceCompany',
			//'a1.name as countryCompany',
			//'d1.name as industry',			
			'vacancies.title',
			'vacancies.description',
			'vacancies.slug',
			'vacancies.years_experience as experience',
			'vacancies.min_salary',
			'vacancies.max_salary',
			'vacancies.hide_salary',			
			'vacancies.address',
			'd.latitude',
			'd.longitude',
			'i.logo',
			\DB::raw('array_agg(distinct d1.name)as industry'),
			\DB::raw('array_agg(distinct n.name)as education')			
		)
		->groupBy(
			'vacancies.id',
			'a.name',
			'c.translation_of',			
			'c.name',
			'd.name',
			'e.name',
			'f.name',			
			'l.name',
			'h.name',
			'i.name',
			'j.address',
			'e1.name',
			'f1.name',
			//'a1.name',
			//'d1.name',
			'vacancies.title',
			'vacancies.description',
			'vacancies.slug',
			'vacancies.years_experience',			
			'vacancies.min_salary',
			'vacancies.max_salary',
			'vacancies.hide_salary',			
			'vacancies.address',
			'd.latitude',
			'd.longitude',
			'i.logo'
		)			
		;	
	}
	
	//Dipakai untuk bagian footer atau selipan di beberapa halaman
	public function scopeSVacContentSkid($query){
		return $query->join('countries as a', function ($join) {
			$join->on('vacancies.country_code', '=', 'a.code');
		})
		->join('categories as c', function ($join) {
			$join->on('vacancies.category_id', '=', 'c.translation_of')->where('c.translation_lang','=',app()->getLocale());
		})		
        ->join('cities as d', 'd.id', '=', 'vacancies.city_id')
        ->join('working_types as e', function ($join) {
                $join->on('vacancies.working_type_id', '=', 'e.translation_of')->where('e.translation_lang','=',app()->getLocale());
            })
        ->join('sub_admin1s as l', 'l.code', '=', 'd.subadmin1_code')		
        ->join('companies as i', 'i.id', '=', 'vacancies.company_id')
		->leftjoin('applications as j', function($join){
			//$join->on('vacancies.id', '=', 'j.vacancy_id')->where('j.user_id',auth()->user()->id);
			$join->on('vacancies.id', '=', 'j.vacancy_id');			
		})		
		->select(
			'vacancies.id',
			'a.name as country',
			'd.name as city',			
			'e.name as type',
			'l.name as province',
			'i.name as company',
			'vacancies.working_type_id',			
			'vacancies.title',
			'vacancies.hide_salary',
			'vacancies.max_salary',
			'vacancies.slug',
			'vacancies.partner',
			'vacancies.created_at',
			'i.logo',
			'j.vacancy_id',
			'j.user_id'			
		)
		->groupBy(
			'vacancies.id',
			'a.name',
			'd.name',
			'e.name',			
			'l.name',
			'i.name',
			'vacancies.working_type_id',			
			'vacancies.title',
			'vacancies.hide_salary',
			'vacancies.max_salary',			
			'vacancies.slug',
			'vacancies.partner',
			'vacancies.created_at',			
			'i.logo',
			'j.vacancy_id',
			'j.user_id'			
		)			
		;	
	}
    public function scopeSJobRecomendet($query)
    {
        return $query->join('vacancy_interests', 'vacancy_interests.category_id', '=', 'vacancies.category_id')
			->leftjoin('working_types', function($join)
				{
					$join->on('vacancies.working_type_id', '=', 'working_types.translation_of')->where('working_types.translation_lang','=',app()->getLocale());
				})
			
			->join('companies', 'companies.id', '=', 'vacancies.company_id')
			->join('cities', 'vacancies.city_id', '=', 'cities.id')
			//->join('sub_admin1s', 'cities.subadmin1_code', '=', 'sub_admin1s.code')
            ->join('countries', 'vacancies.country_code', '=', 'countries.code')
			->select(
				'vacancies.id',
				'vacancies.slug',
				'vacancies.title',
				'vacancies.created_at',
				'working_types.name as types',
				'vacancies.visits',
				'companies.name as company',
				'companies.logo',
				'countries.date_format',
				'cities.name as city'
			)
			->where('vacancy_interests.user_id',auth()->user()->id)
			->where('vacancies.closing_date','>',date("Y-m-d"))        
			->where('vacancies.active','=','1')
			->groupBy('vacancies.id','vacancies.slug','vacancies.title','vacancies.created_at','working_types.name','vacancies.visits','companies.name','companies.logo','countries.date_format','cities.name')
			;
    }
	
	public function scopeSBackSelect($query){
		return $query->select(
				'vacancies.title','vacancies.partner',
				'vacancies.closing_date',
				'vacancies.min_salary','vacancies.max_salary',
				'vacancies.active',			
				'vacancies.reviewed',
				'c.logo','c.name as company',
				'a.translation_of as type_id','a.name as type_name',
				'f.date_format','currency_code as currency'
		);		
	}	
    public function scopeSBackIndexVacancy($query)
    {
        return $query->join('working_types as a', function($join)
            {
                $join->on('vacancies.working_type_id', '=', 'a.translation_of')->where('a.translation_lang','=',app()->getLocale());
            })
			/*->join('salary_types as b', function($join)
            {
                $join->on('vacancies.salary_type_id', '=', 'b.translation_of')->where('b.translation_lang','=',app()->getLocale());
            })*/			
			->join('companies as c', 'c.id', '=', 'vacancies.company_id')
			//->join('cities as d', 'vacancies.city_id', '=', 'd.id')
			//->join('sub_admin1s as e', 'd.subadmin1_code', '=', 'e.code')
            ->join('countries as f', 'vacancies.country_code', '=', 'f.code');
    }	
	
    public function user()
    {
        //return $this->belongsTo('App\Models\User', 'id');
		return $this->belongsTo(User::class);
    }
	
    public function application()
    {
        //return $this->hasMany('App\Models\Application');
        return $this->hasMany(Application::class);		
    }	
    public function country()
    {
        //return $this->belongsTo('App\Models\Country', 'code');
        return $this->belongsTo(Country::class);       
    }	
    public function city()
    {
        //return $this->belongsTo('App\Models\City', 'id');
        return $this->belongsTo(City::class);
    }
    public function company()
    {
        //return $this->belongsTo('App\Models\Company', 'id');
		return $this->belongsTo(Company::class);
    }	
    public function category()
    {

        //return $this->belongsTo('App\Models\Category', 'translation_of');
        return $this->belongsTo(Category::class);
    }
    public function workingtype()
    {
        return $this->belongsTo(WorkingType::class);
    }
    public function WorkingLevel()
    {
        return $this->belongsTo('App\Models\WorkingLevel', 'translation_of');
    }
    public function salarytype()
    {
        return $this->belongsTo('App\Models\SalaryType', 'translation_of');
    }

    public function vacancyeducation()
    {
        return $this->hasMany(VacancyEducation::class);
    }	
	
    public function vacancymajor()
    {
        return $this->hasMany(VacancyMajor::class);
    }	

    public function education(){
        return $this->belongsToMany(Education::class,'vacancy_educations','vacancy_id','education_id');
    }
	
    public function major(){
        return $this->belongsToMany(Major::class,'vacancy_majors','vacancy_id','major_id');
    }

	 public function gender()
	 {

		return $this->belongsTo('App\Models\Gender','translation_of');
	 }
    public function vacancysave()
    {
        return $this->hasMany(VacancySave::class);		
    } 
    public function vacancyoffer()
    {
        return $this->hasMany(VacancyOffer::class);		
    } 
  

}

