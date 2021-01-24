<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';
    public $timestamps = false;
    //protected $guarded = ['id'];	
    protected $fillable = [
        'type',
        'translation_lang',
        'translation_of',
        'parent_id',
        'name',		
        'keyword',
        'description',
        'title',
        'content',
        'slug',		
		'link',
		'target_blank',		
        'picture',
        'position',
        'css_class',		
        'active',
        'lft',
        'rgt',
        'depth',
    ];
    public $translatable = ['name','keyword','description','title','slug','link'];	
}
