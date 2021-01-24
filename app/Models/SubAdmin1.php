<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\Country;
use App\Models\City;
class SubAdmin1 extends Model
{
    //
    protected $table = 'sub_admin1s';
    protected $primaryKey = 'code';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['code', 'name', 'asciiname', 'active'];
	
    public function country()
    {
        return $this->belongsTo(Country::class);
    }	
	public function city()
	{
		return $this->hasMany('App\Models\City', 'subadmin1_code');
	}
	
	//Dipakai
    public function scopeSProvinceAll(){
		$getMyCountry=Country::SMyCountry()->select('date_format', 'currency_code', 'name', 'code')->first();	
		return SubAdmin1::where('active','=','1')->where('country_code','=','ID');
    }

	//dipakai
	public function scopeSMyProvince($query){
		$myCities=City::SMyCity()->select('subadmin1_code','name','country_code','id')->first();	
        return SubAdmin1::where('code','=',$myCities->subadmin1_code)->where('active','=','1');		
	}	
	
	public function scopeSSubAdmin1() {
		$subaAdmins1 = SubAdmin1::where('country_code','=','ID')->orderBy('name','asc');
        return $subaAdmins1;
    }
}
