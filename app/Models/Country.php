<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\UserDescription;
class Country extends Model
{
    protected $table = 'countries'; 
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $appends = ['icode'];
    protected $visible = ['code', 'name', 'asciiname', 'icode', 'currency_code', 'phone', 'languages', 'currency']; 
   // protected $fillable = ['code', 'name', 'asciiname', 'capital', 'continent', 'tld', 'currency_code', 'phone', 'languages', 'active'];
    protected $dates = ['created_at', 'created_at'];
    
       // protected $guarded = ['id'];
    protected $fillable = ['code', 'name', 'asciiname', 'capital', 'continent', 'tld', 'currency_code', 'phone', 'languages', 'date_format', 'active'];
    
    public function continent()
    {
        return $this->belongsTo('App\Models\Continent', 'continent_code');        
    }
    public function userdescription()
    {
        return $this->hasMany(UserDescription::class);
		//return $this->hasMany('App\Models\UserDescription', 'country_code'); 
    }
    public function subadmin1()
    {
        return $this->hasMany(SubAdmin1::class);
    }    
    public function city()
    {
        return $this->hasMany(City::class);
    }
    public function vacancy()
    {
        return $this->hasMany('App\Models\Vacancy','country_code');        
    }
    public function article()
    {
        return $this->hasMany(Country::class);
    }
    public function scopeSCountry() {
		return Country::select('date_format', 'currency_code', 'name', 'code')->where('active','=','1');
    }
	
	//Dipakai
    public function scopeSCountryAll(){
		return Country::where('active',1);
    }

	//Dipakai
    public function scopeSMyCountry(){
		/*$getIP=geoip()->getClientIP();
		$visitorIPs=geoip()->getLocation($getIP = null);
		$countriesByIP=Country::select('code','date_format')->whereActive('1')->whereCode($visitorIPs->iso_code)->first();
		if(auth()->user()){	
			$UserDescriptions=UserDescription::where('user_id',Auth::user()->id)->first();
			if(!empty($UserDescriptions->country_code)){
				$countryID=$UserDescriptions->country_code;    
			}
			else{
				$countryID=$countriesByIP->code;
			}	
			return Country::where('active','=','1')->where('code',$countryID);
			
		}
		else{*/
			return Country::select('code')->where('active','=','1')->where('code','=','ID')->first();
		//}
    }	
}
