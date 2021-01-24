<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyBankAccount extends Model
{
    protected $table = 'company_bank_accounts';
    //public $timestamps = false;
    protected $fillable = [
		'company_id',
		'number',
		'owner',
		'bank',
		'active',
		'created_at',
		'updated_at',
    ];      
	public function company()
	{
		return $this->belongsTo(Company::class);		
	}  
}
