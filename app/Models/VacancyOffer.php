<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VacancyOffer extends Model
{
    protected $table = 'vacancy_offers';
	
    public function user()
    {
	    return $this->belongsTo(User::class);
    }
    public function vacancy()
    {
	    return $this->belongsTo(Vacancy::class);
    }	
}
