<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkingUniform extends Model
{
    //
    protected $primaryKey = 'translation_of';    
    protected $table = 'working_uniforms';
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
	
    public function scopeSWorkingUniform() {
        return WorkingUniform::select('name','translation_of','translation_lang')->where('translation_lang', app()->getLocale())->where('active',1);
    }	
}
