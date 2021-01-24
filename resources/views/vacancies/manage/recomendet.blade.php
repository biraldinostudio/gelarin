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
								<h2 class="detail-title">@lang('vacancy.Job recommendations')</h2>
								<form role="form" enctype="multipart/form-data" method="GET" action="{{ route('manage.vacancies.recommendet') }}" role="search">
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
								@if(count($jobRecommendations)>0)	
								@foreach($jobRecommendations as $jobRecommendet)
								<article>							
									<div class="mng-resume">
										<div class="col-md-2 col-sm-2">
											<div class="mng-resume-pic">
											<a href="#" target="_blank">
												<img src="{{ asset('storage/uploads/company/logo/'.$jobRecommendet->logo) }}" class="img-responsive" alt="#" /></a>
											</div>
										</div>
										<div class="col-md-8 col-sm-8">
											<div class="mng-resume-name">
												<h4><a href="{{route('vacancies.detail',[$jobRecommendet->id,$jobRecommendet->slug])}}" target="_blank">{{ str_limit(strip_tags(ucwords($jobRecommendet->title)), 50) }}</a> <span class="cand-designation">({{$jobRecommendet->visits}} @lang('vacancy.Visits'))</span></h4>
												<span class="cand-status">{{ str_limit(strip_tags(ucwords($jobRecommendet->company)), 21) }}</span> (<span style="color:#11b719;">{{date($jobRecommendet->date_format, strtotime($jobRecommendet->created_at))}}</span>)<br>
												<span>{{$jobRecommendet->types}}</span>,
												<span>{{ str_limit(strip_tags(ucwords($jobRecommendet->city)), 21) }}<span>						
											</div>
										</div>
										<div class="col-md-2 col-sm-2">
											<div class="mng-resume-action">
												<a href="{{route('application.apply',[$jobRecommendet->id,$jobRecommendet->slug])}}" class="btn advance-search" title="apply">@lang('vacancy.Apply')</a>
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
														<p>@lang('vacancy.Sorry, job recommendations don\'t exist')!</p> 
													</div>
												</div>
											</div>
										</div>
									</div>
								</article>									
								@endif									
							</div>
						<div class="row">
						{{$jobRecommendations->render()}}
						</div>							
							
							<div class="row-bottom">
								<h2 class="detail-title">@lang('vacancy.Job Vacancies Premium')</h2>
								@foreach($premiumVacancies as $premiumVacancy)								
								<!--Browse Job In Grid-->
								<div class="row extra-mrg">
								
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
												<h3><a href="job-detail.html"><a href="{{ route('vacancies.detail',[$premiumVacancy->id,$premiumVacancy->slug]) }}" target="_blank">{{ str_limit(strip_tags(ucwords($premiumVacancy->title)), 40) }}</a></a></h3>
												<p><span>{{ str_limit(strip_tags(ucwords($premiumVacancy->company)), 21) }}</span></p>
											</div>
											<div class="job-position">
												<span class="job-num">{{CountDay($premiumVacancy->created_at,date("Y-m-d"))}} @lang('vacancy.Days Ago')</span>
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
														<p><i class="fa fa-see"></i><a href="{{ route('vacancies.detail',[$premiumVacancy->id,$premiumVacancy->slug]) }}" target="_blank"><i class="fa fa-info-circle"></i>@lang('vacancy.See')</a></p>
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
											@if($premiumVacancy->partner=='1')								
												<span class="tg-themetag tg-featuretag">Premium</span>
											@endif
										</div>
									</div>
		
								</div>
								<!--/.Browse Job In Grid-->
								@endforeach
					
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
@push('styles')

@endpush
@push('scripts')

@endpush			
	
