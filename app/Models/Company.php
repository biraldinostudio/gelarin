<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $table = 'companies';
    public $timestamps = true;

    protected $fillable = [
    'id',
		'working_time_id',
		'working_uniform_id',
		'code',		
		'name',
		'description',
		'slug',
		'email1',
		'email2',
		'phone1',
		'phone2',
		'fax1',
		'fax2',
		'slug',
		'size',
		'phone_code',		
		'language',
		'logo',
		'partner',		
		'active',
		'hide_email',
		'hide_phone',
		'hide_address',
		'updated_at',
		'created_at',
    ];    
	public function companyofficer(){
		return $this->hasMany(CompanyOfficer::class, 'company_id');
	}
	public function companyaddress(){
		return $this->hasMany(CompanyAddress::class, 'company_id');
	}
	public function companylegal(){
		return $this->hasMany(CompanyLegal::class, 'company_id');
	}
	public function companybankaccount(){
		return $this->hasMany(CompanyBankAccount::class, 'company_id');
	}
	public function vacancy(){
		return $this->hasMany(Vacancy::class, 'company_id');
	}	
    public function workingtime()
    {
        return $this->belongsTo(WorkingTime::class);
    }
    public function workinguniform()
    {
        return $this->belongsTo(WorkingUniform::class);
    }
	
	//sync
    public function category(){
        return $this->belongsToMany(Category::class,'company_categories','company_id','category_id');
    }
	
	public function companycategory(){
        return $this->hasMany(CompanyCategory::class);
	}

    public function scopeSCompanyActive() {
        $companies = Company::where('active',1);
        return $companies;
    }	

    public function scopeSCompanyIndustry($query)
    {
		return $query->join('company_categories', 'company_categories.company_id', '=', 'companies.id')             
           ->join('categories', function ($join) {
                $join->on('company_categories.category_id', '=', 'categories.translation_of')->where('categories.translation_lang',app()->getLocale());
           })         
            ->select(array('companies.id',
				\DB::raw('array_agg(distinct categories.name)as industry')))					
            ->groupBy('companies.id'			
			);
	}
	
    public function scopeSCompany($query)
    {
		return $query->leftjoin('company_categories as a', 'a.company_id', '=', 'companies.id')             
           ->leftjoin('categories as b', function ($join) {
                $join->on('a.category_id', '=', 'b.translation_of')->where('b.translation_lang',app()->getLocale());
           })
			->leftjoin('company_addresses as c', 'c.company_id', '=', 'companies.id')->where('c.active','=','1')
			->leftjoin('cities as d', 'd.id', '=', 'c.city_id')
			->leftjoin('sub_admin1s as e', 'e.code', '=', 'd.subadmin1_code')			
            ->select(array('companies.id','companies.name','companies.slug','companies.logo','companies.rating','c.address','d.name as city','e.name as province',
				\DB::raw('array_agg(distinct b.name)as industry')))					
            ->groupBy('companies.id','companies.name','companies.slug','companies.logo','companies.rating','c.address','d.name','e.name')
			;
	}
	
    public function scopeSCompanyDetail($query)
    {
		return $query->leftjoin('company_categories as a', 'a.company_id', '=', 'companies.id')             
           ->leftjoin('categories as b', function ($join) {
                $join->on('a.category_id', '=', 'b.translation_of')->where('b.translation_lang',app()->getLocale());
           })
           ->leftjoin('working_uniforms as c', function ($join) {
                $join->on('companies.working_uniform_id', '=', 'c.translation_of')->where('c.translation_lang',app()->getLocale());
           })
           ->leftjoin('working_times as d', function ($join) {
                $join->on('companies.working_time_id', '=', 'd.translation_of')->where('d.translation_lang',app()->getLocale());
           })		   
			->leftjoin('company_addresses as e', 'e.company_id', '=', 'companies.id')->where('e.active','=','1')
			->leftjoin('cities as f', 'f.id', '=', 'e.city_id')
			->leftjoin('sub_admin1s as g', 'g.code', '=', 'f.subadmin1_code')
			->leftjoin('countries as h', 'h.code', '=', 'f.country_code')			
            ->select(array('companies.id',
				'companies.name',
				'companies.slug',
				'companies.logo',
				'companies.description',
				'companies.phone1',
				'companies.phone2',
				'companies.email1',
				'companies.email2',
				'companies.size',
				'companies.rating',
				'companies.hide_email',
				'companies.hide_phone',
				'companies.hide_address',
				'c.name as uniform',
				'd.name as time',
				'e.address',
				'f.name as city',
				'g.name as province',
				'h.phone as phone_code',
				\DB::raw('array_agg(distinct b.name)as industry')))					
            ->groupBy('companies.id',
				'companies.name',
				'companies.slug',
				'companies.logo',
				'companies.description',
				'companies.phone1',
				'companies.phone2',
				'companies.email1',
				'companies.email2',
				'companies.size',
				'companies.rating',
				'companies.hide_email',
				'companies.hide_phone',
				'companies.hide_address',
				'c.name',
				'd.name',
				'e.address',
				'f.name',
				'g.name',
				'h.phone'
			);
       	
	}


    public function scopeSAdmCompanyList($query)
    {
		return $query->leftjoin('company_categories as a', 'a.company_id', '=', 'companies.id')
           ->leftjoin('working_uniforms as c', function ($join) {
                $join->on('companies.working_uniform_id', '=', 'c.translation_of')->where('c.translation_lang',app()->getLocale());
           })
           ->leftjoin('working_times as d', function ($join) {
                $join->on('companies.working_time_id', '=', 'd.translation_of')->where('d.translation_lang',app()->getLocale());
           })
           ->leftjoin('company_addresses as e', function ($join) {
                $join->on('e.company_id', '=', 'companies.id')->where('e.active','=','1');
           })		   
			->leftjoin('cities as f', 'f.id', '=', 'e.city_id')
			->leftjoin('sub_admin1s as g', 'g.code', '=', 'f.subadmin1_code')
			->leftjoin('countries as h', 'h.code', '=', 'f.country_code')
			->select('companies.id','companies.name','companies.slug','companies.logo','companies.description','companies.phone1','companies.phone2','companies.email1','companies.email2','companies.size','companies.rating','companies.hide_email','companies.hide_phone','companies.hide_address','companies.partner','companies.created_at','c.name as uniform','d.name as time','e.address','f.name as city','g.name as province','h.phone as phone_code')					
			->groupBy('companies.id','companies.name','companies.slug','companies.logo','companies.description','companies.phone1','companies.phone2','companies.email1','companies.email2','companies.size','companies.rating','companies.hide_email','companies.hide_phone','companies.hide_address','companies.partner','companies.created_at','c.name','d.name','e.address','f.name','g.name','h.phone')								
			; 	
	}     
	


	
	
}
