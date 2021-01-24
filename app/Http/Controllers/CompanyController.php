<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Vacancy;
use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Crypt;
use Auth;
use Hashids\Hashids;
class CompanyController extends Controller
{

    public function index(Request $request){
		$crypto = new Hashids();		
        $keyword=$request->keyword;		
		$removeWords=["{", "}", '"'];		
		$companies=Company::SCompany()->where('companies.name', 'ILIKE', '%'.trim($keyword).'%')->paginate(5);
		return view('employer.index', compact('companies','removeWords','crypto'));		
    }

    public function show($id,$slug)
    {
		$crypto = new Hashids();		
		$removeWords=["{", "}", '"'];		
		$companies=Company::SCompanyDetail()->where('companies.id',$crypto->decodeHex($id))->first();
		$vacancies=Vacancy::SVacContentSkid()->where('vacancies.company_id',$crypto->decodeHex($id))->SActive()->inRandomOrder()->paginate(5);		
		if(Auth::check()){
			$applications=Application::whereActive('1')->where('user_id',auth()->user()->id)->get();				
			return view('employer.detail', compact('companies','removeWords','vacancies','applications','crypto'));
		 }
		else{
			return view('employer.detail', compact('companies','removeWords','vacancies','crypto'));			
		}		 
    }
	
	
}
