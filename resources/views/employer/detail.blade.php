@extends('layouts.app')
@section('meta')
	<meta name="keywords" content="{{strtolower($companies->name)}}" />
	<meta name="description" content="{!! str_limit(strip_tags(ucwords($companies->description)), 255) !!}">
	<meta name="author" content="gelarin.com">	
	<title>{{str_limit(strip_tags(ucwords($companies->name)),50)}} - {{ config('app.name', 'Gelarin') }}</title>	
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
							
							<div class="ur-thumb">
											@if(!empty($companies->logo))
												<img src="{{ asset('storage/uploads/company/logo/'.$companies->logo) }}" class="img-responsive" title="{{$companies->name}}" />
											@else
												<img src="{{asset('front/img/default/cover.jpg') }}" class="img-responsive" title="{{$companies->name}}" />												
											@endif
							</div>
							<div class="ur-caption">
								<h4 class="ur-title">{{str_limit(strip_tags(ucwords($companies->name)),30)}}</h4>
								<p class="ur-location"><i class="ti-location-pin mrg-r-5"></i>{{str_limit(strip_tags(ucwords($companies->address)),40)}},{{str_limit(strip_tags(ucwords($companies->city)),30)}},{{str_limit(strip_tags(ucwords($companies->province)),30)}}</p>
								<span class="ur-designation">({{str_limit(strip_tags(ucwords(str_replace($removeWords,'',$companies->industry))),50)}})</span>
								<div class="rateing">
													@if($companies->rating>0 and $companies->rating<=5)
														<i class="fa fa-star filled"></i>														
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
													@elseif($companies->rating>5 and $companies->rating<=10)	
														<i class="fa fa-star filled"></i>
														<i class="fa fa-star filled"></i>														
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
													@elseif($companies->rating>10 and $companies->rating<=50)
														<i class="fa fa-star filled"></i>
														<i class="fa fa-star filled"></i>														
														<i class="fa fa-star filled"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
													@elseif($companies->rating>50 and $companies->rating<=100)
														<i class="fa fa-star filled"></i>
														<i class="fa fa-star filled"></i>														
														<i class="fa fa-star filled"></i>
														<i class="fa fa-star filled"></i>
														<i class="fa fa-star"></i>
													@elseif($companies->rating>100)
														<i class="fa fa-star filled"></i>
														<i class="fa fa-star filled"></i>														
														<i class="fa fa-star filled"></i>
														<i class="fa fa-star filled"></i>
														<i class="fa fa-star filled"></i>
													@else		
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
													@endif
								</div>
							</div>
							
						</div>
						{{--
						<div class="ur-detail-btn">
							<a href="#" class="btn btn-warning mrg-bot-10 full-width">Follow Now</a><br>
							<a href="#" class="btn btn-primary full-width">Get in Touch</a>
						</div>
						--}}
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
								<h2 class="detail-title">@lang('global.About Company')</h2>
								<p>{{str_limit(strip_tags(ucwords($companies->description)),300)}}</p>
							</div>
							
							<div class="row-bottom">
								<h2 class="detail-title">@lang('global.Vacancies posted')</h2>
								<h4 class="mrg-bot-15">{{$vacancies->count()}} @lang('global.Jobs')</h4>	


									
								<!--Browse Job In Grid-->
								<div class="row extra-mrg">
								@foreach($vacancies as $vacancy)
									<div class="col-md-12 col-sm-12">
										<article>						
											<div class="mng-resume">
												<div class="col-md-10 col-sm-10">
													<div class="mng-resume-name">
														<h4><a href="{{ route('vacancies.detail',[$vacancy->id,$vacancy->slug]) }}" target="_blank">{{ str_limit(strip_tags(ucwords($vacancy->title)), 40) }}</a></h4>
														 <span style="font-size:11px; color:brown;">(<i class="fa fa-clock-o"></i> {{CountDay($vacancy->created_at,date("Y-m-d"))}} @lang('global.Days Ago')</span>)
														<br>
														<span>
															@if($vacancy->working_type_id=='1')
																<span class="alert-success" style="font-size:11px;">{{$vacancy->type}}</span>
															@elseif($vacancy->working_type_id=='2')
																<span class="alert-danger" style="font-size:11px;">{{$vacancy->type}}</span>
															@elseif($vacancy->working_type_id=='3')
																<span class="alert-success" style="font-size:11px;">{{$vacancy->type}}</span>
															@elseif($vacancy->working_type_id=='4')
																<span class="alert-success" style="font-size:11px;">{{$vacancy->type}}</span>
															@elseif($vacancy->working_type_id=='5')
																<span class="alert-warning" style="font-size:11px;">{{$vacancy->type}}</span>
															@elseif($vacancy->working_type_id=='6')															
																<span class="alert-success" style="font-size:11px;">{{$vacancy->type}}</span>
															@endif
														</span>													
													</div>
												</div>
												<div class="col-md-2 col-sm-2">
													<div class="mng-resume-action">
														@if(auth()->check())
															@if($vacancy->vacancy_id==$vacancy->id and $vacancy->user_id==auth()->user()->id)
																{{__('home.Applied')}}
															@else
																<a href="{{route('application.apply',[$vacancy->id,$vacancy->slug])}}" title="@lang('home.Apply for this job application')" style="color:#2867b2;">@lang('home.Apply')</a>
															@endif
														@else
															<a href="{{route('application.apply',[$vacancy->id,$vacancy->slug])}}" title="@lang('home.Apply for this job application')" style="color:#2867b2;">@lang('home.Apply')</a>										
														@endif															
													</div>
												</div>
											</div>
										</article>


									</div>
									@endforeach
								</div>
								<!--/.Browse Job In Grid-->
								
					
							</div>
							<div class="row-bottom">
							{{$vacancies->render()}}
							</div>
							
						</div>
						
						<div class="col-lg-4 col-md-4">
							<div class="full-sidebar-wrap">
								
								<!-- Company overview -->
								<div class="sidebar-widgets">
								
									<div class="ur-detail-wrap">
										<div class="ur-detail-wrap-header">
											<h4>@lang('global.Company Overview')</h4>
										</div>
										<div class="ur-detail-wrap-body">
											<ul class="ove-detail-list">
											
												<li>
													<i class="ti-ruler-pencil"></i>
													<h5>@lang('global.Working Hours')</h5>
													<span>{{$companies->time}}</span>
												</li>
												
												<li>
													<i class="ti-user"></i>
													<h5>@lang('global.Employees')</h5>
													<span>{{$companies->size}} @lang('global.People')</span>
												</li>
												
												<li>
													<i class="ti-face-smile"></i>
													<h5>@lang('global.Work Uniform')</h5>
													<span>{{$companies->uniform}}</span>
												</li>
												@if($companies->hide_email!='1')
												<li>
													<i class="ti-email"></i>
													<h5>@lang('auth.Email')</h5>
													<span>{{ str_limit(strip_tags(ucwords($companies->email1)), 40) }}</span>
												</li>
												@else
												@endif	
												@if($companies->hide_phone!='1')												
												<li>
													<i class="ti-mobile"></i>
													<h5>@lang('auth.Telephone')</h5>
													<span>+{{$companies->phone_code}}{{ str_limit(strip_tags(ucwords($companies->phone1)), 11) }} @if(!empty($companies->phone2))/+{{$companies->phone_code}}{{ str_limit(strip_tags(ucwords($companies->phone2)), 11) }} @else @endif</span>
												</li>
												@else
												@endif	
												
											</ul>
										</div>
									</div>
									
								</div>
								<!-- /Company overview -->
							
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