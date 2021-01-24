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
								@if(!empty($users->userdescription->photo))
									<img src="{{ asset('storage/uploads/member/photo/'.$users->userdescription->photo) }}" class="img-responsive" alt="{{ str_limit(strip_tags(ucwords($users->name)), 21) }}" />
								@else
									<img src="{{asset('front/img/default/photo.jpg')}}" class="img-responsive" alt="{{ str_limit(strip_tags(ucwords($users->name)), 21) }}" />											
								@endif									
							</div>
							<div class="ur-caption">
								<h4 class="ur-title">{{ str_limit(strip_tags(ucwords($users->name)), 50) }}</h4>
								<p class="ur-location"><i class="ti-location-pin mrg-r-5"></i>{{ str_limit(strip_tags(ucwords($users->userdescription->address)), 100) }},{{ str_limit(strip_tags(ucwords($users->userdescription->city->name)), 100) }},{{ str_limit(strip_tags(ucwords($users->userdescription->city->subadmin1->name)), 100) }}</p>
								<span class="ur-designation">{{ str_limit(strip_tags(ucwords($users->userdescription->profession)), 100) }}</span>
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
						{{--<a href="#" class="btn btn-warning mrg-bot-10 full-width"><i class="ti-thumb-up mrg-r-5"></i>{{__('talent.Offer a Job')}}</a><br>--}}
								@if(!empty($users->userdescription->resume))
								<a href="{{route('talents.download.resume',$crypto->encodeHex($users->id))}}" class="btn btn-info full-width"><i class="ti-download mrg-r-5"></i>{{__('talent.Download CV')}}</a>							
								@else
								<a href="" class="btn btn-default full-width"><i class="ti-download mrg-r-5"></i>{{__('talent.There is no CV')}}</a>										
								@endif	
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
								<h2 class="detail-title">{{__('talent.About Candidate')}}</h2>
								<p>{{ str_limit(strip_tags(ucwords($users->userdescription->about)), 300) }}</p>
							</div>
							
							<div class="row-bottom">
								<h2 class="detail-title">{{__('talent.Education')}}</h2>
								<p>{{__('talent.The candidate\'s educational background is your consideration in recruiting the best candidates to fill the work positions you offer.')}}</p>
								<ul class="trim-edu-list">									
									<li>
										<div class="trim-edu">
											<h4 class="trim-edu-title">{{$users->userdescription->jun_school_name}}<span class="title-est">{{$users->userdescription->jun_school_start}} - {{$users->userdescription->jun_school_last}}</span></h4>
										</div>
									</li>
									<li>
										<div class="trim-edu">
											<h4 class="trim-edu-title">{{$users->userdescription->sen_school_name}}<span class="title-est">{{$users->userdescription->sen_school_start}} - {{$users->userdescription->sen_school_last}}</span></h4>
										</div>
									</li>									
									
