<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\User;
use App\Models\Application;
use App\Models\Vacancy;
use App\Models\Ad;
use App\Models\UserDescription;
use App\Models\Company;
use App\Models\CompanyOfficer;
use App\Models\SubAdmin1;
use App\Models\Gender;
use App\Models\SalaryType;
use App\Models\WorkingType;
use App\Models\WorkingLevel;
use App\Models\ReasonCancelVacancy;
use App\Models\ApplicationMessage;
use App\Models\VacancySave;
use HelpRandom;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image as Image;
use Mail;
use File;
use Storage;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Route;
use Hashids\Hashids;
use DB;
use App\Jobs\JobApplication;

class ManageApplicationController extends Controller
{
 	public function __construct(){
        $this->middleware('auth');
    }
	public function countUnprocessed(){
		return Application::SApplication()
				->Where('applications.application_status','=','Unprocessed')
				->Where('applications.active','=',1)
				->get();
	}
	public function countShortlist(){
		return Application::SApplication()
				->Where('applications.application_status','=','Shortlist')
				->Where('applications.active','=',1)
				->get();
	}
	public function countInterview(){
		return Application::SApplication()
				->Where('applications.application_status','=','Interview')
				->Where('applications.active','=',1)
				->get();
	}
	public function countNot(){
		return Application::SApplication()
				->Where('applications.application_status','=','Not Suitable')
				->Where('applications.active','=',1)
				->get();
	}
	public function countPass(){
		return Application::SApplication()
				->Where('applications.application_status','=','Pass')
				->Where('applications.active','=',1)
				->get();
	}
	public function countCancel(){
		return Application::SApplication()
				->Where('applications.application_status','=','Cancel')
				->Where('applications.active','=',1)
				->get();
	}	
	
    public function index(Request $request)
    {
		$keyword=$request->input('keyword');
		$status=1;

		if(Route::is('application.list.unprocessed')){		
			$applications=Application::SApplication($keyword)
				->where(function($q) use($status){
					$q->Where('applications.application_status','=','Unprocessed')
					  ->Where('applications.active','=',$status);
				})			
				->paginate(6);
			$titlePages=trans('global.Unprocessed');
			$routeFormSearchs="application.list.unprocessed";
			/*foreach($applications as $application){
				$messages=ApplicationMessage::whereActive('1')->where('application_id',$application->id)->get();
			}*/				
		}
		if(Route::is('application.list.shortlist')){		
			$applications=Application::SApplication($keyword)
				->where(function($q) use($status){
					$q->Where('applications.application_status','=','Shortlist')
					  ->Where('applications.active','=',$status);
				})			
				->paginate(6);
			$titlePages=trans('global.Shortlist');
			$routeFormSearchs="application.list.shortlist";			
		}
		if(Route::is('application.list.interview')){		
			$applications=Application::SApplication($keyword)
				->where(function($q) use($status){
					$q->Where('applications.application_status','=','Interview')
					  ->Where('applications.active','=',$status);
				})			
				->paginate(6);
			$titlePages=trans('global.Interview');
			$routeFormSearchs="application.list.interview";			
		}
		if(Route::is('application.list.not')){		
			$applications=Application::SApplication($keyword)
				->where(function($q) use($status){
					$q->Where('applications.application_status','=','Not Suitable')
					  ->Where('applications.active','=',$status);
				})			
				->paginate(6);
			$titlePages=trans('global.Not Suitable');
			$routeFormSearchs="application.list.not";			
		}
		if(Route::is('application.list.pass')){		
			$applications=Application::SApplication($keyword)
				->where(function($q) use($status){
					$q->Where('applications.application_status','=','Pass')
					  ->Where('applications.active','=',$status);
				})			
				->paginate(6);
			$titlePages=trans('global.Pass');
			$routeFormSearchs="application.list.pass";			
		}
		if(Route::is('application.list.cancel')){
			$status=0;			
			$applications=Application::SApplication($keyword)
				->where(function($q) use($status){
					$q->orWhere('applications.active','=',$status);
				})			
				->paginate(6);
			$titlePages=trans('global.Cancel');
			$routeFormSearchs="application.list.cancel";			
		}	
		$countUnprocesseds=$this->countUnprocessed();
		$countShortlists=$this->countShortlist();
		$countInterviews=$this->countInterview();
		$countNots=$this->countNot();
		$countPasss=$this->countPass();
		$countCancels=$this->countCancel();	
		$premiumVacancies=Vacancy::SVacContentSkid()->SActive()->inRandomOrder()->get();
		$countVacanciesAlls=Vacancy::get();
		$countApplications=Application::where('user_id',auth()->user()->id)->get();
		$adse=Ad::whereActive('1')
			->where('end_date','>',date("Y-m-d")) 
		    ->orderBy('id', 'desc');
		if ($adse->count()==1) {
			$ads = $adse->get()->random(1);
		}
		elseif ($adse->count()>1) {
			$ads = $adse->get()->random(2);
		} 		
		else {
			$ads = $adse->get();
		}
		$premiumVacancies=Vacancy::SVacContentSkid()->where('vacancies.partner','=','1')->inRandomOrder()->paginate(5);
		$countPremVacancies=Vacancy::SVacContentSkid()->where('vacancies.partner','=','1')->count();		
		return view('application.index')->with(compact(
			'applications',
			'countUnprocesseds',
			'countShortlists',
			'countInterviews',
			'countNots',
			'countPasss',
			'countCancels',
			'premiumVacancies',
			'titlePages',
			'routeFormSearchs',
			'countVacanciesAlls',
			'countApplications',
			'ads',
			'premiumVacancies',
			'countPremVacancies'//,
			//'messages'
		));
    }
	
