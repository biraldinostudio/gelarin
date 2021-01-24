<?php

namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
Use Auth;
//Use Route;
class CompanyLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/company/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       //$this->middleware('guest:companypage')->except('logout');
        $this->middleware('guest:companypage');
    }
	
	public function showCompanyLoginForm(){
		return view('company.auth.login');
	}
	    public function login(Request $request)
    {
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);

      if (Auth::guard('companypage')->attempt(['email' => $request->email, 'password' => $request->password,'type'=>'Company','active'=>'1','verified'=>'1'], $request->remember)) {
        return redirect()->intended(route('company.dashboard'));
      }
  return redirect()->back();
    }
	   public function authenticated(Request $request, $user)
    {
        if (!$user->verified) {
            auth()->logout();
            return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }
        return redirect()->intended($this->redirectPath());
    }

/*public function logout(Request $request) {
Auth::guard('companypage')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route( 'company.login' ));
} */

    /*public function logout(Request $request)
    {
        Auth::guard('companypage')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route( 'company.login' ));
    }*/

}
