<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\Country;
class City extends Model
{
    //
	protected $table = 'cities';
    public $timestamps = true;
        //protected $with = 'Vacancy';
            //protected $with = 'companyaddresss';
    protected $fillable = [
        'id',
        'country_code',
        'name',
        'asciiname',
        'latitude',
        'longitude',
        'subadmin1_code',
        'subadmin2_code',
        'population',
        'time_zone',
        'active'
    ];
    protected $dates = ['created_at', 'updated_at'];

    public function country()
    {
        return $this->belongsTo('App\Models\Country','code');
    }
    // Specials
    public function subadmin2()
    {
        return SubAdmin2::where('code', $this->country_code . '.' . $this->subadmin1_code . '.' . $this->subadmin2_code)->first();
    }
    
    public function subadmin1()
    {
        //return SubAdmin1::where('code', $this->country_code . '.' . $this->subadmin1_code)->first();
        //return $this->belongsTo('App\Models\SubAdmin1', 'active','asciiname','name','code', 'id');	
		 return $this->belongsTo(SubAdmin1::class);		
    }	
	
	public function userdescription()
	{
		return $this->hasMany(UserDescription::class);
	}
    public function vacancy()
    {
        return $this->hasMany('App\Models\Vacancy','city_id');
    }
    public function companyaddress()
    {
        return $this->hasMany('App\Models\CompanyAddress','city_id');
    }
    public function scopeSCity() {
    	$citx=Auth::User()->UserDescription->city_id;
    	$region=Auth::User()->UserDescription->country_code;		
        //$cite=City::select('subadmin1_code','name','country_code','id')->where('country_code',$region)->where('id',$citx)->where('active',1)->with('userdescription')->take(1)->first();
        $cite=City::select('subadmin1_code','name','country_code','id')->where('country_code','=',$region)->where('active',1); 
	return $cite;
    }
	
	
	//Dipakai
    public function scopeSCityAll(){
		$getMyCountry=Country::SMyCountry()->select('code')->first();
        return City::where('country_code','=',$getMyCountry->code)->where('active',1);
    }

	
	public function scopeSMyCity(){
		$getIP=geoip()->getClientIP();
        $visitorIPs=geoip()->getLocation($getIP = null);
        $UserDescriptions = UserDescription::where('user_id',auth()->user()->id)->first();
		$cityByIP=City::select('id','subadmin1_code','name')->whereActive('1')->whereId($visitorIPs->city_id)->first();				
		
        if(!empty($UserDescriptions->city_id)){
            $cityID=$UserDescriptions->city_id;    
        }
        else{
            $cityID=$cityByIP->id;
        }
        return City::where('id',$cityID)->where('active','=','1');			
	}
	
	
}
