<?php

namespace App\Http\Controllers\Company\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Company;
use App\Models\CompanyLegal;
use App\Models\Country;
use App\Models\SubAdmin1;
use App\Models\City;
use App\Models\UserDescription;
use Illuminate\Support\Facades\Validator;
use View;
use Route;
use Carbon\Carbon;
use DateTime;
use Intervention\Image\Facades\Image as Image;
use Storage;
use File;
use Crypt;
class LegalController extends Controller
{
    public function __construct(){
        $this->middleware('auth:companypage');
    }
    public function index()
    {
		$getIP=geoip()->getClientIP();
        $visitorIPs=geoip()->getLocation($getIP = null);
        $userDetails = UserDescription::where('user_id',Auth::User()->id)->first();
        $countriesByIP=Country::select('code')->where('active',1)->where('code',$visitorIPs->iso_code)->first();		
        if(!empty($userDetails->country_code)){
            $countryID=$userDetails->country_code;			
        }
        else{
            $countryID=$countriesByIP->code;
        }
		$myCountries=Country::whereCode($countryID)->first();
		$companies=Company::where('id',auth()->user()->companyofficer->company->id)->first();
		$legals=CompanyLegal::where('company_id',$companies->id)->orderBY('active','DESC')->paginate(3);
		$countlegalTrash=CompanyLegal::onlyTrashed()->where('company_id',$companies->id)->count();		
		return view('company.settings.legal.index')->with(compact('legals','myCountries','countlegalTrash'));
    }
	
    public function trash()
    {
        //
		$getIP=geoip()->getClientIP();
        $visitorIPs=geoip()->getLocation($getIP = null);
        $userDetails = UserDescription::where('user_id',Auth::User()->id)->first();
        $countriesByIP=Country::select('code')->where('active',1)->where('code',$visitorIPs->iso_code)->first();		
        if(!empty($userDetails->country_code)){
            $countryID=$userDetails->country_code;			
        }
        else{
            $countryID=$countriesByIP->code;
        }
		$myCountries=Country::whereCode($countryID)->first();
		$companies=Company::where('id',auth()->user()->companyofficer->company->id)->first();
		$legals=CompanyLegal::onlyTrashed()->where('company_id',$companies->id)->orderBY('active','DESC')->paginate(3);
		$countlegalTrash=CompanyLegal::onlyTrashed()->where('company_id',$companies->id)->count();		
		return view('company.settings.legal.index')->with(compact('legals','myCountries','countlegalTrash'));
    }	

    public function store(Request $request)
    {
		$chars = "123456789";
        $acak = "";
        $monte=date("m");
        for($i=0; $i<6; $i++)
        $acak.=$chars[mt_rand(0,strlen($chars)-1)];
        $randData=strtolower($acak).$monte;		
		
		$expire= str_replace('/', '-', $request->expire);	       
		Validator::make($request->all(), [
            'name'=>'required|min:3|max:50',
            'number'=>'required|min:3|max:50',
            'doc'=>'required|max:50000',                                                                             
        ])->validate();

		if($request->hasFile('doc')){
			$dirStore="public/uploads/company/legal/";
			$dirRemove="public/uploads/company/legal/";

				// dapatkan nama file dengan ekstensi
				$filenamewithextension = $request->file('doc')->getClientOriginalName();

				// dapatkan nama file tanpa ekstensi
				$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

				// dapatkan ekstensi file
				$extension = $request->file('doc')->getClientOriginalExtension();
				
				// nama file untuk disimpan
				$filenametostore = auth()->user()->companyofficer->company->id.'-'.substr($randData,0,4).substr(md5(auth()->user()->companyofficer->company->id),6,6).'-'.substr($request->name,0,25).' '.auth()->user()->companyofficer->company->code.'.'.$extension;			

				//Unggah file
				$request->file('doc')->storeAs($dirStore, $filenametostore);

				$legals = CompanyLegal::create([
					'company_id'=>auth()->user()->companyofficer->company->id,
					'name' => $request->name,
					'number' => $request->number,				
					'expire' => date('Y-m-d', strtotime($expire)),
					'active' =>'1', 
					'file'=>$filenametostore,						
				]);					
			}
        if(!empty($legals)) {
			return redirect(route('settings.legal.index'))->with('success', trans('global.Data saved successfully.')); 
        } else {
			return redirect()->back()->with(['warning' => trans('global.Data failed to save')]);
        } 
    }

