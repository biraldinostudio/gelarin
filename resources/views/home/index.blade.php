@extends('layouts.app')
@section('meta')<meta name="keywords" content="{{ config('app.keyword') }}" />
	<meta name="description" content="{{ config('app.description') }}">
	<meta name="author" content="gelarin.com">	
	<title>{{ config('app.name', 'Gelarin') }} {{ config('app.title') }}</title>	
@endsection
@section('content')
			<!-- Main Banner Section Start -->
			<div class="banner" style="background-image:url({{asset('front/img/home/banner-9.jpg')}});">  
				<div class="container">
					<div class="banner-caption">
							<div class="col-md-12 col-sm-12 banner-text">
								<h1>@lang('home.Explore the Best Jobs')</h1>
								@if(session()->has('statusSession'))
									<br>
									<span class="invalid-feedback" style="color:#2867b2;font-size:12px;background-color:#f5f5f5;">
										:<strong>{{ session()->get('statusSession') }}</strong>
									</span>		
								@endif								
								<form class="form-horizontal" method="GET" action="{{ route('vacancies') }}" role="form" role="search">
									<div class="col-md-4 no-padd">
										 <div class="input-group">
											<input type="text" class="form-control right-bor" id="joblist" name="keyword" placeholder="@lang('home.Keyword: title or employer')..." value="{{request('keyword')}}" autofocus>
										 </div>
									</div>
									<div class="col-md-3 no-padd">
										 <div class="input-group">
										 <select name="type" class="form-control">
											<option value="" data-type=""@if (old('type')=='' or old('type')=='')selected="selected"@endif> @lang('home.All Types')</option>
											@foreach ($working_types as $type)
											<option value="{{ $type->translation_of}}"@if (old('type')==$type->translation_of)selected="selected"@endif> {{ $type->name }} </option>
											@endforeach 
										</select>
										 </div>
									</div>
									
									<div class="col-md-3 no-padd">
										 <div class="input-group">
											<select name="location" id="choose-city" class="form-control">
												<option value="" data-type=""
													@if (request('location')=='' or request('location')==0)
														selected="selected"
													@endif
													> @lang('home.All Locations') 
												</option>
												@foreach ($locations as $prov)
													<option value="{{ $prov->code }}"
															@if (request('location')==$prov->code)
																selected="selected"
															@endif
															> {{ $prov->name }} 
													</option>
												@endforeach
											</select>
										 </div>
									</div>
									
									<div class="col-md-2 no-padd">
										<div class="input-group">
											<button type="submit" class="btn btn-primary">@lang('home.Search Job')</button>
										</div>
									</div>
								</form>
								{{--<div class="video-box">
									<a href="#" class="btn btn-video"><i class="fa fa-play" aria-hidden="true"></i></a>
								</div>--}}
							</div>
					</div>
				</div>
				
				<div class="company-brand">
					<div class="container">
						<div id="company-brands" class="owl-carousel">
							@if(count($companies)>0)
								@foreach($companies as $company)
									<div class="brand-img">
										<img src="{{ asset('storage/uploads/company/logo/'.$company->logo) }}" class="img-responsive" style="height:40px;" title="{{$company->name}}" />
									</div>							
								@endforeach
							@else
								<div class="brand-img">
									<img src="{{asset('front/img/sponsor/microsoft-home.png')}}" class="img-responsive" alt="" />
								</div>
								<div class="brand-img">
									<img src="{{asset('front/img/sponsor/img-home.png')}}" class="img-responsive" alt="" />
								</div>
								<div class="brand-img">
									<img src="{{asset('front/img/sponsor/mothercare-home.png')}}" class="img-responsive" alt="" />
								</div>
								<div class="brand-img">
									<img src="{{asset('front/img/sponsor/paypal-home.png')}}" class="img-responsive" alt="" />
								</div>
								<div class="brand-img">
									<img src="{{asset('front/img/sponsor/serv-home.png')}}" class="img-responsive" alt="" />
								</div>
								<div class="brand-img">
									<img src="{{asset('front/img/sponsor/xerox-home.png')}}" class="img-responsive" alt="" />
								</div>
								<div class="brand-img">
									<img src="{{asset('front/img/sponsor/yahoo-home.png')}}" class="img-responsive" alt="" />
								</div>
								<div class="brand-img">
									<img src="{{asset('front/img/sponsor/mothercare-home.png')}}" class="img-responsive" alt="" />
								</div>
							@endif
						</div>
					</div>
				</div>
				
			</div>
			<div class="clearfix"></div>
			<!-- Main Banner Section End -->
			
			<!-- Job List-->
			<section>
				<div class="container">
					
					<div class="row">
						<div class="main-heading">
							<p>@lang('home.Achieve career opportunities')</p>
							<h2>@lang('home.Job Vacancy') <span>Premium</span></h2>
						</div>
					</div>
					<!--/row-->
					
					<!--Browse Job In Grid-->
					<div class="row extra-mrg">
						
			@if(count($vacancies)>0)
				@foreach($vacancies as $vacancy)						
					<!-- Single New Job -->
                    <div class="col-md-3 col-sm-6">
                        <div class="job-instructor-layout">
							@if($vacancy->partner=='1')<span class="tg-themetag tg-featuretag">Premium</span>@endif							
							<div class="brows-job-type">
								@if($vacancy->working_type_id==1)
									<span class="full-time">
								@endif
								@if($vacancy->working_type_id==2)
									<span class="part-time">
								@endif
								@if($vacancy->working_type_id==3)
									<span class="freelanc">
								@endif
								@if($vacancy->working_type_id==4)
									<span class="freelanc">
								@endif
								@if($vacancy->working_type_id==5)
									<span class="enternship">
								@endif
								@if($vacancy->working_type_id==6)
									<span class="enternship">
								@endif								
									
									{{$vacancy->type}}</span>							
							
							</div>
							<div class="job-instructor-thumb">
								@if(!empty($vacancy->logo))
									<img src="{{ asset('storage/uploads/company/logo/'.$vacancy->logo) }}" class="img-fluid" style="height:150px;" alt="{{$vacancy->company}}"/>
								@else
									<img src="{{asset('front/img/blank/150x150.png') }}" class="img-fluid" alt="{{$vacancy->company}}" style="height:150px;"/> 
								@endif
							</div>
							<div class="job-instructor-content">
								<h4 class="instructor-title"><a href="{{ route('vacancies.detail',[$vacancy->id,$vacancy->slug]) }}" target="_blank">{{ str_limit(strip_tags(ucwords($vacancy->title)), 23) }}</a></h4>
								<div class="instructor-skills">
									<a href="{{route('employers.pages.profiles',[$crypto->encodeHex($vacancy->company_id),$vacancy->company_slug])}}">{{ str_limit(strip_tags(ucwords($vacancy->company)), 25) }}</a>
									<br>
									<i class="fa fa-map-marker"></i> 
									{{ str_limit(strip_tags(ucwords($vacancy->city)), 12) }},
									{{ str_limit(strip_tags(ucwords($vacancy->province)), 16) }}
									<h5 class="instructor-scount kyt-font-kecil">{{CountDay($vacancy->created_at,date("Y-m-d"))}} @lang('home.Days Ago')</h5>
								</div>
							</div>
							<div class="job-instructor-footer">
								<div class="instructor-students">
									@if(auth()->check())
										@if($vacancy->user_id_save==auth()->user()->id  and $vacancy->vacancy_id_save==$vacancy->id or $vacancy->vacancy_id==$vacancy->id and $vacancy->user_id==auth()->user()->id)
										@else
											<a href="{{route('manage.vacancies.store',[$vacancy->idx,$vacancy->slug])}}"><i class="fa fa-save"></i></a>
										@endif
									@else
										<a href="{{route('manage.vacancies.store',[$vacancy->idx,$vacancy->slug])}}"><i class="fa fa-save"></i></a>
									@endif									
								</div>
								<div class="instructor-corses">
									<span class="c-counting">
									@if(auth()->check())
										@if($vacancy->vacancy_id==$vacancy->id and $vacancy->user_id==auth()->user()->id)
											{{__('home.Applied')}}
										@else
											<a href="{{route('application.apply',[$vacancy->id,$vacancy->slug])}}" title="@lang('home.Apply for this job application')" style="color:#2867b2;">@lang('home.Apply')</a>
										@endif
									@else
										<a href="{{route('application.apply',[$vacancy->id,$vacancy->slug])}}" title="@lang('home.Apply for this job application')" style="color:#2867b2;">@lang('home.Apply')</a>										
									@endif		
									
									</span>
								</div>
							</div>
						</div>
                    </div>
				@endforeach
				@endif	
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- Latest Job End-->
			
			<!-- start Call To Action section -->
			<div class="clearfix"></div>
			<section class="call-to-act">
				<div class="container-fluid">
					<div class="col-md-6 col-sm-6 no-padd bl-dark">
						<div class="call-to-act-caption">
							<h2>@lang('home.Explore the Best Corporate Job Opportunities')</h2>
							<h3>@lang('home.Various information on leading vacancies from various companies, both national and international scale companies, are posted directly by the Company')</h3>
							<a href="{{url('vacancies')}}" class="btn bat-call-to-act">@lang('home.Explore')</a>
						</div>
					</div>
					
					<div class="col-md-6 col-sm-6 no-padd gr-dark">
						<div class="call-to-act-caption">
							<h2>@lang('home.Post Your Company Job Adverts Quickly')</h2>
							<h3>@lang('home.Promotion of career opportunities and information about your company\'s job through Gelarin. Find the best candidates to join you')</h3>
							@guest
								<a href="{{ route('company.login') }}" class="btn bat-call-to-act">@lang('home.Post a Job')</a>
							@else
								<a href="{{ route('vacancies.create') }}" class="btn bat-call-to-act">@lang('home.Post a Job')</a>							
							@endguest
						</div>
					</div>
					
				</div>
			</section>
			<!-- Call To Action section End -->

			<!-- ====================== How It Work ================= -->
			<section class="how-it-works">
				<div class="container">
					
					{{--<div class="row" data-aos="fade-up">
						<div class="col-md-12">
							<div class="main-heading">
								<p>Working Process</p>
								<h2>How It <span>Works</span></h2>
							</div>
						</div>
					</div>--}}
					
					<div class="row">
					
						<div class="col-md-4 col-sm-4">
							<div class="working-process">
								<span class="process-img">
									<img src="{{asset('front/img/home/step-1.png')}}" class="img-responsive" alt="" />
									<span class="process-num">01</span>
								</span>
								<h4>@lang('home.Professional Identity')</h4>
								<p>@lang('home.Build your professional identity online and stay connected with opportunities.')</p>
							</div>
						</div>
						
						<div class="col-md-4 col-sm-4">
							<div class="working-process">
								<span class="process-img">
									<img src="{{asset('front/img/home/step-2.png')}}" class="img-responsive" alt="" />
									<span class="process-num">02</span>
								</span>
								<h4>@lang('home.Your Personal Page')</h4>
								<p>@lang('home.Login to your personal page and view jobs that match you.')</p>
							</div>
						</div>
						
						<div class="col-md-4 col-sm-4">
							<div class="working-process">
								<span class="process-img">
									<img src="{{asset('front/img/home/step-3.png')}}" class="img-responsive" alt="" />
									<span class="process-num">03</span>
								</span>
								<h4>@lang('home.Richer Job Ads')</h4>
								<p>@lang('home.Get Salary Matching, Location Map and Company Insights.')</p>
							</div>
						</div>
						
					</div>
					
				</div>
			</section>
			<div class="clearfix"></div>
			
			<!-- testimonial section Start -->
			<section class="testimonial" id="testimonial">
				<div class="container">
					<div class="row">
						<div class="main-heading">
							<p>@lang('home.What Say Our Client')</p>
							<h2>@lang('home.Our Success') <span>@lang('home.Stories')</span></h2>
						</div>
					</div>
					<!--/row-->
					<div class="row">
						<div id="client-testimonial-slider" class="owl-carousel">
							@if(count($testimonials)>0)
							@foreach($testimonials as $testimonial)
							<div class="client-testimonial">
								<div class="pic">
									<img src="{{ asset('storage/uploads/member/photo/'.$testimonial->photo) }}" alt="">
								</div>
								<p class="client-description">
								{{ str_limit(strip_tags($testimonial->comment), 102) }}
								</p>
								<h3 class="client-testimonial-title">{{ str_limit(strip_tags($testimonial->name), 25) }}</h3>
								<p>{{ str_limit(strip_tags($testimonial->position), 25) }}</p>
								<p>{{ str_limit(strip_tags($testimonial->company), 25) }}</p>
								<ul class="client-testimonial-rating">
									@if($testimonial->value=='1')
									<li class="fa fa-star"></li>										
									<li class="fa fa-star-o"></li>
									<li class="fa fa-star-o"></li>
									<li class="fa fa-star-o"></li>
									<li class="fa fa-star-o"></li>
									@elseif($testimonial->value=='2')
									<li class="fa fa-star"></li>						
									<li class="fa fa-star"></li>
									<li class="fa fa-star-o"></li>
									<li class="fa fa-star-o"></li>
									<li class="fa fa-star-o"></li>									
									@elseif($testimonial->value=='3')
									<li class="fa fa-star"></li>									
									<li class="fa fa-star"></li>
									<li class="fa fa-star"></li>									
									<li class="fa fa-star-o"></li>
									<li class="fa fa-star-o"></li>									
									@elseif($testimonial->value=='4')
									<li class="fa fa-star"></li>
									<li class="fa fa-star"></li>
									<li class="fa fa-star"></li>									
									<li class="fa fa-star"></li>									
									<li class="fa fa-star-o"></li>									
									@elseif($testimonial->value=='5')
									<li class="fa fa-star"></li>
									<li class="fa fa-star"></li>
									<li class="fa fa-star"></li>
									<li class="fa fa-star"></li>									
									<li class="fa fa-star"></li>									
									@else
									<li class="fa fa-star-o"></li>
									<li class="fa fa-star-o"></li>
									<li class="fa fa-star-o"></li>
									<li class="fa fa-star-o"></li>									
									<li class="fa fa-star-o"></li>										
									@endif
								</ul>
							</div>
							@endforeach	
						@endif

						</div>
					</div>
				</div>
			</section>
			<!-- testimonial section End -->
			
			<!-- Work Process Counter Section Start -->
			<section class="wp-process home-three">
				<div class="container">
					<div class="row">
						<div class="main-heading">
							<!--<p>@lang('home.How We Work')</p>-->
							<h2>{!!__('home.Work Process')!!}</h2>
						</div>
					</div>
					<!--/row-->
					
					<div class="col-md-4 col-sm-6">
						<div class="work-process">
							<div class="work-process-icon">
								<span class="icon-edit"></span>
							</div>
							<div class="work-process-caption">
								<h4>@lang('home.Posting Job Vacancies')</h4>
								<p>@lang('home.Post your company\'s job openings, net the best candidates according to predetermined criteria')</p>
							</div>
						</div>
						
						<div class="work-process">
							<div class="work-process-icon">
								<span class="icon-layers"></span>
							</div>
							<div class="work-process-caption">
								<h4>@lang('home.Receive Applicant Data')</h4>
								<p>@lang('home.Receive applicant data through the applicant\'s data page at Gelarin. Check applicants\' resumes for interviews and tests')</p>
							</div>
						</div>
						
						<div class="work-process">
							<div class="work-process-icon">
								<span class="icon-profile-female"></span>
							</div>
							<div class="work-process-caption">
								<h4>@lang('home.Interview Call')</h4>
								<p>@lang('home.Call candidates for interview interviews through the Process Interview page on the Gelarin platform')</p>
							</div>
						</div>						
						
						<div class="work-process">
							<div class="work-process-icon">
								<span class="icon-profile-male"></span>
							</div>
							<div class="work-process-caption">
								<h4>@lang('home.Post Results')</h4>
								<p>@lang('home.Post the results of the selection of applicants who have already passed through the page posting results on Gelarin')</p>
							</div>
						</div>
						
						
					</div>
					
					<div class="col-md-4 hidden-sm">
						<img src="@if(app()->getLocale()=='id'){{asset('front/img/home/gelarin-iphone-id.png')}} @else {{asset('front/img/home/gelarin-iphone-en.png')}} @endif" class="img-responsive" alt="" />
					</div>
					
					<div class="col-md-4 col-sm-6">
						<div class="work-process">
							<div class="work-process-icon">
								<span class="icon-search"></span>
							</div>
							<div class="work-process-caption">
								<h4>@lang('home.Search Job')</h4>
								<p>@lang('home.Filter job openings by category and location. Find the best job for you to choose according to your expertise')</p>
							</div>
						</div>
						
						<div class="work-process">
							<div class="work-process-icon">
								<span class="icon-mobile"></span>
							</div>
							<div class="work-process-caption">
								<h4>@lang('home.Apply Job')</h4>
								<p>@lang('home.If you have found a suitable job, please apply for a job through the Apply Job button at Gelarin')</p>
							</div>
						</div>
						
						<div class="work-process">
							<div class="work-process-icon">
								<span class="icon-envelope"></span>
							</div>
							<div class="work-process-caption">
								<h4>@lang('home.Interview Call')</h4>
								<p>@lang('home.Receive information on calling company job interview invitations directly on the job application status page')</p>
							</div>
						</div>
						
						<div class="work-process">
							<div class="work-process-icon">
								<span class="icon-happy"></span>
							</div>
							<div class="work-process-caption">
								<h4>@lang('home.Results of Job Application')</h4>
								<p>@lang('home.Receive information on calling company job interview invitations directly on the job application status page')</p>
							</div>
						</div>
					</div>
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- Work Process Counter Section End -->
			
			<!-- Download app Section Start -->
			<section class="download-app inverse-bg" style="background:url({{asset('front/img/home/geometric-bg.jpg')}}),linear-gradient(135deg,#2867b2 0%,#2867b2 100%)!important">
				<div class="container text-center">
					<div class="row">
						<div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1">
							<div class="app-content">
							<h2>@lang('home.Download Anywhere')</h2>
							<p>@lang('home.Best oppertunity in your hand')</p>
							<p>@lang('home.Available for all smartphone and desktop platforms. Download now too!.')</p>
								<a href="#" class="btn call-btn"><i class="fa fa-apple"></i>iPhone Store</a>
								<a href="#" class="btn call-btn gps"><i class="fa fa-android"></i>Google Store</a>
							</div>
						</div>
					</div>
					<!--/row-->
				</div>
			</section>
			<!-- Download app Section End -->			
@endsection	