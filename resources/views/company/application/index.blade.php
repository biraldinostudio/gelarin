@extends('layouts.company.app')
@section('meta')<meta name="keywords" content="{{ config('app.keyword') }}" />
	<meta name="description" content="{{ config('app.description') }}">
	<meta name="author" content="gelarin.com">	
	<title>{{ config('app.name', 'Gelarin') }} {{ config('app.title') }}</title>	
@endsection
@section('content')
<!-- Title Header Start -->
<section class="kyt-header-content">
	<div class="container"></div>
</section>
<div class="clearfix"></div>
<!-- Title Header End -->
			
<!-- ========== Begin: Brows job Category ===============  -->
<section class="brows-job-category gray-bg">
	<div class="container">
		<div class="col-md-9 col-sm-12">
			<div class="full-card">		
				<div class="card-header">
					<div class="row mrg-0">		
						<div class="col-md-11 col-sm-11">

							<ol class="breadcrumb pull-left">
								<li><a href="{{route('company.dashboard')}}"><i class="fa fa-home"></i></a></li>						
								<li class="active">
									@if(Route::is('unprocessed'))
										@lang('application.Applicants Unprocessed')
									@endif
									@if(Route::is('shortlist'))
										@lang('application.Applicants Shortlist')
									@endif
									@if(Route::is('interview'))
										@lang('application.Applicants For Interview Phase')
									@endif
									@if(Route::is('pass'))
										@lang('application.Applicants Pass Selection')
									@endif
									@if(Route::is('not'))
										@lang('application.Applicants Who Fail Selection')
									@endif	
									@lang('application.for work'): "<strong>{{ str_limit(strip_tags(ucwords($vacTitles->title)), 50) }}</strong>"					
								</li>
							</ol>					
						</div>									
						<!--<div class="col-md-1 col-sm-1">
						</div>									
						<div class="col-md-1 col-sm-1">
						</div>-->
					</div>
				</div>			
				<div class="card-body">
					@if(session()->has('message'))
						<article class="advance-search-job">
							<div class="advance-search-caption">
								<i class="fa fa-check"></i> {{ session()->get('message') }}: <strong>{{ session()->get('applUser') }}</strong> "{{ session()->get('status') }}" @lang('application.for job openings') 

								<strong>{{ str_limit(strip_tags(ucwords($vacTitles->title)), 50) }}</strong>
								
							</div>
						</article>
					@endif						
					@if(count($applications)>0)
						@foreach($applications as $application)				
							<article class="advance-search-job">
								<div class="row no-mrg">
									<div class="col-md-9 col-sm-9">
										<a href="{{route('detail',[$crypto->encodeHex($application->user_id),str_slug($application->name)])}}" target="blank" title="{{$application->name}}">
											<div class="advance-search-img-box">
												@if(!empty($application->photo))
													<img src="{{ asset('storage/uploads/member/photo/'.$application->photo) }}" class="img-responsive" alt="{{$application->name}}"/>
												@else
													<img src="{{ asset('storage/uploads/member/photo/150x150.png')}}" class="img-responsive" alt="{{$application->name}}" />									
												@endif
											
											</div>
										</a>								
										<div class="advance-search-caption">
											<h4><a href="{{route('detail',[$crypto->encodeHex($application->user_id),str_slug($application->name)])}}" target="_blank">{{ str_limit(strip_tags(ucwords($application->name)), 35) }}</a></h4>
											<span><i class="fa fa-envelope"></i> {{$application->email}}</span>
											<p style="font-size:12px;">											
												@if($application->application_status=='Unprocessed')
													<strong>@lang('application.Phase'):</strong> @lang('application.Unprocessed')
												@endif
												@if($application->application_status=='Shortlist')
													<strong>@lang('application.Phase'):</strong> @lang('application.Shortlist')
												@endif
												@if($application->application_status=='Interview')
													<strong>@lang('application.Phase'):</strong> @lang('application.Interview')
												@endif
												@if($application->application_status=='Pass')
													<strong>@lang('application.Phase'):</strong> @lang('application.Pass')
												@endif
												@if($application->application_status=='Not Suitable')
													<strong>@lang('application.Phase'):</strong> @lang('application.Not Suitable')
												@endif 
												@if(!empty($application->resume))
													| <a href="{{route('download_resume',[$crypto->encodeHex($application->user_id),str_slug($application->name)])}}" target="_blank"><i class="fa fa-file-pdf-o" style="font-size:12px;"></i> @lang('application.Resume')</a>
												@endif
												|@if($application->applicationmessage->count()>0)<a href="{{route('message',[$application->id,$vacTitles->title,str_slug($application->name)])}}"><i class="fa fa-comments-o"></i> @lang('application.Message')({{$application->applicationmessage->count()}}) @else <a href="{{route('message',[$application->id,$vacTitles->title,$application->name])}}"><i class="fa fa-comments-o"></i> {{__('application.Send Message')}}</a>@endif
											</p>
										</div>
									</div>
									<div class="col-md-3 col-sm-3">
										<div class="mng-resume-action">
										@if($application->application_status=='Unprocessed')
											<form role="form" files="true" enctype="multipart/form-data" method="POST" action="{{route('update.shortlist',$application->id)}}">
											@csrf
												<button class="signin">@lang('application.Shortlist') ?</button>
											</form>	
										@elseif($application->application_status=='Shortlist')
											<form role="form" files="true" enctype="multipart/form-data" method="POST" action="{{route('update.interview',$application->id)}}">
											@csrf									
												<button class="signin">@lang('application.Interview') ?</button>
											</form>											
										@elseif($application->application_status=='Interview')
											<form role="form" files="true" enctype="multipart/form-data" method="POST" action="{{route('update.pass',$application->id)}}">
											@csrf									
												<button class="signin">@lang('application.Pass') ?</button>
											</form>
											<form role="form" files="true" enctype="multipart/form-data" method="POST" action="{{route('update.not',$application->id)}}">
											@csrf										
												<button class="signin">@lang('application.Not Suitable') ?</button>
											</form>	
										@endif							
																					
										</div>
									</div>
								</div>
							</article>
						@endforeach
					@else	
						@if(!session()->has('message'))						
							<article class="advance-search-job">
								<div class="row no-mrg">
									<div class="col-md-10 col-sm-10">
										<div class="advance-search-caption">
											<h4>@lang('application.Sorry') ,</h4>
											@if(Route::is('unprocessed'))
												<span>@lang('application.No new applicants have not yet been processed, please check applicants who enter the selection.')</span>
											@elseif(Route::is('shortlist'))
												<span>@lang('application.No new applicants are still entering the selection stage. Please check applicants who enter the Interview stage.')</span>
											@elseif(Route::is('interview'))
												<span>@lang('application.There are no new applicants being interviewed.')</span>
											@else
												<span>@lang('application.There are no applicants.')</span>											
											@endif									
										</div>
									</div>
								</div>
							</article>
						@endif		
					@endif			
					
					<article class="advance-search-job">
						<div class="row no-mrg">
							<div class="col-md-10 col-sm-10">
								<p style="text-align:left;">
									<a class="btn btn-warning" href="{{route('vacancies.active')}}"><i class="fa fa-arrow-circle-left"></i> @lang('application.Back')</a>										
								</p>
							</div>
						</div>
					</article>				
				</div>
			</div>			
			<div class="row">
				{{$applications->render()}}
			</div>			
			<!-- Ad banner -->
			<!--
			<div class="row">
				<div class="ad-banner">
					<img src="http://via.placeholder.com/728x90" class="img-responsive" alt="">
				</div>
			</div>
			-->
		</div>
		<!-- Sidebar Start -->
		@section('sidebar')
			@include('layouts.company.inc.sidebar')
		@show
	<!-- Sidebar End -->	
	</div>
</section>
@endsection	
		