<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
class AdminLoginController extends Controller
{
    use AuthenticatesUsers;
    protected $guard = 'adminMiddle';
    protected $redirectTo = '/home';
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

     public function guard()
    {
        return auth()->guard('adminMiddle');
    }   
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    public function login(Request $request)
    {
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);		
        if (auth()->guard('adminMiddle')->attempt(['email' => $request->email, 'password' => $request->password,'active'=>'1','verified'=>'1' ])) {
            return redirect()->route('admin.home');
        }
        return back()->withErrors(['email' => 'Email atau Kata Sandi Salah!']);
    }
}