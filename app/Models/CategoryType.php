<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryType extends Model
{
    //
    protected $table = 'category_types';
	//protected $primaryKey = 'translation_of';
    
     //protected $appends = ['tid'];
    //protected $appends = ['translation_of'];
    public $timestamps = false;
    protected $guarded = ['id'];	
    protected $fillable = [
        'name',
        'translation_lang',
        'translation_of',
        'active',
    ];
    public $translatable = ['name'];	
        
   	public function category()
	{
        return $this->hasMany(Category::class);
	}
}
