@extends('layouts.app')
@section('meta')<meta name="keywords" content="{{ config('app.keyword') }}" />
	<meta name="description" content="{{ config('app.description') }}">
	<meta name="author" content="gelarin.com">	
	<title>{{ config('app.name', 'Gelarin') }} {{ config('app.title') }}</title>	
@endsection
@section('content')
			<!-- Title Header Start -->
			<section class="inner-header-title" style="background-image:url({{asset('front/img/content/banner-10.jpg')}});">
				<div class="container">
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- Title Header End -->
			
			<!-- Company Detail Start -->
			<section class="detail-desc">
				<div class="container">
				
					<div class="ur-detail-wrap top-lay">
						
						<div class="ur-detail-box">
							
						<div class="col-md-12 col-sm-12">
							<div class="advance-detail detail-desc-caption">
								<ul>
									<li><strong class="j-view">{{$premiumVacancies->count()}}</strong>@lang('global.Job Vacancies Premium')</li>
									<li><strong class="j-applied">{{$countVacanciesAlls->count()}}</strong>@lang('global.Job Vacancy')</li>
									<li><strong class="j-shared">{{$countApplications->count()}}</strong>@lang('global.Job application')</li>
								</ul>
							</div>
						</div>
							
						</div>
						

						
					</div>
					
				</div>
			</section>
			<!-- Company Detail End -->
			
			<!-- company full detail Start -->
			<section class="full-detail-description full-detail">
				<div class="container">
					<div class="row">
						
						<div class="col-lg-8 col-md-8">
							
							<div class="row-bottom">
								<h2 class="detail-title">{{$titlePages}}</h2>
							
								
								
								
								<form role="form" enctype="multipart/form-data" method="GET" action="{{ route($routeFormSearchs) }}" role="search">
								@csrf
								<div class="filter-form">
									<div class="input-group">									
										<input type="text" name="keyword" class="form-control" placeholder="@lang('global.Keyword')" value="{{old('keyword')}}">
										<span class="input-group-btn">
												<?php
													if ($_SERVER['REQUEST_METHOD'] === 'GET') {
														if (isset($_GET['search'])) {
															?>
																<button name="refresh" class="btn btn-primary"><i class="fa fa-refresh"></i></button>												
															<?php
														} 
														else {
															?>
																<button class="btn btn-primary" id="search" name="search">Go</button>												
															<?php
														 }
													}
													else{
														?>
															<button class="btn btn-primary" id="search" name="search">Go</button>												
														<?php
													}
												?>											
										</span>
										
									</div>
								</div>
								</form>								
									@if(count($applications)>0)	
									@foreach($applications as $application)						
		
										<article>						
											<div class="mng-resume">
												<div class="col-md-2 col-sm-2">
													<div class="mng-resume-pic">
													<a href="#" target="_blank">
														@if(!empty($application->vacancy->company->logo))
																<img src="{{ asset('storage/uploads/company/logo/'.$application->vacancy->company->logo) }}" class="img-responsive" alt="{{$application->vacancy->company->name}}"/>
														@else
															<img src="{{ asset('storage/uploads/company/logo/150x150.png')}}" class="img-responsive" alt="" />									
														@endif
													</a>
													</div>
												</div>
												<div class="col-md-8 col-sm-8">
													<div class="mng-resume-name">
														<h4><a href="{{ route('vacancies.detail',[$application->vacancy->id,$application->vacancy->slug]) }}" target="_blank">{{ str_limit(strip_tags(ucwords($application->vacancy->title)), 40) }}</a> <span class="cand-designation">({{$application->vacancy->visits}} dilihat)</span></h4>
														<span class="cand-status">{{ str_limit(strip_tags(ucwords($application->vacancy->company->name)), 21) }}</span> <span style="font-size:11px; color:brown;">(<i class="fa fa-clock-o"></i> {{CountDay($application->created_at,date("Y-m-d"))}} @lang('global.Days Ago')</span>)
														<br>
														<span><a href="{{ asset('storage/uploads/member/resume/'.$application->resume) }}" target="_blank" style="color:#2867b2;"><i class="fa fa-file-pdf-o" style="font-size:12px;"></i></a></span>
														<span>
															@if($application->application_status=='Shortlist')
																<span class="alert-success" style="font-size:11px;"> @lang('global.Application has been seen') </span>
															@elseif($application->application_status=='Not Suitable')
																<span class="alert-danger" style="font-size:11px;"> @lang('global.Not passed') </span>
															@elseif($application->application_status=='Interview')
																<span class="alert-success" style="font-size:11px;"> @lang('global.Interview Process') </span>
															@elseif($application->application_status=='Pass')
																<span class="alert-success" style="font-size:11px;"> @lang('global.You are accepted') </span>
															@elseif($application->application_status=='Cancel')
																<span class="alert-warning" style="font-size:11px;"> @lang('global.Application has been canceled') </span>																		
															@else <span class="alert-info" style="font-size:11px;"> @lang('global.Application not yet processed') </span>
															@endif
														,</span>
														@if($application->active=='0')
															<span style="color:red;font-size:11px;">@lang('global.Canceled') !</span>
														@endif
														@if($application->applicationmessage->count()>0)
														
																		<span>(<a href="{{route('application.message',[$application->id,$application->vacancy->slug,str_slug($application->vacancy->user->companyofficer->company->name)])}}"><i class="fa fa-comments-o"></i> {{$application->applicationmessage->count()}}</a>)</span>
														
														@endif
													</div>
												</div>
												<div class="col-md-2 col-sm-2">
													<div class="mng-resume-action">
														@if($application->active=='0')
															<a href="{{route('application.delete',$application->id)}}" onclick="return confirm('@lang('global.Do you want to delete it?')')" data-toggle="tooltip" title="@lang('global.Delete Application')"><i class="fa fa-trash" aria-hidden="true"></i></a>
														@else
															<a href="{{route('application.cancel',$application->id)}}" data-toggle="tooltip" title="@lang('global.Cancel Application')"><i class="fa fa-close" aria-hidden="true"></i></a>									
														@endif
													</div>
												</div>
											</div>
										</article>
								@endforeach
								@else
									<article class="blog-news">
										<div class="short-blog">
											<div class="blog-content">
												<div class="blog-text">
													<div class="post-meta">
														<div class="error-page">
															<h2 style="font-size:18px;"><span style="font-size:30px;">@lang('global.Sorry'),</span></h2>
															<p>@lang('global.There is no job application')!</p> 
														</div>
													</div>
												</div>
											</div>
										</div>
									</article>									
								@endif
							
							</div>
							
							<div class="row-bottom">
							{{$applications->render()}}
							</div>
							<div class="row-bottom">
								<h2 class="detail-title">@lang('global.Job Vacancies Premium')</h2>
								<!--Browse Job In Grid-->
								<div class="row extra-mrg">
									@foreach($premiumVacancies as $premiumVacancy)

									<div class="col-md-6 col-sm-6">
										<div class="grid-view brows-job-list">
											<div class="brows-job-company-img">
												@if(!empty($premiumVacancy->logo))
													<img src="{{ asset('storage/uploads/company/logo/'.$premiumVacancy->logo) }}" class="img-responsive" title="{{$premiumVacancy->title}}" />			
												@else	
													<img src="{{asset('front/img/default/120x120.jpg')}}" class="img-responsive" alt="" />
												@endif
											</div>
											<div class="brows-job-position">
												<h3><a href="{{ route('vacancies.detail',[$premiumVacancy->id,$premiumVacancy->slug]) }}" target="_blank">{{ str_limit(strip_tags(ucwords($premiumVacancy->title)), 40) }}</a></h3>
												<p><span>{{ str_limit(strip_tags(ucwords($premiumVacancy->company)), 21) }}</span></p>
											</div>
											<div class="job-position">
												<span class="job-num">{{CountDay($premiumVacancy->created_at,date("Y-m-d"))}} @lang('global.Days Ago')</span>
											</div>
											<br>
											<i class="fa fa-map-marker"></i> 
											{{ str_limit(strip_tags(ucwords($premiumVacancy->city)), 15) }},
											
											{{ str_limit(strip_tags(ucwords($premiumVacancy->province)), 20) }}						
											@if($premiumVacancy->working_type_id=='1')
												<div class="brows-job-type">
													<span class="full-time">{{$premiumVacancy->type}}</span>
												</div>
											@elseif($premiumVacancy->working_type_id=='2')
												<div class="brows-job-type">
													<span class="part-time">{{$premiumVacancy->type}}</span>
												</div>
											@elseif($premiumVacancy->working_type_id=='3')
												<div class="brows-job-type">
													<span class="contract">{{$premiumVacancy->type}}</span>
												</div>
											@elseif($premiumVacancy->working_type_id=='4')
												<div class="brows-job-type">
													<span class="freelanc">{{$premiumVacancy->type}}</span>
												</div>
											@elseif($premiumVacancy->working_type_id=='5')
												<div class="brows-job-type">
													<span class="enternship">{{$premiumVacancy->type}}</span>
												</div>
											@elseif($premiumVacancy->working_type_id=='6')
												<div class="brows-job-type">
													<span class="temporary">{{$premiumVacancy->type}}</span>
												</div>												
											@endif
											<ul class="grid-view-caption">
												<li>
													<div class="brows-job-location">
														<p><i class="fa fa-see"></i><a href="{{ route('vacancies.detail',[$premiumVacancy->id,$premiumVacancy->slug]) }}" target="_blank"><i class="fa fa-info-circle"></i>@lang('global.See')</a></p>
													</div>
												</li>
												<li>
													<p><span class="brows-job-sallery">
														@if(auth()->check())
															@if($premiumVacancy->vacancy_id==$premiumVacancy->id and $premiumVacancy->user_id==auth()->user()->id)
																<i class="fa fa-check"></i>{{__('vacancy.Applied')}}
															@else
																<a href="{{route('application.apply',[$premiumVacancy->id,$premiumVacancy->slug])}}" title="@lang('home.Apply for this job application')" style="color:#2867b2;">@lang('vacancy.Apply')</a>
															@endif
														@else
															<a href="{{route('application.apply',[$premiumVacancy->id,$premiumVacancy->slug])}}" title="@lang('home.Apply for this job application')" style="color:#2867b2;">@lang('vacancy.Apply')</a>										
														@endif												
													</span></p>
												</li>
											</ul>
											{{--@if($relatedVacancy->partner=='1')--}}								
												<span class="tg-themetag tg-featuretag">Premium</span>
												{{--@endif--}}
										</div>
									</div>

									@endforeach

									
								</div>
								<!--/.Browse Job In Grid-->
					
							</div>
							<div class="row-bottom">
							{{$premiumVacancies->render()}}
							</div>							
						</div>
						
		@includeWhen(auth()->check(), 'layouts.inc.sidebar')	
					
					</div>
				</div>
			</section>
			<!-- company full detail End -->
@endsection
