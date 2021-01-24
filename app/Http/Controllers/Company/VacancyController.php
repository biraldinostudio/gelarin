<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Ip;
use App\Models\Currency;
use App\Models\SalaryType;
use App\Models\Vacancy;
use App\Models\Education;
use App\Models\VacancyEducation;
use App\Models\VacancyGender;
use App\Models\Major;
use App\Models\VacancyMajor;
use App\Models\WorkingType;
use App\Models\WorkingLevel;
use App\Models\City;
use App\Models\SubAdmin1;
use App\Models\Country;
use App\Models\Category;
use App\Models\Gender;
use App\Models\Application;
use Auth;
use Carbon\Carbon;
use DateTime;
use App\Models\User;
use App\Models\UserDescription;
use App\Models\Company;
use App\Models\CompanyOfficer;
use App\Models\CompanyAddress;
use App\Models\CompanyLegal;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; // untuk slug atau tags
use View; //Jika paka return View::make
use Route;

use Illuminate\Database\Eloquent\Builder;

class VacancyController extends Controller
{
    public function __construct(){
        $this->middleware('auth:companypage');
    }
	
    public function index(Request $request)
    {
        $keyword=$request->keyword;           
        $checkAccess=CompanyOfficer::SCompAccessStaff()->first();
		if(Route::is('vacancies.active')){
			if($checkAccess->vacancy_access=='1'){
				$vacancies = Vacancy::SCompVacColumn()->SCompAllStaffVac()->SActive()->SReviewed()->SKeyword($keyword)->paginate(6);	
			}   
			else{
				$vacancies = Vacancy::SCompVacColumn()->SCompMyVacPost(auth()->user()->id)->SActive()->SReviewed()->SKeyword($keyword)->paginate(6);           
			}
		}
		if(Route::is('vacancies.active')){
			if($checkAccess->vacancy_access=='1'){
				$vacancies = Vacancy::SCompVacColumn()->SCompAllStaffVac()->SActive()->SReviewed()->SKeyword($keyword)->paginate(6);	
			}   
			else{
				$vacancies = Vacancy::SCompVacColumn()->SCompMyVacPost(auth()->user()->id)->SActive()->SReviewed()->SKeyword($keyword)->paginate(6);           
			}
		}
		if(Route::is('vacancies.pending')){
			if($checkAccess->vacancy_access=='1'){
				$vacancies = Vacancy::SCompVacColumn()->SCompAllStaffVac()->SActive()->SUnReviewed()->SKeyword($keyword)->paginate(6);	
			}   
			else{
				$vacancies = Vacancy::SCompVacColumn()->SCompMyVacPost(auth()->user()->id)->SActive()->SUnReviewed()->SKeyword($keyword)->paginate(6);           
			}
		}
		if(Route::is('vacancies.expire')){
			if($checkAccess->vacancy_access=='1'){
				$vacancies = Vacancy::SCompVacColumn()->SCompAllStaffVac()->SExpire()->SReviewed()->SKeyword($keyword)->paginate(6);	
			}   
			else{
				$vacancies = Vacancy::SCompVacColumn()->SCompMyVacPost(auth()->user()->id)->SExpire()->SReviewed()->SKeyword($keyword)->paginate(6);           
			}
		}
		if(Route::is('vacancies.inactive')){
			if($checkAccess->vacancy_access=='1'){
				$vacancies = Vacancy::SCompVacColumn()->SCompAllStaffVac()->SInActive()->SKeyword($keyword)->paginate(6);	
			}   
			else{
				$vacancies = Vacancy::SCompVacColumn()->SCompMyVacPost(auth()->user()->id)->SInActive()->SKeyword($keyword)->paginate(6);           
			} 
		}
			if($checkAccess->vacancy_access=='1'){
				$countVacancyTrash = Vacancy::SCompVacColumn()->SCompAllStaffVac()->onlyTrashed()->count();					
			}   
			else{
				$countVacancyTrash = Vacancy::SCompVacColumn()->SCompAllStaffVac()->onlyTrashed()->count();					
				
			}		

		
        return view('company.vacancies.index', compact(
			'vacancies',
			'countVacancyTrash'			
		));         
    }
    public function trash(Request $request)
    {
        $keyword=$request->keyword;           
        $checkAccess=CompanyOfficer::SCompAccessStaff()->first();
			if($checkAccess->vacancy_access=='1'){
				$vacancies = Vacancy::SCompVacColumn()->SCompAllStaffVac()->onlyTrashed()->SKeyword($keyword)->paginate(6);
				$countVacancyTrash = Vacancy::SCompVacColumn()->SCompAllStaffVac()->onlyTrashed()->count();					
			}   
			else{
				$vacancies = Vacancy::SCompVacColumn()->SCompMyVacPost(auth()->user()->id)->onlyTrashed()->SKeyword($keyword)->paginate(6);
				$countVacancyTrash = Vacancy::SCompVacColumn()->SCompAllStaffVac()->onlyTrashed()->count();					
				
			}		
        return view('company.vacancies.index', compact(
			'vacancies',
			'countVacancyTrash'
		));         
    }
    public function create(Request $request)
    {
		$companyAddresses=CompanyAddress::where('company_id',auth()->user()->companyofficer->company->id)->whereActive('1')->first();
		$companyLegals=CompanyLegal::where('company_id',auth()->user()->companyofficer->company->id)->whereActive('1')->first();		
		if(auth()->user()->companyofficer->company->working_time_id=='' or auth()->user()->companyofficer->company->working_uniform_id=='' 
			or auth()->user()->companyofficer->company->email1=='' or auth()->user()->companyofficer->company->phone1==''
			//or auth()->user()->companyofficer->company->logo=='' 
			or auth()->user()->companyofficer->company->size=='' 
			or empty($companyAddresses) or empty($companyLegals)
			){
			if(auth()->user()->companyofficer->type=='Creator')
			{
			return redirect(route('settings.index'))->with('blocks', trans('setting.Before posting a job, you must complete the data first as follows:'));
			}
			else{
				return \Response::view('company.errors.000');
			}
		}else{
			$keyword=$request->keyword;          
			$checkAccess=CompanyOfficer::SCompAccessStaff()->first();
			if($checkAccess->vacancy_access=='1'){
				$vacancies = Vacancy::SCompVacColumn()->SCompAllStaffVac()->SActive()->SReviewed()->SKeyword($keyword)->paginate(6);	
			}   
			else{
				$vacancies = Vacancy::SCompVacColumn()->SCompMyVacPost(auth()->user()->id)->SActive()->SReviewed()->SKeyword($keyword)->paginate(6);           
			}
			
			
			$checkAccess=CompanyOfficer::SCompAccessStaff()->first();
				if($checkAccess->vacancy_posting=='1'){   
					$countries=Country::SMyCountry()->where('code',Auth::User()->UserDescription->country_code)->take(1)->first();
					$sub_admin1s=SubAdmin1::SSubAdmin1()->get();
					$cite=City::SCity()->get();    
					$educations=Education::SEducation()->get();
					$genders=Gender::SGender();
					$working_types = WorkingType::SCompWorkType();
					$working_levels = WorkingLevel::SWorkingLevel();		
					$parents=Category::SCategory()->get();
					$categories=Category::SSubCategory()->get();
					$salary_types = SalaryType::SSalaryType();
					$majorparents = Major::SMajorParent();			
					$majors = Major::SMajorChild();		
					return view('company.vacancies.create')->with(compact(
						'parents',
						'categories',
						'working_levels',
						'working_types',
						'educations',
						'majorparents',
						'majors',
						'genders',
						'countries',
						'sub_admin1s',
						'cite',
						'salary_types',
						'vacancies'				
					));
			}
			else{
				return redirect()->back();
			}
		}
    }