    public function apply($id,$slug,Request $request){
		//dd($id);
		if(auth()->user()->userdescription->resume=='' or auth()->user()->userdescription->photo=='' 
			or auth()->user()->userdescription->country_code=='' or auth()->user()->userdescription->city_id=='' 
			or auth()->user()->userdescription->address==''	or auth()->user()->userdescription->postal_code=='' 
			or auth()->user()->userdescription->gender_id=='' or auth()->user()->userdescription->phone=='' 
			or auth()->user()->userdescription->date_birth=='' or auth()->user()->userdescription->jun_school_name=='' 
			//or auth()->user()->userskill=='' or auth()->user()->jobinterest==''
			){
			return redirect(route('account'))->with('blocks', trans('application.Before submitting a job application, you must first complete the following data:'));
		}
		else{
		$crypto = new Hashids();		
		$vacancies = Vacancy::where('id',$id)->with('city')->first();		
		$salarytypes=SalaryType::SSalaryType();	
		$vacancytypes=WorkingType::SWorkingTypeOnly()->get();
		$vacancylevels=WorkingLevel::SWorkingLevel();
		$genders=Gender::SGender();
		$userdesc=UserDescription::where('user_id',auth()->user()->id)->get();
		$applications=Application::where('active',1)->where('vacancy_id',$id)->where('user_id',auth()->user()->id)->get();
		return view('application.apply')->with(compact(
			'vacancies',
			'userdesc',
			'salarytypes',
			'provinces',
			'vacancytypes',
			'genders',
			'vacancylevels',
			'applications',
			'crypto'
		));
		}
	}
    public function store($id,$slug,Request $request){
		$satu='1';
		$recipientApplication = Vacancy::SCandidateEmailRecipients()->SVacancyId($id)->SAccessRecipients($satu)->get();
		$vacancies=Vacancy::find($id);	
		//Start untuk upload file jika belum ada file
        $storage="public/uploads/member/resume/";
        $public_path="public/storage/uploads/member/resume/";		
		
        //Tahun dan bulan untuk DB
        $datefile_todb=date("Y").'/'.date("m").'/';

        //Pembuatan Direktori
        $year_storage = $storage . date("Y");
        $year_publicpath = $public_path . date("Y");
        $month_storage = $year_storage . '/' . date("m").'/';
        $month_publicpath = $year_publicpath . '/' . date("m").'/';
		$existing=UserDescription::where('user_id',auth()->user()->id)->first();
        if(empty($existing->resume)){
            $resume_check="required|max:500000"; 
        }
		else{
			$resume_check="nullable";
		}
        Validator::make($request->all(), [
			'resume' => $resume_check,
           //	'description'=> 'required|string|min:10|max:1000',			
        ])->validate();
		
		if($request->hasFile('resume')){
            !file_exists($year_publicpath) && mkdir($year_publicpath , 0777,true);
            !file_exists($month_publicpath) && mkdir($month_publicpath, 0777, true);
            
            //Hapus file lama
            if(\File::exists($public_path.$existing->resume)){
                \File::delete($public_path.$existing->resume);
            } 
            //User ID untuk selip di nama file
            $userid_file=$existing->user_id;

            // dapatkan nama file dengan ekstensi
            $filenamewithextension = $request->file('resume')->getClientOriginalName();

            // dapatkan nama file tanpa ekstensi
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            // dapatkan ekstensi file
            $extension = $request->file('resume')->getClientOriginalExtension();

            // nama file untuk disimpan
           // $filenametostore = $filename.'_'.time().$userid_file.$userid_file.'.'.$extension;
            $filenametostore = auth()->user()->name.'_'.time().$userid_file.$userid_file.'.'.$extension;			

            //Unggah file
            $request->file('resume')->storeAs($month_storage, $filenametostore);
			
			
			$application = Application::create([ 
					'user_id'=>auth()->user()->id,
					'vacancy_id'=>$id,			  
					'resume' =>$datefile_todb.$filenametostore,
					'description'=>$request->description,
					'application_status'=>'Unprocessed',
					'active'=>'1'                        
				]);
			$userdescriptions=UserDescription::updateOrcreate(
					[ 
						'user_id'=>auth()->user()->id 
					],
					[
						'resume' => $datefile_todb.$filenametostore,
						'resume_at' => date("Y-m-d")                       
					]
				);
		} // End upload file
		else{
			//Menggunakan file existing	
			$application = Application::create([ 
				'user_id'=>auth()->user()->id,
				'vacancy_id'=>$id,			  
				'resume' =>$existing->resume,
				'description'=>$request->description,
				'application_status'=>'Unprocessed',
				'active'=>'1'                       
			]);			
		}
		
		//Untuk menghapus pekerjaan yang tersimpan
		$vacancySaves=VacancySave::select('vacancy_id')->where('user_id',auth()->user()->id)->where('vacancy_id',$id)->first();
		if(!empty($vacancySaves->vacancy_id)){
			$process = VacancySave::where('vacancy_id',$id)->where('user_id',auth()->user()->id)->delete();
			//$process->delete();		
		}		
		
			$existing2=UserDescription::where('user_id',auth()->user()->id)->first(); //Untuk handle belum ada resume dan sudah ada resume
			foreach($recipientApplication as $recipients){
					$data=array(
						'from'=>config('mail.from.address'),
						'name'=>auth()->user()->name,
						'userCreatorEmail'=>auth()->user()->email,        	
						'telp'=>$existing->phone,
						'email'=>$recipients->email, // untuk peneriman multiple		
						'id'=>$vacancies->id,
						'slug'=>$vacancies->slug,
						'subject'=>trans('mail.Job application') .' '.ucwords($vacancies->title) .' '. HelpRandom::generateRandomString() .' '. trans('mail.in') .' '.config('app.name'),
						'bodyMessage'=>$request->description, 
						'file'=>$public_path.$existing2->resume,				
					);
					dispatch(new JobApplication($data));		
				}
		if (Mail::failures()) {
				return redirect(route('application.apply',[$vacancies->id,$vacancies->slug]))->with('error', trans('global.Your job application failed to send!. Please try again some time.'));  
		}
		return redirect(route('application.apply',[$vacancies->id,$vacancies->slug]))->with('success', trans('application.Your cover letter with the title'));
	//return redirect()->back()->with('message', trans('global.Successfully save job vacancy data'));		
   }

