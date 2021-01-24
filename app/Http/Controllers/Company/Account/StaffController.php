<?php

namespace App\Http\Controllers\Company\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Currency;
use App\Models\User;
use App\Models\UserDescription;
use App\Models\CompanyOfficer;
use App\Models\Country;
use App\Models\City;
use App\Models\VerifyUser;
use Auth;
use Ip;
use Carbon\Carbon;
use DateTime;
use View; //Jika paka return View::make
use Redirect; // Untuk redirect halaman
use HelpBahasaPlanet;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; // untuk slug atau tags
use Illuminate\Database\Eloquent\Builder;
use Intervention\Image\Facades\Image as Image;
use Storage;
use File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered; //"Class 'App\Http\Controllers\Company\Auth\Registered' not found"
use App\Jobs\VerificationEmailCompanyStaff;

class StaffController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = '/company/dashboard';    
	
	public function __construct(){
        $this->middleware('auth:companypage');
    }
	
    public function index(Request $request)
    {
		$keyword=$request->keyword;            
		$checkAccess=CompanyOfficer::SCompAccessStaff()->first();
		if($checkAccess->user_management=='1'){
			$companyOfficers = CompanyOfficer::SCompStaffList()->where('company_officers.type','=','Staff')->Keyword($keyword)->paginate(6);
			$countStaffTrash = CompanyOfficer::SCompStaffList()->where('company_officers.type','=','Staff')->onlyTrashed()->count();			
			return view('company.account.officer.staff.index', compact(
				'companyOfficers',
				'countStaffTrash'
			)); 
		}   
		else{
			//return abort(404);
			return Redirect::to("/home"); // redirect ke halaman awal
		} 
    }
	
    public function trash(Request $request){
		$keyword=$request->keyword;            
		$checkAccess=CompanyOfficer::SCompAccessStaff()->first();
		if($checkAccess->user_management=='1'){
			//$companyOfficers = User::ColumnCompanyStaff()->CompanyStaffList()->Keyword($keyword)->paginate(6);
			$companyOfficers = CompanyOfficer::SCompStaffList()->where('company_officers.type','=','Staff')->onlyTrashed()->Keyword($keyword)->paginate(6);
			$countStaffTrash = CompanyOfficer::SCompStaffList()->where('company_officers.type','=','Staff')->onlyTrashed()->count();			
			return view('company.account.officer.staff.index', compact(
				'companyOfficers',
				'countStaffTrash'
			)); 
		}   
		else{
			//return abort(404);
			return Redirect::to("/home"); // redirect ke halaman awal
		} 		
	}		
    public function create(){
        $checkAccess=CompanyOfficer::SCompAccessStaff()->first();
        if($checkAccess->user_management=='1'){                
            $countries=Country::SCountry()->get();
			return view('company.account.officer.staff.create')->with(compact('countries'));
        }
        else{
            return redirect()->back();
        }     
    }


    public function store(Request $request)
    {
		$getIP=geoip()->getClientIP();
		$visitorIPs=geoip()->getLocation($getIP = null);
		$countriesByIP=Country::select('code','phone','date_format')->where('code',$visitorIPs->iso_code)->first();
		$citiesByIP=City::select('id')->where('id',$visitorIPs->city_id)->first();	 
 
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
        $acak = "";
        $monte=date("m");
        for($i=0; $i<6; $i++)
        $acak.=$chars[mt_rand(0,strlen($chars)-1)];
        $defaultPassword=strtolower($acak).$monte;
        $userCreator = Auth::User();
        $userId = $userCreator->id;          
        $getCompany=CompanyOfficer::where('user_id',$userId)->first();             
        Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:35', 		
            'username'=>'required|min:3|max:16|unique:user_descriptions',                                        
            'email' => 'required|string|email|max:255|unique:users',
            'number' => 'required|string|min:3|max:11',			
        ])->validate();        
            $user = User::create([   
            'name' => $request->name,
            'email' => $request->email,
            'password' => HelpBahasaPlanet::encrypt_decrypt('encrypt', $defaultPassword),
            'type' => 'Company',
            'active' => '1',               
        ]);          
        $userDescription= UserDescription::create([
            'user_id' => $user->id,
            'country_code' => $countriesByIP->code,
            'city_id' => $citiesByIP->id,			
            'username' => $request->username,                                   
            'nickname' => explode(' ', trim(ucfirst($request->name)))[0],
            'phone_code' => $countriesByIP->phone,			
            'phone' => $request->number,			
        ]); 
        $companyOfficer=CompanyOfficer::create([
            'user_id' => $user->id,
            'company_id' => $getCompany->company_id,
            'type' => 'Staff',
            'vacancy_access' => $request->vacancy_access,
            'vacancy_posting' => $request->vacancy_posting,
            'talent_search' => $request->talent_search,
            'user_management' => $request->staff_management,
            'credit_management' => $request->credit_management,
            'receive_candidate_email' => $request->receive_candidate_email,
            'add_articles' => $request->add_article,
            'active' =>'1',			
        ]); 
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40),
        ]); 
		dispatch(new VerificationEmailCompanyStaff($user));
        return redirect()->back()->with('message', trans('mail.We send your Staff to the activation code. Please check your email staff and click the link to verify.')); 
    }

    protected function registered(Request $request, $user){
        $this->guard()->logout();
        return redirect(route('company.login'))->with('status', trans('mail.We sent you an activation code. Check your email and click on the link to verify.'));
    }

    public function show($id)
    {
        //
    }


    public function edit($id){
        $countries=Country::SCountry()->get();    
        $staffs = User::find($id);	
        return view('company.account.officer.staff.edit')->with(compact('staffs','countries'));               
    }


    public function update(Request $request, $id)
    {
		$getIP=geoip()->getClientIP();
		$visitorIPs=geoip()->getLocation($getIP = null);
		$countriesByIP=Country::select('code','phone','date_format')->where('code',$visitorIPs->iso_code)->first();
		$citiesByIP=City::select('id')->where('id',$visitorIPs->city_id)->first();	
		
		//Untuk enskripsi password default jika ada pergantian email staff
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
        $acak = "";
        $monte=date("m");
        for($i=0; $i<6; $i++)
        $acak.=$chars[mt_rand(0,strlen($chars)-1)];
        $defaultPassword=strtolower($acak).$monte;
		
        $staffCheck=User::where('id',$id)->first(); // cek email dan password	
        $staffUserNameCheck=UserDescription::where('user_id',$id)->first(); // cek username
        $staffUserTokenCheck=VerifyUser::where('user_id',$id)->first(); // cek username			
		
		//Cek email
		if($request->input('email')==$staffCheck->email){
			$email="string|email|max:255";
			$notif=trans('global.Staff data was successfully changed.');			
		}
		if($request->input('email')!=$staffCheck->email){
			$email="required|string|email|max:255|unique:users";
			$notif=trans('global.Staff data was successfully changed. The verification code has been sent to your staff email.');		
		}		
		if($request->input('email')==""){
			$email="required|string|email|max:255|unique:users";		
		}
		//Cek username
		if($request->input('username')==$staffUserNameCheck->username){
			$username="string|max:255";
		}
		if($request->input('username')!=$staffUserNameCheck->username){
			$username="required|string|max:255|unique:user_descriptions";
		}		
		if($request->input('username')==""){
			$username="required|string|max:255|unique:user_descriptions";
		}
		//Cek status aktif
		if($staffCheck->active=='0'){
			if($request->active==$staffCheck->active){
				$active="";
			}
			if($request->username!=$staffCheck->active){
				$active="required";
			}		
			if($request->active==""){
				$active="required";
			}
		}
		else{
			if($request->active==""){
				$active="";
			}			
		}


        //Validate data
        Validator::make($request->all(), [
            'active' =>$active,        	
            'username' =>$username,
            //'nickname' => 'required|string|min:3|max:16',                        
            'name' => 'required|string|min:3|max:35',
            //'countries_phone1' => 'required',           
            //'telpcode' => 'required|string|min:1|max:5',            
            'number' => 'required|string|min:3|max:11',  
            'email' => $email,
        ])->validate();
        $user = User::find($id);
		if($request->email !=$staffCheck->email){
			$user->update([        
				'email' => $request->email,
				'password' => HelpBahasaPlanet::encrypt_decrypt('encrypt', $defaultPassword),
				'verified'=>'0',
			]);
			VerifyUser::where('user_id', '=', $user->id)
				->update([
				'token' => str_random(40),			
					]
				);
			dispatch(new VerificationEmailCompanyStaff($user));			
		}
		if($request->name!=$staffCheck->name){		
				$user->update([        
					'name' => $request->name,
				]);
		}
		if($request->active=='1'){		
				$user->update([        
					'active' => $request->active,
				]);
		}				
		UserDescription::where('user_id', '=', $user->id)
			->update([
            'country_code' => $countriesByIP->code,
            'city_id' => $citiesByIP->id,			
			'username' => $request->username,
			'nickname' => explode(' ', trim(ucfirst($request->name)))[0],
            'phone_code' => $countriesByIP->phone,			
            'phone' => $request->number,			
			]
		);
		CompanyOfficer::where('user_id', '=', $user->id)
			->update([
			'vacancy_access' => $request->vacancy_access,
			'vacancy_posting' => $request->vacancy_posting,
			'talent_search' => $request->talent_search,
			'user_management' => $request->staff_management,
			'credit_management' => $request->credit_management,
			'receive_candidate_email' => $request->receive_candidate_email,
            'add_articles' => $request->add_article,			
			]
		);		
		return redirect()->back()->with('message', $notif);			
    }


    public function editCancel($id)
    {
        $staffs = User::find($id);                
        return view('company.account.officer.staff.cancel')->with(compact('staffs'));   
    }

    public function updateCancel(Request $request, $id)
    {
        //
        //Validate data
        Validator::make($request->all(), [
                    'active'=> 'required',         
            'description'=> 'required|string|min:10|max:500',
        ])->validate();
        $user = Auth::User();
        $userId = $user->id;
        $userName = $user->name;		
  
        $user = User::find($id);
		$active=$request->active;
        $user->update([
            'active' => $request->active,		
        ]);
		CompanyOfficer::where('user_id', '=', $user->id)
			->update([
				'active' => $request->active,			
				'cancel_reason' => $request->description,
				'cancel_user' => $userName,
			]
		);
		if($active=='0')
		{
			return redirect()->back()->with('message', trans('global.Staff was successfully disabled.'));
		}
		else
		{
			return redirect()->back()->with('message', trans('global.The staff was successfully reactivated.'));
		}
    }
    public function destroy($id)
    {
    	
		if(Route::is('account.staff.delete')){
			$processBox=CompanyOfficer::find($id)->delete();
			if(!empty($processBox)) {
				//return redirect(route('article.active'))->with('success', trans('global.Data successfully deleted.'));
				return redirect()->back()->with('message', trans('global.Data successfully deleted.'));			
			}
			else{
				return redirect()->back()->with(['warning' => trans('global.Data failed to delete')]);
			}			
		}
		if(Route::is('account.staff.destroy')){
			$processBox=CompanyOfficer::withTrashed()->whereId($id)->forceDelete();
			if(!empty($processBox)) {
				return redirect(route('account.staff.trash'))->with('success', trans('global.Data successfully deleted.'));
			}
			else{
				return redirect()->back()->with(['warning' => trans('global.Data failed to delete')]);
			}			
		}		
		
    }
	
    public function restore($id)
    {
    	$processBox=CompanyOfficer::withTrashed()->whereId($id)->restore();
		if(!empty($processBox)) {
			return redirect(route('account.staff.trash'))->with('success', trans('global.Data returned successfully.'));
		}
		else{
			return redirect()->back()->with(['warning' => trans('global.Data failed to return')]);
		}
			
    }
}
