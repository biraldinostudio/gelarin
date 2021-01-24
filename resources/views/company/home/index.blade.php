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
					@if(Route::is('company.dashboard'))
						<form role="form" name="yo" files="true"  enctype="multipart/form-data" method="GET" action="{{ route('vacancies.active') }}" role="search">
					{{ method_field('PATCH') }}
					@endif	
					
					@csrf
					<div class="row mrg-0">		
						<div class="col-md-7 col-sm-7">
							<input type="text" id="keyword" name="keyword" class="form-control" value="{{old('keyword')}}" placeholder="@lang('global.Input keyword')...">
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
						<div class="col-md-4 col-sm-4">
							<ol class="breadcrumb pull-right">
								<li><a href="{{route('company.dashboard')}}"><i class="fa fa-home"></i></a></li>
								<li>
									@lang('global.Active Jobs')																						
								</li>
										<li><a href="{{route('vacancies.trash')}}"><i class="fa fa-trash"></i> ({{$countVacancyTrash}})</a></li>							
							</ol>
						</div>
					</div>
					</form>
				</div>			
				<div class="card-body">
					@if(!empty($vacancies))
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
											<p style="font-size:12px;">										
													@if($vacancy->application->where('application_status','Unprocessed')->count()>0)
														<i class="fa fa-users"></i>	<a href="{{route('unprocessed',[$vacancy->id,$vacancy->slug])}}">@lang('global.Unprocessed'):<strong>{{$vacancy->application->where('application_status','Unprocessed')->count()}}</strong></a>,
													@endif
													
													@if($vacancy->application->where('application_status','Shortlist')->count()>0)
														<i class="fa fa-users"></i>	<a href="{{route('shortlist',[$vacancy->id,$vacancy->slug])}}">@lang('global.Shortlist'):<strong>{{$vacancy->application->where('application_status','Shortlist')->count()}}</strong></a>,
													@endif

													@if($vacancy->application->where('application_status','Interview')->count()>0)
														<i class="fa fa-users"></i>	<a href="{{route('interview',[$vacancy->id,$vacancy->slug])}}">@lang('global.Interview'):<strong>{{$vacancy->application->where('application_status','Interview')->count()}}</strong></a>,
													@endif

													@if($vacancy->application->where('application_status','Pass')->count()>0)
														<i class="fa fa-users"></i>	<a href="{{route('pass',[$vacancy->id,$vacancy->slug])}}">@lang('global.Pass'):<strong>{{$vacancy->application->where('application_status','Pass')->count()}}</strong></a>,
													@endif

													@if($vacancy->application->where('application_status','Not Suitable')->count()>0)
														<i class="fa fa-users"></i>	<a href="{{route('not',[$vacancy->id,$vacancy->slug])}}">@lang('global.Not Suitable'):<strong>{{$vacancy->application->where('application_status','Not Suitable')->count()}}</strong></a>,
													@endif
											</p>										
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
											@if(!Route::is('vacancies.inactive'))
												<a href="{{ route('vacancies.edit',$vacancy->id) }}" data-toggle="tooltip" title="@lang('global.Change')"><i class="fa fa-edit" style="color:green;font-size:20px;"></i></a>&nbsp;
												@if(empty($vacancy->application->count()))
													<a href="{{ route('vacancies.cancel',$vacancy->id) }}" data-toggle="tooltip" title="@lang('global.Cancel')"><i class="fa fa-remove" style="color:orange;font-size:20px;"></i></a>																					
												@endif
											@else
												<a href="{{ route('vacancies.delete',$vacancy->id) }}" onclick="return confirm('@lang('global.Do you want to delete it?')')" data-toggle="tooltip" title="@lang('global.Delete')"><i class="fa fa-trash" style="color:orange;font-size:20px;"></i></a>											
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
											<a href="{{ route('company.vacancies.detail',[$vacancy->id,$vacancy->slug]) }}" title="Job Dtail" target="_blank"><h4>@lang('Sorry')</h4></a>
											<span>@lang('global.Empty jobs').</span>										
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