    public function indexMessage($id,$slug,$name,Request $request){
		$countUnprocesseds=$this->countUnprocessed();
		$countShortlists=$this->countShortlist();
		$countInterviews=$this->countInterview();
		$countNots=$this->countNot();
		$countPasss=$this->countPass();
		$countCancels=$this->countCancel();
		$userdesc=UserDescription::where('user_id',auth()->user()->id)->get();
		$applications=Application::with('applicationmessage')->where('active',1)->where('id',$id)->where('user_id',auth()->user()->id)->first();
		$salarytypes=SalaryType::SSalaryType();
		$provinces=SubAdmin1::select('code','name')->get();
		$vacancytypes=WorkingType::SWorkingType();
		$vacancylevels=WorkingLevel::SWorkingLevel();
		$genders=Gender::SGender();
        $applMessages=ApplicationMessage::
			select(
			    'application_messages.application_id',	
				'application_messages.user_id',
				'application_messages.message',		
				'application_messages.active',
				'application_messages.created_at',
				'users.name as user',
				'user_descriptions.photo',
				'countries.date_format'
			)
		->SApplMessage($id)->paginate(4);
		$companyOfficers=CompanyOfficer::get();
		return view('application.message.index')->with(compact(
			//'vacancies',
			'userdesc',
			'salarytypes',
			'provinces',
			'vacancytypes',
			'genders',
			'vacancylevels',
			'applications',
			'applMessages',
			'companyOfficers',
			'countUnprocesseds',
			'countShortlists',
			'countInterviews',
			'countNots',
			'countPasss',
			'countCancels'			
		));    	
    }
	
