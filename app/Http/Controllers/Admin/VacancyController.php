<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use DateTime;
use Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; // untuk slug atau tags
use Ip;
use App\Models\Vacancy;
use App\Models\Currency;
use App\Models\SalaryType;
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
use App\Models\Company;
use App\Models\CompanyOfficer;
class VacancyController extends Controller
{
    public function __construct(){
        $this->middleware('auth:adminMiddle');
    }
	    
	public function index()
    {
		if(Route::is('admin.vacancies.index')){
			$vacancies=Vacancy::SBackSelect()->SBackIndexVacancy()->SUnReviewed()->paginate(5);
			}
		if(Route::is('admin.vacancies.reviewed')){
			$vacancies=Vacancy::SBackSelect()->SBackIndexVacancy()->SReviewed()->paginate(5);
		}
		if(Route::is('admin.vacancies.inactived')){
			$vacancies=Vacancy::SBackSelect()->SBackIndexVacancy()->SReviewed()->SActive()->paginate(5);
		}
		if(Route::is('admin.vacancies.expired')){
			$vacancies=Vacancy::SBackSelect()->SBackIndexVacancy()->whereReviewed('1')->SExpire()->paginate(5);
		}		
		if(Route::is('admin.vacancies.trash')){
			$vacancies=Vacancy::SBackSelect()->SBackIndexVacancy()->whereReviewed('1')->onlyTrashed()->paginate(5);
		}		
		return view('admin.vacancies.index')->with(compact('vacancies'));
    }


    public function create()
    {
		$countries=Country::SMyCountry()->where('code','ID')->take(1)->first();
		$sub_admin1s=SubAdmin1::where('country_code','=','ID')->orderBy('name','asc')->get();
		$cite=City::select('subadmin1_code','name','country_code','id')->where('country_code','=','ID')->where('active',1)->get(); 
		$educations=Education::SEducation()->get();
		$genders=Gender::SGender();
		$working_types = WorkingType::SCompWorkType();
		$working_levels = WorkingLevel::SWorkingLevel();		
		$parents=Category::SCategory()->get();
		$categories=Category::SSubCategory()->get();
		$salary_types = SalaryType::SSalaryType();
		$majorparents = Major::SMajorParent();			
		$majors = Major::SMajorChild();
		$companies=Company::select('id','name')->whereActive('1')->get();	
		return view('admin.vacancies.create')->with(compact(
			'companies',
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

    public function store(Request $request)
    {
				//Convert text ke float
            	$min_salary = floatval(str_replace(',' ,'', $request->min_salary));
            	$max_salary = floatval(str_replace(',' ,'', $request->max_salary));

            	//Range
            	$min = $min_salary  + 0.01;
            	$max = $max_salary - 0.01;
            	$end= str_replace('/', '-', $request->end_date);
            	//Validate data
            	Validator::make($request->all(), [
            		'company' => 'required',				
            		'subject' => 'required|string|min:8|max:53',
            		'type' => 'required',
            		'level' => 'required',
            		'parent' => 'required',
            		'category' => 'required',					
            		'subadmin1' => 'required',
            		'cit' => 'required',
            		'address' => 'required|min:5|max:53',					
            		'educatione' => 'required',
            		'majorne' => 'required',			
            		'experience' => 'required',
            		'age' => 'required|numeric|min:17|max:55',
                    'gender' => 'required',					
            		'min_salary' => [
            			'required',
            		],
            		'max_salary' => [
            			'required',
            			function($attribute, $value, $fail) use($max_salary, $min) {
            			if ($max_salary < $min) {
            				return $fail('validation.maksimal gaji harus lebih besar dari minimum gaji.');
            			}
            		}],
            		'salary' => 'required',             
            		'description'=> 'required|min:100|max:20000',
            		'end_date' => 'required|date:d/m/y|after:'.date("Y-m-d"),					
            	])->validate();
            	$dt= new DateTime();
            	$user = Auth::User();
            	$userId = $user->id;
                if ($request->has('cit')) {
                    $city = City::find($request->cit);
                    if (empty($city)) {
                        flash()->error('Data pos dinonaktifkan untuk saat ini. Silakan coba lagi nanti. Terima kasih');
                        return back();
                    }
                }				
				$officerId=CompanyOfficer::select('user_id','company_id')->where('company_id',$request->company)->first();
				$process = Vacancy::create([				
            		'country_code'=>'ID',		
            		'user_id'=>$officerId->user_id,			
                    'category_id' => $request->category,
                    'city_id' => $request->cit,	
                    'working_type_id' => $request->type,	
                    'working_level_id' => $request->level,	
                    'salary_type_id' => $request->salary,
                    'gender_id' => $request->gender,
                    'company_id' => $request->company,                            	
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
			$process->education()->sync($educations);

			$majors=$request->majorne;
			$process->major()->sync($majors);
			
		if(!$process){
			return back()->with('error', 'Data gagal disimpan');				
		}
		else{
			return back()->with('success', 'Dat berhasil disimpan');	
		}			

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
