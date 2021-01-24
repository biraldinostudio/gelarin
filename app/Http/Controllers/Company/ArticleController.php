<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hashids\Hashids;
use App\Models\User;
use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\Category;
use App\Models\Ad;
use Auth;
use DB;
class ArticleController extends Controller
{
    public function __construct(){
        $this->middleware('auth:companypage');
    }	
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
		$crypto = new Hashids();		
		$keyword=$request->input('keyword');
		$articles = Article::SList()->SActive()->SReviewed()->SKeyword($keyword)->inRandomOrder()->SOrder()->paginate(6);		
		return view('company.article.index')->with(compact('articles','crypto'));
    }

    public function indexByCategory($translation_of, $slug,Request $request){
		$crypto = new Hashids();		
		$keyword=$request->input('keyword');
		$articles=Article::SList()
			->where('articles.category_id',$translation_of)
			->SActive()
			->SReviewed()
			->SKeyword($keyword)
			->inRandomOrder()
			->orderBy('articles.created_at','DESC')			
			->paginate(6);
		return view('company.article.index')->with(compact('articles','crypto'));
    }

    public function show($id,$slug, Request $request){
		/*$crypto = new Hashids();		
		$commentCounts=ArticleComment::where('article_id',$id)->count();		
		$comments = ArticleComment::where('parent_id',0)->where('article_id',$id)->get();	
		//$articles=Article::SArticleDetail()->with('user')->find($crypto->decodeHex($id));
		$articles=Article::SArticleDetail()->with('user')->find($id);			
        $visits=Article::updateOrcreate(
            [ 
                'id'=>$id      
            ],
            [
                'visits' => $articles->visits+1                         
            ]
        );
		return view('company.article.detail')->with(compact('articles','comments','commentCounts','crypto'));
		*/
		
		
		$crypto = new Hashids();		
		$commentCounts=ArticleComment::where('article_id',$id)->count();		
		$comments = ArticleComment::where('parent_id',0)->where('article_id',$id)->get();	
		//$articles=Article::SArticleDetail()->with('user')->find($crypto->decodeHex($id));		
		$articles=Article::SArticleDetail()->with('user')->find($id);		
        $visits=Article::updateOrcreate(
            [ 
                'id'=>$id      
            ],
            [
                'visits' => $articles->visits+1                         
            ]
        );
		return view('company.article.detail')->with(compact('articles','comments','commentCounts','crypto'));		
		
		
		
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
		return view('company.article.detail')->with(compact('articles','comments','commentCounts','crypto'));
    }
}
