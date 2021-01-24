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
			
			<!-- Freelancer Detail Start -->
			<section>
				<div class="container">
					<div class="row">
						
						<div class="col-lg-8 col-md-8">
							
							<div class="row-bottom">
								<h2 class="detail-title">
									@if(Route::is('manage.article.index'))
										@lang('global.Articles approved')
									@endif
									@if(Route::is('manage.article.pending'))
										@lang('global.Article waiting')
									@endif
									@if(Route::is('manage.article.inactived'))
										@lang('global.Disabled article')
									@endif	
									@if(Route::is('manage.article.archived'))
										@lang('global.Article archive')
									@endif
									@if(Route::is('manage.article.trash'))
										@lang('global.Trash')
									@endif									
								</h2>								
								@if(Route::is('manage.article.index'))
									<form role="form" enctype="multipart/form-data" method="POST" action="{{ route('manage.article.index') }}" role="search">
								@endif
								@if(Route::is('manage.article.pending'))
									<form role="form" enctype="multipart/form-data" method="POST" action="{{ route('manage.article.pending') }}" role="search">
								@endif
								@if(Route::is('manage.article.inactived'))
									<form role="form" enctype="multipart/form-data" method="POST" action="{{ route('manage.article.inactived') }}" role="search">
								@endif
								@if(Route::is('manage.article.archived'))
									<form role="form" enctype="multipart/form-data" method="POST" action="{{ route('manage.article.archived') }}" role="search">
								@endif								
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
								@if(session()->has('message'))
									<p style="color:#11b719;">
										{{ session()->get('message') }}
									</p>
								@endif	

							@if(count($articles)>0)
								@foreach($articles as $article)									
								<article>							
									<div class="mng-resume">
										<div class="col-md-2 col-sm-2">
											<div class="mng-resume-pic">
											<a href="{{route('article.detail',[$article->id,$article->slug])}}" target="_blank">
												<img src="{{ asset('storage/uploads/article/'.$article->cover) }}" class="img-responsive" alt="{{ str_limit(strip_tags(ucwords($article->title)), 50) }}" /></a>
											</div>
										</div>
										<div class="col-md-8 col-sm-8">
											<div class="mng-resume-name">
												<h4><a href="{{route('article.detail',[$article->id,$article->slug])}}" target="_blank">{{ str_limit(strip_tags(ucwords($article->title)), 50) }}</a></h4>
												<span class="cand-designation">{{$article->visits}} x @lang('global.Visits')</span> <span>({{$article->articlecomment->count()}} @lang('global.Comment'))</span>
											</div>
										</div>
										<div class="col-md-2 col-sm-2">
											<div class="mng-resume-action">
												<a href="{{route('manage.article.edit',[$article->id,$article->slug])}}" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
												<a href="{{route('manage.article.delete',[$article->id,$article->slug])}}" onclick="return confirm('@lang('global.Do you want to delete it?')')" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></a>
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
													<p>@lang('global.Your article does not yet exist')!</p> 
													<a href="{{url('article')}}" class="btn btn-success small-btn">@lang('global.See another article')</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</article>								
							@endif	

								
							</div>
						<div class="row">
						{{$articles->render()}}
						</div>								
							<div class="row-bottom">
								<h2 class="detail-title">@lang('global.Job Vacancies Premium')</h2>
									@foreach($premiumVacancies as $premiumVacancy)
										@if(count($applications)>0)	
											@foreach($applications as $application)
												@if($premiumVacancy->id<>$application->vacancy->id)
												<h4 class="mrg-bot-15">{{--{{$countPremVacancies}}--}} @lang('global.Jobs')</h4>	
												@endif
											@endforeach		
										@endif			
									@endforeach	
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
						
						<div class="col-lg-4 col-md-4">
							<div class="full-sidebar-wrap">
								<!-- Company overview -->
								<div class="sidebar-container">
									<div class="sidebar-box">
										<span class="sidebar-status kyt-sidebar-status"><a href="{{route('manage.article.create')}}"><i class="fa fa-plus"></i> @lang('global.Add Article')</a></span>
									</div>
									<div class="sidebar-box-extra">
									<ul class="status-detail">
										<li class="br-1"><strong>{{ $articles->sum('visits') }}</strong>@lang('global.Visits')</li>
										<li class="br-1"><strong>{{ $artActiveCounts+$artWaitingCounts }}</strong>@lang('global.Article')</li>
										<li><strong>{{ $artActiveCounts}}</strong>@lang('global.Approved')</li>
									</ul>
								</div>								
								</div>
								<!-- /Company overview -->									
								<!-- Working Days -->
								<div class="sidebar-widgets">
								
									<div class="ur-detail-wrap">
										<div class="ur-detail-wrap-header">
											<h4>@lang('global.Review Status')</h4>
										</div>
										<div class="ur-detail-wrap-body">
											<ul class="working-days">
												
										<li>
											<a href="{{route('manage.article.index')}}">@lang('global.Approved')</a>
											<span>{{ $artActiveCounts}}</span>
										</li>
										<li>
											<a href="{{route('manage.article.pending')}}">@lang('global.Waiting')</a>
											<span>{{ $artWaitingCounts}}</span>
										</li>
										<li>
											<a href="{{route('manage.article.archived')}}">@lang('global.Archive')</a>
											<span>{{ $artArchiveCounts}}</span>
										</li>
										<li>
											<a href="{{route('manage.article.inactived')}}">@lang('global.Non-active')</a>
											<span>{{$artUnactiveCounts}}</span>
										</li>
												
											</ul>
										</div>
									</div>
									
								</div>
								<!-- /Working Days -->
								<!-- Company overview -->
								<div class="sidebar-container">
									<div class="sidebar-box">
										<span class="sidebar-status kyt-sidebar-status"><a href="{{route('manage.article.trash')}}"><i class="fa fa-trash"></i> @lang('global.Trash')</a></span>

									</div>
								</div>
								<!-- /Company overview -->								
								@if($ads->count()>0)
								<!-- Say Hello -->
								<div class="sidebar-widgets">
								
									<div class="ur-detail-wrap">
										<div class="ur-detail-wrap-header">
											<h4>Sponsor</h4>
										</div>
										<div class="ur-detail-wrap-body">
									@foreach($ads as $ad)
										<div class="ad-banner">
											<a href="http://{{url($ad->link)}}" target="_blank"><img src="{{ asset('storage/uploads/banner/'.$ad->banner) }}" class="img-responsive" alt="{{$ad->title}}"></a>
										</div>
									@endforeach
										</div>
									</div>
									
								</div>
								<!-- /Say Hello -->
								@else
								@endif	
							
							</div>
						</div>
					
					</div>
				</div>
			</section>
			<!-- company full detail End -->
@endsection
@push('styles')
@endpush
@push('scripts')

@endpush