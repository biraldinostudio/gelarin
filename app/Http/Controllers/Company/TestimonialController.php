<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\Testimonial;
class TestimonialController extends Controller
{
    public function __construct(){
        $this->middleware('auth:companypage');
    }	
    public function store(Request $request)
    {		
		$validator = Validator::make($request->all(), [
			'testimonial' => 'required|min:50|max:300',			
			'value' => 'required|min:1|max:1',
		])->validate();		
		$process = Testimonial::create([			
			'user_id'=>auth()->user()->id,
			'comment'=>$request->testimonial,				
			'value' =>$request->value,
			'active' =>'1'		
		]);			
		if(!empty($process)){	
			return redirect(route('company.testimonial'))->with('success', trans('message.Data saved successfully'));			
		}
		else{
			return redirect(route('company.testimonial'))->with('error', trans('message.Data failed to save'));	
		}
	}
	
    public function edit(Request $request)
    {
		$testimonials=Testimonial::where('user_id',auth()->user()->id)->first();
		return view('company.testimonial.edit')->with(compact('testimonials'));
    }
	
    public function update(Request $request)
    {
		$validator = Validator::make($request->all(), [
			'testimonial' => 'required|min:50|max:300',			
			'value' => 'required|min:1|max:1',
		])->validate();			
		$process = Testimonial::where('user_id',auth()->user()->id)->first();
		$process->update([
			'comment'=>$request->testimonial,				
			'value' =>$request->value,	
		]);
		if(!empty($process)){	
			return redirect(route('company.testimonial'))->with('success', trans('message.Data saved successfully'));			
		}
		else{
			return redirect(route('company.testimonial'))->with('error', trans('message.Data failed to save'));	
		}		
    }	
}
