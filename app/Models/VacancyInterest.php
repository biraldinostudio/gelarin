<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VacancyInterest extends Model
{
    protected $table = 'vacancy_interests';	
	public $timestamps = true;		
    public function user()
    {
	    return $this->belongsTo(User::class);
    }
}
