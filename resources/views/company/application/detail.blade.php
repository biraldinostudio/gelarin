@extends('layouts.company.app')

@section('content')
			
			<!-- Title Header Start -->
			<section class="inner-header-title" style="background-image:url({{asset('front/img/header-content/banner-4.jpg')}});">
				<div class="container">
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
								@if(!empty($appProfiles->photo))
									<img src="{{ asset('storage/uploads/member/photo/'.$appProfiles->photo) }}" class="img-responsive" alt="{{ str_limit(strip_tags(ucwords($appProfiles->name)), 35) }}" style="height:130px;"/>
								@else
									<img src="{{ asset('storage/uploads/member/photo/150x150.png')}}" class="img-responsive"/>									
								@endif
							</div>
							<div class="ur-caption">
								<h4 class="ur-title">{{ str_limit(strip_tags(ucwords($appProfiles->name)), 35) }} ({{$appProfiles->nickname}})</h4>
								<p class="ur-location"><i class="ti-location-pin mrg-r-5"></i>@if(!empty($appProfiles->address)){{ str_limit(strip_tags(ucwords($appProfiles->address)), 35) }} @else - @endif,@if(!empty($appProfiles->city)){{ str_limit(strip_tags(ucwords($appProfiles->city)), 35) }} @else - @endif,@if(!empty($appProfiles->province)){{ str_limit(strip_tags(ucwords($appProfiles->province)), 35) }} @else - @endif,@if(!empty($appProfiles->country)){{ str_limit(strip_tags(ucwords($appProfiles->country)), 35) }} @else - @endif</p>
								<span class="ur-designation">@if(!empty($appProfiles->profession)){{ str_limit(strip_tags(ucwords($appProfiles->profession)), 50) }} @else  - @endif</span>
								<div class="rateing">
									<i class="fa fa-star filled"></i>
									<i class="fa fa-star filled"></i>
									<i class="fa fa-star filled"></i>
									<i class="fa fa-star filled"></i>
									<i class="fa fa-star"></i>
								</div>
							</div>
						</div>
						<div class="ur-detail-btn">
							<a href="#" class="btn btn-warning mrg-bot-10 full-width"><i class="ti-thumb-up mrg-r-5"></i>{{__('application.Shortlist')}}</a><br>
							<a href="{{route('download_resume',[$crypto->encodeHex($talents->id),str_slug($talents->name)])}}" class="btn btn-info full-width"><i class="ti-download mrg-r-5"></i>{{__('application.Download CV')}}</a>
						</div>
						
					</div>
					
				</div>
			</section>
			<!-- Candidate Detail End -->
			
			<!-- Candidate full detail Start -->
			<section class="full-detail-description full-detail">
				<div class="container">
					<div class="row">
						
						<div class="col-lg-8 col-md-8">
							
							<div class="row-bottom">
								<h2 class="detail-title">{{__('application.About Candidate')}}</h2>
								<p>@if(!empty($appProfiles->about)){{ str_limit(strip_tags(ucwords($appProfiles->about)), 300) }} @else - @endif</p>
							</div>
							
							<div class="row-bottom">
								<h2 class="detail-title">{{__('application.Education')}}</h2>
								<p>{{__('application.A brief description of the candidate\'s educational background, as a basis for supporting your consideration of recruiting the best talents for you and your company.')}}</p>
								<ul class="trim-edu-list">
									<li>
										<div class="trim-edu">
											<h4 class="trim-edu-title">{{$talents->userdescription->jun_school_name}}<span class="title-est">{{$talents->userdescription->jun_school_start}}-{{$talents->userdescription->jun_school_last}}</span></h4>
											<strong></strong>
											<p></p>
										</div>
									</li>
									<li>
										<div class="trim-edu">
											<h4 class="trim-edu-title">{{$talents->userdescription->sen_school_name}}<span class="title-est">{{$talents->userdescription->sen_school_start}}-{{$talents->userdescription->sen_school_last}}</span></h4>
											<strong></strong>
											<p></p>
										</div>
									</li>									
										@if($appEducations->count()>0)
											@foreach($appEducations as $appEducation)								
									<li>
										<div class="trim-edu">
											<h4 class="trim-edu-title">{{$appEducation->school}}<span class="title-est">{{$appEducation->start_year}}-{{$appEducation->last_year}}</span></h4>
											<strong>{{$appEducation->major}}</strong>
											<p></p>
										</div>
									</li>
									@endforeach
									@else
										<li>-</li>
									@endif
									
								</ul>
							</div>
							
							<div class="row-bottom">
								<h2 class="detail-title">{{__('application.Experience')}}</h2>
								<p>{{__('application.A brief description of the candidate\'s work experience, as a basis for supporting your consideration of recruiting the best talents for you and your company.')}}</p>
								<ul class="trim-edu-list">
										@if($appExperiences->count()>0)
											@foreach($appExperiences as $appExperience)
									<li>
										<div class="trim-edu">
											<h4 class="trim-edu-title">{{$appExperience->company}}<span class="title-est">@if(!empty($appExperience->start_working)){{date($talents->userdescription->country->date_format, strtotime($appExperience->start_working))}}-{{date($talents->userdescription->country->date_format, strtotime($appExperience->last_working))}} @else @endif</span></h4>
											<strong>{{$appExperience->job_position}}</strong>
											<p></p>
										</div>
									</li>
									@endforeach
									@else
										</li></li>
									@endif
									
									
								</ul>
							</div>
							
							<div class="row-bottom">
								<h2 class="detail-title">{{__('application.Skill')}}</h2>
								<p>{{__('application.A brief description of the candidate\'s expertise background, as a basis for supporting your consideration in recruiting the best talents for you and your company.')}}</p>
								<div class="ext-mrg row third-progress">
									<div class="col-md-8 col-sm-8">
										<div class="panel-body">
										@if($appSkills->count()>0)
											@foreach($appSkills as $appSkill)
											<h3 class="progressbar-title">{{$appSkill->skill}}</h3>
											<div class="progress">
												<div class="progress-bar" style="width: {{$appSkill->value}}%; background: #26a9e1;">
													<span class="progress-icon fa fa-plus" style="border-color:#f6931e; color:#f6931e;"></span>
													<div class="progress-value">{{$appSkill->value}}%</div>
												</div>
											</div>
											@endforeach
											@else
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>
					@section('sidebar')
						@include('layouts.company.inc.sidebar')
					@show
					</div>
				</div>
			</section>
			<!-- company full detail End -->


@endsection	
		