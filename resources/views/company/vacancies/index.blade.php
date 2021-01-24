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
		
						@if(Route::is('vacancies.active'))
							<form role="form" name="yo" files="true"  enctype="multipart/form-data" method="GET" action="{{ route('vacancies.active') }}" role="search">
						@endif
						@if(Route::is('vacancies.pending'))
							<form role="form" name="yo" files="true"  enctype="multipart/form-data" method="GET" action="{{ route('vacancies.pending') }}" role="search">
						@endif
						@if(Route::is('vacancies.expire'))
							<form role="form" name="yo" files="true"  enctype="multipart/form-data" method="GET" action="{{ route('vacancies.expire') }}" role="search">
						@endif
						@if(Route::is('vacancies.inactive'))
							<form role="form" name="yo" files="true"  enctype="multipart/form-data" method="GET" action="{{ route('vacancies.inactive') }}" role="search">
						@endif															
						@csrf				
						<div class="col-md-6 col-sm-6">
							<input type="text" id="keyword" name="keyword" class="form-control" value="{{old('keyword')}}" placeholder="@lang('vacancy.Input keyword')...">
						</div>
						<!--<div class="col-md-3 col-sm-3">
							<select class="form-control">
								<option>By Category</option>
								<option>Information Technology</option>
								<option>Mechanical</option>
								<option>Hardware</option>
								</select>
						</div>-->									
						<div class="col-md-1 col-sm-1">
							<?php
								if ($_SERVER['REQUEST_METHOD'] === 'GET') {
									if (isset($_GET['search'])) {
										?>
										<button type="submit" class="btn btn-primary" id="refresh" name="refresh"><i class="fa fa-refresh"></i></button>
										<?php
									} else {
										?>
										<button type="submit" class="btn btn-primary" id="search" name="search"><i class="fa fa-search"></i></button>
										<?php
									}
								}
								else{
									?>
									<button type="submit" class="btn btn-primary" id="search" name="search"><i class="fa fa-search"></i></button>
									<?php
								}
								?>
						</div>									
						<div class="col-md-5 col-sm-5">
							<ol class="breadcrumb pull-right">
								<li><a href="{{route('company.dashboard')}}"><i class="fa fa-home"></i></a></li>
								
									@if(Route::is('vacancies.active'))
										<li>@lang('vacancy.Active Jobs')</li>
										<li><a href="{{route('vacancies.trash')}}"><i class="fa fa-trash"></i> ({{$countVacancyTrash}})</a></li>								
									@endif
									@if(Route::is('vacancies.pending'))
										<li>@lang('vacancy.Pending Jobs')</li>
										<li><a href="{{route('vacancies.trash')}}"><i class="fa fa-trash"></i> ({{$countVacancyTrash}})</a></li>	
										<li><a href="{{route('vacancies.active')}}" class="kyt-font-green" title="@lang('vacancy.Back')"><i class="fa fa-arrow-left"></i></a></li>							
									@endif
									@if(Route::is('vacancies.expire'))
										<li>@lang('vacancy.Expire Jobs')</li>
										<li><a href="{{route('vacancies.trash')}}"><i class="fa fa-trash"></i> ({{$countVacancyTrash}})</a></li>
										<li><a href="{{route('vacancies.active')}}" class="kyt-font-green" title="@lang('vacancy.Back')"><i class="fa fa-arrow-left"></i></a></li>
									
									@endif
									@if(Route::is('vacancies.inactive'))
										<li>@lang('vacancy.Inactive Jobs')</li>
										<li><a href="{{route('vacancies.trash')}}"><i class="fa fa-trash"></i> ({{$countVacancyTrash}})</a></li>							
										<li><a href="{{route('vacancies.active')}}" class="kyt-font-green" title="@lang('vacancy.Back')"><i class="fa fa-arrow-left"></i></a></li>
									@endif
									@if(Route::is('vacancies.trash'))
										<li>@lang('vacancy.Trash')</li>							
										<li><a href="{{route('vacancies.active')}}" class="kyt-font-green" title="@lang('vacancy.Back')"><i class="fa fa-arrow-left"></i></a></li>
								
									@endif								
							</ol>
						</div>
					</form>				
					</div>
				</div>
				<div class="card-body">
					@if(count($vacancies)>0)
						@foreach($vacancies as $vacancy)
							<article class="advance-search-job">
								<div class="row no-mrg">
									<div class="col-md-10 col-sm-10">
										<a href="new-job-detail.html" title="job Detail">
											<div class="advance-search-img-box">
												<button class="btn btn-default">{{$vacancy->application->count()}}</button>
											</div>
										</a>
										<div class="advance-search-caption">
											<a href="{{ route('company.vacancies.detail',[$vacancy->id,$vacancy->slug]) }}" title="Job Dtail" target="_blank"><h4>{{ str_limit(strip_tags(ucwords($vacancy->title)), 50) }}</h4></a>
											<span><strong>Exp:</strong> {{date('d M Y', strtotime($vacancy->closing_date))}}</span>,
											<span> {{$vacancy->type}},</span>
											<span><i class="fa fa-map-marker"></i> @if($vacancy->city_id!=""){{ str_limit(strip_tags(ucwords($vacancy->city)), 15) }}@endif</span>
											@if(Route::is('vacancies.active') or Route::is('vacancies.expire'))
												<p style="font-size:12px;">
													@if($vacancy->application->where('application_status','Unprocessed')->count()>0)
														<a href="{{route('unprocessed',[$vacancy->id,$vacancy->slug])}}"><i class="fa fa-users"></i> @lang('vacancy.Unprocessed'):<strong>{{$vacancy->application->where('application_status','Unprocessed')->count()}}</strong></a>,
													@endif
													
													@if($vacancy->application->where('application_status','Shortlist')->count()>0)
														<a href="{{route('shortlist',[$vacancy->id,$vacancy->slug])}}"><i class="fa fa-users"></i> @lang('vacancy.Shortlist'):<strong>{{$vacancy->application->where('application_status','Shortlist')->count()}}</strong></a>,
													@endif

													@if($vacancy->application->where('application_status','Interview')->count()>0)
														<a href="{{route('interview',[$vacancy->id,$vacancy->slug])}}"><i class="fa fa-users"></i> @lang('vacancy.Interview'):<strong>{{$vacancy->application->where('application_status','Interview')->count()}}</strong></a>,
													@endif

													@if($vacancy->application->where('application_status','Pass')->count()>0)
														<a href="{{route('pass',[$vacancy->id,$vacancy->slug])}}"><i class="fa fa-users"></i> @lang('vacancy.Pass'):<strong>{{$vacancy->application->where('application_status','Pass')->count()}}</strong></a>,
													@endif

													@if($vacancy->application->where('application_status','Not Suitable')->count()>0)
														<a href="{{route('not',[$vacancy->id,$vacancy->slug])}}"><i class="fa fa-users"></i> @lang('vacancy.Not Suitable'):<strong>{{$vacancy->application->where('application_status','Not Suitable')->count()}}</strong></a>,
													@endif												
													
													
													
										
												</p>
											@endif										
									</div>
									</div>
									<!--<div class="col-md-3 col-sm-3">
										<div class="advance-search-job-locat">
											<p><i class="fa fa-map-marker"></i> @if($vacancy->city_id!=""){{ str_limit(strip_tags(ucwords($vacancy->city)), 15) }}@endif</p>
										</div>
									</div>
									-->
									<div class="col-md-2 col-sm-2">
										<div class="mng-resume-action">
											@if(empty($vacancy->application->count()))
												<a href="{{ route('vacancies.edit',$vacancy->id) }}" data-toggle="tooltip" title="@lang('vacancy.Change')"><i class="fa fa-edit" style="color:green;font-size:20px;"></i></a>&nbsp;
												<a href="{{ route('vacancies.cancel',$vacancy->id) }}" data-toggle="tooltip" title="@lang('vacancy.Cancel')"><i class="fa fa-remove" style="color:orange;font-size:20px;"></i></a>&nbsp;
												<a href="{{ route('vacancies.delete',$vacancy->id) }}" onclick="return confirm('@lang('vacancy.Do you want to delete it?')')" data-toggle="tooltip" title="@lang('vacancy.Delete')"><i class="fa fa-trash" style="color:orange;font-size:20px;"></i></a>								
											@else
												<a href="{{ route('vacancies.edit',$vacancy->id) }}" data-toggle="tooltip" title="@lang('vacancy.Change')"><i class="fa fa-edit" style="color:green;font-size:20px;"></i></a>&nbsp;
											@endif
											@if(Route::is('vacancies.trash'))
												<a href="{{ route('vacancies.restore',$vacancy->id) }}" onclick="return confirm('@lang('vacancy.Do you want to delete it?')')" data-toggle="tooltip" title="@lang('vacancy.Restore')"><i class="fa fa-undo" style="color:orange;font-size:20px;"></i></a>
												<a href="{{ route('vacancies.destroy',$vacancy->id) }}" onclick="return confirm('@lang('vacancy.Do you want to delete it?')')" data-toggle="tooltip" title="@lang('vacancy.Delete')"><i class="fa fa-trash" style="color:orange;font-size:20px;"></i></a>										
											@endif		
										</div>
									</div>
								</div>
								@if($vacancy->partner=='1')
								<span class="tg-themetag tg-featuretag">Premium</span>
							@endif
							</article>
						@endforeach
					@else
							<article class="advance-search-job">
								<div class="row no-mrg">
									<div class="col-md-10 col-sm-10">
										<div class="advance-search-caption">
											@if(Route::is('vacancies.delete'))
												@if(session()->has('message'))
													<ol class="breadcrumb pull-left">
														<li class="active">
															<i class="fa fa-check"></i> {{ session()->get('message') }}
														</li>
													</ol>	
												@endif
											@else
												<h4>@lang('vacancy.Sorry') ,</h4>
												<span>@lang('vacancy.Empty jobs').</span>											
											@endif	
									</div>
									</div>
								</div>
							</article>					
					@endif						
				</div>
			</div>			
			<div class="row">
				{{$vacancies->render()}}
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