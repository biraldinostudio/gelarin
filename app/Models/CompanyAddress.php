<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Untuk hapus data sementara dan permanen
class CompanyAddress extends Model
{
	use SoftDeletes;//Untuk hapus data sementara dan permanen	
    protected $table = 'company_addresses';
            //protected $with = 'cities';
    //public $timestamps = false;
	protected $dates = ['deleted_at'];//Untuk hapus data sementara dan permanen		
    protected $fillable = [
    'id',
		'company_id',
		'city_id',
		'address',
		'postal_code',
		'active',
		'created_at',
		'updated_at',
		'deleted_at',
    ];      
	public function company()
	{
		return $this->belongsTo(Company::class);		
	}
	public function city()
	{
		return $this->belongsTo(City::class);		
	}  	    //
}
