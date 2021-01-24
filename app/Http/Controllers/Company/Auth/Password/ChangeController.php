<?php

namespace App\Http\Controllers\Company\Auth\Password;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input as input;

class ChangeController extends Controller
{ 
	public function __construct(){
        $this->middleware('auth:companypage');
    }

    public function index(){
		return view('company.auth.passwords.change');
    }

    public function update(Request $request){
        Validator::make($request->all(), [
			'oldpassword' => 'required',			
            'newpassword' => 'required|string|min:6',
            'password_confirmation' => 'required|same:newpassword',
        ])->validate();		
		
		$user = User::find(Auth::user()->id);
		if(Hash::check($request->oldpassword,$user['password'])&& $request->newpassword==$request->password_confirmation){
			$user->password=Hash::make($request->newpassword);
			$user->save();
			 return redirect()->back()->with('status', trans('auth.Password successfully changed.'));
		}
		else{
			return redirect()->back()->with('warning', trans('auth.Password failed to change.'));
		}
    }
}
