<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WorkingLevel;
use App\Models\WorkingType;
use App\Models\VacancySave;
use App\Models\City;
use App\Models\Gender;
use App\Models\Company;
use App\Models\SubAdmin1;
use App\Models\Currency;
use App\Models\Vacancy;
use App\Models\CompanyCategory;
use Auth;
use Carbon\Carbon;
use DateTime;
use App\Models\User;
use App\Models\Application;
use App\Models\CompanyAddress;
use View; //Jika pakai return View::make
use App\Models\UserDescription;
use Illuminate\Support\Facades\Input;
Use Route;
use DB;
use Hashids\Hashids;
class VacancyController extends Controller
{
    protected $redirectTo = '/home';
    /*public function __construct()
    {
        $this->middleware('guest');
    }*/
    public function index(Request $request)
    {	
        /*$keyword=$request['keyword'];
        $location=$request['location'];
        $type=$request['type'];		
		$locations=SubAdmin1::where('country_code','ID')->orderBy('name','asc')->get();
	    $vacancyTypes = WorkingType::SWorkingType()->get();			
           $vacancies = Vacancy::SListVacancy()
            ->where(function($q) use($keyword){
                $q->where('vacancies.title','ILIKE', '%'.trim($keyword).'%')
                ->orWhere('vacancies.title','=',$keyword);
            })
            ->where(function($q) use($location){
                $q->where('cities.subadmin1_code','ILIKE', '%'.trim($location).'%')
                ->orWhere('cities.subadmin1_code','=',$location);
            })
            ->where(function($q) use($type){
                $q->where('working_types.translation_of','ILIKE', '%'.trim($type).'%')
                ->orWhere('working_types.translation_of','=',$type);
            })				
            ->where('vacancies.active',1)->where('reviewed',1)
            ->where('vacancies.closing_date','>',date("Y-m-d"))
			->orderBy('id','DESC')
			->orderBy('partner','DESC')
			->inRandomOrder()			
            ->paginate(6);*/
			
			//return view('vacancies.index', compact('vacancies','locations','vacancyTypes'));
			
			
			
		if(User::count()>0){
		$keyword=$request['keyword'];
        $keycategory=$request['category'];
        $location=$request['location'];			
		$locations=SubAdmin1::SProvinceAll()->get();
		$type=$request['type'];		
        $working_types = WorkingType::SWorkingType()->get();		
		$vacancies = Vacancy::SFrontVacColumn()->SFrontVacancy()->with('vacancysave')
            ->where(function($q) use($keyword){
                $q->where('vacancies.title','ILIKE', '%'.trim($keyword).'%')
                ->orWhere('vacancies.title','=',$keyword)
				->orWhere('c.name','ILIKE', '%'.trim($keyword).'%')
				->orWhere('c.name','=',$keyword)
				;
            })
            ->where(function($q) use($location){
                $q->where('d.subadmin1_code','ILIKE', '%'.trim($location).'%')
                ->orWhere('d.subadmin1_code','=',$location);
            })
            ->where(function($q) use($type){
                $q->where('a.translation_of','ILIKE', '%'.trim($type).'%')
                ->orWhere('a.translation_of','=',$type);
            })
		->SActive()->SReviewed()->inRandomOrder()->SOrder()->paginate(12);
		$crypto = new Hashids();			
			return view('vacancies.index', compact('vacancies','locations','working_types','vacancySaves','crypto'));
		}
		else{
			return \Response::view('errors.503',array(),503);
		}			
	}
	
