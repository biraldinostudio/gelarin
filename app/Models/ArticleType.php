<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleType extends Model
{
    protected $table = 'article_types';
    public $timestamps = false;
    protected $guarded = ['id'];	
    protected $fillable = [
        'name',
        'translation_lang',
        'translation_of',
        'active',
    ];
    public $translatable = ['name'];	
        
   	public function article()
	{
        return $this->hasMany(Article::class);
	}
	
    public function scopeSArticleType() {
		return ArticleType::select('name','translation_of','translation_lang')->where('translation_lang', app()->getLocale())->where('active',1);
    }  	
}
