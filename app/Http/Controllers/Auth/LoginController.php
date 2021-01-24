<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
class LoginController extends Controller
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
    protected $redirectTo = '/home';
    //protected $redirectTo = '/company/dashboard';	

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	
	public function showLoginForm(){
		return view('auth.login');
	}
	
	//Penanganan login halaman depan hanya member - kayetanus
	public function login(Request $request)
    {
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);

      if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password,'type'=>'Member','active'=>'1','verified'=>'1'], $request->remember)) {
        return redirect()->intended(route('home'));
      }
	  return redirect()->back();
	}
	
	public function authenticated(Request $request, $user){
		if (!$user->verified) {
			auth()->logout();
			return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
		}
			return redirect()->intended($this->redirectPath());
	}
	//Batas Penanganan login halaman depan hanya member - kayetanus
}
