<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Illuminate\Database\Eloquent\SoftDeletes; // Untuk hapus data sementara dan permanen
class CompanyOfficer extends Model
{
    //
	use SoftDeletes;//Untuk hapus data sementara dan permanen	
    protected $table = 'company_officers';
    //public $timestamps = false;
	protected $primaryKey = 'id';
	protected $dates = ['deleted_at'];//Untuk hapus data sementara dan permanen		
    protected $fillable = [
 		'user_id',
 		'company_id',
 		'type',
 		'position',		
        'vacancy_access',
        'vacancy_posting',
        'talent_search',
        'user_management',
        'credit_management',
		'receive_candidate_email',
		'add_articles',		
		'active',		
 		'cancel_reason',
 		'cancel_user',
 		'created_at',
 		'updated_at',		
		'deleted_at',
    ]; 		
	public function company(){
		return $this->belongsTo('App\Models\Company');
	}
	public function user(){
		//return $this->hasOne('App\Models\User');
        return $this->hasOne(User::class);		
	}
    public function scopeSCompAccessStaff() {
        return CompanyOfficer::select(
			'user_id',
			'vacancy_access',
			'vacancy_posting',
			'user_management',
			'credit_management',
			'receive_candidate_email',
			'add_articles'
		)->where('user_id',auth::user()->id);
    }
    public function scopeKeyword($query, $keyword) {
        return $query->where(function($q) use($keyword)
            {
                $q->where('users.name','ILIKE', '%'.trim($keyword).'%')
                ->orWhere('users.name','=',$keyword);
            });   
    }
    public function scopeSCompStaffList($query){	
        return $query->join('users', function($join)
            {
                $join->on('users.id', '=', 'company_officers.user_id')->where('company_officers.company_id','=',auth()->user()->companyofficer->company_id);
            })
			->join('user_descriptions', 'user_descriptions.user_id', '=', 'users.id')
			;
			//->select('users.id','users.email','users.name','users.active','company_officers.vacancy_access','company_officers.vacancy_posting','company_officers.talent_search','company_officers.user_management','company_officers.credit_management','company_officers.receive_candidate_email','user_descriptions.photo');	
    }
	 	
}
