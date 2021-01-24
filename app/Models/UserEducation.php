<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEducation extends Model
{
    protected $table = 'user_educations';	
	protected $primaryKey = 'user_id';
	public $timestamps = true;
    protected $fillable = [
        'user_id',
        'education_id',
        'school',		
        'major',
        'start_year',
		'last_year',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
	
    public function education()
    {
        return $this->belongsTo(Education::class);
    }
	
	//Bagian company->untuk menampilkan data pelamar
    public function scopeSUserEducation($query)
    {
        return $query->join('users', 'users.id', '=', 'user_educations.user_id')
			->join('educations', function($join){
				$join->on('educations.translation_of', '=', 'user_educations.education_id')->where('educations.translation_lang','=',app()->getLocale());
			})						
        	//->where('users.id',$user_id)
            ->select(
				'user_educations.id',
                'educations.name as education',
                'user_educations.education_id',				
                'user_educations.major',
                'user_educations.school',
                'user_educations.degree',				
                'user_educations.start_year',
                'user_educations.last_year'				
            )
		;
    }   	
}
