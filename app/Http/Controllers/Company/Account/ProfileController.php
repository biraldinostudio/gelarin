<?php

namespace App\Http\Controllers\Company\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\SubAdmin1;
use App\Models\Company;
use App\Models\CompanyOfficer;
use App\Models\Gender;
use Auth;
use Carbon\Carbon;
use DateTime;
use App\Models\User;
use App\Models\UserDescription;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; // untuk slug atau tags
use Illuminate\Database\Eloquent\Builder;
use Intervention\Image\Facades\Image as Image;
use Storage;
use File;
use Crypt;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth:companypage');
    }
	public function index(){
		//dd(CompanyOfficer::where('company_id',auth()->user()->companyOfficer->company_id)->select('id')->count());
		$getIP=geoip()->getClientIP();
		$visitorIPs=geoip()->getLocation($getIP = null);
		$countriesByIP=Country::select('code','phone','date_format')->where('code',$visitorIPs->iso_code)->first();			
		$phoneCodes=$countriesByIP->phone;
		$citiesByIP=City::select('id')->where('id',$visitorIPs->city_id)->first();		    
        $users=User::whereId(auth()->user()->id)->first();
        $userdescriptions=UserDescription::where('user_id',$users->id)->first();
		$removeWords   = ["{", "}", '"'];		
		$genders=Gender::SGenderMyAccount()->where('translation_of',$userdescriptions->gender_id)->first();		
		$companyOfficers=CompanyOfficer::where('user_id',auth()->user()->id)->where('company_id',auth()->user()->companyofficer->company->id)->first();		
        return view('company.account.officer.index')->with(compact(
			'genders',
			'users',
			'userdescriptions',
			'removeWords',
			'phoneCodes',
			'companyOfficers'	
		)); 		
	}	
    public function edit(Request $request)
    {	
        $countries=Country::SMyCountry()->first();
	    $provinces=SubAdmin1::SProvinceAll()->get();		
        $cities=City::SCity()->get();

        $users=User::whereId(auth()->user()->id)->first();
        $userdescriptions=UserDescription::where('user_id',$users->id)->first();
		$companyOfficers=CompanyOfficer::where('user_id',$users->id)->where('company_id',auth()->user()->companyofficer->company->id)->first();			
		$removeWords   = ["{", "}", '"'];
		$genders=Gender::SGenderAccount()->get();		
        //$genders=Gender::SGenderMyAccount()->where('translation_of',$userdescriptions->gender_id)->first();			
        return view('company.account.officer.edit')->with(compact(
			'countries',
			'provinces',
			'cities',
			'genders',
			'users',
			'userdescriptions',
			'removeWords',
			'companyOfficers'	
		)); 	              
    }    

    public function update(Request $request)//: RedirectResponse
    {
        $existing=UserDescription::where('user_id',auth()->user()->id)->first();
			if(!empty($existing->photo)){
				$photo="max:1024|mimes:jpeg,png,jpg"; 
			}
			else{
				$photo="required|max:1024|mimes:jpeg,png,jpg"; 
			}
        Validator::make($request->all(), [  
            'name' => 'required|string|min:3|max:35', 
            'nickname' => 'required|string|min:3|max:12',
            'position' => 'required|string|min:5|max:20',
            'address' => 'required|string|min:10|max:100',
            'postal_code' => 'required|string|min:3|max:5',			
            'province' => 'required',
            'cit' => 'required',
            'phone' => 'required|string|min:5|max:12',  
            'gender' => 'required',			
            'photo' => $photo,
        ])->validate();
        if($request->hasFile('photo')) {
			//Bagian upload gambar cover primary
			$storage="public/uploads/member/photo/";
			$public_path="storage/uploads/member/photo/";

			//Hapus file lama
			if(\File::exists($public_path.auth()->user()->userdescription->photo)){
				\File::delete($public_path.auth()->user()->userdescription->photo);
			}

			// dapatkan nama file dengan ekstensi
			$filenamewithextension = $request->file('photo')->getClientOriginalName();

			// dapatkan nama file tanpa ekstensi
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

			// dapatkan ekstensi file
			$extension = $request->file('photo')->getClientOriginalExtension();

			// nama file untuk disimpan
			$filenametostore = md5(auth()->user()->id).'.'.$extension;

			//Unggah file
			$request->file('photo')->storeAs($storage, $filenametostore);

			// Ubah ukuran gambar di sini
			$thumbnailpath = public_path($public_path.$filenametostore);
			$img = Image::make($thumbnailpath)->resize(200, 200, function($constraint) {
				$constraint->aspectRatio();
			});
			$img->save($thumbnailpath);
								   					
			$process=UserDescription::updateOrcreate(
				[ 
					'user_id'=>auth()->user()->id       
				],
				[     
					'photo' => $filenametostore,						
				]
			);
        }
        $users = User::find(auth()->user()->id);
        $users->update([        
            'name' => $request->name,                                                 
        ]);
       $userdescriptions=UserDescription::updateOrcreate(
            [ 
                'user_id'=>auth()->user()->id       
            ],
            [
                'gender_id' => $request->gender,
                'city_id' => $request->cit,
                'nickname' => $request->nickname,
                'phone_code' => $request->phone_code,                            
                'phone' => $request->phone,
                'address' => $request->address,
                'postal_code' => $request->postal_code,
				'closed'=>'0',
            ]
        );
		
        $companyOfficers=CompanyOfficer::updateOrcreate(
            [ 
                'user_id'=>auth()->user()->id       
            ],
            [
                'position' => $request->position,
            ]
        );		
        if(!empty($users)) {
			return redirect(route('account.index'))->with('message',trans('global.Successfully saved account data.')); 
        } else {
			return redirect()->back()->with(['message' => trans('global.Data failed to save')]);
        }       
    }
}