    public function downloadFile($id)
    {
		$existFile=CompanyLegal::find($id);
    	$myFile = "storage/uploads/company/legal/".$existFile->file;
    	$headers = ['Content-Type: application/pdf'];
    	$newName = substr($existFile->file,7);
    	return response()->download($myFile, $newName, $headers);
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
		$getIP=geoip()->getClientIP();
        $visitorIPs=geoip()->getLocation($getIP = null);
        $userDetails = UserDescription::where('user_id',Auth::User()->id)->first();
        $countriesByIP=Country::select('code')->where('active',1)->where('code',$visitorIPs->iso_code)->first();		
        if(!empty($userDetails->country_code)){
            $countryID=$userDetails->country_code;			
        }
        else{
            $countryID=$countriesByIP->code;
        }
		$myCountries=Country::whereCode($countryID)->first();
		$companies=Company::where('id',auth()->user()->companyofficer->company->id)->first();
		$legals=CompanyLegal::find($id);
		return view('company.settings.legal.edit')->with(compact('legals','myCountries'));
    }


    public function update(Request $request, $id)
    {
		$chars = "123456789";
        $acak = "";
        $monte=date("m");
        for($i=0; $i<6; $i++)
        $acak.=$chars[mt_rand(0,strlen($chars)-1)];
        $randData=strtolower($acak).$monte;			
		$existing=CompanyLegal::find($id);
		if(empty($existing->file)){
			$doc="required|max:500000"; 
		}
		else{
			$doc="nullable";
		}
		$expire= str_replace('/', '-', $request->expire);	       
		Validator::make($request->all(), [
            'name'=>'required|min:3|max:50',
            'number'=>'required|min:3|max:50',
            'doc'=>$doc,                                                                             
        ])->validate();
		
		if($request->hasFile('doc')){
			$dirStore="public/uploads/company/legal/";
			$dirRemove="storage/uploads/company/legal/";
			if(\File::exists(public_path($dirRemove.$existing->file))){
				\File::delete(public_path($dirRemove.$existing->file));
			}
			// dapatkan nama file dengan ekstensi
			$filenamewithextension = $request->file('doc')->getClientOriginalName();

			// dapatkan nama file tanpa ekstensi
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

			// dapatkan ekstensi file
			$extension = $request->file('doc')->getClientOriginalExtension();
				
			// nama file untuk disimpan
			$filenametostore = auth()->user()->companyofficer->company->id.'-'.substr($randData,0,4).substr(md5(auth()->user()->companyofficer->company->id),6,6).'-'.substr($request->name,0,25).' '.auth()->user()->companyofficer->company->code.'.'.$extension;			

			//Unggah file
			$request->file('doc')->storeAs($dirStore, $filenametostore);
			$legals = CompanyLegal::whereId($id);
			$legals->update([
				'file'=>$filenametostore,  
			]);			
		}
			$legals = CompanyLegal::whereId($id);
			$legals->update([
				'name' => $request->name,
				'number' => $request->number,				
				'expire' => date('Y-m-d', strtotime($expire)),   
			]);			
        if(!empty($legals)) {
			return redirect()->back()->with(['success' => trans('global.Data saved successfully.')]);			
        } else {
			return redirect()->back()->with(['warning' => trans('global.Data failed to save')]);
        } 		
    }

    public function destroy($id)
    {
		if(Route::is('settings.legal.delete')){
			$processBox=CompanyLegal::find($id)->delete();
			if(!empty($processBox)) {
				return redirect(route('settings.legal.index'))->with('success', trans('global.Data successfully deleted.'));
			}
			else{
				return redirect()->back()->with(['warning' => trans('global.Data failed to delete')]);
			}			
		}
		if(Route::is('settings.legal.destroy')){
			$existing=CompanyLegal::withTrashed()->whereId($id)->first();
			//dd($existing->file);
			$dirStore="public/uploads/company/legal/";
			$dirRemove="storage/uploads/company/legal/";
			if(\File::exists(public_path($dirRemove.$existing->file))){
				\File::delete(public_path($dirRemove.$existing->file));
			}
			$processBox=CompanyLegal::withTrashed()->whereId($id)->forceDelete();
			if(!empty($processBox)) {
				return redirect(route('settings.legal.trash'))->with('success', trans('global.Data successfully deleted.'));
			}
			else{
				return redirect()->back()->with(['warning' => trans('global.Data failed to delete')]);
			}
			
		}
    }
    public function restore($id)
    {
    	$processBox=CompanyLegal::withTrashed()->whereId($id)->restore();
		if(!empty($processBox)) {
			return redirect(route('settings.legal.trash'))->with('success', trans('global.Data returned successfully.'));
		}
		else{
			return redirect()->back()->with(['warning' => trans('global.Data failed to return')]);
		}	
    }	
}
