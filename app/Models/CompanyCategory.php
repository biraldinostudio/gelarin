<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyCategory extends Model
{
    //
        //public $timestamps = false;
    protected $table = 'company_categories';
    protected $fillable = [
        'company_id',
        'category_id',
    ];	
    public function company(){
        return $this->belongsTo(Company::class);           
    }		
	
    /*public function category()
    {
       // return $this->belongsTo(Education::class);
         return $this->belongsTo('App\Models\Category','translation_of');
    }*/		
}
