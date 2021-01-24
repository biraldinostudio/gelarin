<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Models\VerifyUser;
use App\Models\Country;
use App\Models\City;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered; //"Class 'App\Http\Controllers\Company\Auth\Registered' not found"
use App\Models\UserDescription;
use Illuminate\Http\Request;
use App\Jobs\VerificationEmailMember;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //'countries_phone1' => 'required',		
            'name' => 'required|string|min:3|max:35',
            //'nickname' => 'required|string|min:3|max:12',			
            'email' => 'required|string|email|max:53|unique:users',			
            //'telpcode' => 'required|string|min:1|max:5',			
            //'areacode' => 'required|string|min:1|max:5',			
			'number' => 'required|string|min:3|max:11',			
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',          
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Model\User
     */
     
    public function showRegisterForm(){
		//$countries = Country::select('active','name','code','id')->where('active','1')->get();
		//$getIP=geoip()->getClientIP();
		//$visitorIPs=geoip()->getLocation($getIP = null);
		$countriesByIP=Country::select('code','phone','date_format')->where('code','=','ID')->first();		
		if(empty($countriesByIP->phone)){
			return"Aplikasi belum bisa diakses";
		}
		else{
			return view('auth.register')->with(compact('countriesByIP'));
		}		
    }    
    protected function create(array $data)
    {  
		//$getIP=geoip()->getClientIP();
		//$visitorIPs=geoip()->getLocation($getIP = null);
		$countriesByIP=Country::select('code','phone','date_format')->where('code','=','ID')->first();
		$citiesByIP=City::select('id')->where('id','=','1642911')->first();	
        $user = User::create([
            'name' => ucwords($data['name']),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => 'Member',
            'active' => '1',            
        ]);
		$separate=explode(" ",ucfirst($data['name']));		
        $userDescription= UserDescription::create([
            'user_id' => $user->id,
            'country_code' => $countriesByIP->code,
			'city_id'=>$citiesByIP->id,
			'nickname'=>explode(' ', trim(ucfirst($data['name'])))[0],
            'phone_code' => $countriesByIP->phone,			
            'phone' => $data['number'],			
        ]);
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40),
        ]);
		//dispatch(new VerificationEmailMember($user));
		
	        VerificationEmailMember::dispatch($user);
                //->delay(now()->addMinutes(1));	
		return $user;
    }
	
    /*public function register(Request $request,$user)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));

       

        $this->guard()->logout();
        return redirect(route('login'))->with('status', trans('mail.We sent you an activation code. Check your email and click on the link to verify.'));
    }	*/
	
	public function registered(Request $request,$user){	
		$this->guard()->logout();
        return redirect(route('login'))->with('status', trans('mail.We sent you an activation code. Check your email and click on the link to verify.'));
	}
    /*protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        return redirect(route('login'))->with('status', trans('mail.We sent you an activation code. Check your email and click on the link to verify.'));
    }*/
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
            return redirect(route('login'))->with('warning', trans('mail.Sorry your email cannot be identified.'));
        }
        return redirect(route('login'))->with('status', $status);
    }   
}
