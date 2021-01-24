@extends('layouts.app')	
@section('meta')
	<meta name="keywords" content="{{strtolower($users->name)}}" />
	<meta name="description" content="{!! str_limit(strip_tags(ucwords($users->userdescription->about)), 255) !!}">
	<meta name="author" content="gelarin.com">	
	<title>{{str_limit(strip_tags(ucwords($users->name)),50)}} - {{ config('app.name', 'Gelarin') }}</title>	
@endsection	
@section('content')
			<!-- Title Header Start -->
			<section class="inner-header-title" style="background-image:url({{asset('front/img/header-content/banner-4.jpg')}});">
				<div class="container">
					<h1>@lang('global.Candidate Profile')</h1>
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- Title Header End -->
		
		<!-- Candidate Profile Start -->
        <section class="detail-desc advance-detail-pr gray-bg">
            <div class="container">
				<div class="ur-detail-wrap create-kit padd-bot-0">
				
					<div class="row">
						<div class="detail-pic">
							@if(!empty($users->userdescription->photo))
								<img src="{{ asset('storage/uploads/member/photo/'.$users->userdescription->photo) }}" class="img" title="{{ str_limit(strip_tags(ucwords($users->name)), 21) }}" />
							@else
								<img src="{{asset('front/img/default/photo.jpg')}}" class="img" title="{{ str_limit(strip_tags(ucwords($users->name)), 21) }}" />											
						@endif						
						</div>
						{{--<div class="detail-status"><span>Active Now</span></div>--}}
					</div>
					
					<div class="row bottom-mrg">
						<div class="col-md-12 col-sm-12">
							<div class="advance-detail detail-desc-caption">
								<h4>{{ str_limit(strip_tags(ucwords($users->name)), 50) }}</h4><span class="designation">{{ str_limit(strip_tags(ucwords($users->userdescription->profession)), 100) }}</span>
									{{--<ul>

									<li><strong class="j-view">85</strong>New Post</li>
									<li><strong class="j-applied">110</strong>Job Applied</li>
									<li><strong class="j-shared">120</strong>Invitation</li>
									</ul>--}}
							</div>
						</div>
					</div>
					
					<div class="row no-padd">
						<div class="detail pannel-footer">
							<div class="col-md-5 col-sm-5">
								<ul class="detail-footer-social">
									<li><a href="https://www.facebook.com/{{$users->userdescription->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
									<li><a href="https://www.google.com/{{$users->userdescription->google}}" target="_blank"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="https://www.twitter.com/{{$users->userdescription->twitter}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
									<li><a href="https://www.linkedin.com/{{$users->userdescription->linkedin}}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
									<li><a href="https://www.instagram.com/{{$users->userdescription->instagram}}" target="_blank"><i class="fa fa-instagram"></i></a></li>
								</ul>
							</div>
							@if(auth()->user()->id==$users->id)	
							@else
							<div class="col-md-7 col-sm-7">
								<div class="detail-pannel-footer-btn pull-right"><a href="javascript:void(0)" data-toggle="modal" data-target="#apply-job" class="footer-btn grn-btn" title="@lang('global.Send Message')">@lang('global.Send Message')</a><a href="#" class="footer-btn blu-btn" title="@lang('global.Make a Reference')">@lang('global.Make a Reference')</a></div>
							</div>
							@endif
						</div>
					</div>
				</div>
            </div>
        </section>
		
        <section class="full-detail-description full-detail gray-bg">
            <div class="container">
                <div class="col-md-12 col-sm-12">
                    <div class="full-card">
                      <div class="deatil-tab-employ tool-tab">
							<ul class="nav simple nav-tabs" id="simple-design-tab">
								<li class="active"><a href="#about">@lang('auth.About')</a></li>
								{{--<li><a href="#address">@lang('auth.Address')</a></li>--}}
							</ul>
							
							<!-- Start All Sec -->
							<div class="tab-content">
								<div id="about" class="tab-pane fade in active">
									<h3>{{ str_limit(strip_tags(ucwords($users->name)), 21) }}</h3>
									<p>{{ str_limit(strip_tags(ucwords($users->userdescription->about)), 300) }}.</p>
								</div>
								<!-- End About Sec -->
								
								<!-- Start Address Sec -->
								{{--<div id="address" class="tab-pane fade">
									<h3>@lang('auth.Address Info')</h3>
									<ul class="job-detail-des">
										<li><span>@lang('auth.Address'):</span>{{ str_limit(strip_tags(ucwords($users->userdescription->address)), 100) }}</li>
										<li><span>@lang('auth.City'):</span>Mohali</li>
										<li><span>@lang('auth.State'):</span>Punjab</li>
										<li><span>@lang('auth.Country'):</span>India</li>
										<li><span>@lang('auth.Postal Code'):</span>{{$users->userdescription->postal_code}}</li>
										<li><span>@lang('auth.Telephone'):</span>(+{{$users->userdescription->country->phone}}){{$users->userdescription->phone}}</li>
										<li><span>@lang('auth.Fax'):</span>(+{{$users->userdescription->country->phone}}){{$users->userdescription->fax}}</li>
										<li><span>@lang('auth.Email'):</span>{{$users->email}}</li>
									</ul>
								</div>--}}
								<!-- End Address Sec -->
								

								

							</div>
							<!-- Start All Sec -->
						</div>  
                    </div>
                </div>
            </div>
        </section>
		<!-- Candidate Profile End -->
@endsection
@push('styles')

@endpush
@push('scripts')

@endpush			
	
