<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vacancy;
use App\Models\VacancySave;
use Auth;
use App\Models\Country;
use App\Models\Application;
use App\Models\VacancyOffer;
use App\Models\Ad;
use Route;
use DB;
Use Carbon\Carbon;
use DateTime;
class ManageVacancyController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
    }
	public function countUnprocessed(){
		return Application::SApplication()
				->Where('applications.application_status','=','Unprocessed')
				->Where('applications.active','=',1)
				->get();
	}
	public function countShortlist(){
		return Application::SApplication()
				->Where('applications.application_status','=','Shortlist')
				->Where('applications.active','=',1)
				->get();
	}
	public function countInterview(){
		return Application::SApplication()
				->Where('applications.application_status','=','Interview')
				->Where('applications.active','=',1)
				->get();
	}
	public function countNot(){
		return Application::SApplication()
				->Where('applications.application_status','=','Not Suitable')
				->Where('applications.active','=',1)
				->get();
	}
	public function countPass(){
		return Application::SApplication()
				->Where('applications.application_status','=','Pass')
				->Where('applications.active','=',1)
				->get();
	}
	public function countCancel(){
		return Application::SApplication()
				->Where('applications.application_status','=','Cancel')
				->Where('applications.active','=',1)
				->get();
	}	
    public function index(Request $request)
    {
		$countSaveVacancies=VacancySave::where('user_id',auth()->user()->id)->count();
		$keyword=$request['keyword'];
		$vacancyCounts=VacancySave::count();
		$countUnprocesseds=$this->countUnprocessed();
		$countShortlists=$this->countShortlist();
		$countInterviews=$this->countInterview();
		$countNots=$this->countNot();
		$countPasss=$this->countPass();
		$countCancels=$this->countCancel();			
		
			$vacancySaves = VacancySave::SVacancySaveList()
				->where(function($q) use($keyword){
					$q->where('vacancies.title','ILIKE', '%'.trim($keyword).'%')
					->orWhere('vacancies.title','=',$keyword);
				})					
				->where('vacancy_saves.user_id',Auth::User()->id)
				->paginate(6);	
		$premiumVacancies=Vacancy::SVacContentSkid()->where('vacancies.partner','=','1')->SActive()->inRandomOrder()->get();
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
		return view('vacancies.manage.index')->with(compact(
			'vacancySaves',
			'vacancyCounts',
			'premiumVacancies',
			'ads',
			'countSaveVacancies',
			'countUnprocesseds',
			'countShortlists',
			'countInterviews',
			'countNots',
			'countPasss',
			'countCancels'			
		));		
    }

    public function jobRecommendet(Request $request){
        $keyword=$request['keyword'];
		$applications=Application::whereActive('1')->where('user_id',auth()->user()->id)->get();		
		$vacancySaveCounts=VacancySave::where('user_id',Auth::User()->id)->count();
		$applicationCounts=Application::where('user_id',Auth::User()->id)->count();		
		$jobRecommendations = Vacancy::SJobRecomendet()
			->where(function($q) use($keyword){
					$q->where('vacancies.title','ILIKE', '%'.trim($keyword).'%')
					->orWhere('vacancies.title','=',$keyword);
			})
			->whereNotIn('vacancies.id', function($query) {
				$query->select('vacancy_id')
					->from('applications');
			})
			->SActive()->paginate(6);
		$premiumVacancies=Vacancy::SVacContentSkid()->where('vacancies.partner','=','1')->SActive()->inRandomOrder()->paginate(5);
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
		$countPremVacancies=Vacancy::SVacContentSkid()->where('vacancies.partner','=','1')->count();		
		return view('vacancies.manage.recomendet')->with(compact(
			'jobRecommendations',
			'vacancySaveCounts',
			'applicationCounts',
			'premiumVacancies',
			'ads',
			'countPremVacancies'
		));	
	}
	
    public function jobOffer(Request $request){
        $keyword=$request['keyword'];		
		$vacancySaveCounts=VacancySave::where('user_id',Auth::User()->id)->count();
		$applicationCounts=Application::where('user_id',Auth::User()->id)->count();	
		$jobOffers = VacancyOffer::where('vacancy_offers.user_id', auth()->user()->id)
			->leftJoin('vacancies as a', 'a.id', '=', 'vacancy_offers.vacancy_id')
			->leftjoin('working_types as b', function($join)
				{
					$join->on('a.working_type_id', '=', 'b.translation_of')->where('b.translation_lang','=',app()->getLocale());
				})
			->join('companies as c', 'c.id', '=', 'a.company_id')
			->join('cities as d', 'a.city_id', '=', 'd.id')
            ->join('countries as e', 'a.country_code', '=', 'e.code')
			->where(function($q) use($keyword){
					$q->where('a.title','ILIKE', '%'.trim($keyword).'%')
					->orWhere('a.title','=',$keyword);
			})			
			->select(	
				'a.id',
				'a.slug',
				'a.title',
				'a.created_at',
				'b.name as types',
				'a.visits',
				'c.name as company',
				'c.logo',
				'e.date_format',
				'd.name as city'
			)
			->paginate(5);		
		$premiumVacancies=Vacancy::SVacContentSkid()->where('vacancies.partner','=','1')->SActive()->inRandomOrder()->paginate(5);
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
		$countPremVacancies=Vacancy::SVacContentSkid()->where('vacancies.partner','=','1')->count();		
		return view('vacancies.manage.job_offer')->with(compact(
			'jobOffers',
			'vacancySaveCounts',
			'applicationCounts',
			'premiumVacancies',
			'ads',
			'countPremVacancies'
		));	
	}	

    public function store(Request $request,$id,$slug)
    {
		$process =VacancySave::create([			
			'user_id'=>auth()->user()->id,
			'vacancy_id'=>$id,				
		]);
        if(!empty($process)) {
			return redirect(route('manage.vacancies'))->with('success', trans('vacancy.Data saved successfully'));			
        } else {
			return redirect(route('manage.vacancies'))->with('error', trans('vacancy.Data failed to save'));		
        }		
    }
	public function countJobRecomendet(){		
		$jobRecommendations = Vacancy::SJobRecomendet()
			->whereNotIn('vacancies.id', function($query) {
				$query->select('vacancy_id')
					->from('applications');
			})
			->SActive()->count();
		return $jobRecommendations;	
	}	
    public function destroy($id)
    {
		$vacancyDeletes = VacancySave::findOrFail($id);
		$vacancyDeletes->delete();
		return redirect()->back()->with('message', trans('global.Job archive successfully deleted'));
    }
}
