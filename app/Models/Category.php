<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';
    public $timestamps = false;
    //protected $guarded = ['id'];	
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'picture',
        'css_class',
        'active',
        'lft',
        'rgt',
        'depth',
        'translation_lang',
        'translation_of',
    ];
    public $translatable = ['name', 'slug', 'description'];	

     /* public function categorysub()
    {
        return $this->hasMany('App\Models\CategorySub', 'parent_id');
    }  */
	
	public function categorytype()
    {
        return $this->belongsTo(Vacancy::class);
        //return $this->hasMany('App\Models\Vacancy','category_id');
    }	
	public function vacancy()
	{
        return $this->hasMany(Vacancy::class);
		//return $this->hasMany('App\Models\Vacancy','category_id');
	}
	
	public function article()
	{
        return $this->hasMany(Article::class);
		//return $this->hasMany('App\Models\Vacancy','category_id');
	}
	
	//sync
	public function vacancyinterest(){
        return $this->hasMany(User::class);
    }

	//sync
    public function company(){
    	return $this->belongsToMany(Company::class,'company_categories');
    }	
	
	//sync
	public function companycategory(){
        return $this->hasMany(Company::class);
    }		

    public function menu(){
    $menu = Category::all()->load('menu');
		return view('layouts.inc.header',compact('menu'));
	}
	
	//Category FrontEnd
   public function scopeSCategoryArticle($query)
    {
        return $query->join('articles', function($join)
            {
                $join->on('categories.translation_of', '=', 'articles.category_id')->where('categories.translation_lang','=',app()->getLocale());
            })
			->select('categories.translation_of','categories.name','categories.slug')
			->where('articles.category_id','!=',null)			
			->groupBy('categories.translation_of','categories.name','categories.slug');
	}
	
	//Keahlian User (FrontEnd)
    /*public function scopeSUserExpertise($query)
    {
        return $query->join('user_expertises', function($join)
            {
                $join->on('categories.translation_of', '=', 'user_expertises.category_id')->where('categories.translation_lang','=',app()->getLocale());
            })
			->join('users', 'user_expertises.user_id', '=', 'users.id')
			->select('categories.translation_of','categories.name','categories.slug')
			//->where('articles.category_id','!=','')			
			->groupBy('categories.translation_of','categories.name','categories.slug');
	}*/

    public function scopeSCategory() {
		return Category::select('name','translation_of','translation_lang')->where('translation_lang', app()->getLocale())->where('parent_id',0)->where('active',1)->where('category_type_id',1);
		
    }

	//Sub Category
    public function scopeSSubCategory() {
        return Category::select('name','translation_of','translation_lang','parent_id')->where('parent_id','!=',0)->where('translation_lang', app()->getLocale())->where('category_type_id',1)->where('active',1);
    }
	
	//Sub Category
    public function scopeSCatIndustry() {
        return Category::select('name','translation_of','translation_lang','parent_id')->where('parent_id','=',0)->where('translation_lang', app()->getLocale())->where('category_type_id',5)->where('active',1);
    }

    public function scopeSCatArticle() {
		return Category::select('name','translation_of','translation_lang')->where('translation_lang', app()->getLocale())->where('parent_id',0)->where('active',1)->where('category_type_id',3);
    }	
	
}