    public function store(Request $request)
    {
		$getIP=geoip()->getClientIP();
        $visitorIPs=geoip()->getLocation($getIP = null);
        $UserDescriptions = UserDescription::where('user_id',Auth::User()->id)->first();
		$countriesByIP=Country::select('code','date_format')->whereActive('1')->whereCode($visitorIPs->iso_code)->first();				
        if(!empty($UserDescriptions->country_code)){
            $countryID=$UserDescriptions->country_code;    
        }
        else{
            $countryID=$countriesByIP->code;
        }
		//dd($countryID);
		$countries=Country::select('code','date_format')->whereCode($countryID)->first();
        $checkAccess=CompanyOfficer::SCompAccessStaff()->first();	
            if($checkAccess->vacancy_posting=='1'){        
                
                //Convert text ke float
            	$min_salary = floatval(str_replace(',' ,'', $request->min_salary));
            	$max_salary = floatval(str_replace(',' ,'', $request->max_salary));

            	//Range
            	$min = $min_salary  + 0.01;
            	$max = $max_salary - 0.01;
            	$start= str_replace('/', '-', $request->start_date);
            	$end= str_replace('/', '-', $request->end_date);
            	//Validate data
            	Validator::make($request->all(), [
            		'subject' => 'required|string|min:8|max:53',
            		'type' => 'required',
            		'level' => 'required',
            		'parent' => 'required',
            		'category' => 'required',
            		'end_date' => 'required|date:'.$countries->date_format.'|after:'.date("Y-m-d"),					
            		'subadmin1' => 'required',
            		'cit' => 'required',
            		'address' => 'required|min:5|max:53',					
            		'educatione' => 'required',
            		'majorne' => 'required',			
            		'experience' => 'required',
            		'age' => 'required|numeric|min:17|max:55',			
            		'min_salary' => [
            			'required',
            				/*function($attribute, $value, $fail) use($min_salary, $max) {
            					if ($min_salary < 0 ||  $min_salary > $max) {
            						return $fail($attribute.' must be between 0 and maximum salary.');
            					}
            				}*/
            		],
            		'max_salary' => [
            			'required',
            			function($attribute, $value, $fail) use($max_salary, $min) {
            			if ($max_salary < $min) {
            				return $fail(trans('validation.maximum salary must be greater than minimum salary.'));
            			}
            		}],
            		'salary' => 'required',
                    'gender' => 'required',             
            		'description'=> 'required|min:100|max:20000',           
            			//'url' => 'min:5|max:180',
            	])->validate();
            	$inputs = $request->all();
            	$dt= new DateTime();
            	$user = Auth::User();
            	$userId = $user->id;

                if ($request->has('cit')) {
                    $city = City::find($request->cit);
                    if (empty($city)) {
                        flash()->error(trans('global.Post data was disabled for this time. Please try later. Thank you'));
                        return back();
                    }
                }	
            	//$vacancyID = \DB::table('vacancies')->insertGetId([
				$vacancies = Vacancy::create([				
            		'country_code'=>Auth::User()->UserDescription->country_code,		
            		'user_id'=>$userId,			
                    'category_id' => $request->category,
                    'city_id' => $request->cit,	
                    'working_type_id' => $request->type,	
                    'working_level_id' => $request->level,	
                    'salary_type_id' => $request->salary,
                    'gender_id' => $request->gender,
                    'company_id' => Auth::User()->CompanyOfficer->company_id,                            	
                    'date' => date("Y-m-d"),	
            		'hours' =>$dt->format('H:i:s'),	
                    'title' => ucwords(strtolower($request->subject)),
                    'description' => $request->description,			
                    'slug' =>Str::slug($request->get('subject')),
					'start_date' => date("Y-m-d"),					
                    'closing_date' => date('Y-m-d', strtotime($end)),
                    'years_experience' => $request->experience,
                    'max_age' => $request->age,			
                    'min_salary' => $min_salary,
                    'max_salary' => $max_salary,				
                    'negotiation' => $request->negotiable,
                    'hide_salary' => $request->hide_salary,				
                    'application_url' => $request->url,
                    //'postal_code' => $request->input('postal_code'),
					'address' => $request->address,					
            		'lat' =>$city->latitude,
            		'lon' =>$city->longitude,
            		'ip_addr'=>Ip::get(),
            		'activation_token'=>md5(microtime() . mt_rand(100000, 999999)),			
            		'active' => '1',
            		'reviewed' => '1',
            		'featured' => '0',
            		'archived' => '0',	
            		'partner' => '0',
					'created_at' => date('Y-m-d H:i:s'),					
                ]);
			$educations=$request->educatione;
			$vacancies->education()->sync($educations);

			$majors=$request->majorne;
			$vacancies->major()->sync($majors);				
				
                    //Mail::to($user->email)->send(new VerifyMail($user));
            		return redirect()->back()->with('message', trans('global.Successfully save job vacancy data'));
        }
        else{
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $countries=Country::SMyCountry()->where('code',Auth::User()->UserDescription->country_code)->first();
        $sub_admin1s=SubAdmin1::SSubAdmin1()->get();
        $cite=City::SCity()->get();    
        $educations=Education::SEducation()->get();
        $vacancyeducations=VacancyEducation::SVacancyEducation()->where('vacancy_id',$id);        
        $genders=Gender::SGender();      
        $working_types = WorkingType::SCompWorkType();
        $working_levels = WorkingLevel::SWorkingLevel();
		$parents=Category::SCategory()->get();
        $categories=Category::SSubCategory()->get();
        $salary_types = SalaryType::SSalaryType();
        $majorparents = Major::SMajorParent();          
        $majors = Major::SMajorChild();
        $vacancymajors = VacancyMajor::SVacancyMajor()->where('vacancy_id',$id);         
        $vacancies = Vacancy::find($id);                
        return view('company.vacancies.edit')->with(compact(
			'vacancies',
			'parents',
			'categories',
			'working_levels',
			'working_types',
			'educations',
			'vacancyeducations',
			'majorparents',
			'majors',
			'vacancymajors',
			'genders',
			'countries',
			'sub_admin1s',
			'cite',
			'salary_types'		
		));               

}
    public function update(Request $request, $id)
    {	
		$countries=Country::SMyCountry()->where('code',Auth::User()->UserDescription->country_code)->take(1)->first();
        //Convert text ke float
        $min_salary = floatval(str_replace(',' ,'', $request->min_salary));
        $max_salary = floatval(str_replace(',' ,'', $request->max_salary));

        //Range
        $min = $min_salary  + 0.01;
        $max = $max_salary - 0.01;
        $start= str_replace('/', '-', $request->start_date);
        $end= str_replace('/', '-', $request->end_date);
        //Validate data
        Validator::make($request->all(), [
            'subject' => 'required|string|min:10|max:53',
            'type' => 'required',
            'level' => 'required',
            'parent' => 'required',
            'category' => 'required',
            'end_date' => 'required|date:'.$countries->date_format.'|after:'.date("Y-m-d"),			
            'subadmin1' => 'required',
            'cit' => 'required',
            'address' => 'required|min:5|max:53',			
            'educatione' => 'required',
            'majorne' => 'required',            
            'experience' => 'required',
            'age' => 'required|numeric|min:17|max:55',          
            'min_salary' => [
                'required',
                /*function($attribute, $value, $fail) use($min_salary, $max) {
                    if ($min_salary < 0 ||  $min_salary > $max) {
                        return $fail($attribute.' must be between 0 and maximum salary.');
                    }
                }*/
            ],
            'max_salary' => [
                'required',
                function($attribute, $value, $fail) use($max_salary, $min) {
                if ($max_salary < $min) {
                    return $fail(trans('validation.maximum salary must be greater than minimum salary.'));
                }
            }],
            'salary' => 'required',
            'gender' => 'required',             
            'description'=> 'required|string|min:100|max:20000',           
            //'url' => 'min:5|max:180',
        ])->validate();
        $inputs = $request->all();
        $dt= new DateTime();
        $user = Auth::User();
        $userId = $user->id;

        if ($request->has('cit')) {
            $city = City::find($request->cit);
            if (empty($city)) {
                flash()->error(trans('global.Post data was disabled for this time. Please try later. Thank you'));
                return back();
            }
        }   
        $vacancy = Vacancy::whereId($id);
        $vacancy->update([        
            'category_id' => $request->category,
            'city_id' => $request->cit,    
            'working_type_id' => $request->type,   
            'working_level_id' => $request->level, 
            'salary_type_id' => $request->salary,
            'gender_id' => $request->gender,            
            'title' => ucwords(strtolower($request->subject)),
            'description' => $request->description,            
            'slug' =>Str::slug($request->get('subject')),
            'start_date' => date("Y-m-d"),               
            'closing_date' => date('Y-m-d', strtotime($end)),
            'years_experience' => $request->experience,
            'max_age' => $request->age,            
            'min_salary' => $min_salary,
            'max_salary' => $max_salary,                
            'negotiation' => $request->negotiable,
            'hide_salary' => $request->hide_salary,                
            'application_url' => $request->url,
            'address' => $request->address,			
        ]);

        $vacancies=Vacancy::find($id);
		
		$educations=$request->educatione;
		$vacancies->education()->sync($educations);

		$majors=$request->majorne;
		$vacancies->major()->sync($majors);	
		
        return redirect()->back()->with('message', trans('global.Successfully save job vacancy data'));
   }

    public function editCancel($id){ 
        $vacancies = Vacancy::find($id);                
        return view('company.vacancies.cancel')->with(compact(
			'vacancies'
		));               
    }	

    public function updateCancel(Request $request, $id){
        //
        Validator::make($request->all(), [
            'status'=> 'required',        
            'description'=> 'required|string|min:10|max:500',
        ])->validate();
        $vacancy = Vacancy::find($id);
        $vacancy->update([                        
            'active' => $request->status,
            'cancel_reason' => $request->description,
            'cancel_user' => Auth::User()->name,
			'cancel_date'=>date("Y-m-d"),
        ]);
		return redirect()->back()->with('message', trans('global.Job vacancies were canceled'));
    }	
	
   /* public function destroy($id){
		$vacancy = Vacancy::find($id);
		$vacancy->delete();		
		return redirect()->back()->with('message', trans('global.Job application successfully deleted!'));		
    }*/
	
    public function destroy($id)
    {
    	
		if(Route::is('vacancies.delete')){
			$processBox=Vacancy::find($id)->delete();
			if(!empty($processBox)) {
				//return redirect(route('article.active'))->with('success', trans('global.Data successfully deleted.'));
				return redirect()->back()->with('message', trans('global.Data successfully deleted.'));			
			}
			else{
				return redirect()->back()->with(['warning' => trans('global.Data failed to delete')]);
			}			
		}
		if(Route::is('vacancies.destroy')){
			$processBox=Vacancy::withTrashed()->whereId($id)->forceDelete();
			if(!empty($processBox)) {
				return redirect(route('article.trash'))->with('success', trans('global.Data successfully deleted.'));
			}
			else{
				return redirect()->back()->with(['warning' => trans('global.Data failed to delete')]);
			}			
		}		
		
    }
	
    public function restore($id)
    {
    	$processBox=Vacancy::withTrashed()->whereId($id)->restore();
		if(!empty($processBox)) {
			return redirect(route('article.trash'))->with('success', trans('global.Data returned successfully.'));
		}
		else{
			return redirect()->back()->with(['warning' => trans('global.Data failed to return')]);
		}
			
    }

	public function show($id,$slug, Request $request)
    {	
	//dd("ehm");
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
		$relatedVacancies=Vacancy::SVacContentSkid()->where('c.translation_of',$vacancies->category_id)->inRandomOrder()->paginate(5);
		if(auth()->user()){
			$countApplSingles=Application::where('vacancy_id',$id)->whereActive('1')->where('user_id',auth()->user()->id)->count();
			$countApplAlls=Application::whereActive('1')->where('user_id',auth()->user()->id)->count();
			$applications=Application::whereActive('1')->where('user_id',auth()->user()->id)->get();			
			return view('company.vacancies.detail', compact(
				'vacancies',
				'removeWords',
				'relatedVacancies',
				'countApplSingles',
				'countApplAlls',
				'applications'
			));
		}
		else{		
			return view('company.vacancies.detail', compact(
				'vacancies',
				'removeWords',
				'relatedVacancies'
			));
		}		
		
    } 	
}