`								@foreach($colleges as $college)									
									<li>
										<div class="trim-edu">
											<h4 class="trim-edu-title">{{$college->school}}<span class="title-est">{{$college->start_year}} - {{$college->last_year}}</span></h4>
											<strong>{{$college->major}}</strong>
										</div>
									</li>
								@endforeach	
									
								</ul>
							</div>
							
							<div class="row-bottom">
								<h2 class="detail-title">{{__('talent.Work Experience')}}</h2>
								<p>{{__('talent.The background of the candidate\'s work experience is your consideration in recruiting the best candidates to fill the job position that you offer.')}}</p>
								<ul class="trim-edu-list">
								@foreach($experiences as $experience)
									<li>
										<div class="trim-edu">
											<h4 class="trim-edu-title">{{$experience->company}}<span class="title-est">@if($users->userdescription->country_code==''){{date('d M Y', strtotime($experience->start_working))}}-{{date('d M Y', strtotime($experience->last_working))}} @else {{date($users->userdescription->country->date_format, strtotime($experience->start_working))}} - {{date($users->userdescription->country->date_format, strtotime($experience->last_working))}} @endif</span></h4>
											<strong>{{$experience->job_position}}</strong>
										</div>
									</li>
									@endforeach
								</ul>
							</div>
							
							<div class="row-bottom">
								<h2 class="detail-title">{{__('talent.Skills')}}</h2>
								<p>{{__('talent.The background of the candidate\s expertise is your consideration in recruiting the best candidates to fill the job position you offer.')}}</p>
								<div class="ext-mrg row third-progress">
									<div class="col-md-8 col-sm-8">
										<div class="panel-body">
											@foreach($skills as $skill)
											<h3 class="progressbar-title">{{$skill->skill}}</h3>
											<div class="progress">
												<div class="progress-bar" style="width: {{$skill->value}}%; background: #26a9e1;">
													<span class="progress-icon fa fa-plus" style="border-color:#f6931e; color:#f6931e;"></span>
													<div class="progress-value">{{$skill->value}}%</div>
												</div>
											</div>
											@endforeach
										</div>
									</div>
								</div>
							</div>
							
						</div>
						
						<div class="col-lg-4 col-md-4">
							<div class="full-sidebar-wrap">
								
								<!-- Candidate overview -->
								<div class="sidebar-widgets">
								
									<div class="ur-detail-wrap">
										<div class="ur-detail-wrap-header">
											<h4>{{__('talent.Candidate Overview')}}</h4>
										</div>
										<div class="ur-detail-wrap-body">
											<ul class="ove-detail-list">
											
												<li>
													<i class="ti-wallet"></i>
													<h5>{{__('talent.Profession')}}</h5>
													<span>{{$users->userdescription->profession}}</span>
												</li>
												
												<li>
													<i class="ti-user"></i>
													<h5>Gender</h5>
													<span>@if(!empty($users->userdescription->gender_id))@foreach($genders as $gender)@if($users->userdescription->gender_id==$gender->translation_of) {{$gender->name}} @endif @endforeach @endif</span>
												</li>
												
												<li>
													<i class="ti-ink-pen"></i>
													<h5>{{__('talent.Website')}}</h5>
													<span>@if(!empty($users->userdescription->website)){{$users->userdescription->website}}@else - @endif</span>
												</li>
												
												<li>
													<i class="ti-home"></i>
													<h5>{{__('talent.Age')}}</h5>
													<span>@if(!empty($users->userdescription->date_birth)){{calculate_age($users->userdescription->date_birth)}} @else @endif</span>
												</li>
												
												<li>
													<i class="ti-shield"></i>
													<h5>{{__('talent.Address')}}</h5>
													<span>{{$users->userdescription->address}},{{$users->userdescription->postal_code}}</span>
												</li>
												
												<li>
													<i class="ti-book"></i>
													<h5>{{__('talent.Location')}}</h5>
													<span>{{$users->userdescription->city->name}},{{$users->userdescription->city->subadmin1->name}},{{$users->userdescription->country->name}}</span>
												</li>
												
											</ul>
										</div>
									</div>
									
								</div>
								<!-- /Candidate overview -->
								
								<!-- Say Hello -->
								<div class="sidebar-widgets">
								
									<div class="ur-detail-wrap">
										<div class="ur-detail-wrap-header">
											<h4>{{__('talent.Offer a Job')}}</h4>
										</div>
										<div class="ur-detail-wrap-body">
					@if(session()->has('success'))
						<span class="full-time pull-left breadcrumb">{{session()->get('success')}}</span>					
					@endif
					@if(session()->has('error'))
						<span class="full-time pull-left breadcrumb">{{session()->get('error')}}</span>			
					@endif										
											<form enctype="multipart/form-data" method="POST" action="{{ route('company.vacancyoffer.store') }}" novalidate>
											@csrf
												<div class="form-group">
													<label>{{__('talent.Job')}}</label>
													<select name="vacancyoffer[]" id="vacancyoffer" class="vacancy form-control{{ $errors->has('vacancyoffer') ? ' is-invalid' : '' }}" multiple="multiple" required>
														@foreach ($vacancies as $majora)                                                    
															<option value="{{ $majora->id}}"
																@if(in_array($majora->id , old('vacancyoffer',[])))      
																	selected="selected"
																@endif >{{ $majora->title }}
															</option>
														@endforeach
													</select>
													@error('vacancyoffer')
														<div class="invalid-feedback">{{ $message }}</div>
													@enderror													
													<input type="hidden" name="talent" value="{{$users->id}}">
												</div>
												<button type="submit" class="btn btn-primary">Submit</button>
											</form>
										</div>
									</div>
									
								</div>
								<!-- /Say Hello -->
							
							</div>
						</div>
					
					</div>
				</div>
			</section>
			<!-- company full detail End -->
@endsection
@push('scripts')	
	<script type="text/javascript">	
			// Education
		$(".vacancy").select2({
			placeholder: "{{trans('talent.Select Job')}}"
		});
		</script>
@endpush