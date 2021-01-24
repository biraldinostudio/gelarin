<?php

namespace App\Http\Controllers\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Vacancy;
use App\Models\CompanyOfficer;
use App\Models\Application;
use App\Models\Contact;
use Auth;
use Carbon\Carbon;
use DateTime;
use App\Models\User;
use View; //Jika paka return View::make
use App\Models\UserDescription;
use Illuminate\Support\Facades\Input;
use Route;
use Illuminate\Support\Facades\Validator;
class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth:companypage');
    }
		
	
    public function index(){
        return view('layouts.company.app');
    }
    public function dashboard(Request $request){
		//$x=Vacancy::SActive()->SReviewed()->where('company_id',auth()->user()->companyofficer->company->id)->count();
		//dd($x);
        $keyword=$request->keyword;          
       // $checkAccess=CompanyOfficer::SCompAccessStaff()->first();
        $checkAccess=CompanyOfficer::where('user_id',auth()->user()->id)->first();		
		if($checkAccess->vacancy_access=='1'){
			//dd("Test");
			$vacancies = Vacancy::
			select(
			'vacancies.id',
			'vacancies.title',
			'vacancies.closing_date',
			'vacancies.category_id',
			'vacancies.working_type_id',			
			'categories.name as category',
			'vacancies.country_code',
			'countries.date_format',
			'countries.currency_code as currency',			
			'vacancies.city_id',
			'cities.name as city',
			'companies.name as company',
			'companies.logo as logo',
			'working_types.name as type',
			'vacancies.min_salary',
			'vacancies.max_salary',
			'vacancies.active',
			'vacancies.description',
			'vacancies.slug',
			'vacancies.partner',
			'vacancies.created_at'
		)->SCompAllStaffVac()->SActive()->SReviewed()->SKeyword($keyword)->paginate(6);	
		}   
		else{
			$vacancies = Vacancy::
			select(
			'vacancies.id',
			'vacancies.title',
			'vacancies.closing_date',
			'vacancies.category_id',
			'vacancies.working_type_id',			
			'categories.name as category',
			'vacancies.country_code',
			'countries.date_format',
			'countries.currency_code as currency',			
			'vacancies.city_id',
			'cities.name as city',
			'companies.name as company',
			'companies.logo as logo',
			'working_types.name as type',
			'vacancies.min_salary',
			'vacancies.max_salary',
			'vacancies.active',
			'vacancies.description',
			'vacancies.slug',
			'vacancies.partner',
			'vacancies.created_at'
		)->SCompMyVacPost()->where('vacancies.user_id',auth()->user()->id)->SActive()->SReviewed()->SKeyword($keyword)->paginate(6);           
		}
			if($checkAccess->vacancy_access=='1'){
				$countVacancyTrash = Vacancy::SCompVacColumn()->SCompAllStaffVac()->onlyTrashed()->count();					
			}   
			else{
				$countVacancyTrash = Vacancy::SCompVacColumn()->SCompAllStaffVac()->onlyTrashed()->count();					
				
			}
        return view('company.home.index')->with(compact(
			'vacancies',
			'countVacancyTrash'
		)); 		
    }

	/*public function CompVacCol(){
		return $query->select(
			'vacancies.id',
			'vacancies.title',
			'vacancies.closing_date',
			'vacancies.category_id',
			'vacancies.working_type_id',			
			'categories.name as category',
			'vacancies.country_code',
			'countries.date_format',
			'countries.currency_code as currency',			
			'vacancies.city_id',
			'cities.name as city',
			'companies.name as company',
			'companies.logo as logo',
			'working_types.name as type',
			'vacancies.min_salary',
			'vacancies.max_salary',
			'vacancies.active',
			'vacancies.description',
			'vacancies.slug',
			'vacancies.partner',
			'vacancies.created_at'
		);		
		
	}*/
	public function contact(Request $request){
        Validator::make($request->all(), [
           	'message'=> 'required|string|min:15|max:300',			
        ])->validate();	

		$process = Contact::create([
			'user_id'=>auth()->user()->id,
			'message'=>$request->message,					
		]);	
        if(!empty($process)) {
			return redirect()->back()->with('alert',trans('home.Your message has been sent to Gelarin management. Management will contact you soon'));
        } else {
			return redirect()->back()->with('alert',trans('home.Your message failed to send, please restart again or wait a few moments to repeat'));
        }
	}	
}
