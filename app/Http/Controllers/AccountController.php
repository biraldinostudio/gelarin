<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\User;
use App\Models\UserDescription;
use App\Models\Category;
use App\Models\Country;
use App\Models\SubAdmin1;
use App\Models\City;
use App\Models\Gender;
use App\Models\UserSkill;
use App\Models\UserExperience;
use App\Models\VacancyInterest;
use App\Models\Article;
use App\Models\UserEducation;
use App\Helpers\Location;
use App\Models\Education;
use Carbon\Carbon;
use DateTime;
use Intervention\Image\Facades\Image as Image;
use Storage;
use File;
use Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Redirect;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        $countryAlls=Country::SCountryAll()->select('date_format', 'currency_code', 'name', 'code')->get();		
		$myCountries=Country::SMyCountry()->select('date_format', 'currency_code', 'name', 'code')->first();
		$myCities=City::SMyCity()->select('subadmin1_code','name','country_code','id')->first();
		$cityAlls=City::SCityAll()->select('subadmin1_code','name','country_code','id')->where('active',1)->get();
		$provinceAlls=SubAdmin1::SProvinceAll()->select('name','country_code','code')->where('active',1)->get();			
        $myProvinces=SubAdmin1::SMyProvince()->select('name','country_code','code')->first();
		$skills=UserSkill::where('user_id',auth()->user()->id)->get();
		$experiences=UserExperience::where('user_id',auth()->user()->id)->orderBy('created_at','DESC')->get();
		$countries=Country::SMyCountry()->select('date_format')->first();		
		if(Route::is('account')){
			return view('account.index')->with(compact('myCountries','countryAlls','provinceAlls','myProvinces','cityAlls','myCities'));
		}
		if(Route::is('account.experience.index')){
			return view('account.experience.index')->with(compact('skills','experiences','countries'));
		}		
    }

	public function store(Request $request){
		$startWorkings= str_replace('/', '-', $request->start_year);
		$lastWorkings= str_replace('/', '-', $request->last_year);
		$startColleges= str_replace('/', '-', $request->start_year);
		$lastColleges= str_replace('/', '-', $request->last_year);		
		$countries=Country::SMyCountry()->select('date_format')->first();		
		if(Route::is('account.college.store')){			
			$validator = Validator::make($request->all(), [
				'level' => 'required',			
				'major' => 'required|min:3|max:25',
				'school' => 'required|min:1|max:30',
				'start_year' => 'required',
				//'last_year' => 'required|after:'.date('Y', strtotime($startColleges)),
				'last_year' => 'required|after:start_year',				
			])->validate();		
			$process = UserEducation::create([			
				'user_id'=>auth()->user()->id,
				'education_id'=>$request->level,				
				'major' =>$request->major,
				'school' => $request->school,
				'start_year' =>$request->start_year,
				'last_year' => $request->last_year			
			]);			
			if(!$process){
				return back()->with('error', trans('message.Data failed to change'));				
			}
			else{
				return back()->with('success', trans('message.Data successfully changed'));	
			}
		}		
		if(Route::is('account.skill.store')){		
			$validator = Validator::make($request->all(), [
					'skill' => 'required|min:3|max:40',
					'size' => 'required|min:1|max:3',
			])->validate();		
			$process = UserSkill::create([
				'user_id'=>auth()->user()->id,
				'skill' =>$request->skill,
				'value' => $request->size				
			]);			
			if(!$process){
				return back()->with('errorSkills', trans('message.Data failed to change'));				
			}
			else{
				return back()->with('successSkills', trans('message.Data successfully changed'));	
			}
		}
		if(Route::is('account.experience.store')){
			$validator = Validator::make($request->all(), [
				'position' => 'required|min:3|max:30',
				'company' => 'required|min:1|max:30',
				'start_year' => 'required|date_format:'.$countries->date_format,				
				//'last_year' => 'required|date:'.$countries->date_format.'|after:'.date('Y-m-d', strtotime($startWorkings)),
				'last_year' => 'required|date_format:'.$countries->date_format.'|after:'.date('Y-m-d', strtotime($startWorkings)),			
			])->validate();		
			$process = UserExperience::create([
				'user_id'=>auth()->user()->id,
				'job_position' =>$request->position,
				'company' => $request->company,
				'start_working' =>date('Y-m-d', strtotime($startWorkings)),
				'last_working' => date('Y-m-d', strtotime($lastWorkings)),
			]);			
			if(!$process){
				return back()->with('error', trans('message.Data failed to change'));				
			}
			else{
				return back()->with('success', trans('message.Data successfully changed'));	
			}
		}	
	}
	
	public function edit(Request $request){
		$categories = Category::SSubCategory()->get();		
		$vacancyInterests=VacancyInterest::select('category_id','user_id')->where('user_id',auth()->user()->id)->get();		
        $countryAlls=Country::select('date_format', 'currency_code', 'name','asciiname', 'code')->get();		
		$myCountries=Country::SMyCountry()->select('date_format', 'currency_code', 'name','asciiname', 'code','phone')->first();
		$provinceAlls=SubAdmin1::SProvinceAll()->select('name','country_code','code')->where('active',1)->get();			
        $myProvinces=SubAdmin1::SMyProvince()->select('name','country_code','code')->first();
		$myCities=City::SMyCity()->select('subadmin1_code','name','country_code','id')->first();
		$cityAlls=City::SCity()->select('subadmin1_code','name','country_code','id')->where('active',1)->get();
		$edu=UserEducation::where('user_id',auth()->user()->id)->first();		
		$educations=UserEducation::SUserEducation()->where('user_id',auth()->user()->id)->orderBy('user_educations.education_id','ASC')->get();		
		$genders=Gender::SGenderAccount()->get();
        $educationLevels=Education::SEducation()->whereIn('translation_of',array(3,4,5,6))->get();
		$educationBasics=UserEducation::whereIn('education_id', array(1, 2))->where('user_id',auth()->user()->id)->get();		
		if(Route::is('account.base.edit')){
			return view('account.base.edit')->with(compact('genders','myCountries'));
		}
		if(Route::is('account.aboutme.edit')){
			return view('account.aboutme.edit');
		}		
		if(Route::is('account.address.edit')){
			return view('account.address.edit')->with(compact('myCountries','countryAlls','provinceAlls','myProvinces','cityAlls','myCities'));
		}		
		if(Route::is('account.education.edit')){
			return view('account.education.edit')->with(compact('educations','edu','educationLevels'));
		}
		if(Route::is('account.job_interest.edit')){
			return view('account.job_interest.edit')->with(compact('categories','vacancyInterests'));
		}
		if(Route::is('account.socialmedia.edit')){
			return view('account.socialmedia.edit');
		}
		if(Route::is('account.photo.edit')){
			return view('account.photo.edit');
		}
		if(Route::is('account.resume.edit')){
			return view('account.resume.edit')->with(compact('myCountries'));
		}		
	}

    public function update(Request $request)
    {
		$getIP=geoip()->getClientIP();
		$visitorIPs=geoip()->getLocation($getIP = null);
		$countriesByIP=Country::select('code','date_format')->whereActive('1')->whereCode($visitorIPs->iso_code)->first();				
		$citiesByIP=City::select('id')->where('id',$visitorIPs->city_id)->first();			
		if(!empty(auth()->user()->userdescription->country_code)){
			$countryID=auth()->user()->userdescription->country_code;
			$cityID=auth()->user()->userdescription->city_id;
			$phoneCode=auth()->user()->userdescription->phone_code; 				
		}
		else{
			$countryID=$countriesByIP->code;
			$cityID=$citiesByIP->id;
			$phoneCode=$countriesByIP->phone_code;  				
		}
		$countries=Country::SMyCountry()->select('date_format')->first();		
		$date_birth= str_replace('/', '-', $request->date_birth);

		$startWorkings= str_replace('/', '-', $request->start_year);
		$lastWorkings= str_replace('/', '-', $request->last_year);			
			//$myCountries=Country::SMyCountry()->select('date_format')->first();
		$startColleges= str_replace('/', '-', $request->start_year);
		$lastColleges= str_replace('/', '-', $request->last_year);			
		if(Route::is('account.base.update')){
			$validator = Validator::make($request->all(), [
				'name' => 'required',			
				'username' => 'required|min:3|max:50',
				'nickname' => 'required|min:3|max:50',
				'gender' => 'required',
				'date_birth' => 'required',				
				'phone' => 'required|string|min:3|max:11',			
			])->validate();
			$bases = User::whereId(auth()->user()->id);
			$bases->update([        
				'name' =>$request->name			
			]);
			$process=UserDescription::updateOrcreate(
				[ 
					'user_id'=>auth()->user()->id      
				],
				[
					'gender_id'=>$request->gender,
					'username' =>$request->username,
					'nickname' => $request->nickname,
					'date_birth' => date('Y-m-d', strtotime($date_birth)),
					'phone_code' => $phoneCode,					
					'phone' => $request->phone																					                    
				]
			);
			if(!$process){
				return back()->with('error', trans('message.Data failed to change'));				
			}
			else{
				return back()->with('success', trans('message.Data successfully changed'));	
			}	
		}
		
		if(Route::is('account.aboutme.update')){
			$validator = Validator::make($request->all(), [
				'aboutme' => 'required|min:100|max:600',
				'profession' => 'required|min:10|max:55',			
			])->validate();
			$process=UserDescription::updateOrcreate(
				[ 
					'user_id'=>auth()->user()->id      
				],
				[
					'profession'=>$request->profession,
					'about'=>$request->aboutme,																				                    
				]
			);
			if(!$process){
				return back()->with('error', trans('message.Data failed to change'));				
			}
			else{
				return back()->with('success', trans('message.Data successfully changed'));	
			}	
		}		

		if(Route::is('account.address.update')){			
			if(!empty(auth()->user()->userdescription->country_code)){
				$countryID=auth()->user()->userdescription->country_code;
				$cityID=auth()->user()->userdescription->city_id;
				$phoneCode=auth()->user()->userdescription->phone_code; 				
			}
			else{
				$countryID=$countriesByIP->code;
				$cityID=$citiesByIP->id;
				$phoneCode=$countriesByIP->phone_code;  				
			}
			if($request->country==$countryID){
				$country=$countryID;
			}
			if($request->country!=$countryID){
				$country=$request->country;
			}
			
			if($request->city==$cityID){
				$city=$cityID;
			}
			if($request->city!=$cityID){
				$city=$request->city;
			}

			$validator = Validator::make($request->all(), [
				'country' => 'required',		
				'province' => 'required',
				'city' => 'required',	
				'address' => 'required|min:3|max:200',	
				'postal_code' => 'required|min:1|max:10',					
			])->validate();			
			$process=UserDescription::updateOrcreate(
				[ 
					'user_id'=>auth()->user()->id      
				],
				[
					'country_code' => $country,
					'city_id' => $city,
					'address' => $request->address, 
					'postal_code' => $request->postal_code,																						                    
				]
			); 			
			if(!$process){
				return back()->with('error', trans('message.Data failed to change'));				
			}
			else{
				return back()->with('success', trans('message.Data successfully changed'));	
			}			
		}
		
		if(Route::is('account.education.update')){
			$validator = Validator::make($request->all(), [
				'jun_sch_name' => 'required|min:3|max:50',
				'start_edujun' => 'required',
				'last_edujun' => 'required|after:'.$request->start_edujun,
				'sen_sch_name' => 'required|min:3|max:50',
				'start_edusen' => 'required',
				'last_edusen' => 'required|after:'.$request->start_edusen,					
			])->validate();			
			$process=UserDescription::updateOrcreate(
				[ 
					'user_id'=>auth()->user()->id      
				],
				[
					'jun_school_name'=>$request->jun_sch_name,
					'jun_school_start'=>$request->start_edujun,
					'jun_school_last'=>$request->last_edujun,
					'sen_school_name'=>$request->sen_sch_name,
					'sen_school_start'=>$request->start_edusen,
					'sen_school_last'=>$request->last_edusen,																					                    
				]
			); 			
			if(!$process){
				return back()->with('error', trans('message.Data failed to change'));				
			}
			else{
				return back()->with('success', trans('message.Data successfully changed'));	
			}			
		}	
		if(Route::is('account.college.update')){		
			$validator = Validator::make($request->all(), [
				'level' => 'required',			
				'major' => 'required|min:3|max:50',
				'school' => 'required|min:3|max:50',
				'start_year' => 'required',
				'last_year' => 'required|after:'.$request->start_year,					
			])->validate();
				
			$process = UserEducation::whereId($request->idx);
			$process->update([
				'education_id' =>$request->level,
				'major' =>$request->major,
				'school' => $request->school,
				'start_year' =>$request->start_year,
				'last_year' => $request->last_year			
			]);
			if(!$process){
				return back()->with('error', trans('message.Data failed to change'));				
			}
			else{
				return back()->with('success', trans('message.Data successfully changed'));	
			}			
		}
		
		if(Route::is('account.experience.update')){			
			$validator = Validator::make($request->all(), [
				'position' => 'required|min:3|max:30',
				'company' => 'required|min:1|max:30',
				//'start_year' => 'required',
				//'last_year' => 'required|date:'.$countries->date_format.'|after:'.date('Y-m-d', strtotime($startWorkings)),
				'start_year' => 'required|date_format:'.$countries->date_format,
				'last_year' => 'required|date_format:'.$countries->date_format.'|after:'.date('Y-m-d', strtotime($startWorkings)),				
			])->validate();
				
			$process = UserExperience::whereId($request->idx);
			$process->update([        
				'job_position' =>$request->position,
				'company' => $request->company,
				'start_working' =>date('Y-m-d', strtotime($startWorkings)),
				'last_working' => date('Y-m-d', strtotime($lastWorkings))	
			]);
			if(!$process){
				return back()->with('error', trans('message.Data failed to change'));				
			}
			else{
				return back()->with('success', trans('message.Data successfully changed'));	
			}			
		}		
		
		if(Route::is('account.skill.update')){
			$validator = Validator::make($request->all(), [
				'skill' => 'required|min:3|max:40',
				'size' => 'required|min:1|max:3',
			])->validate();
			$process = UserSkill::find($request->idx);
			$process->update([  
				'skill' =>$request->skill,
				'value' => $request->size
			]);
			if(!$process){
				return back()->with('errorSkills', trans('message.Data failed to change'));				
			}
			else{
				return back()->with('successSkills', trans('message.Data successfully changed'));	
			}			
		}
		
		if(Route::is('account.job_interest.update')){
			$validator = Validator::make($request->all(), [
				'job_interest' => 'required',
			])->validate();
			$process=auth()->user();
			$jobInterests=$request->job_interest;
			$process->category()->sync($jobInterests);
			if(!$process){
				return back()->with('error', trans('message.Data failed to change'));				
			}
			else{
				return back()->with('success', trans('message.Data successfully changed'));	
			}
		}
		
		if(Route::is('account.socialmedia.update')){
			//Check Facebook
			if($request->facebook==auth()->user()->userdescription->facebook){
				$facebook="min:3|max:200";
			}
			if($request->facebook!=auth()->user()->userdescription->facebook){
				$facebook="min:3|max:200";
			}		
			if($request->facebook!=""){
				$facebook="min:3|max:200";
			}
			if($request->facebook==""){
				$facebook="max:200";
			}		
			//Check Google
			if($request->google==auth()->user()->userdescription->google){
				$google="min:3|max:200";
			}
			if($request->google!=auth()->user()->userdescription->google){
				$google="min:3|max:200";
			}
			if($request->google!=""){
				$google="min:3|max:200";
			}				
			if($request->google==""){
				$google="max:200";
			}
			//Check Twitter
			if($request->twitter==auth()->user()->userdescription->twitter){
				$twitter="min:3|max:200";
			}
			if($request->twitter!=auth()->user()->userdescription->twitter){
				$twitter="min:3|max:200";
			}
			if($request->twitter!=""){
				$twitter="min:3|max:200";
			}				
			if($request->twitter==""){
				$twitter="max:200";
			}
			//Check Linkedin
			if($request->linkedin==auth()->user()->userdescription->linkedin){
				$linkedin="min:3|max:200";
			}
			if($request->linkedin!=auth()->user()->userdescription->linkedin){
				$linkedin="min:3|max:200";
			}
			if($request->linkedin!=""){
				$linkedin="min:3|max:200";
			}				
			if($request->linkedin==""){
				$linkedin="max:200";
			}
			//Check Instagram
			if($request->instagram==auth()->user()->userdescription->instagram){
				$instagram="min:3|max:200";
			}
			if($request->instagram!=auth()->user()->userdescription->instagram){
				$instagram="min:3|max:200";
			}
			if($request->instagram!=""){
				$instagram="min:3|max:200";
			}				
			if($request->instagram==""){
				$instagram="max:200";
			}
			//Check pinterest
			if($request->pinterest==auth()->user()->userdescription->pinterest){
				$pinterest="min:3|max:200";
			}
			if($request->pinterest!=auth()->user()->userdescription->pinterest){
				$pinterest="min:3|max:200";
			}
			if($request->pinterest!=""){
				$pinterest="min:3|max:200";
			}				
			if($request->pinterest==""){
				$pinterest="max:200";
			}			
			$validator = Validator::make($request->all(), [
				'facebook' =>$facebook,
				'google' =>$google,
				'twitter' =>$twitter,
				'linkedin' =>$linkedin,
				'instagram' =>$instagram,
				'pinterest' =>$pinterest,				
			])->validate();
			$process=UserDescription::updateOrcreate(
				[ 
					'user_id'=>auth()->user()->id      
				],
				[
					'facebook' => $request->facebook,
					'google' => $request->google,
					'twitter' => $request->twitter,
					'linkedin' => $request->linkedin,
					'instagram' => $request->instagram,
					'pinterest' => $request->pinterest,																				                    
				]
			);
			if(!$process){
				return back()->with('error', trans('message.Data failed to change'));				
			}
			else{
				return back()->with('success', trans('message.Data successfully changed'));	
			}	
		}

		if(Route::is('account.photo.update')){
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
			if(!$process){
				return back()->with('error', trans('message.Data failed to change'));				
			}
			else{
				return back()->with('success', trans('message.Data successfully changed'));	
			}				
		}

		if(Route::is('account.cover.update')){
			//Bagian upload gambar cover primary
			$storage="public/uploads/member/cover/";
			$public_path="storage/uploads/member/cover/";

			//Hapus file lama
			if(\File::exists($public_path.auth()->user()->userdescription->cover)){
				\File::delete($public_path.auth()->user()->userdescription->cover);
			}

			// dapatkan nama file dengan ekstensi
			$filenamewithextension = $request->file('cover')->getClientOriginalName();

			// dapatkan nama file tanpa ekstensi
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

			// dapatkan ekstensi file
			$extension = $request->file('cover')->getClientOriginalExtension();

			// nama file untuk disimpan
			$filenametostore = md5(auth()->user()->id).'.'.$extension;

			//Unggah file
			$request->file('cover')->storeAs($storage, $filenametostore);

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
					'cover' => $filenametostore,						
				]
			);			
			if(!$process){
				return back()->with('errorCover', trans('message.Data failed to change'));				
			}
			else{
				return back()->with('successCover', trans('message.Data successfully changed'));	
			}				
		}

		if(Route::is('account.resume.update')){
			$dirStore="public/uploads/member/resume/";
			$dirRemove="/storage/uploads/member/resume/";	

			$existing=UserDescription::where('user_id',auth()->user()->id)->first();

			if(empty($existing->resume)){
				$resume_check="required|max:500000"; 
			}
			else{
				$resume_check="nullable";
			}
			Validator::make($request->all(), [
				'resume' => $resume_check,			
			])->validate();
			if($request->hasFile('resume')){
				if(\File::exists(public_path($dirRemove.$existing->resume))){
					\File::delete(public_path($dirRemove.$existing->resume));
				}
				//User ID untuk selip di nama file
				$userid_file=$existing->user_id;

				// dapatkan nama file dengan ekstensi
				$filenamewithextension = $request->file('resume')->getClientOriginalName();

				// dapatkan nama file tanpa ekstensi
				$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

				// dapatkan ekstensi file
				$extension = $request->file('resume')->getClientOriginalExtension();

				$filenametostore = substr(md5(auth()->user()->id),6,6).'-'.trans('account.Curriculum Vitae').' '.auth()->user()->name.'.'.$extension;			

				//Unggah file
				$request->file('resume')->storeAs($dirStore, $filenametostore);
				
				$process=UserDescription::updateOrcreate(
						[ 
							'user_id'=>auth()->user()->id 
						],
						[
							'resume' => $filenametostore,
							'resume_at' => date("Y-m-d")                       
						]
					);
				if(!$process){
					return back()->with('error', trans('message.Data failed to change'));				
				}
				else{
					return back()->with('success', trans('message.Data successfully changed'));	
				}	
			} // End upload file	
		}
    }
	
    public function downloadResume()
    {
		$existResume=UserDescription::where('user_id',auth()->user()->id)->first();
    	$myFile = "storage/uploads/member/resume/".$existResume->resume;
    	$headers = ['Content-Type: application/pdf'];
    	$newName = substr($existResume->resume,7);
    	return response()->download($myFile, $newName, $headers);
    }
}
