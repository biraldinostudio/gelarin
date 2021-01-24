<?php

namespace App\Http\Controllers\Company\Auth;
use App\Models\User;
use App\Models\VerifyUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered; //"Class 'App\Http\Controllers\Company\Auth\Registered' not found"
use Illuminate\Http\Request;
use App\Models\UserDescription;
use App\Models\Company;
use App\Models\CompanyOfficer;
use App\Models\Country;
use App\Models\City;
//use Mail;
//use App\Mail\Company\VerifyMail;
use Auth;
use App\Jobs\VerificationEmailCompany;
use Illuminate\Support\Str; // untuk slug atau tags
class CompanyRegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/company/dashboard';


    public function __construct()
    {
        $this->middleware('guest');
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|min:3|max:35',		
			'number' => 'required|string|min:3|max:11',
            'company' => 'required|string|min:5|max:35',	
            'email' => 'required|string|email|max:53|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',			
        ]);
    }

	 
	public function showCompanyRegisterForm(){
		//$countries = Country::select('active','name','code','id')->where('active','1')->get();
		return view('company.auth.register');
	}	 
    protected function create(array $data)
    {
		//$getIP=geoip()->getClientIP();
		//$visitorIPs=geoip()->getLocation($getIP = null);

		$countriesByIP=Country::select('code','phone','date_format')->where('code','=','ID')->first();
		$citiesByIP=City::select('id')->where('id','=','1642911')->first();	
		
		//dd($countriesByIP->code);
		$user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => 'Company',
			'active' => '1',			
        ]);
		
		$getCompanyNames=explode(" ",$request->company);
		$code="";
		foreach($getCompanyNames as $w){
			$code .= $w[0];
		}		
		$company=Company::create([
            'code' => $code,		
            'name' => $data['company'],
			'slug' => Str::slug($data['company']),
			'partner' => '0',		
            'active' => '1',
            'hide_email' => '0',
            'hide_phone' => '0',
            'hide_address' => '0',			
        ]);
		$userDescription= UserDescription::create([
            /*'user_id' => $user->id,
            'nickname' => explode(' ', trim(ucfirst($data['name'])))[0],		
            'country_code' => $countriesByIP->code,
			'city_id'=>$citiesByIP->id,
            'phone_code' => $countriesByIP->phone,			
            'phone' => $data['number'],*/


            'user_id' => $user->id,
            'country_code' => $countriesByIP->code,
			'city_id'=>$citiesByIP->id,
			'nickname'=>explode(' ', trim(ucfirst($data['name'])))[0],
            'phone_code' => $countriesByIP->phone,			
            'phone' => $data['number'],			
        ]);
		$companyOfficer=CompanyOfficer::create([
            'user_id' => $user->id,
            'company_id' => $company->id,
            'type' => 'Creator',
            'vacancy_access' => '1',
            'vacancy_posting' => '1',
            'talent_search' => '1',
            'user_management' => '1',
            'credit_management' => '1',
            'receive_candidate_email' => '1',
			'add_articles'=>'1',
        ]);	
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40),
        ]);
        //Mail::to($user->email)->send(new VerifyMail($user));
		dispatch(new VerificationEmailCompany($user));
        return $user;
		return $company;
    }
	protected function registered(Request $request, $user)
	{
		$this->guard()->logout();
		return redirect(route('company.login'))->with('status', trans('mail.We sent you an activation code. Check your email and click on the link to verify.'));
	}
	public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                $status = trans('mail.Your e-mail is verified. You can now login.');
            }else{
                $status = trans('mail.Your e-mail is already verified. You can now login.');
            }
        }else{
            return redirect(route('company.login'))->with('warning', trans('mail.Sorry your email cannot be identified.'));
        }
        return redirect(route('company.login'))->with('status', $status);
    }	
}
