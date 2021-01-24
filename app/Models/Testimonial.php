<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Testimonial extends Model
{
    protected $table = 'testimonials';	
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $fillable = [	
        'user_id',
		'comment',
		'value',		
		'active'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSOrder($query){
        return $query->orderBy('testimonials.created_at','DESC');
    }
   /* public function scopeSRandom($query){
        return $query->orderBy(DB::raw('RAND()'));
    }*/	
    public function scopeSTestimonial($query)
    {
        return $query->join('users', function($join)
            {
                $join->on('testimonials.user_id', '=', 'users.id');
            })
			->join('user_descriptions', 'user_descriptions.user_id', '=', 'users.id')
			->join('company_officers', 'company_officers.user_id', '=', 'users.id')
			->join('companies', 'companies.id', '=', 'company_officers.company_id')			
			->select(
			        'testimonials.user_id',	
					'testimonials.comment',
					'testimonials.value',		
					'testimonials.active',
					'users.name',
					'user_descriptions.photo as photo',
					'company_officers.position',
					'companies.name as company',
					'testimonials.created_at'
			);
	}		
}
