<?php

namespace App\Http\Controllers\Auth\Password;
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
        $this->middleware('auth');
    }

    public function index(){
		return view('auth.passwords.change');
    }

    public function update(Request $request){
        Validator::make($request->all(), [
			'oldpassword' => 'required',			
            'newpassword' => 'required|string|min:6',
            'password_confirmation' => 'required|same:newpassword',
        ])->validate();		
		
		$user = User::find(Auth::user()->id);
		if(Hash::check(Input::get('oldpassword'),$user['password'])&& Input::get('newpassword')==Input::get('password_confirmation')){
			$user->password=Hash::make(Input::get('newpassword'));
			$user->save();
			 return redirect()->back()->with('status', trans('auth.Password successfully changed.'));
		}
		else{
			return redirect()->back()->with('warning', trans('auth.Password failed to change.'));
		}
    }
}
