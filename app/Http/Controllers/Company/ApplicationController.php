<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\User;
use App\Models\UserDescription;
use App\Models\Vacancy;
use App\Models\UserExperience;
use App\Models\UserEducation;
use App\Models\UserSkill;
use App\Models\ApplicationMessage;
use Auth;
use Route;
use Hashids\Hashids;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Validator;


class ApplicationController extends Controller
{
    public function __construct(){
        $this->middleware('auth:companypage');
    } 
	
    public function index($id,$slug)
    {
        
		$crypto = new Hashids();
        $language=app()->getLocale();
        $vacTitles=Vacancy::find($id);
        if(Route::is('unprocessed')){
            $applications=Application::SAppVac()
               /* ->where(function($q) use($language){
                    $q->where('reason_cancel_vacancies.translation_of','=','applications.reason_cancel_id')
                    ->orWhere('reason_cancel_vacancies.translation_lang','=',$language);
                }) */           
            ->where('vacancies.id',$id)
            ->where('applications.application_status','=','Unprocessed')
            ->paginate(6);
        }
        if(Route::is('shortlist')){
            $applications=Application::SAppVac()
               /* ->where(function($q) use($language){
                    $q->where('reason_cancel_vacancies.translation_of','=','applications.reason_cancel_id')
                    ->orWhere('reason_cancel_vacancies.translation_lang','=',$language);
                }) */        
            ->where('vacancies.id',$id)
            ->where('applications.application_status','=','Shortlist')
            ->paginate(6);
        } 
        if(Route::is('interview')){
            $applications=Application::SAppVac()
               /* ->where(function($q) use($language){
                    $q->where('reason_cancel_vacancies.translation_of','=','applications.reason_cancel_id')
                    ->orWhere('reason_cancel_vacancies.translation_lang','=',$language);
                }) */        
            ->where('vacancies.id',$id)
            ->where('applications.application_status','=','Interview')
            ->paginate(6);
        } 
        if(Route::is('pass')){
            $applications=Application::SAppVac()
               /* ->where(function($q) use($language){
                    $q->where('reason_cancel_vacancies.translation_of','=','applications.reason_cancel_id')
                    ->orWhere('reason_cancel_vacancies.translation_lang','=',$language);
                }) */        
            ->where('vacancies.id',$id)
            ->where('applications.application_status','=','Pass')
            ->paginate(6);
        } 
        if(Route::is('not')){
            $applications=Application::SAppVac()
               /* ->where(function($q) use($language){
                    $q->where('reason_cancel_vacancies.translation_of','=','applications.reason_cancel_id')
                    ->orWhere('reason_cancel_vacancies.translation_lang','=',$language);
                }) */        
            ->where('vacancies.id',$id)
            ->where('applications.application_status','=','Not Suitable')
            ->paginate(6);
        }
        /*foreach ($applications as $key => $application) {
            $applMessagesCounts=ApplicationMessage::
			
			SApplMessage($application->id)->count();
        } */                              
   
        return view('company.application.index')->with(compact(
            'applications',
            'vacTitles',
           // 'applMessagesCounts',
			'crypto'
        ));
    }

    public function show($user_id,$id)
    {
        //
        //$vacTitles=Vacancy::find($id);
		$crypto = new Hashids();		
        $appProfiles=Application::SAppProfile($crypto->decodeHex($user_id))->first();
        $talents=User::where('id',$crypto->decodeHex($user_id))->with('userdescription')->first();		
        $appExperiences=UserExperience::where('user_id',$crypto->decodeHex($user_id))->orderBy('start_working','ASC')->get();
        $appEducations=UserEducation::SUserEducation()->where('user_id',$crypto->decodeHex($user_id))->orderBy('start_year','ASC')->get();          
        $appSkills=UserSkill::where('user_id',$crypto->decodeHex($user_id))->get();       
		return view('company.application.detail')->with(compact(
           // 'vacTitles',
            'appProfiles',
            'appExperiences',
            'appEducations',
			'talents',
			'appSkills',
			'crypto'
        ));            
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
		$crypto = new Hashids();
        $ApplUser= Application::SAppVacMessage($id)->first();
        if(Route::is('update.shortlist')){
            $dt= new DateTime();
            $process=Application::where('id',$id)
                ->update([
                'application_status' => 'Shortlist',
                'read_date' => date("Y-m-d"), 
                'read_time' => $dt->format('H:i:s'),                                 
                'shortlist_date' => date("Y-m-d"),            
                ]
            );
            $status=trans('application.Shortlist');
        }
        if(Route::is('update.interview')){
            $process=Application::where('id',$id)
                ->update([
                'application_status' => 'Interview',
                'interview_date' => date("Y-m-d"),            
                ]
            );
            $status=trans('application.Interview');                          
        }
        if(Route::is('update.pass')){
            $process=Application::where('id',$id)
                ->update([
                'application_status' => 'Pass',
                'pass_date' => date("Y-m-d"),            
                ]
            );
            $status=trans('application.Pass');                      
        }
        if(Route::is('update.not')){
            $process=Application::where('id',$id)
                ->update([
                'application_status' => 'Not Suitable',
                'not_suitable_date' => date("Y-m-d"),            
                ]
            );
            $status=trans('application.Not Suitable');

        }
		if(!$process){
			return back()->with('error', trans('message.Data failed to change'));				
		}
		else{
			return back()->with('message', trans('application.You have set it'))->with('applUser', $ApplUser->name)->with('status', $status);
		}  
    }

    public function indexMessage($id,$title)
    {
        $applMessageTitles=Application::
			select(
				'applications.id',
				'applications.created_at',
				'users.name',
				'user_descriptions.profession',
				'user_descriptions.photo'
			)		
		->SApplMessageTitle($id)->first();  
        $applMessages=ApplicationMessage::
			select(
			    'application_messages.application_id',	
				'application_messages.user_id',
				'application_messages.message',		
				'application_messages.active',
				'application_messages.created_at',
				'users.name as user',
				'user_descriptions.photo',
				'user_descriptions.profession',
				'countries.date_format'
			)		
		->SApplMessage($id)->paginate(4);       
        //$vacTitles=$title;  
		//$companyOfficers=CompanyOfficer::get();		
        return view('company.application.message.index')->with(compact(
            'applMessageTitles',
            'vacTitles',
            'applMessages',
			'title'
			//'companyOfficers'
        ));
    }
	
    public function storeMessage(Request $request,$application_id)
    {
        Validator::make($request->all(), [
            'message'=> 'required|string|min:10|max:500',           
        ])->validate();     
        
        $postMessages = ApplicationMessage::create([
                'application_id' => $application_id, 
                'user_id' => Auth::User()->id, 
                'message' => $request->input('message'),
                'active'=>'1',                      
        ]);         
         
        if(!empty($postMessages)) {
            return redirect()->back()->with(['message' => 'Pesan anda sudah dikirim']);
        } else {
            return redirect()->back()->with(['message' => 'Pesan gagal']);
        }
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
