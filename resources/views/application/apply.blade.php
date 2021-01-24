@extends('layouts.app')
<?php
          $storage="public/uploads/member/resume/";
            $public_path="storage/uploads/member/resume/";
?>
@section('content')

@foreach($userdesc as $ude)


			<!-- bottom form section start -->
			<section class="kyt-header-content">
				<div class="container" >

				</div>
				
			</section>
			<!-- Bottom Search Form Section End -->
			<!-- ========== Begin: Brows job Category ===============  -->			
			<section class="brows-job-category">
				<div class="container">
					<div class="col-md-9 col-sm-12">
						<div class="full-card">
						
							<div class="card-header">
								<div class="row mrg-0">

									<div class="col-md-12 col-sm-12 small-padd">
									<ol class="breadcrumb pull-left" style="background-color:#ffffff;">
										<li>
											@if(!empty($ude->photo))
												<img src="{{ asset('storage/uploads/member/photo/'.$ude->photo) }}" class="img-circle" alt="user" style="width:45px;height:45px;">
											@else
												<img src="{{asset('front/front/img/blank/photo.jpg') }}" class="img-circle" alt="user" style="width:45px;height:45px;">
											@endif
										</li>	
										<li>{{auth()->user()->name}}</li>
										<li><i class="fa fa-envelope"></i> {{auth()->user()->email}}</li>
										<li><i class="fa fa-phone"></i>(+{{$ude->phone_code}}){{$ude->phone}}</li>										

									</ol>
									</div>
								</div>
							</div>
							<div class="card-body kyt-panel-body">
							<form role="form" files="true" enctype="multipart/form-data" method="POST" action="{{ route('application.apply',[$vacancies->id,$vacancies->slug]) }}" novalidate="novalidate">
								@csrf	
								<article class="advance-search-job">
									<div class="row no-mrg">
										<div style="padding-left:25px;width:97%;">
										
										
			@if(session()->has('success'))
				<span class="full-time pull-left breadcrumb">{{session()->get('success')}} <b>{{$vacancies->title}}</b> {{__('application.successfully sent and saved')}}</span>					
			
			@elseif(session()->has('error'))
				<span class="full-time pull-left breadcrumb">{{session()->get('error')}}</span>					
			@else										
										
										
										
							@foreach($applications as $application)
							@endforeach
							@if(!empty($application->vacancy_id)  and $vacancies->id==$application->vacancy_id and auth()->user()->id==$application->user_id)
									<span style="color:#707c88;">
									@lang('application.You have already sent a job application for this job. Please search other vacancies!',
										[
											'vacancyUrl' => url('vacancies')
										])
										</span>
							@else	

											<a href="{{ route('vacancies.detail',[$vacancies->id,$vacancies->slug]) }}" target="_blank" style="color:#2867b2;" title="{{ucwords($vacancies->title)}}"><h5>{{ucwords($vacancies->title)}}</h5></a>
											@if(!empty($ude->resume) and !empty(file_exists(public_path('storage/uploads/member/resume/'.$ude->resume))))
												@lang('global.Uploaded resume') - @lang('global.Resume uploaded on') <b>{{date($vacancies->country->date_format, strtotime($ude->resume_at))}}</b>
												<a href="{{route('application.download_resume',$crypto->encodeHex($ude->user_id))}}" target="_blank" style="color:#2867b2;">@lang('application.Download')</a> | <a href="#" style="color:#2867b2;">@lang('global.Change')</a>
											@else
												<input class="fileinput{{ $errors->has('resume') ? ' is-invalid' : '' }}" type="file" id="file" name="resume" accept=".pdf,.doc,.docx" title="@lang('global.Curiculum Vitae')" required="required"/>
											    @if ($errors->has('resume'))
													<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
														<strong>{{ $errors->first('resume') }}</strong>
													</span>
												@endif										
											@endif
											<br>
											<textarea id="summernote" name="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
											@error('description')
												<span class="invalid-feedback kyt-color-text" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror									
											<p>
												<span class="span-umum">
													@lang('global.By pressing the "Send Application" button,') @lang('global.I have read and agree with Gelarin regulations on calling interviews')
												</span>
											</p>
											<input type="submit" value="@lang('global.Send Application')" class="btn btn-hijau" data-loading-text="Loading..."> 
											<a href="{{ url()->previous() }}" class="btn btn-kuning"><i class="fa fa-times-circle" ></i> @lang('global.Closed')</a>	
								@endif	
