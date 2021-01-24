@extends('layouts.app')	
@section('content')
			<!-- Title Header Start -->
			<section class="inner-header-title" style="background-image:url({{asset('front/img/content/banner-10.jpg')}});">
				<div class="container">
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- Title Header End -->
			
			<!-- company full detail Start -->
			<section>
				<div class="container">
					<div class="row">
						
						<div class="col-lg-8 col-md-8">
							
							<div class="row-bottom">
								<h2 class="detail-title">
									@if(Route::is('manage.vacancies'))
										@lang('vacancy.Saved Workers')
									@endif								
								</h2>
								@if(session()->has('success'))
									<span class="full-time pull-left breadcrumb">{{session()->get('success')}}</span>					
								@endif
								@if(session()->has('error'))
									<span class="full-time pull-left breadcrumb">{{session()->get('error')}}</span>					
								@endif									
								@if(Route::is('manage.vacancies'))
									<form role="form" enctype="multipart/form-data" method="POST" action="{{ route('manage.vacancies') }}" role="search">
								@endif								
								@csrf
								<div class="filter-form">
									<div class="input-group">									
										<input type="text" name="keyword" class="form-control" placeholder="@lang('vacancy.Keyword')" value="{{old('keyword')}}">
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
								@if(session()->has('message'))
									<p style="color:#11b719;">
										{{ session()->get('message') }}
									</p>
								@endif								
								
								@if(count($vacancySaves)>0)			
								@foreach($vacancySaves as $vacancySave)
								<article>							
									<div class="mng-resume">
										<div class="col-md-2 col-sm-2">
											<div class="mng-resume-pic">
											<a href="#" target="_blank">
												<img src="{{ asset('storage/uploads/company/logo/'.$vacancySave->logo) }}" class="img-responsive" alt="#" /></a>
											</div>
										</div>
										<div class="col-md-8 col-sm-8">
											<div class="mng-resume-name">
												<h4><a href="{{route('vacancies.detail',[$vacancySave->vacancy_id,$vacancySave->slug])}}" target="_blank">{{ str_limit(strip_tags(ucwords($vacancySave->title)), 50) }}</a> <!--<span class="cand-designation"></span>--></h4>
												<span class="cand-status">{{ str_limit(strip_tags(ucwords($vacancySave->company)), 21) }} ({{date($vacancySave->date_format, strtotime($vacancySave->created_at))}})</span><br> 
												<span style="color:#11b719;">@if(!empty($vacancySave->application_id))(@lang('vacancy.Already applied')) @endif</span>
												<span>{{$vacancySave->vacancy_type}}</span>,
												<span>{{ str_limit(strip_tags(ucwords($vacancySave->city)), 21) }}<span>
												<span>
												@if(!empty($vacancySave->application_status)),
													@if($vacancySave->application_status=='Shortlist')
													<span class="alert-success" style="font-size:11px;"> @lang('vacancy.Application has been seen') </span>
													@elseif($vacancySave->application_status=='Not Suitable')
														<span class="alert-danger" style="font-size:11px;"> @lang('vacancy.Not passed') </span>
													@elseif($vacancySave->application_status=='Interview')
														<span class="alert-success" style="font-size:11px;"> @lang('vacancy.Interview Process') </span>
													@elseif($vacancySave->application_status=='Pass')
														<span class="alert-success" style="font-size:11px;"> @lang('vacancy.You are accepted') </span>
													@elseif($vacancySave->application_status=='Cancel')
														<span class="alert-warning" style="font-size:11px;"> @lang('vacancy.Application has been canceled') </span>																		
													@else <span class="alert-info" style="font-size:11px;"> @lang('vacancy.Application not yet processed') </span>
													@endif
												@endif	
												</span>
												<span>
													(<a href="{{route('application.apply',[$vacancySave->vacancy_id,$vacancySave->slug])}}" style="color:#11b719;" class="footer-btn grn-btn" title="@lang('vacancy.Apply for this job application')">@lang('vacancy.Apply Now')</a>)
												</span>
											</div>
										</div>
										<div class="col-md-2 col-sm-2">
											<div class="mng-resume-action">
											{{--<a href="{{route('manage.vacancies.delete',$vacancySave->id)}}" onclick="return confirm('@lang('vacancy.Do you want to delete it?')')" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></a>
											--}}
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
														<h2 style="font-size:18px;"><span style="font-size:30px;">@lang('vacancy.Sorry'),</span></h2>
														<p>@lang('vacancy.There are no job opening data stored')!</p> 
													</div>
												</div>
											</div>
										</div>
									</div>
								</article>				
								@endif								
								

								
							</div>
						<div class="row">
						{{$vacancySaves->render()}}
						</div>

						<!-- Similar Jobs -->
						<div class="container-detail-box">
						
							<div class="row">
								<div class="col-md-12">
									<h4>@lang('vacancy.Job Vacancies Premium')</h4>
								</div>
							</div>
							
							<div class="row">
								<div class="grid-slide-2">
									@foreach($premiumVacancies as $premiumVacancy)
									<!-- Single Freelancer & Premium job -->
									<div class="top-candidate-box">
										<div class="popular-jobs-container">
											<div class="popular-jobs-box">
												<span class="popular-jobs-status bg-success">{{$premiumVacancy->type}}</span>
												<h6 class="flc-rate"></h6>
												<div class="popular-jobs-box">
													<div class="popular-jobs-box-detail">
														<h4>{{ str_limit(strip_tags(ucwords($premiumVacancy->company)), 21) }}</h4>
														<span class="desination"><a href="{{ route('vacancies.detail',[$premiumVacancy->id,$premiumVacancy->slug]) }}" target="_blank">{{ str_limit(strip_tags(ucwords($premiumVacancy->title)), 40) }}</a></span>
													</div>
												</div>
												<div class="popular-jobs-box-extra">
													<ul>
														<li>{{$premiumVacancy->city}}</li>
														<li>{{$premiumVacancy->province}}</li>														
														{{--<li class="more-skill bg-primary">+3</li>--}}
													</ul>
													<label>
														@if($premiumVacancy->hide_salary=='1')@lang('vacancy.Salary kept confidential') @else
															Min: {{$premiumVacancy->currency}} {{ number_format($premiumVacancy->min_salary, 0, ',', '.') }}/{{$premiumVacancy->salary_type}}
														@endif													
													</label><br>
													<label>{{CountDay($premiumVacancy->created_at,date("Y-m-d"))}} @lang('vacancy.Days Ago')</label>
												</div>
											</div>
											<a href="{{ route('vacancies.detail',[$premiumVacancy->id,$premiumVacancy->slug]) }}" target="_blank" class="btn btn-popular-jobs bt-1">@lang('vacancy.View')</a>
										</div>
									</div>
									@endforeach
								</div>
							</div>
							
						</div>
					</div>

					@includeWhen(auth()->check(), 'layouts.inc.sidebar')
					
					</div>
				</div>
			</section>
			<!-- company full detail End -->
@endsection