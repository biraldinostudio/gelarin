<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hashids\Hashids;
use App\Models\User;
use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\Category;
use App\Models\Ad;
use App\Models\Vacancy;
use App\Models\Application;
use App\Models\ArticleType;
use Auth;
use DB;
use Ip;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Storage;
use Illuminate\Http\RedirectResponse;
use Path\To\DOMDocument;
Use Carbon\Carbon;
use DateTime;
use Route;
use Illuminate\Support\Str; // untuk slug atau tags


class ManageArticleController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
		$crypto = new Hashids();
		$keyword=$request->input('keyword');
		//$categories = Category::SCategoryArticle()->get();
		$applications=Application::whereActive('1')->where('user_id',auth()->user()->id)->get();	
		$artArchiveCounts = Article::SList()->select('articles.id')->where('articles.archived',1)->where('articles.user_id',auth()->user()->id)->count();		
		$artUnactiveCounts = Article::SList()->select('articles.id')->SUnActive()->where('articles.user_id',auth()->user()->id)->count();		
		$artWaitingCounts = Article::SList()->select('articles.id')->SActive()->SUnReviewed()->where('articles.user_id',auth()->user()->id)->count();
		$artActiveCounts = Article::SList()->select('articles.id')->SActive()->SReviewed()->where('articles.user_id',auth()->user()->id)->count();		
		if(Route::is('manage.article.index')){
			$articles = Article::SList()->SActive()->SReviewed()->SKeyword($keyword)->where('articles.user_id',auth()->user()->id)->SOrder()->paginate(6);
		}
		if(Route::is('manage.article.pending')){
			$articles = Article::SList()->SActive()->SUnReviewed()->SKeyword($keyword)->where('articles.user_id',auth()->user()->id)->SOrder()->paginate(6);
		}
		if(Route::is('manage.article.inactived')){
			$articles = Article::SList()->SUnActive()->SReviewed()->SKeyword($keyword)->where('articles.user_id',auth()->user()->id)->SOrder()->paginate(6);
		}
		if(Route::is('manage.article.archived')){
			$articles = Article::SList()->where('archived',1)->SReviewed()->SKeyword($keyword)->where('articles.user_id',auth()->user()->id)->SOrder()->paginate(6);
		}		
		$ads=$this->getAd();
		$premiumVacancies=Vacancy::SVacContentSkid()->where('vacancies.partner','=','1')->SActive()->inRandomOrder()->paginate(5);		
		return view('article.manage.index')->with(compact(
			'articles',
			'artActiveCounts',
			'artWaitingCounts',
			'artArchiveCounts',
			'artUnactiveCounts',
			'ads',
			'premiumVacancies',
			'applications',
			'crypto'
		));	
    }
	
    public function trash(Request $request)
    {
		$crypto = new Hashids();		
		$keyword=$request->input('keyword');
		//$categories = Category::SCategoryArticle()->get();
		$applications=Application::whereActive('1')->where('user_id',auth()->user()->id)->get();	
		$artArchiveCounts = Article::SList()->select('articles.id')->where('archived',1)->where('user_id',auth()->user()->id)->count();		
		$artUnactiveCounts = Article::SList()->select('articles.id')->SUnActive()->where('user_id',auth()->user()->id)->count();		
		$artWaitingCounts = Article::SList()->select('articles.id')->SActive()->SUnReviewed()->where('user_id',auth()->user()->id)->count();
		$artActiveCounts = Article::SList()->select('articles.id')->SActive()->SReviewed()->where('user_id',auth()->user()->id)->count();		
		$articles = Article::SList()->onlyTrashed()->SActive()->SReviewed()->SKeyword($keyword)->where('user_id',auth()->user()->id)->SOrder()->paginate(6);
		$ads=$this->getAd();
		$premiumVacancies=Vacancy::SVacContentSkid()->where('vacancies.partner','=','1')->SActive()->inRandomOrder()->paginate(5);		
		return view('article.manage.index')->with(compact(
			'articles',
			'artActiveCounts',
			'artWaitingCounts',
			'artArchiveCounts',
			'artUnactiveCounts',
			'ads',
			'premiumVacancies',
			'applications',
			'crypto'
		));	
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

    public function create(Request $request)
    {
		$userCreator = Auth::User();
        $userId = $userCreator->id;	
	    $this->middleware('auth');
		$keyword=$request->input('keyword');
		$categories=Category::SCatArticle()->get();
		$articleTypes=ArticleType::SArticleType()->get();		
		$applications=Application::whereActive('1')->where('user_id',auth()->user()->id)->get();	
		$artArchiveCounts = Article::SList()->select('articles.id')->where('articles.archived',1)->where('articles.user_id',$userId)->count();		
		$artUnactiveCounts = Article::SList()->select('articles.id')->SUnActive()->where('articles.user_id',$userId)->count();		
		$artWaitingCounts = Article::SList()->select('articles.id')->SActive()->SUnReviewed()->where('articles.user_id',$userId)->count();
		$artActiveCounts = Article::SList()->select('articles.id')->SActive()->SReviewed()->where('articles.user_id',auth()->user()->id)->count();		
		$articles = Article::SList()->SActive()->SReviewed()->SKeyword($keyword)->where('articles.user_id',auth()->user()->id)->SOrder()->paginate(6);
		$ads=$this->getAd();		
		return view('article.manage.create')->with(compact(
			'articles',
			'artActiveCounts',
			'artWaitingCounts',
			'artArchiveCounts',
			'artUnactiveCounts',
			'ads',
			'applications',
			'categories',
			'articleTypes'
		));	
    }
    public function store(Request $request)
    {
        Validator::make($request->all(), [
			'title' => 'required|string|min:37|max:50|unique:articles',
           	'category'=> 'required',
           	'detail'=> 'required|string|min:200|max:1000000',
           	'cover'=> 'required|max:1920|mimes:jpeg,png,jpg',			
           	'type'=> 'required',
           	//'reference'=> 'required|string|max:250',
           	'keyword'=> 'required|string|min:20|max:255',
           	'description'=> 'required|string|min:15|max:255',			
        ])->validate();	
		$userCreator = Auth::User();
        $userId = $userCreator->id;	
        $dt= new DateTime();
        $storage="storage/uploads/article/";
        $public_path="storage/uploads/article/";
        //Tahun dan bulan untuk DB
        $datefile_todb=date("Y").'/'.date("m").'/';
		
		//Pembuatan Direktori
        $year_storage = $storage . date("Y");
        $year_publicpath = $public_path . date("Y");
        $month_storage = $year_storage . '/' . date("m");
        $month_publicpath = $year_publicpath . '/' . date("m").'/';

        !file_exists($year_publicpath) && mkdir($year_publicpath , 0777,true);
        !file_exists($month_publicpath) && mkdir($month_publicpath, 0777, true);
		
        $content=$request->detail;
		$articles= new Article;
		//$lastContent = DB::table('articles')->latest()->first();
		$table_name='articles';
		/*$lastContent = DB::table('information_schema.tables')
          ->where('table_name', $table_name)
          ->whereRaw('table_schema = DATABASE()')
         // ->select('AUTO_INCREMENT')->first();
		  //->select row_number() OVER()
		  //select row_number() over (order by id)
		 // ->first();
		 ->select row_number() over (orderBy id)*/
		 
		$current_id = DB::table('articles')->max('id');
		$lastContent=$current_id + 1;
		 
		$dom = new \DOMDocument();
		libxml_use_internal_errors(true);//Tambah bro	
		$dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
		libxml_clear_errors();//Tambag bro
		$images = $dom->getElementsByTagName('img');
		
		foreach($images as $img){
			$src = $img->getAttribute('src');
			if(preg_match('/data:image/', $src)){
				// dapatkan mimetype
				preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
				$mimetype = $groups['mime'];
				$filename = uniqid();
				//foreach($lastContent as $lastId){	
					//$filenameRand = 'Content'.'_'.auth()->user()->id.'_'.substr(md5($filename),6,6).time();			
					$filenameRand = 'Content'.'_'.auth()->user()->id.'_'.substr(md5($filename),6,6).'_'.time();
				//}		
				$filepath = ("$month_storage/$filenameRand.$mimetype");
				$image=Image::make($src)
					->resize(1200, 1200)
					->encode($mimetype, 100)
					->save(public_path($filepath));
				$new_src = asset($filepath);
				$img->removeAttribute('src');
				$img->setAttribute('src', $new_src);
				$img->setAttribute('class','img-responsive');
			}
		}
		//Untuk upload article
		   if($request->hasFile('cover')) {
				$storage="public/uploads/article/";
				$public_path="storage/uploads/article/";

				//Tahun dan bulan untuk DB
				$datefile_todb=date("Y").'/'.date("m").'/';

				//Pembuatan Direktori
				$year_storage = $storage . date("Y");
				$year_publicpath = $public_path . date("Y");
				$month_storage = $year_storage . '/' . date("m").'/';
				$month_publicpath = $year_publicpath . '/' . date("m").'/';  
				!file_exists($year_publicpath) && mkdir($year_publicpath , 0777);
				!file_exists($month_publicpath) && mkdir($month_publicpath, 0777);

				// dapatkan nama file dengan ekstensi
				$filenamewithextension = $request->file('cover')->getClientOriginalName();

				// dapatkan nama file tanpa ekstensi
				$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

				// dapatkan ekstensi file
				$extension = $request->file('cover')->getClientOriginalExtension();

				// nama file untuk disimpan
				//foreach($lastContent as $lastId){
					//$filenametostore = 'Cover_'.auth()->user()->id.'-'.substr($filename),6,6).time().$extension;					
					//$filenametostore = 'Cover'.'_'.auth()->user()->id.'_'.substr(md5($filename),6,6).'_'.time().'.'.$extension;
					$filenametostore = Str::slug($request->get('title')).'.'.$extension;					
				//}
				//Unggah file
				$request->file('cover')->storeAs($month_storage, $filenametostore);

				// Ubah ukuran gambar di sini
				$thumbnailpath = public_path($month_publicpath.$filenametostore);
				$img = Image::make($thumbnailpath)->resize(2210, 1473, function($constraint) {
					$constraint->aspectRatio();
				});
			   $img->save($thumbnailpath);			   
			}		
		//Batas upload article
		$articles = Article::create([
			'country_code'=>$userCreator->UserDescription->country_code,
			'user_id'=>$userId,
			'category_id'=>$request->category,
			'article_type_id'=>$request->type,			
			'date'=>date("Y-m-d"),
			'hours'=>$dt->format('H:i:s'),
			'title'=>ucwords(strtolower($request->title)),
			'description'=>$request->description,
			'keyword'=>$request->keyword,			
			'content'=>$dom->saveHTML(),
            'slug' =>Str::slug($request->get('title')),
			'cover'=>$datefile_todb.$filenametostore,
			'cover_description'=>ucwords(strtolower($request->title)),			
			'language'=>app()->getLocale(),
			'reference_link'=>$request->reference,
            'ip_addr'=>Ip::get(),
            'active' => '1',
            'reviewed' => '1',
            'featured' => '0',
            'archived' => '0',
            'partner' => '0',					
		]);	
        if(!empty($articles)) {
			return redirect()->back()->with(['message' => trans('global.The article was posted successfully, waiting for a review by the editor')]);
        } else {
			return redirect()->back()->with(['message' => trans('global.Article failed to post')]);
        }
    }


    public function edit($id,$slug)
    {
		$crypto = new Hashids();
		$categories=Category::SCatArticle()->get();
		$articleTypes=ArticleType::SArticleType()->get();		
		$applications=Application::whereActive('1')->where('user_id',auth()->user()->id)->get();	
		$artArchiveCounts = Article::SList()->select('articles.id')->where('archived',1)->where('articles.user_id',auth()->user()->id)->count();		
		$artUnactiveCounts = Article::SList()->select('articles.id')->SUnActive()->where('articles.user_id',auth()->user()->id)->count();		
		$artWaitingCounts = Article::SList()->select('articles.id')->SActive()->SUnReviewed()->where('articles.user_id',auth()->user()->id)->count();
		$artActiveCounts = Article::SList()->select('articles.id')->SActive()->SReviewed()->where('articles.user_id',auth()->user()->id)->count();		
		$articleSums = Article::SActive()->SReviewed()->where('articles.user_id',auth()->user()->id)->SOrder()->get();
		$articles=Article::find($id);
		$ads=$this->getAd();
		return view('article.manage.edit')->with(compact(
			'articleSums',
			'articles',
			'artActiveCounts',
			'artWaitingCounts',
			'artArchiveCounts',
			'artUnactiveCounts',
			'ads',
			'applications',
			'categories',
			'articleTypes'
		));
    }

    public function update(Request $request, $id)
    {
		$crypto = new Hashids();
		$existing=Article::find($id);
		//dd($existing->title);
	/*	if($request->hasFile('cover')) {
			$uplCover='required|max:1920|mimes:jpeg,png,jpg';
		}
		else{
			$uplCover='max:1920|mimes:jpeg,png,jpg';
		}*/
		if($existing->title==$request->title){
			$title='required|string|min:37|max:50';
		}
		elseif($request->title==''){
			$title='required|string|min:37|max:50|unique:articles';
		}
		elseif($existing->title==''){
			$title='required|string|min:37|max:50|unique:articles';
		}
		elseif(!empty($request->title)){
			$title='required|string|min:37|max:50|unique:articles';
		}
		elseif(!empty($existing->title)){
			$title='required|string|min:37|max:50';
		}		
		else{
			$title='required|string|min:37|max:50|unique:articles';
		}		
		
        Validator::make($request->all(), [
			'title' => $title,
           	'category'=> 'required',
           	'detail'=> 'required|string|min:200|max:1000000',
           	//'cover'=> $uplCover,			
           	'type'=> 'required',
           	//'reference'=> 'required|string|max:250',
           	'keyword'=> 'required|string|min:20|max:255',
			'description'=> 'required|string|min:15|max:255',
           	'active'=> 'required',			
        ])->validate();
		$userCreator = Auth::User();
        $userId = $userCreator->id;	
        $dt= new DateTime();
		
        $storage="storage/uploads/article/";
        $public_path="storage/uploads/article/";
        //Tahun dan bulan untuk DB
        $datefile_todb=date("Y").'/'.date("m").'/';
		
		//Pembuatan Direktori
        $year_storage = $storage . date("Y");
        $year_publicpath = $public_path . date("Y");
        $month_storage = $year_storage . '/' . date("m");
        $month_publicpath = $year_publicpath . '/' . date("m").'/';

        !file_exists($year_publicpath) && mkdir($year_publicpath , 0777,true);
        !file_exists($month_publicpath) && mkdir($month_publicpath, 0777, true);



		
        $content=$request->detail;
		$articles= new Article;
		//$lastContent = DB::table('articles')->latest()->first();
		$table_name='articles';
		/*$lastContent = DB::table('information_schema.tables')
          ->where('table_name', $table_name)
          ->whereRaw('table_schema = DATABASE()')
          ->select('AUTO_INCREMENT')->first();*/
		libxml_use_internal_errors(true); // untuk menonaktifkan peringatan DOM null
		$dom = new \DOMDocument();
		//$dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
		
		libxml_use_internal_errors(true);//Tambah bro	
		$dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
		libxml_clear_errors();//Tambag bro		
		
		$images = $dom->getElementsByTagName('img');
		
		foreach($images as $img){
			$src = $img->getAttribute('src');
			if(preg_match('/data:image/', $src)){
				// dapatkan mimetype
				preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
				$mimetype = $groups['mime'];
				$filename = uniqid();
				//foreach($lastContent as $lastId){				
					//$filenameRand = 'Content'.'_'.$existing->id.'_'.$userId.'_'.$filename.'_'.time();
					$filenameRand = 'Content'.'_'.auth()->user()->id.'_'.substr(md5($filename),6,6).'_'.time();					
				//}	

				if($existing->detail!=$request->detail){
					$filepath = ("$month_storage/$filenameRand.$mimetype");
					$image=Image::make($src)
						->resize(1200, 1200)
						->encode($mimetype, 100)
						->save(public_path($filepath));
					$new_src = asset($filepath);
					$img->removeAttribute('src');
					$img->setAttribute('src', $new_src);
					$img->setAttribute('class','img-responsive');
					
					/*$articles=Article::updateOrcreate(
						[ 
							'id'=>$id        
						],
						[
							'content'=>$dom->saveHTML(),
						]
					);*/		
				}
			}
		}
		//Untuk upload COVER article
		   if($request->hasFile('cover')) {
				$storage="public/uploads/article/";
				$public_path="storage/uploads/article/";

				//Tahun dan bulan untuk DB
				$datefile_todb=date("Y").'/'.date("m").'/';

				//Pembuatan Direktori
				$year_storage = $storage . date("Y");
				$year_publicpath = $public_path . date("Y");
				$month_storage = $year_storage . '/' . date("m").'/';
				$month_publicpath = $year_publicpath . '/' . date("m").'/';  
				!file_exists($year_publicpath) && mkdir($year_publicpath , 0777);
				!file_exists($month_publicpath) && mkdir($month_publicpath, 0777); 				
				
				//Hapus file lama
				if(\File::exists($public_path.$existing->cover)){
					\File::delete($public_path.$existing->cover);
				}				
				
				// dapatkan nama file dengan ekstensi
				$filenamewithextension = $request->file('cover')->getClientOriginalName();

				// dapatkan nama file tanpa ekstensi
				$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

				// dapatkan ekstensi file
				$extension = $request->file('cover')->getClientOriginalExtension();

				// nama file untuk disimpan
				//foreach($lastContent as $lastId){
					//$filenametostore = 'Cover'.'_'.$existing->id.'_'.$userId.'_'.$filename.'_'.time().'.'.$extension;
					//$filenametostore = 'Cover'.'_'.auth()->user()->id.'_'.substr(md5($filename),6,6).'_'.time().'.'.$extension;
					$filenametostore = Str::slug($request->get('title')).'.'.$extension;		
				//}
				//Unggah file
				$request->file('cover')->storeAs($month_storage, $filenametostore);

				// Ubah ukuran gambar di sini
				$thumbnailpath = public_path($month_publicpath.$filenametostore);
				$img = Image::make($thumbnailpath)->resize(2210, 1473, function($constraint) {
					$constraint->aspectRatio();
				});
			   $img->save($thumbnailpath);			   
			}		
		//Batas upload image article
		   if($request->hasFile('cover')) {
			   $cekFileName=$datefile_todb.$filenametostore;
		   }
			else{			   
				$cekFileName=$existing->cover;
			}
			
		if(empty($request->active)){
			$active='0';
		}
		else{
			$active=$request->active;
		}		
        $articles=Article::updateOrcreate(
            [ 
                'id'=>$id        
            ],
            [
				'category_id'=>$request->input('category'),
				'article_type_id'=>$request->input('type'),
				'title'=>ucwords(strtolower($request->title)),
				'description'=>$request->description,
				'keyword'=>$request->keyword,
				'content'=>$dom->saveHTML(),				
				'slug' =>Str::slug($request->get('title')),
				'cover'=>$cekFileName,
				'cover_description'=>ucwords(strtolower($request->title)),
				'reference_link'=>$request->reference,
				'active'=>$active,
            ]
        );
        if(!empty($articles)) {
			return redirect()->back()->with(['message' => trans('global.Data saved successfully.')]);
        } else {
			return redirect()->back()->with(['message' => trans('global.Article failed to post')]);
        }
    }


    public function destroy($id)
    {
    		$crypto = new Hashids();  	
		if(Route::is('manage.article.delete')){
			$processBox=Article::find($id)->delete();
			if(!empty($processBox)) {
				return redirect(route('manage.articles.index'))->with('success', trans('global.Data successfully deleted.'));
			}
			else{
				return redirect()->back()->with(['warning' => trans('global.Data failed to delete')]);
			}			
		}
		if(Route::is('manage.article.destroy')){
			$processBox=Article::withTrashed()->whereId($id)->forceDelete();
			if(!empty($processBox)) {
				return redirect(route('manage.article.trash'))->with('success', trans('global.Data successfully deleted.'));
			}
			else{
				return redirect()->back()->with(['warning' => trans('global.Data failed to delete')]);
			}			
		}		
		
    }
	
    public function restore($id)
    {
 		$crypto = new Hashids();   	
		$processBox=Article::withTrashed()->whereId($id)->restore();
		if(!empty($processBox)) {
			return redirect(route('manage.article.trash'))->with('success', trans('global.Data returned successfully.'));
		}
		else{
			return redirect()->back()->with(['warning' => trans('global.Data failed to return')]);
		}
			
    }	
}
