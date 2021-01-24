<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReasonCancelVacancy extends Model
{
    protected $table = 'reason_cancel_vacancies';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'active',
        'translation_lang',
        'translation_of'
    ];
    public function application()
    {
        return $this->hasMany('App\Models\Application','reason_cancel_id');
    }
}
