<?php

namespace App\Models;
use Auth;
//use App\Models\Vacancy;
//use App\Model\CompanyOfficer;
//use App\Model\Company;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;// Tambah Kayetanus

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	 protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'email', 'password', 'type', 'active', 'verified',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	// Kolom yang akan ditampilkan
	public function scopeColumnCompanyStaff($query){
		return $query->select('users.id','users.email','users.name','users.active','company_officers.vacancy_access','company_officers.vacancy_posting','company_officers.talent_search','company_officers.user_management','company_officers.credit_management','company_officers.receive_candidate_email','company_officers.receive_add_articles','user_descriptions.photo');
	}	

   /* public function scopeCompanyStaffList($query)
    {
		$userId = Auth()->user()->id;  	
        $staff=CompanyOfficer::where('user_id',$userId)->first();
		$staffCompany=$staff->company_id;
		$officer = CompanyOfficer::query();
        foreach ($officer as $column => $values) {
            $officer->whereIn($column, $values);
		}
      $zip = $officer->where('user_id',$userId)->first()->company_id;
		
        return $query->join('user_descriptions', function($join) use ($zip,$userId)
            {
                $join->on('user_descriptions.user_id', '=', 'users.id')->where('users.id','!=',$userId);
            })
			->join('company_officers', 'company_officers.user_id', '=', 'users.id')->where('company_officers.company_id','=',$zip);
    }*/
	
	//Keyword pencarian lowongan
    public function scopeKeyword($query, $keyword) {
        return $query->where(function($q) use($keyword)
            {
                $q->where('users.name','ILIKE', '%'.trim($keyword).'%')
                ->orWhere('users.name','=',$keyword);
            });   
    }
	public function scopeColFrontMyAccount($query){
		return $query->select(
			'users.id',		
			'users.email',
			'users.name',
			'user_descriptions.user_id',
			'user_descriptions.country_code',
			'user_descriptions.gender_id',
			'user_descriptions.city_id',
			'user_descriptions.username',
			'user_descriptions.nickname',
			'user_descriptions.date_birth',
			'user_descriptions.profession',
			'user_descriptions.about',
			'user_descriptions.phone_code',
			'user_descriptions.phone',
			'user_descriptions.facebook',
			'user_descriptions.google+',
			'user_descriptions.twitter',
			'user_descriptions.linkedin',
			'user_descriptions.instagram',
			'user_descriptions.pinterest',
			'user_descriptions.website',
			'user_descriptions.address',
			'user_descriptions.postal_code',
			'user_descriptions.photo',
			'user_descriptions.cover',
			'user_descriptions.resume',
			'user_descriptions.comments_enabled',
			'user_descriptions.receive_newsletter',
			'user_descriptions.receive_advice',
			'user_descriptions.resume',
			'countries.code as countryCode',			
			'countries.name as countryName',
			'countries.date_format',			
			'genders.name as genderName',			
			'cities.name as cityName',
			'sub_admin1s.code as subadmin1Code',		
			'sub_admin1s.name as subadmin1Name'
		);
	}
    public function scopeFrontMyAccount($query)
    {
		$userId = Auth()->user()->id;
        $account=UserDescription::where('user_id',$userId)->first();
        $city=City::where('id',$account->city_id)->where('country_code',$account->country_code)->first();			
        return $query->join('user_descriptions', function($join) use ($userId)
            {
                $join->on('user_descriptions.user_id', '=', 'users.id')->where('users.id',$userId);
            })
			->join('genders', 'genders.translation_of', '=', 'user_descriptions.gender_id')->where('genders.translation_lang','=',app()->getLocale())		
			->join('countries', 'countries.code', '=', 'user_descriptions.country_code')->where('countries.code','=',$account->country_code)
			->join('cities', 'cities.id', '=', 'user_descriptions.city_id')->where('cities.country_code','=',$account->country_code)
			
			/*->join('sub_admin1s', function($join) use ($userId)
						{
							$join->on('sub_admin1s.code', '=', 'cities.subadmin1_code')->where('cities.subadmin1_code','=',$city->subadmin1_code);
			})->where('sub_admin1s.country_code','=',$account->country_code)		
			*/
			->join('sub_admin1s', 'sub_admin1s.code', '=', 'cities.subadmin1_code')->where('cities.subadmin1_code','=',$city->subadmin1_code)->where('sub_admin1s.country_code','=',$account->country_code);
			
    }

    public function scopeSAdmMemberList($query)
    {			
			return $query->join('user_descriptions as a', 'a.user_id', '=', 'users.id')	
				->leftjoin('cities as c', 'a.city_id', '=', 'c.id')
				->leftjoin('sub_admin1s as d', 'c.subadmin1_code', '=', 'd.code')
				->leftjoin('countries as e', 'c.country_code', '=', 'e.code')
				->orderBy('users.created_at','desc')
				;
    }		
	
   public function userdescription()
    {
        return $this->hasOne(UserDescription::class);          
    }
	
   public function userexperience()
    {
        return $this->hasOne('App\Models\UserExperience','user_id');          
    }
	
   public function usereducation()
    {
        return $this->hasOne('App\Models\UserEducation','user_id');          
    }	
	
	public function companyofficer()
	{
		//return $this->hasOne('App\Models\CompanyOfficer' ,'user_id');
        return $this->hasOne(CompanyOfficer::class);		
	}	
    public function verifyUser()
    {
        return $this->hasOne('App\Models\VerifyUser');
    }

    public function vacancy()
    {
        return $this->hasMany('App\Models\Vacancy');
    }
    public function article()
    {
        return $this->hasMany(Vacancy::class);
    }	
    public function application()
    {
        return $this->hasMany('App\Models\Application');
    }	
      
	public function articlecomment()
	{
        return $this->hasMany(ArticleComment::class);
	}
	
	public function applicationmessage()
	{
        return $this->hasMany(ApplicationMessage::class);
	}	

	public function testimonial()
	{
        return $this->hasMany(Testimonial::class);
	}		
		//Tambah Kayetanus
	public function sendPasswordResetNotification($token)
	{
		$this->notify(new ResetPassword($token));
	}
	
    public function vacancysave()
    {
        return $this->hasMany(VacancySave::class);
    }

	//sync
    public function vacancyinterest()
    {
        return $this->hasMany(VacancyInterest::class)->withTimestamps();
    }
	
	//sync
    public function category(){
        return $this->belongsToMany(Category::class,'vacancy_interests','user_id','category_id');
    }	

    public function userskill()
    {
        return $this->hasMany(UserSkill::class);
    }
	
	//sync
    public function vacancyoffer()
    {
        return $this->hasMany(VacancyOffer::class);
    }
	
	//sync
    public function vacancyToOffer(){
        return $this->belongsToMany(Vacancy::class,'vacancy_offers','user_id','vacancy_id');
    }		
}
