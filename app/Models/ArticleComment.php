<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleComment extends Model
{
    protected $table = 'article_comments';	
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $fillable = [
		'parent_id',
        'article_id',	
        'user_id',
		'comment',
		'value',		
		'active'
    ];
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
	
    public function user()
    {
        return $this->belongsTo(User::class);
    }
	
	//Comment child
     public function childs() {
        return $this->hasMany(ArticleComment::class,'parent_id','id');
    }	
	
	

    public function scopeSArticleComment($query)
    {
        return $query->join('articles', function($join)
            {
                $join->on('article_comments.article_id', '=', 'articles.id');
            })
			->join('users', 'users.id', '=', 'article_comments.user_id')
			->join('user_descriptions', 'user_descriptions.user_id', '=', 'users.id')			
			->select(
					'article_comments.id',
			        'article_comments.article_id as article_id',	
					'article_comments.user_id as user_id',
					'article_comments.comment as comment',
					'article_comments.value as value',		
					'article_comments.active as active',
					'article_comments.created_at',					
					'users.name as user',
					'user_descriptions.photo as photo'
			)
			->where('article_comments.active','1');
	}	
}
