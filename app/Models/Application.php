<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Application extends Model
{
    protected $table = 'applications';
    protected $fillable = [
		'id',
		'user_id',
		'vacancy_id',
		'reason_cancel_id',
		'description',
		'application_status',
		'active',
		'read_date',
		'read_time',
		'shortlist_date',
		'interview_date',
		'not_suitable_date',
		'pass_date',
		//'reason_cancel',		
		'created_at',
		'updated_at',
		'deleted_at',              
    ];
    public function vacancy(){
        return $this->belongsTo(Vacancy::class);           
    }
    public function user(){
        return $this->belongsTo(User::class);           
    }
    public function reasonCancelvacancy(){
        return $this->belongsTo(ReasonCancelVacancy::class);           
    }
	
	public function applicationmessage()
	{
        return $this->hasMany(ApplicationMessage::class);
	}
	

    //Bagian Frontend
    public function scopeSApplication($query,$keyword='')
    {
        return $query->where('user_id',auth()->user()->id)->with('vacancy')
			->WhereHas('vacancy', function ($query) use ($keyword) {
				$query->where('title', 'ILIKE', '%'.trim($keyword).'%')
					->orWhereHas('company', function ($query) use ($keyword) {
						$query->where('name', 'ILIKE', '%'.trim($keyword).'%');
					});
				});
    }
	
	//Bagian company->untuk menampilkan data pelamar
    public function scopeSAppVac($query)
    {      
        $region= auth()->user()->UserDescription->country_code;
        $staff=CompanyOfficer::where('user_id',auth()->user()->id)->first();
		        $officer = CompanyOfficer::query();
        foreach ($officer as $column => $values) {
            $officer->whereIn($column, $values);
		}
        $zip = $officer->where('user_id',auth()->user()->id)->first()->company_id;
		
        return $query->join('vacancies', 'vacancies.id', '=', 'applications.vacancy_id')
			->join('companies', 'companies.id', '=', 'vacancies.company_id')
			->join('users', 'users.id', '=', 'applications.user_id')
			->join('user_descriptions', 'user_descriptions.user_id', '=', 'users.id')
			->select(
				'applications.id',
				'users.id as user_id',
				'vacancies.id as vacancy_id',
				'user_descriptions.resume',				
				'applications.application_status',
				'applications.active',
				'users.name',
				'users.email',
				'user_descriptions.photo'
			)					
		;
    }
	//Bagian company->untuk menampilkan data pelamar
    public function scopeSAppVacMessage($query,$id)
    {
        return $query->join('users', 'users.id', '=', 'applications.user_id')
        	->join('user_descriptions', 'user_descriptions.user_id', '=', 'users.id')
			->select(
				'applications.id',
				'users.id as user_id',
				'user_descriptions.resume',				
				'applications.application_status',
				'applications.active',
				'users.name',
				'users.email'
			)
			->where('applications.id',$id)					
		;
    } 
     
	//Bagian company->untuk menampilkan profil pelamar
    public function scopeSAppProfile($query,$user_id)
    {      
        $region= auth()->user()->UserDescription->country_code;
        $staff=CompanyOfficer::where('user_id',auth()->user()->id)->first();
		        $officer = CompanyOfficer::query();
        foreach ($officer as $column => $values) {
            $officer->whereIn($column, $values);
		}
        $zip = $officer->where('user_id',auth()->user()->id)->first()->company_id;
		
        return $query->join('users', 'users.id', '=', 'applications.user_id')
        	->join('user_descriptions', 'user_descriptions.user_id', '=', 'users.id')
        	->leftjoin('cities', 'cities.id', '=', 'user_descriptions.city_id')
        	->leftjoin('sub_admin1s', 'sub_admin1s.code', '=', 'cities.subadmin1_code')
        	//->join('countries', 'countries.code', '=', 'sub_admin1s.country_code')
			->leftjoin('countries', function($join){
			    $join->on('countries.code', '=', 'user_descriptions.country_code');
			})
        	/*->leftjoin('user_expertises', 'user_expertises.user_id', '=', 'users.id')
			->leftjoin('categories', function($join){
			    $join->on('categories.translation_of', '=', 'user_expertises.category_id')->where('categories.translation_lang','=',app()->getLocale());
			})*/
			->leftjoin('genders', function($join){
			    $join->on('genders.translation_of', '=', 'user_descriptions.gender_id')->where('genders.translation_lang','=',app()->getLocale());
			})					     				
        	->select(array(
        		'users.id',
        		'users.name',
        		'users.email',
        		'user_descriptions.address',
        		'user_descriptions.postal_code',
        		'user_descriptions.phone_code',
        		'user_descriptions.phone',
        		'user_descriptions.fax',
        		'user_descriptions.profession',
        		'user_descriptions.about',
        		'user_descriptions.photo',
        		'user_descriptions.nickname',
        		'user_descriptions.date_birth',
        		'user_descriptions.resume',
        		'user_descriptions.website',
        		'user_descriptions.facebook',
        		'user_descriptions.google',
        		'user_descriptions.twitter',
        		'user_descriptions.linkedin',
        		'user_descriptions.instagram',
        		'user_descriptions.pinterest',
        		'cities.name as city',
        		'sub_admin1s.name as province',
        		'countries.name as country',
        		'countries.date_format',
        		'applications.application_status',
        		'genders.name as gender'
        		//\DB::raw('GROUP_CONCAT(DISTINCT categories.name)as expertises')

        	))        	
        	->where('users.id',$user_id)
        	->groupBy(
        		'users.id',
        		'users.name',
        		'users.email',
        		'user_descriptions.address',
        		'user_descriptions.postal_code',
        		'user_descriptions.phone_code',
        		'user_descriptions.phone',
        		'user_descriptions.fax',
        		'user_descriptions.profession',
        		'user_descriptions.about',
        		'user_descriptions.photo',
        		'user_descriptions.nickname',        		
        		'user_descriptions.date_birth',
        		'user_descriptions.resume',        		
        		'user_descriptions.website',
        		'user_descriptions.facebook',
        		'user_descriptions.google',
        		'user_descriptions.twitter',
        		'user_descriptions.linkedin',
        		'user_descriptions.instagram',
        		'user_descriptions.pinterest',        		    		
        		'cities.name',
        		'sub_admin1s.name',
        		'countries.name',
        		'countries.date_format',
        		'applications.application_status',
        		'genders.name'
        	)         					
		;
    }

	//Bagian company->untuk menampilkan data pelamar
    public function scopeSUserExperience($query,$user_id)
    {
        return $query->join('user', 'users.id', '=', 'applications.user_id')
			->join('user_descriptions', 'user_descriptions.user_id', '=', 'users.id')
			->join('countries', 'countries.code', '=', 'user_descriptions.country_code')
			->leftjoin('user_experiences', 'user_experiences.user_id', '=', 'users.id')
        	->where('users.id',$user_id)					
		;
    }    

    public function scopeSApplMessageTitle($query,$id)
    {
        return $query->join('users', function($join)
            {
                $join->on('users.id', '=', 'applications.user_id');
            })
			->join('user_descriptions', 'user_descriptions.user_id', '=', 'users.id')
			->where('applications.active','=','1')
			->where('applications.id',$id)
			;
	}
}
