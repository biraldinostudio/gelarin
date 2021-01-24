<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Route;
use Illuminate\Support\Facades\Validator;
use Hashids\Hashids;
use App\Models\User;
use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\Category;
use App\Models\Ad;
class ArticleController extends Controller
{
    public function getAd(){
		$adse=Ad::whereActive('1')
			->where('end_date','>',date("Y-m-d")) 
		    ->orderBy('id', 'desc');
		if ($adse->count()==1) {
			$ads = $adse->get()->random(1);
		}
		elseif ($adse->count()>1) {
			$ads = $adse->get()->random(2);
		} 		
		else {
			$ads = $adse->get();
		}	
		return $ads;
	}
    
	public function index(Request $request) {
		if(Route::is('article.index.search')){
			$validator = Validator::make($request->all(), [
				'keyword' => 'required',			
			])->validate();				
		}
		$crypto = new Hashids();		
		$keyword=$request->input('keyword');
		$oneArticles = Article::select('id','title','content','slug','cover')->latest('created_at')->inRandomOrder()->first();
		$featArticles = Article::SList()->SActive()->SReviewed()->SKeyword($keyword)->where('articles.visits','>','5')->inRandomOrder()->SOrder()->paginate(4);		
		$articles = Article::SList()->SActive()->SReviewed()->SKeyword($keyword)->inRandomOrder()->SOrder()->paginate(18);		
		return view('article.index')->with(compact('articles','crypto','oneArticles','featArticles'));
    }

    public function indexByCategory($translation_of, $slug,Request $request){
		$crypto = new Hashids();		
		$keyword=$request->input('keyword');
		$oneArticles = Article::select('id','title','content','slug','cover')->latest('created_at')->where('category_id',$translation_of)->inRandomOrder()->first();			
		$featArticles=Article::SList()
			->where('articles.category_id',$translation_of)
			->SActive()
			->SReviewed()
			->SKeyword($keyword)
			->where('articles.visits','>','5')			
			->inRandomOrder()
			->orderBy('articles.created_at','DESC')			
			->paginate(4);
		$articles=Article::SList()
			->where('articles.category_id',$translation_of)
			->SActive()
			->SReviewed()
			->SKeyword($keyword)
			->inRandomOrder()
			->orderBy('articles.created_at','DESC')			
			->paginate(18);
		return view('article.index')->with(compact('articles','crypto','oneArticles','featArticles'));
    }
	
    public function indexByGroup(Request $request){
		if(Route::is('article.lifestyle')){
			$idGroups=[13,93,95,96,98,99,100];			
		}
		if(Route::is('article.technology')){
			$idGroups=[85,92,94,97];			
		}
		if(Route::is('article.social')){
			$idGroups=[86,88,89,90];			
		}
		if(Route::is('article.industry')){
			$idGroups=[84,87,91];			
		}			
		$crypto = new Hashids();		
		$keyword=$request->input('keyword');
		$oneArticles = Article::select('id','title','content','slug','cover')->latest('created_at')->whereIn('category_id', $idGroups)->inRandomOrder()->first();		
		$featArticles=Article::SList()
			->whereIn('articles.category_id', $idGroups) 
			->SActive()
			->SReviewed()
			->SKeyword($keyword)
			->where('articles.visits','>','5')			
			->inRandomOrder()
			->orderBy('articles.created_at','DESC')			
			->paginate(4);
		$articles=Article::SList()
			->whereIn('articles.category_id', $idGroups)
			->SActive()
			->SReviewed()
			->SKeyword($keyword)
			->inRandomOrder()
			->orderBy('articles.created_at','DESC')			
			->paginate(18);
		return view('article.index')->with(compact('articles','crypto','oneArticles','featArticles'));
    }	

    public function show($id,$slug, Request $request){
		$crypto = new Hashids();		
		$commentCounts=ArticleComment::where('article_id',$id)->count();		
		$comments = ArticleComment::where('parent_id',0)->where('article_id',$id)->get();	
		//$articles=Article::SArticleDetail()->with('user')->find($crypto->decodeHex($id));
		$articles=Article::SArticleDetail()->with('user')->find($id);
		$featArticles=Article::SList()
			->where('articles.category_id',$articles->category_id)
			->SActive()
			->SReviewed()
			->where('articles.visits','>','5')			
			->inRandomOrder()
			->orderBy('articles.created_at','DESC')			
			->paginate(9);		
        $visits=Article::updateOrcreate(
            [ 
                'id'=>$id      
            ],
            [
                'visits' => $articles->visits+1                         
            ]
        );
		return view('article.detail')->with(compact('articles','comments','commentCounts','crypto','featArticles'));
    }

    public function showByCategory($translation_of, $category_slug,$id,$slug, Request $request)
    {
		$crypto = new Hashids();
		$commentCounts=ArticleComment::where('article_id',$id)->count();		
		$comments = ArticleComment::where('parent_id',0)->where('article_id',$id)->get();		
		//$articles=Article::SArticleDetail()->find($crypto->decodeHex($id));
		$articles=Article::SArticleDetail()->find($id);		
        $visits=Article::updateOrcreate(
            [ 
                'id'=>$id      
            ],
            [
                'visits' => $articles->visits+1                         
            ]
        );
		return view('article.detail')->with(compact('articles','comments','commentCounts','crypto'));
    }
	
    public function showAuthor($id,$name, Request $request){
		$crypto = new Hashids();
		$users=User::whereId($crypto->decodeHex($id))->first();
		$articles=Article::where('user_id',$crypto->decodeHex($id))->paginate(6);		
		return view('article.author', compact('users','crypto','articles'));
    }		
}
