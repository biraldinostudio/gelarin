<?php

namespace App\Http\Controllers\Company\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Password; //Tambah kayetanus
use Auth; //Tambah kayetanus
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/company/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:companypage');
    }
	
    public function showResetForm(Request $request, $token = null) {
        return view('company.auth.passwords.reset')
            ->with(['token' => $token, 'email' => $request->email]
            );
    }
    protected function guard()
    {
        return Auth::guard('companypage');
    }
 
    //defining our password broker function
    protected function broker() {
        return Password::broker('companypage');
    }	
}
