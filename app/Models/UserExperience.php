<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserExperience extends Model
{
    //  
    protected $table = 'user_experiences';	
	protected $primaryKey = 'user_id';
	public $timestamps = true;
    protected $fillable = [
        'user_id',
        'job_position',
        'company',
        'start_working',
        'last_working',
    ];
    public function user()
    {
        return $this->hasOne('App\Models\User','id');
    }	
}
