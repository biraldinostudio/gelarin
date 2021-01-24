<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\UserDescription;
use App\Models\Country;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes; // Untuk hapus data sementara dan permanen
class Article extends Model
{
	use SoftDeletes;//Untuk hapus data sementara dan permanen		
    protected $table = 'articles';	
	protected $primaryKey = 'id';
    //protected $with = 'cities';
	protected $dates = ['deleted_at'];//Untuk hapus data sementara dan permanen		
	public $timestamps = true;
    protected $fillable = [
        'country_code',	
        'user_id',
		'category_id',
		'article_type_id',		
		'date',
		'hours',
        'title',		
        'description',
		'keyword',	
		'content',
		'slug',
		'cover',
		'cover_description',
		'language',
		'reference_link',
        'ip_addr',
        'visits',
		'activation_token',
		'active',
        'reviewed',
        'featured',
        'archived',
        'partner',
        'created_at',
		'deleted_at',		
    ];
    public function country()
    {
        return $this->belongsTo(Country::class);
    }	
    public function user()
    {
		return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }	
    public function articletype()
    {
        return $this->belongsTo(ArticleType::class);
    }
   /*public function articlecomment(){
        return $this->hasMany(ArticleComment::class)->whereNull('parent_id');
    }*/

    public function articlecomment(){
        return $this->hasMany(ArticleComment::class);
    }		
	
	public function scopeSColArticle($query){
		return $query->select(
		'articles.id',
		'articles.user_id',
		'articles.title',
		'articles.category_id',
		'articles.article_type_id',		
		'categories.name as category',
		'articles.country_code',
		'countries.date_format',
		'articles.active',
		'articles.keyword',		
		'articles.description',
		'articles.content',		
		'articles.slug',
		'articles.created_at',
		'users.name as user_name',
		'articles.cover',
		'articles.cover_description',		
		'articles.visits',
		'articles.created_at',
		'categories.slug as cat_slug',
		'articles.reference_link',
		'articles.archived'	
				
		);
	}
    public function scopeSKeyword($query, $keyword) {
        return $query->where(function($q) use($keyword)
            {
                $q->where('articles.title','ILIKE', '%'.trim($keyword).'%')
                ->orWhere('articles.title','=',$keyword);
            });   
    }
    public function scopeSActive($query){
        return $query->where('articles.active',1);
    }
    public function scopeSUnActive($query){
        return $query->where('articles.active',0);
    }	
    public function scopeSReviewed($query){
        return $query->where('articles.reviewed',1);
    }
    public function scopeSUnReviewed($query){
        return $query->where('articles.reviewed',0);
    }	
    public function scopeSOrder($query){
        return $query->orderBy('articles.created_at','DESC');
    }
    public function scopeSRandom($query){
        return $query->orderBy(DB::raw('RAND()'));
    }
    
	//FrontEnd: ManageArticleController
    public function scopeSList($query)
    {
        return $query->join('categories as a', function($join)
            {
                $join->on('articles.category_id', '=', 'a.translation_of')->where('a.translation_lang','=',app()->getLocale());
            })
			->join('users as b', 'b.id', '=', 'articles.user_id')
			->join('countries as c', 'articles.country_code', '=', 'c.code')
			->leftjoin('user_descriptions as d', 'b.id', '=', 'd.user_id')			
			->select(
				'articles.id',
				'articles.category_id',
				//'a.translation_of as category_id',
				'a.name as category',
				'a.slug as category_slug',				
				'articles.title',
				'articles.keyword',
				'articles.content',
				'articles.slug',
				'articles.cover',
				'articles.visits',				
				'c.date_format',
				'articles.active',
				'articles.archived',
				'articles.created_at',
				'b.id as user_id',				
				'b.name as user_name',
				'd.photo as user_photo'
			)
		;
	}
	
	//FrontEnd: Article/ReadController
    /*public function scopeSByCatArticle($query)
    {
        return $query->join('categories', function($join)
            {
                $join->on('articles.category_id', '=', 'categories.translation_of')->where('categories.translation_lang','=',app()->getLocale());
            })
			->join('users', 'users.id', '=', 'articles.user_id')
			->join('countries', 'articles.country_code', '=', 'countries.code')
->select(
		'articles.id',
		'articles.user_id',
		'articles.title',
		'articles.category_id',
		'articles.article_type_id',		
		'categories.name as category',
		'articles.country_code',
		'countries.date_format',
		'articles.active',
		'articles.keyword',		
		'articles.description',
		'articles.content',		
		'articles.slug',
		'articles.created_at',
		'users.name as user_name',
		'articles.cover',
		'articles.cover_description',		
		'articles.visits',
		'articles.created_at',
		'categories.slug as cat_slug',
		'articles.reference_link',
		'articles.archived'	
				
		)			
			;

	}*/	
	
	//FrontEnd: Article/ReadController	
    public function scopeSArticleDetail($query)
    {
        return $query->join('categories', function($join)
            {
                $join->on('articles.category_id', '=', 'categories.translation_of')->where('categories.translation_lang','=',app()->getLocale());
            })
			//->join('users', 'users.id', '=', 'articles.user_id')
			->join('countries', 'articles.country_code', '=', 'countries.code')
->select(
		'articles.id',
		'articles.user_id',
		'articles.title',
		'articles.category_id',
		'articles.article_type_id',
		'categories.name as category',
		'articles.country_code',
		'countries.date_format',
		'articles.active',
		'articles.keyword',		
		'articles.description',
		'articles.content',		
		'articles.slug',
		'articles.created_at',
		//'users.id as user_id',		
		//'users.name as user_name',
		'articles.cover',
		'articles.cover_description',		
		'articles.visits',
		'articles.created_at',
		'categories.slug as cat_slug',
		'articles.reference_link',
		'articles.archived'	
				
		)			
			;
    }
	

    public function scopeSMyArticle($query)
    {
        return $query->join('categories', function($join)
            {
                $join->on('articles.category_id', '=', 'categories.translation_of')->where('categories.translation_lang','=',app()->getLocale());
            })
			->join('article_types','article_types.translation_of', '=', 'article.article_type_id')->where('article_types.translation_lang','=',app()->getLocale())		
			->join('users', 'users.id', '=', 'articles.user_id')
			->join('countries', 'articles.country_code', '=', 'countries.code');
	}
		
}
