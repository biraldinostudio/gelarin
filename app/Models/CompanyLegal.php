<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Untuk hapus data sementara dan permanen
class CompanyLegal extends Model
{
    //
	use SoftDeletes;//Untuk hapus data sementara dan permanen	
    protected $table = 'company_legals';
    //public $timestamps = false;
	protected $dates = ['deleted_at'];//Untuk hapus data sementara dan permanen	
    protected $fillable = [
		'company_id',
		'name',
		'number',
		'expire',
		'active',
		'created_at',
		'updated_at',
		'deleted_at',		
		'file',
    ];
	public function company()
	{
		return $this->belongsTo(Company::class);		
	}	
}
