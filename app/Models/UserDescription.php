<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class UserDescription extends Model
{
    //  
    protected $table = 'user_descriptions';	
	protected $primaryKey = 'user_id';
	public $timestamps = false; //Untuk menonaktifkan timestamp di field tabel
    protected $fillable = [
        'user_id',
        'country_code',
        'gender_id',
        'city_id',	
        'username',
        'nickname',      
        'date_birth',
        'profession',		
        'about',
        'phone_code',		
        'phone',
		'fax',
        'facebook',
        'google',
        'twitter',
        'linkedin',
        'instagram',
        'pinterest',
        'website',
        'address',
        'postal_code',
        'photo',
        'cover',		
        'resume',
		'jun_school_name',
		'jun_school_start',
		'jun_school_last',
		'sen_school_name',
		'sen_school_major',
		'sen_school_start',
		'sen_school_last',	
		'comments_enabled',
		'receive_newsletter',
		'receive_advice',
		'resume_at',
    ];	
    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function country()
    {
        //return $this->belongsTo('App\Models\Country','code');
        return $this->belongsTo(Country::class);         
    }
	
    public function city()
    {
        //return $this->belongsTo('App\Models\City','id');
        return $this->belongsTo(City::class);           
    }
	
    public function gender()
    {
        //return $this->belongsTo('App\Models\City','id');
        return $this->belongsTo(Gender::class);           
    }	
}
