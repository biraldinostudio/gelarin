@extends('layouts.app')
@section('meta')
	<meta name="keywords" content="{{strtolower($vacancies->title)}},{{strtolower($vacancies->company)}}" />
	<meta name="description" content="{{__('vacancy.Send application as')}} {{$vacancies->title}} {{$vacancies->company}} {!! str_limit(strip_tags(ucwords($vacancies->description)), 255) !!}">
	<meta name="author" content="gelarin.com">	
	<title>{{$vacancies->title}} {{$vacancies->company}} - {{ config('app.name', 'Gelarin') }}</title>	
@endsection	
@section('content')
			<!-- Title Header Start -->
			<section class="inner-header-title" style="background-image:url({{asset('front/img/content/banner-10.jpg')}});">
				<div class="container">
					<h1>@lang('vacancy.Job Detail')</h1>
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- Title Header End -->
			
			<!-- Candidate Detail Start -->
			<section class="detail-desc">
				<div class="container">
				
					<div class="ur-detail-wrap top-lay">
						
						<div class="ur-detail-box">
							
							<div class="ur-thumb">
							@if(!empty($vacancies->logo))
								<img src="{{ asset('storage/uploads/company/logo/'.$vacancies->logo) }}" class="img-responsive" title="{{$vacancies->title}}" />			
							@else	
								<img src="{{asset('front/img/default/120x120.jpg')}}" class="img-responsive" alt="" />
							@endif
							</div>
							<div class="ur-caption">
								<h4 class="ur-title">{{ str_limit(strip_tags(ucwords($vacancies->title)), 50) }}</h4>
								<p class="ur-location"><i class="ti-location-pin mrg-r-5"></i>{{ str_limit(strip_tags(ucwords($vacancies->company_address)), 50) }}, {{$vacancies->cityCompany}},{{$vacancies->provinceCompany}}</p>
								<span class="ur-designation"><i class="ti-home mrg-r-5"></i>{{$vacancies->company}}</span><br>
								<span class="ur-designation"><i class="fa fa-industry mrg-r-5"></i>{{str_replace($removeWords,'',$vacancies->industry)}}</span>					
							</div>
							
						</div>
						
						<div class="ur-detail-btn">
						@if(auth()->check())
							@if($countApplSingles>0)
								<span class="btn btn-default mrg-bot-10 full-width"><i class="ti-check mrg-r-5"></i>@lang('vacancy.Applied')</span><br>							
							@else
								<a href="{{route('application.apply',[$vacancies->id,$vacancies->slug])}}" class="btn btn-warning mrg-bot-10 full-width"><i class="ti-star mrg-r-5"></i>@lang('vacancy.Apply This Job')</a><br>
							@endif
						@else
							<a href="{{route('application.apply',[$vacancies->id,$vacancies->slug])}}" class="btn btn-warning mrg-bot-10 full-width"><i class="ti-star mrg-r-5"></i>@lang('vacancy.Apply This Job')</a><br>
						@endif							
						{{--<a href="#" class="btn btn-info full-width"><i class="ti-linkedin mrg-r-5"></i>Apply With Linkedin</a>--}}						
						</div>
						
					</div>
					
				</div>
			</section>
			
			<!-- Job full detail Start -->
			<section class="full-detail-description full-detail">
				<div class="container">
					<!-- Job Description -->
					<div class="col-md-8 col-sm-12">
						<div class="full-card">
							
							<div class="row row-bottom mrg-0">
								<h2 class="detail-title">@lang('vacancy.Responsibility & Expertise')</h2>
								<p>{!!$vacancies->description!!}</p>
							</div>
							<div class="row row-bottom mrg-0">
								<h2 class="detail-title">@lang('vacancy.Location')</h2>
								<ul class="job-detail-des">
									<li><span>@lang('auth.Address'):</span>{{ str_limit(strip_tags(ucwords($vacancies->address)), 53) }}</li>
									<li><span>@lang('auth.City'):</span>{{$vacancies->city}}</li>
									<li><span>@lang('auth.State'):</span>{{$vacancies->province}}</li>
									<li><span>@lang('auth.Country'):</span>{{$vacancies->country}}</li>
								</ul>
							</div>							
							
							<div class="row row-bottom mrg-0">
								<h2 class="detail-title">@lang('vacancy.Map Location')</h2>
								<div id="map_full_width_one" class="full-width" style="height:400px;"></div>
							</div>
						</div>
					</div>
					<!-- End Job Description -->
					
					<!-- Start Sidebar -->
					<div class="col-md-4 col-sm-12">
						<div class="sidebar right-sidebar">
						{{--
							<div class="side-widget">
								<h2 class="side-widget-title">Job Alert</h2>
								<div class="job-alert">
									<div class="widget-text">
										<form>
											<input type="text" name="keyword" class="form-control" placeholder="Job Keyword">
											<input type="email" name="email" class="form-control" placeholder="Email ID">
											<button type="submit" class="btn btn-alrt">Add Alert</button>
										</form>
									</div>
								</div>
							</div>
						--}}
							{{--
							<div class="side-widget">
								<h2 class="side-widget-title">Advertisment</h2>
								<div class="widget-text padd-0">
									<div class="ad-banner">
										<img src="http://via.placeholder.com/320x285" class="img-responsive" alt="">
									</div>
								</div>
							</div>
							--}}
							<div class="side-widget">
								<h2 class="side-widget-title">@lang('vacancy.Vacancies Overview')</h2>
								<div class="widget-text padd-0">
									<div class="ur-detail-wrap">
										<div class="ur-detail-wrap-body padd-top-20">
											<ul class="ove-detail-list">
											
												<li>
													<i class="ti-wallet"></i>
													<h5>@lang('vacancy.Offerd Salary')</h5>
													<span>
														@if (!auth()->check())
															<a href="{{route('login')}}" style="color:#2867b2;"><strong>@lang('vacancy.Signin')</strong></a> @lang('vacancy.to see salary')
														@else
															@if($vacancies->hide_salary==1) @lang('vacancy.Secret') @else
																<span>{{$vacancies->currency}} {{ number_format($vacancies->min_salary, 2, ',', '.') }} - {{ number_format($vacancies->max_salary, 2, ',', '.') }}/{{$vacancies->salary_type}}</span>
															@endif
														@endif													
													</span>
												</li>
												
												<li>
													<i class="ti-user"></i>
													<h5>@lang('vacancy.Gender')</h5>
													<span>{{$vacancies->gender}}</span>
												</li>
												
												<li>
													<i class="ti-ink-pen"></i>
													<h5>@lang('vacancy.Work Types')</h5>
													<span>{{$vacancies->type}}</span>
												</li>
												
												<li>
													<i class="fa fa-level-up"></i>
													<h5>@lang('vacancy.Career Level')</h5>
													<span>{{$vacancies->level}}</span>
												</li>												
												
												<li>
													<i class="ti-home"></i>
													<h5>@lang('vacancy.Category')</h5>
													<span>{{$vacancies->category}}</span>
												</li>
												
												<li>
													<i class="ti-shield"></i>
													<h5>@lang('vacancy.Experience')</h5>
													<span>{{$vacancies->experience}} @lang('vacancy.Years Experience')</span>
												</li>
												
												<li>
													<i class="ti-book"></i>
													<h5>@lang('vacancy.Qualification')</h5>
													<span>{{str_replace($removeWords,'',$vacancies->education)}}</span>
												</li>
												
											</ul>
										</div>
									</div>
								</div>
							</div>	
							
						</div>
					</div>
					<!-- End Sidebar -->
				</div>
			</section>
			<!-- Job full detail End -->
			
			<!-- More Jobs -->
			<section class="padd-top-20">
				<div class="container">
				
					<div class="row mrg-0">
						<div class="col-md-12 col-sm-12">
							<h3>@lang('vacancy.Related Jobs')</h3>
						</div>
					</div>
					<!--Browse Job In Grid-->
					<div class="row mrg-0">
					@foreach($relatedVacancies as $relatedVacancy)
						<div class="col-md-4 col-sm-6">
							<div class="grid-view brows-job-list">
								<div class="brows-job-company-img">

							@if(!empty($relatedVacancy->logo))
								<img src="{{ asset('storage/uploads/company/logo/'.$relatedVacancy->logo) }}" class="img-responsive" title="{{$relatedVacancy->title}}" />			
							@else	
								<img src="{{asset('front/img/default/120x120.jpg')}}" class="img-responsive" alt="" />
							@endif
								</div>
								<div class="brows-job-position">
									<h3><a href="{{ route('vacancies.detail',[$relatedVacancy->id,$relatedVacancy->slug]) }}">{{ str_limit(strip_tags(ucwords($relatedVacancy->title)), 40) }}</a></h3>
									<p><span>{{ str_limit(strip_tags(ucwords($relatedVacancy->company)), 21) }}</span></p>
								</div>
								<div class="job-position">
									<span class="job-num">{{CountDay($relatedVacancy->created_at,date("Y-m-d"))}} @lang('vacancy.Days Ago')</span>
								</div>
									<br>
									<i class="fa fa-map-marker"></i> 
									{{ str_limit(strip_tags(ucwords($relatedVacancy->city)), 15) }},
									
									{{ str_limit(strip_tags(ucwords($relatedVacancy->province)), 20) }}

								@if($relatedVacancy->working_type_id=='1')
									<div class="brows-job-type">
										<span class="full-time">{{$relatedVacancy->type}}</span>
									</div>
								@elseif($relatedVacancy->working_type_id=='2')
									<div class="brows-job-type">
										<span class="part-time">{{$relatedVacancy->type}}</span>
									</div>
								@elseif($relatedVacancy->working_type_id=='3')
									<div class="brows-job-type">
										<span class="full-time">{{$relatedVacancy->type}}</span>
									</div>
								@elseif($relatedVacancy->working_type_id=='4')
									<div class="brows-job-type">
										<span class="freelanc">{{$relatedVacancy->type}}</span>
									</div>
								@elseif($premiumVacancy->working_type_id=='5')
									<div class="brows-job-type">
										<span class="enternship">{{$premiumVacancy->type}}</span>
									</div>
								@elseif($premiumVacancy->working_type_id=='6')
									<div class="brows-job-type">
										<span class="full-time">{{$premiumVacancy->type}}</span>
									</div>																				
								@endif
								<ul class="grid-view-caption">
									<li>
										<div class="brows-job-location">
											<p><a href="{{ route('vacancies.detail',[$vacancies->id,$vacancies->slug]) }}"><i class="fa fa-info-circle"></i>@lang('vacancy.See')</a></p>
										</div>
									</li>
									<li>
										<p><span class="brows-job-sallery">
											
														@if(auth()->check())
															@if($relatedVacancy->vacancy_id==$relatedVacancy->id and $relatedVacancy->user_id==auth()->user()->id)
																<i class="fa fa-check"></i>{{__('vacancy.Applied')}}
															@else
																<a href="{{route('application.apply',[$vacancies->id,$vacancies->slug])}}" title="@lang('home.Apply for this job application')" style="color:#2867b2;">@lang('vacancy.Apply')</a>
															@endif
														@else
															<a href="{{route('application.apply',[$vacancies->id,$vacancies->slug])}}" title="@lang('home.Apply for this job application')" style="color:#2867b2;">@lang('vacancy.Apply')</a>										
														@endif											
										</span></p>
									</li>
								</ul>
								@if($relatedVacancy->partner=='1')								
								<span class="tg-themetag tg-featuretag">Premium</span>
							@endif
							</div>
						</div>
						@endforeach
					</div>
					<!--/.Browse Job In Grid-->
							<div class="row-bottom">
							{{$relatedVacancies->render()}}
							</div>					
					
				</div>
			</section>
			<!-- More Jobs End -->

@endsection	
@push('styles')

@endpush
@push('scripts')
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmiJjq5DIg_K9fv6RE72OY__p9jz0YTMI"></script>
			<script type="text/javascript">
		var $ = jQuery.noConflict();			
				$('#map_full_width_one').gmap3({
					map: {
						options: {
							zoom: 5,
							center: [<?php echo $vacancies->latitude; ?>, <?php echo $vacancies->longitude; ?>],
							mapTypeControl: true,
							mapTypeControlOptions: {
								style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
							},
							mapTypeId: "style1",
							mapTypeControlOptions: {
								mapTypeIds: [google.maps.MapTypeId.ROADMAP, "style1"]
							},
							navigationControl: true,
							scrollwheel: false,
							streetViewControl: true
						}
					},
					marker: {
						latLng: [<?php echo $vacancies->latitude; ?>, <?php echo $vacancies->longitude; ?>],
						options: {animation:google.maps.Animation.BOUNCE, icon: 'assets/img/marker.png' }
					},
					styledmaptype: {
						id: "style1",
						options: {
							name: "Style 1"
						},

					}
				});

			</script>
@endpush