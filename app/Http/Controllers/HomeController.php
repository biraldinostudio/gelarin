<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use App\Models\City;
use App\Models\SubAdmin1;
use App\Models\WorkingType;
use App\Models\Vacancy;
use App\Models\Testimonial;
use App\Models\UserDescription;
use App\Models\CompanyOfficer;
use App\Models\Company;
use App\Models\Application;
use App\Models\VacancySave;
use App\Models\Contact;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Validator;
use Hashids\Hashids;
class HomeController extends Controller
{
    public function index(Request $request)
    {
		$crypto = new Hashids();
		if(User::count()>0){
		$keyword=$request['keyword'];
        $keycategory=$request['category'];
        $location=$request['location'];			
		$locations=SubAdmin1::SProvinceAll()->get();	
        $working_types = WorkingType::SWorkingType()->get();		
		$testimonials = Testimonial::STestimonial()->where('testimonials.active','=','1')->inRandomOrder()->SOrder()->get();
		$companies=Company::SCompanyActive()->where('partner','=','1')->inRandomOrder()->get();
		$vacancies = Vacancy::SFrontVacColumn()->SFrontVacancy()->with('vacancysave')->SActive()->SReviewed()->inRandomOrder()->SOrder()->paginate(12);
			return view('home.index', compact('vacancies','locations','working_types','testimonials','companies','vacancySaves','crypto'));
		}
		else{
			return \Response::view('errors.503',array(),503);
		}		
		
    }
	
    /*public function dashboard(Request $req){
        return view('company.middleware')->withMessage("Company");
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
