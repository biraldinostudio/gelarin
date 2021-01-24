<?php

namespace App\Http\Controllers\Company\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Company;
use App\Models\CompanyAddress;
use App\Models\Country;
use App\Models\SubAdmin1;
use App\Models\City;
use App\Models\UserDescription;
use Illuminate\Support\Facades\Validator;
use View;
use Route;
class AddressController extends Controller
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
		$cite=City::select('subadmin1_code','name','country_code','id')->where('country_code',$countryID)->where('active',1)->get(); 
        //$warehouseAddresses=WarehouseAddress::SAddress()->SCountryID($countryID)->where('d.user_id',auth()->user()->id)->paginate(4);
        $provinces=SubAdmin1::where('country_code',$countryID)->get(); 
		
		$companies=Company::where('id',auth()->user()->companyofficer->company->id)->first();
		//dd($companies->id);
		$addresses=CompanyAddress::where('company_id',$companies->id)->orderBY('active','DESC')->paginate(3);
		$countAddressTrash=CompanyAddress::onlyTrashed()->where('company_id',$companies->id)->count();		
		return view('company.settings.address.index')->with(compact('provinces','cite','addresses','countAddressTrash'));
    }
	
    public function trash()
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
		$cite=City::select('subadmin1_code','name','country_code','id')->where('country_code',$countryID)->where('active',1)->get(); 
        //$warehouseAddresses=WarehouseAddress::SAddress()->SCountryID($countryID)->where('d.user_id',auth()->user()->id)->paginate(4);
        $provinces=SubAdmin1::where('country_code',$countryID)->get(); 
		
		$companies=Company::where('id',auth()->user()->companyofficer->company->id)->first();
		//dd($companies->id);
		$addresses=CompanyAddress::onlyTrashed()->where('company_id',$companies->id)->orderBY('active','DESC')->paginate(3);
		$countAddressTrash=CompanyAddress::onlyTrashed()->where('company_id',$companies->id)->count();	
		return view('company.settings.address.index')->with(compact('provinces','cite','addresses','countAddressTrash'));
    }

    public function store(Request $request)
    {
		$getCompanyAddress=CompanyAddress::where('company_id',auth()->user()->companyofficer->company->id)->count();
		if($getCompanyAddress>0){
		   $active='0';
		}
		else{
		   $active='1';
		}
		Validator::make($request->all(), [
            'address'=>'required|min:10|max:50',
            'province'=>'required',        
            'city'=>'required',
            'postal_code'=>'required|min:3|max:10',                                                                             
        ])->validate();
		$addresses = CompanyAddress::create([
                'company_id'=>auth()->user()->companyofficer->company->id,
                'city_id' => $request->city,
                'address' => $request->address,				
                'postal_code' => $request->postal_code,
                'active' =>$active, 					
		]);
        if(!empty($addresses)) {
			return redirect(route('settings.address.index'))->with('success', trans('global.Data saved successfully.')); 
        } else {
			return redirect()->back()->with(['warning' => trans('global.Data failed to save')]);
        }   		
    }


    public function edit($id)
    {
        $addresses = CompanyAddress::find($id);
		$provinces=SubAdmin1::SProvinceAll()->get();		
        $countries=Country::SMyCountry()->where('code',Auth::User()->UserDescription->country_code)->first();
        $cite=City::SCity()->get();		
		return view('company.settings.address.edit',compact('addresses','cite','provinces'));
    }


    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'address'=>'required|min:10|max:50',
            'province'=>'required',        
            'cit'=>'required',
            'postal_code'=>'required|min:3|max:10',                                                                             
        ])->validate();   
        $companyAddresses = CompanyAddress::whereId($id);
        $companyAddresses->update([        
            'city_id' => $request->cit,
            'address' => $request->address,				
            'postal_code' => $request->postal_code,
			
        ]);
		if(!empty($companyAddresses)) {
			return redirect()->back()->with('success', trans('global.Data saved successfully.'));
		} else {
			return redirect()->back()->with(['warning' => trans('global.Data failed to save')]);
		}		
    }
	
    public function updateActive(Request $request,$id){
		CompanyAddress::where('id','<>',$request->id)->update([
			'active' => '0',
		]);		
		$addresses=CompanyAddress::where('id',$request->id)->update([
			'active' => '1',
		]);
		if(!empty($addresses)) {
			return redirect(route('settings.address.index'))->with('success', trans('global.Data saved successfully.')); 
		} else {
			return redirect()->back()->with(['warning' => trans('global.Data failed to save')]);
		}			                         
    }	


    public function destroy($id)
    {
    	
		if(Route::is('settings.address.delete')){
			CompanyAddress::find($id)->delete();
			if(!empty($processBox)) {
				return redirect(route('settings.address.index'))->with('success', trans('global.Data successfully deleted.'));
			}
			else{
				return redirect()->back()->with(['warning' => trans('global.Data failed to delete')]);
			}			
		}
		if(Route::is('settings.address.destroy')){
			$processBox=CompanyAddress::withTrashed()->whereId($id)->forceDelete();
			if(!empty($processBox)) {
				return redirect(route('settings.address.trash'))->with('success', trans('global.Data successfully deleted.'));
			}
			else{
				return redirect()->back()->with(['warning' => trans('global.Data failed to delete')]);
			}			
		}		
		
    }
	
    public function restore($id)
    {
    	$processBox=CompanyAddress::withTrashed()->whereId($id)->restore();
		if(!empty($processBox)) {
			return redirect(route('settings.address.trash'))->with('success', trans('global.Data returned successfully.'));
		}
		else{
			return redirect()->back()->with(['warning' => trans('global.Data failed to return')]);
		}
			
    }	
}