@endif								
										</div>
									</div>								
									
								</article>
								</form>	
							</div>
						</div>
						
						<div class="row">
						<p></p>
						</div>
						
						<!-- Ad banner -->
						<div class="row">
							<div class="ad-banner">
							{{-- <img src="http://via.placeholder.com/728x90" class="img-responsive" alt="">--}}
							</div>
						</div>
					</div>
					
					<!-- Sidebar Start -->
					<div class="col-md-3 col-sm-12">
						<div class="sidebar right-sidebar">
						
							<div class="side-widget">
								<h2 class="side-widget-title">@lang('global.Job Vacancy')</h2>
								<div class="job-alert">
									<div class="widget-text padd-0">
										<div class="brows-job-company-img">
										@if(!empty($vacancies->company->logo))
											<img src="{{ asset('storage/uploads/company/logo/'.$vacancies->company->logo) }}" class="img-responsive" alt="{{$vacancies->company}}"/>
										@else
											<img src="{{asset('front/front/img/blank/150x150.png') }}" class="img-responsive" alt="{{$vacancies->company}}"/>
										@endif
										</div>	
										<p>
											{{ str_limit(strip_tags(ucwords($vacancies->company->name)), 28) }}<br>										
											<a href="{{ route('vacancies.detail',[$vacancies->id,$vacancies->slug]) }}" target="_blank" style="color:#2867b2;">{{ str_limit(strip_tags(ucwords($vacancies->title)), 17) }}</a>
										</p>
									</div>
								</div>
							</div>
							
							<div class="side-widget">
								<h2 class="side-widget-title"><a href="#general" data-toggle="collapse">@lang('global.General Information')<i class="pull-right fa fa-angle-double-down" aria-hidden="true"></i></a></h2>
								<div class="widget-text padd-0 collapse" id="general">
									<div class="ad-banner">
										<ul>
											<li><i class="fa fa-map-marker"></i> {{ str_limit(strip_tags(ucwords($vacancies->city->name)), 14) }},
												{{ str_limit(strip_tags(ucwords($vacancies->city->subadmin1->name)), 14) }}
											</li>
											<li><i class="fa fa-clock-o"></i>
											@foreach ($vacancytypes as $vacancytype)
													@if($vacancies->working_type_id==$vacancytype->translation_of) {{ $vacancytype->name }} @endif
											@endforeach
											</li>
											<li><i class="fa fa-flask"></i> @lang('global.Minimum') {{ucwords($vacancies->years_experience)}} @lang('global.Years Experience')</li>

											<li>
													<i class="fa fa-users"></i>
												@foreach ($genders as $gender)
													@if($vacancies->gender_id==$gender->translation_of) {{ $gender->name }} @endif
												@endforeach
											</li>
											<li><i class="fa fa-clock-o"></i>
												@foreach ($vacancylevels as $vacancylevel)
													@if($vacancies->working_level_id==$vacancylevel->translation_of) {{ str_limit(strip_tags(ucwords($vacancylevel->name)), 25) }} @endif
												@endforeach
											</li>										
										</ul>
									</div>
								</div>
							</div>
							
							<div class="side-widget">
								<h2 class="side-widget-title"><a href="#salary" data-toggle="collapse">@lang('global.Salary')<i class="pull-right fa fa-angle-double-down" aria-hidden="true"></i></a></h2>
								<div class="widget-text padd-0 collapse" id="salary">
									<ul>
									@if($vacancies->hide_salary==1)
										<li>@lang('global.Confidential')</li>
									@else 
										<li>
											@lang('global.Minimum'): {{$vacancies->country->currency_code}} {{ number_format($vacancies->min_salary, 2, ',', '.') }} /
											@foreach ($salarytypes as $sal)
												@if($vacancies->salary_type_id==$sal->translation_of) {{ $sal->name }} @endif
											@endforeach
										</li>
										<li>
										@lang('global.Maximum'): {{$vacancies->country->currency_code}} {{ number_format($vacancies->max_salary, 2, ',', '.') }} / 
										@foreach ($salarytypes as $sal)
											@if($vacancies->salary_type_id==$sal->translation_of) {{ $sal->name }} @endif
										@endforeach
										</li>
									@endif
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- Sidebar End -->
					
				</div>
			</section>
	
			<!-- ========== Begin: Brows job Category End ===============  -->
		@endforeach

@endsection	
	@push('styles')
	<link rel="stylesheet" href="{{asset('front/center/summernote/summernote.css')}}" />	
@endpush
@push('scripts')
	<script src="{{asset('front/center/file_upload/file-upload.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/center/summernote/summernote.js')}}"></script>
			<script type="text/javascript">
					var $ = jQuery.noConflict();
					$(document).ready(function() {
						$('#summernote').summernote({
							height: 150,
							tabsize: 2,
							toolbar: [
								['font', ['bold', 'italic']],
								['para', ['ul', 'ol']],
							],
							required:"required",
						placeholder: "{{trans('global.Tell the company why you are best suited for this position. Mention specific skills and how you contribute.')}}",  
						});
					});
			</script>	
@endpush	