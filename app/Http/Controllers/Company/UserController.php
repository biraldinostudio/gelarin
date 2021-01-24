<?php

namespace App\Http\Controllers\Company;
use Illuminate\Http\Request;
use Hashids\Hashids;
use App\Models\User;
use App\Models\UserDescription;
use App\Models\UserSkill;
use App\Models\UserExperience;
use App\Models\UserEducation;
use App\Models\SubAdmin1;
use App\Models\Gender;
use App\Models\Vacancy;
class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth:companypage');
    }
	
	public function index(Request $request){	
		$crypto = new Hashids();
		$keyword=$request['keyword'];
        $keycategory=$request['category'];
        $location=$request['location'];		
		$locations=SubAdmin1::SProvinceAll()->get();		
		$users=User::whereActive('1')->whereType('Member')->with('userdescription')->paginate(6);





         /*  $users = User::SListVacancy()
            ->where(function($q) use($keyword){
                $q->where('userdescriptions.profession','LIKE','%'.$keyword.'%')
                ->orWhere('vacancies.title','=',$keyword);
            })
            ->where(function($q) use($location){
                $q->where('cities.subadmin1_code','LIKE','%'.$location.'%')
                ->orWhere('cities.subadmin1_code','=',$location);
            })
            ->where(function($q) use($type){
                $q->where('working_types.translation_of','LIKE','%'.$type.'%')
                ->orWhere('working_types.translation_of','=',$type);
            })				
            ->where('vacancies.active',1)->where('reviewed',1)
            ->where('vacancies.closing_date','>',date("Y-m-d"))
			->orderBy('id','DESC')
			->orderBy('partner','DESC')		
            ->paginate(6);*/
		
		return view('company.user.index')->with(compact('users','crypto','locations'));		
    }

    public function show($id,$name, Request $request){
		$crypto = new Hashids();
		//$usr=User::find($crypto->decodeHex($id));
		//dd($usr->userdescription->city->subadmin1->name);
		//date($countries->date_format, strtotime($vacancies->closing_date))
		$users=User::find($crypto->decodeHex($id));
		$skills=UserSkill::where('user_id',$crypto->decodeHex($id))->get();
		$experiences=UserExperience::where('user_id',$crypto->decodeHex($id))->get();
		$colleges=UserEducation::where('user_id',$crypto->decodeHex($id))->orderBy('start_year','ASC')->get();
		$genders=Gender::SGenderAccount()->with('userdescription')->get();
		$vacancies=Vacancy::where('company_id',auth()->user()->companyofficer->company_id)->get();//Untuk  Job Offer
		return view('company.user.detail', compact('users','skills','experiences','colleges','genders','crypto','vacancies'));
    }
	
    public function authorShow($id,$name, Request $request){
		$crypto = new Hashids();
		//date($countries->date_format, strtotime($vacancies->closing_date))
		$users=User::find($crypto->decodeHex($id));
		$skills=UserSkill::where('user_id',$crypto->decodeHex($id))->get();
		$experiences=UserExperience::where('user_id',$crypto->decodeHex($id))->get();		
		return view('company.author.detail', compact('users','skills','experiences'));
    }

    public function downloadResume($id)
    {
		$crypto = new Hashids();
		//dd($crypto->decodeHex($id));
		$existResume=UserDescription::where('user_id',$crypto->decodeHex($id))->first();
		//dd($existResume->resume);
    	$myFile = "storage/uploads/member/resume/".$existResume->resume;
    	$headers = ['Content-Type: application/pdf'];
    	$newName = substr($existResume->resume,7);
    	return response()->download($myFile, $newName, $headers);
    }	

}