    public function byCategory($translation_of, $slug,Request $request)
    {  	
        /*$keyword=$request['keyword'];
        $location=$request['location'];
        $type=$request['type'];			
		$locations=SubAdmin1::where('country_code','ID')->orderBy('name','asc')->get();
		$vacancyTypes = WorkingType::SWorkingType()->get();
           $vacancies = Vacancy::SListVacancy()
            ->where(function($q) use($keyword){
                $q->where('vacancies.title','ILIKE', '%'.trim($keyword).'%')
                ->orWhere('vacancies.title','=',$keyword);
            })
            ->where(function($q) use($location){
                $q->where('cities.subadmin1_code','ILIKE', '%'.trim($location).'%')
                ->orWhere('cities.subadmin1_code','=',$location);
            })
            ->where(function($q) use($type){
                $q->where('working_types.translation_of','ILIKE', '%'.trim($type).'%')
                ->orWhere('working_types.translation_of','=',$type);
            })				
            ->where('vacancies.active','=','1')->where('reviewed','=','1')
            ->where('vacancies.closing_date','>',date("Y-m-d"))
			->where('categories.parent_id',$translation_of)
			->orderBy('id','DESC')
			->orderBy('partner','DESC')
			->inRandomOrder()			
            ->paginate(6);			
			return view('vacancies.index', compact('vacancies','locations','vacancyTypes'));*/
			
			
			$crypto = new Hashids();
		if(User::count()>0){
		$keyword=$request['keyword'];
        $keycategory=$request['category'];
        $location=$request['location'];			
		$locations=SubAdmin1::SProvinceAll()->get();
		$type=$request['type'];		
        $working_types = WorkingType::SWorkingType()->get();
		$vacancies = Vacancy::SFrontVacColumn()->SFrontVacancy()->with('vacancysave')
            ->where(function($q) use($keyword){
                $q->where('vacancies.title','ILIKE', '%'.trim($keyword).'%')
                ->orWhere('vacancies.title','=',$keyword)
				->orWhere('c.name','ILIKE', '%'.trim($keyword).'%')
				->orWhere('c.name','=',$keyword)
				;
            })
            ->where(function($q) use($location){
                $q->where('d.subadmin1_code','ILIKE', '%'.trim($location).'%')
                ->orWhere('d.subadmin1_code','=',$location);
            })
            ->where(function($q) use($type){
                $q->where('a.translation_of','ILIKE', '%'.trim($type).'%')
                ->orWhere('a.translation_of','=',$type);
            })
            ->join('categories', function ($join) {
                $join->on('vacancies.category_id', '=', 'categories.translation_of')->where('categories.translation_lang','=',app()->getLocale());
            })	
			->where('categories.parent_id',$translation_of)
		->SActive()->SReviewed()->inRandomOrder()->SOrder()->paginate(12);
			return view('vacancies.index', compact('vacancies','locations','working_types','vacancySaves','crypto'));
		}
		else{
			return \Response::view('errors.503',array(),503);
		}
			
    }
    
	public function show($id,$slug, Request $request)
    {	
       $getVisits=Vacancy::find($id);
	   Vacancy::updateOrcreate(
            [ 
                'id'=>$id      
            ],
            [
                'visits' => $getVisits->visits+1,
            ]
        );		
		$removeWords   = ["{", "}", '"'];		
		$vacancies=Vacancy::SJobDetail()->where('vacancies.id',$id)->first();
		if(auth()->check()){
		//$relatedVacancies=Vacancy::SVacContentSkid()->where('c.translation_of',$vacancies->category_id)->inRandomOrder()->paginate(5);
		
		$relatedVacancies=Vacancy::SVacContentSkid()->where('c.translation_of',$vacancies->category_id)->where('j.user_id',auth()->user()->id)->inRandomOrder()->paginate(5);
		}
		else{
			$relatedVacancies=Vacancy::SVacContentSkid()->where('c.translation_of',$vacancies->category_id)->inRandomOrder()->paginate(5);			
		}
		if(auth()->user()){
			$countApplSingles=Application::where('vacancy_id',$id)->whereActive('1')->where('user_id',auth()->user()->id)->count();
			$countApplAlls=Application::whereActive('1')->where('user_id',auth()->user()->id)->count();
			$applications=Application::whereActive('1')->where('user_id',auth()->user()->id)->get();			
			return view('vacancies.detail', compact(
				'vacancies',
				'removeWords',
				'relatedVacancies',
				'countApplSingles',
				'countApplAlls',
				'applications'
			));
		}
		else{		
			return view('vacancies.detail', compact(
				'vacancies',
				'removeWords',
				'relatedVacancies'
			));
		}		
		
    }     
}
