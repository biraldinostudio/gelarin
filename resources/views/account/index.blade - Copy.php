@extends('layouts.app')

@section('content')
<!-- Title Header Start -->
<section class="kyt-header-content">
	<div class="container"></div>
</section>
<div class="clearfix"></div>
<section>
	<div class="container">
		<div class="col-md-8 col-sm-8">
			{{ Breadcrumbs::render('account') }}
			@if(session()->has('blocks'))	
				<div class="container-detail-box">
					<span><label class="enternship pull-left breadcrumb">{{session()->get('blocks')}}</label></span>
					<div class="col-md-7 col-sm-7">
						<div class="apply-job-detail">
							<ul class="job-requirements">
								@if(empty(auth()->user()->userdescription->resume))
									<li><a href="{{route('account.resume.edit')}}">{{__('application.Curriculum Vitae')}}</a></li>
								@endif
								@if(empty(auth()->user()->userdescription->address))
								<li><a href="{{route('account.address.edit')}}">{{__('application.Address')}}</a></li>
								@endif
								@if(empty(auth()->user()->userdescription->photo))								
								<li><a href="{{route('account.photo.edit')}}">{{__('application.Profile Picture')}}</a></li>
								@endif
								@if(empty(auth()->user()->userdescription->jun_school_name))								
								<li><a href="{{route('account.education.edit')}}">{{__('application.Education')}}</a></li>
								@endif
								@if(empty(auth()->user()->userdescription->username))								
								<li><a href="{{route('account.base.edit')}}">{{__('application.Username')}}</a></li>
								@endif
								@if(empty(auth()->user()->userdescription->phone))								
								<li><a href="{{route('account.base.edit')}}">{{__('application.Phone Number')}}</a></li>
								@endif
								@if(empty(auth()->user()->userdescription->gender_id))								
								<li><a href="{{route('account.base.edit')}}">{{__('application.Gender')}}</a></li>							
								@endif
								@if(empty(auth()->user()->userdescription->date_birth))								
								<li><a href="{{route('account.base.edit')}}">{{__('application.Date of Birth')}}</a></li>							
								@endif																
								<li><a href="{{route('account.experience.index')}}">{{__('application.Skill')}}</a></li>														
								<li><a href="{{route('account.job_interest.edit')}}">{{__('application.Job Interest')}}</a></li>															
							</ul>
						</div>
					</div>
				</div>
			@else
				
            <div class="deatil-tab-employ tool-tab">
				<ul class="nav simple nav-tabs" id="simple-design-tab">
					<li class="active"><a href="#about">{{__('account.About')}}</a></li>
					<li><a href="#address">{{__('account.Address')}}</a></li>
				</ul>
				<!-- Start All Sec -->
				<div class="tab-content">
					<div id="about" class="tab-pane fade in active">
						<h3>@lang('account.About Me')</h3>								
						<p>{{ str_limit(strip_tags(ucwords(auth()->user()->userdescription->about)), 800) }}</p>
					</div>
					<!-- End About Sec -->		
					<!-- Start Address Sec -->
					<div id="address" class="tab-pane fade">
						<h3>@lang('account.Address Information')</h3>
						<ul class="job-detail-des">
							<li><span>@lang('account.Address'):</span>{{ str_limit(strip_tags(ucwords(auth()->user()->userdescription->address)), 150) }}</li>
							<li><span>@lang('account.City'):</span>{{ str_limit(strip_tags(ucwords($myCities->name)), 150) }}</li>
							<li><span>@lang('account.Province'):</span>{{ str_limit(strip_tags(ucwords($myProvinces->name)), 150) }}</li>
							<li><span>@lang('account.Country'):</span>{{ str_limit(strip_tags(ucwords($myCountries->name)), 150) }}</li>
							<li><span>@lang('account.Postal Code'):</span>{{ str_limit(strip_tags(ucwords(auth()->user()->userdescription->postal_code)), 150) }}</li>
							<li><span>@lang('account.Phone Number'):</span>{{ str_limit(strip_tags(ucwords(auth()->user()->userdescription->phone)), 150) }}</li>
							<li><span>@lang('account.Email'):</span>{{ str_limit(strip_tags(auth()->user()->email), 150) }}</li>
						</ul>
					</div>
					<!-- End Address Sec -->
				</div>
			</div>
			@endif	
		</div>
		@includeWhen(auth()->check(), 'layouts.inc.sidebar')				
	</div>
</section>
@endsection