    public function storeMessage(Request $request,$id)
    {
		Validator::make($request->all(), [
            'message'=> 'required|string|min:10|max:500',           
        ])->validate();     
        
        $process = ApplicationMessage::create([
                'application_id' => $id, 
                'user_id' => auth::user()->id, 
                'message' => $request->message,
                'active'=>'1',                      
        ]);         
         
		if(!$process){
			return back()->with('error', trans('message.Data failed to change'));				
		}
		else{
			return back()->with('success', trans('message.Data successfully changed'));	
		}
    }	

    public function edit($id)
    {
		$reasons=ReasonCancelVacancy::where('active',1)->where('translation_lang', app()->getLocale())->get();
        $applications = Application::find($id);                
        return view('application.cancel')->with(compact('applications','reasons')); 
    }

    public function update(Request $request, $id)
    {
      //Validate data
        Validator::make($request->all(), [         
            'reason'=> 'required',
        ])->validate();
        $inputs = $request->all();		
  
        $application = Application::find($id);
        $application->update([                        
            'reason_cancel_id' => $request->input('reason'),
            'active' => '0',			
        ]);
		return redirect()->route('application.index')->with('message', trans('global.Job application has been canceled'));			
    }
	
    public function destroy($id)
    {
		$applications = Application::findOrFail($id);
		$applications->delete();
		return redirect()->back()->with('message', trans('global.Job application successfully deleted!'));
    }

    public function downloadResume($id)
    {
		$crypto = new Hashids();
		$existResume=UserDescription::where('user_id',$crypto->decodeHex($id))->first();
    	$myFile = "storage/uploads/member/resume/".$existResume->resume;
    	$headers = ['Content-Type: application/pdf'];
    	$newName = substr($existResume->resume,7);
    	return response()->download($myFile, $newName, $headers);
    }	
	
}
