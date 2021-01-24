<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class ApplicationMessage extends Model
{
    protected $table = 'application_messages';	
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $fillable = [
        'application_id',	
        'user_id',
		'message',		
		'active'
    ];
    public function application()
    {
        return $this->belongsTo(Application::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }	
	
    public function scopeSApplMessage($query,$id)
    {
        return $query->join('applications', function($join)
            {
                $join->on('application_messages.application_id', '=', 'applications.id');
            })
			->join('users', 'users.id', '=', 'application_messages.user_id')
			->join('user_descriptions', 'user_descriptions.user_id', '=', 'users.id')
			->join('countries', 'countries.code', '=', 'user_descriptions.country_code')			
			->where('application_messages.active','1')
			->where('application_messages.application_id',$id)
			->orderBy('application_messages.id','DESC')
			;
	}	
}
