<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faqs';
    public $timestamps = true;
    //protected $guarded = ['id'];	
    protected $fillable = [
        'type',
        'translation_lang',
        'translation_of',
        'name',
        'title',
        'content',
        'slug',
		'picture',		
        'active',
		'created_at',
		'updated_at',
    ];
    public $translatable = ['name','title','slug'];	
}
