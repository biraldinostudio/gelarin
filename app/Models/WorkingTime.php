<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkingTime extends Model
{    //
    protected $primaryKey = 'translation_of';    
    protected $table = 'working_times';
    //protected $appends = ['tid'];
    public $timestamps = false;
    protected $guarded = ['id'];	
    protected $fillable = [
        'name',
        'active',
        'translation_lang',
        'translation_of',
    ];
    public $translatable = ['name'];

    public function company()
    {
        return $this->hasMany(Company::class);
    }

    public function scopeSWorkingTime() {
        return WorkingTime::select('name','translation_of','translation_lang')->where('translation_lang', app()->getLocale())->where('active',1);
    }	
}
