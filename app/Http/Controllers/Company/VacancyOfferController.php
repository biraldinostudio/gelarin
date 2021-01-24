<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\VacancyOffer;
use App\Models\User;
use App\Models\Vacancy;
class VacancyOfferController extends Controller
{
    public function __construct(){
        $this->middleware('auth:companypage');
    }

    public function store(Request $request)
    {
		$validator = Validator::make($request->all(), [
			'vacancyoffer' => 'required',
		])->validate();
		$process=User::find($request->talent);
		$vacancyoffers=$request->vacancyoffer;
		$process->vacancyToOffer()->sync($vacancyoffers);		
		if(!empty($process)){
			return back()->with('success', trans('message.Data saved successfully'));							
		}
		else{
			return back()->with('error', trans('message.Data failed to save'));	
		}
    }
}
