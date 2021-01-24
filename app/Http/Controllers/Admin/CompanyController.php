<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // untuk slug atau tags
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;
use Storage;
use File;
use App\Models\User;
use App\Models\UserDescription;
use App\Models\Company;
use App\Models\CompanyOfficer;
use App\Models\CompanyAddress;
use App\Models\Category;
use App\Models\SubAdmin1;
use App\Models\City;
class CompanyController extends Controller
{
    public function __construct(){
        $this->middleware('auth:adminMiddle');
    }
    public function index()
    {
		//$companies=Company::whereActive('1')->with('companyofficer')->paginate(5);
		$companies=Company::SAdmCompanyList()->paginate(5);
		return view('admin.company.index')->with(compact('companies'));
    }


    public function create()
    {
 		$industries=Category::SCatIndustry()->get();
		$sub_admin1s=SubAdmin1::where('country_code','=','ID')->orderBy('name','asc')->get();
		$cite=City::select('subadmin1_code','name','country_code','id')->where('country_code','=','ID')->where('active',1)->get(); 					
		return view('admin.company.create')->with(compact('industries','sub_admin1s','cite'));
    }


    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'code' => 'required|string|min:2|max:5',		
            'name' => 'required|string|min:5|max:35',
            'email' => 'required|string|email|max:53|unique:users',
			'phone' => 'required|string|min:3|max:11',
            'logo'=>'required',			
            'industry'=>'required',
            'description'=> 'required|string|min:10|max:5000',
            'subadmin1'=>'required',			
            'cit'=>'required',
            'address'=>'required|min:10|max:50',
            'officer' => 'required|string|min:5|max:35',	
        ])->validate();
		
		if($request->hasFile('logo')) {
			$storage="public/uploads/company/logo/";
			$public_path="storage/uploads/company/logo/";

			// dapatkan nama file dengan ekstensi
			$filenamewithextension = $request->file('logo')->getClientOriginalName();

			// dapatkan nama file tanpa ekstensi
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

			// dapatkan ekstensi file
			$extension = $request->file('logo')->getClientOriginalExtension();

			// nama file untuk disimpan
			$filenametostore = substr(md5($request->name),6,6).'_'.substr(md5($filename),6,6).'_'.time().'.'.$extension;			

			//Unggah file
			$request->file('logo')->storeAs($storage, $filenametostore);

			// Ubah ukuran gambar di sini
			$thumbnailpath = public_path($public_path.$filenametostore);
			$img = Image::make($thumbnailpath)->resize(600, 600, function($constraint) {
				$constraint->aspectRatio();
			});
			$img->save($thumbnailpath);		
		}
		if($request->hasFile('logo')) {
			$cekFileName=$filenametostore;
		}
		else{			   
			$cekFileName='';
		}
		$user = User::create([
            'name' =>$request->officer,
            'email' => $request->email,
            'password' => Hash::make('123456'),
            'type' => 'Company',
			'active' => '1',			
        ]);
		$userDescription= UserDescription::create([
            'user_id' => $user->id,
            'country_code' => 'ID',
			'city_id'=>$request->cit,
			'nickname'=>explode(' ', trim(ucfirst($request->name)))[0],			
        ]);
		$getCompanyNames=explode(" ",$request->name);
		$code="";
		foreach($getCompanyNames as $w){
			$code .= $w[0];
		}			
		$company=Company::create([
            'code' => $code,		
            'name' => $request->name,
            'description' => $request->description,			
			'slug' => Str::slug($request->name),
			'email1'=>$request->email,
			'phone1'=>$request->phone,
			'phone_code'=>'62',
			'logo' => $cekFileName,			
			'partner' => '1',		
            'active' => '1',
            'hide_email' => '1',
            'hide_phone' => '1',
            'hide_address' => '0',			
        ]);
		$companyOfficer=CompanyOfficer::create([
            'user_id' => $user->id,
            'company_id' => $company->id,
            'type' => 'Creator',
            'position' => $request->position,			
            'vacancy_access' => '1',
            'vacancy_posting' => '1',
            'talent_search' => '1',
            'user_management' => '1',
            'credit_management' => '1',
            'receive_candidate_email' => '1',
			'add_articles'=>'1',
        ]);
		$industries=$request->industry;
		$company->category()->sync($industries);
		
		$process = CompanyAddress::create([
            'company_id'=>$company->id,
            'city_id' => $request->cit,
            'address' => $request->address,
            'active' =>'1', 					
		]);		
		if(!$process){
			return back()->with('error', 'Data gagal disimpan');				
		}
		else{
			return back()->with('success', 'Data berhasil disimpan');	
		}		
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
