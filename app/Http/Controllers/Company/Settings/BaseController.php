<?php

namespace App\Http\Controllers\Company\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Crypt;
use App\Models\Company;
use App\Models\Category;
use App\Models\WorkingTime;
use App\Models\WorkingUniform;
use App\Models\Country;
use App\Models\CompanyAddress;//Untuk cek alamat perusahaan sebelum pasang lowongan kerja
use App\Models\CompanyLegal;//Untuk cek legalitas perusahaan sebelum pasang lowongan kerja
use Illuminate\Support\Str; // untuk slug atau tags
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image as Image;
use Storage;
use File;
use Hashids\Hashids;
class BaseController extends Controller
{
    public function __construct(){
        $this->middleware('auth:companypage');
    }

    public function index()
    {
		$crypto = new Hashids();
		$getIP=geoip()->getClientIP();
		$visitorIPs=geoip()->getLocation($getIP = null);
		$countriesByIP=Country::select('code','phone','date_format')->where('code','=',$visitorIPs->iso_code)->first();			
		$phoneCodes=$countriesByIP->phone;
		$companies=Company::where('id',auth()->user()->companyofficer->company->id)->first();		
		$categories=Category::SCatIndustry()->get();
		$workingTimes=WorkingTime::SWorkingTime()->get();
		$workingUniforms=WorkingUniform::SWorkingUniform()->get();
		$companyUniforms=WorkingUniform::SWorkingUniform()->where('translation_of',$companies->working_uniform_id)->first();
		$companyTimes=WorkingTime::SWorkingTime()->where('translation_of',$companies->working_time_id)->first();
		$industries=Company::SCompanyIndustry()->where('companies.id',auth()->user()->companyofficer->company->id)->first();	
		$removeWords   = ["{", "}", '"'];
		
		//untuk cek identitas perusahaan sebelum posting lowongan
		$companyAddresses=CompanyAddress::where('company_id',auth()->user()->companyofficer->company->id)->whereActive('1')->first();
		$companyLegals=CompanyLegal::where('company_id',auth()->user()->companyofficer->company->id)->whereActive('1')->first();			
		return view('company.settings.index')->with(compact('phoneCodes','companies','categories','workingTimes','workingUniforms','companyUniforms','companyTimes','industries','removeWords','crypto','companyAddresses','companyLegals'));
    }
	
	public function edit(Request $request, $id){
		$crypto = new Hashids();
		$getIP=geoip()->getClientIP();
		$visitorIPs=geoip()->getLocation($getIP = null);
		$countriesByIP=Country::select('code','phone','date_format')->where('code',$visitorIPs->iso_code)->first();			
		$phoneCodes=$countriesByIP->phone;
		$companies=Company::find($crypto->decodeHex($id));		
		$categories=Category::SCatIndustry()->get();
		$workingTimes=WorkingTime::SWorkingTime()->get();
		$workingUniforms=WorkingUniform::SWorkingUniform()->get();
		$companyUniforms=WorkingUniform::SWorkingUniform()->where('translation_of',$companies->working_uniform_id)->first();
		$companyTimes=WorkingTime::SWorkingTime()->where('translation_of',$companies->working_time_id)->first();
		$industries=Company::SCompanyIndustry()->where('companies.id',auth()->user()->companyofficer->company->id)->first();	
		$removeWords   = ["{", "}", '"'];		
		return view('company.settings.edit')->with(compact('phoneCodes','companies','categories','workingTimes','workingUniforms','companyUniforms','companyTimes','industries','removeWords','crypto'));		
	}

    public function update(Request $request, $id){
		//dd($crypto->decodeHex($id));
//		dd($id);
		$crypto = new Hashids();
		
		$companies=Company::find($id);		
		if(empty($companies->email1)){
			$email1="required|string|email|max:53|unique:companies";
		}
		if(!empty($companies->email1)){
			$email1="max:53";
		}	
		if(empty($request->hide_email)){
			$hideEmail="0";
		}
		else{
			$hideEmail=$request->hide_email;
		}
		
		if(empty($request->hide_phone)){
			$hidePhone="0";
		}
		else{
			$hidePhone=$request->hide_phone;
		}

		if(empty($request->hide_address)){
			$hideAddress="0";
		}
		else{
			$hideAddress=$request->hide_address;
		}		

		$getIP=geoip()->getClientIP();
		$visitorIPs=geoip()->getLocation($getIP = null);
		$countriesByIP=Country::select('code','phone','date_format')->where('code','=',$visitorIPs->iso_code)->first();

		if(!empty($companies->phone_code)){
			$phoneCode=$companies->phone_code;
		}
		else{
			$phoneCode=$countriesByIP->phone;
		}
		Validator::make($request->all(), [
            'code' => 'required|string|min:2|max:5',		
            'name' => 'required|string|min:5|max:35',
            'description'=> 'required|string|min:10|max:5000',
            'email1' => $email1,			
			'phone1' => 'required|string|min:3|max:11',			
            'employee' => 'required',
            'industry' => 'required',
            'working' => 'required',
            'uniform' => 'required',
            'logo' => 'max:600|mimes:jpeg,png,jpg',			
        ])->validate();
		$existing=Company::find($id);
		if($request->hasFile('logo')) {
			$storage="public/uploads/company/logo/";
			$public_path="storage/uploads/company/logo/";
					
			//Hapus file lama
			if(\File::exists($public_path.$existing->logo)){
				\File::delete($public_path.$existing->logo);
			}

			// dapatkan nama file dengan ekstensi
			$filenamewithextension = $request->file('logo')->getClientOriginalName();

			// dapatkan nama file tanpa ekstensi
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

			// dapatkan ekstensi file
			$extension = $request->file('logo')->getClientOriginalExtension();

			// nama file untuk disimpan
			$filenametostore = auth()->user()->companyofficer->company->id . md5(auth()->user()->companyofficer->company->id).'.'.$extension;

			//Unggah file
			$request->file('logo')->storeAs($storage, $filenametostore);

			// Ubah ukuran gambar di sini
			$thumbnailpath = public_path($public_path.$filenametostore);
			$img = Image::make($thumbnailpath)->resize(600, 600, function($constraint) {
				$constraint->aspectRatio();
			});
			$img->save($thumbnailpath);				
		}
					
		if(empty($request->hasFile('logo'))){
			$cFile=$existing->logo;
		}
		else{
			$cFile=$filenametostore;
		}					
		$companies=Company::updateOrcreate(
			[ 
				'id'=>$id  
			],
			[
				'working_time_id'=>$request->working,
				'working_uniform_id'=>$request->uniform,
				'code' => strtoupper($request->code),							
				'name' => ucfirst($request->name),
				'description'=>$request->description,
				'slug' => Str::slug(ucfirst($request->name)),
				'email1' => $request->email1,
				'email2' => $request->email2,
				'phone1' => $request->phone1,
				'phone2' => $request->phone2,
				'fax1' => $request->fax1,
				'fax2' => $request->fax2,							
				'size'=>$request->employee,
				'phone_code' => $phoneCode,
				'logo'=>$cFile,							
				'hide_email'=>$hideEmail,
				'hide_phone'=>$hidePhone,
				'hide_address'=>$hideAddress,
			]
		);
        $companies=Company::find($id);
		$industries=$request->industry;
		$companies->category()->sync($industries);
		return redirect()->route('settings.index')->with('message', trans('global.Save data successfully'));			
    }
}
