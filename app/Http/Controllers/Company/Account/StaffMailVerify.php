<?php

namespace App\Http\Controllers\Company\Account;

use Illuminate\Http\Request;
//use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use App\Models\VerifyUser;
use Illuminate\Support\Facades\Hash;
use HelpBahasaPlanet;
//use Auth;
use App\Models\User;
//use Illuminate\Foundation\Auth\RegistersUsers;
class StaffMailVerify extends Controller
{
	//use RegistersUsers;
    public function __construct()
    {
        $this->middleware('guest');
    }
    /*protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        return redirect(route('company.login'))->with('status', trans('mail.We sent you an activation code. Check your email and click on the link to verify.'));
    }*/	
     public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->password =  Hash::make(HelpBahasaPlanet::encrypt_decrypt('decrypt',$user->password));                
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
