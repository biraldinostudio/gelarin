<div class="col-lg-4 col-md-4">
	<div class="full-sidebar-wrap">
		@if(Route::is('application.list.unprocessed')or Route::is('application.list.shortlist')or Route::is('application.list.interview')or Route::is('application.list.not')or Route::is('application.list.pass')or Route::is('application.list.cancel'))							
		<!-- Follow Links -->
			<div class="sidebar-widgets">
				<div class="ur-detail-wrap">
					<div class="ur-detail-wrap-header">
						<h4>@lang('global.Application Status')</h4>
					</div>
					<div class="ur-detail-wrap-body">
						<ul class="follow-links">
						@if(Route::is('application.list.unprocessed'))
							<li><a href="{{route('application.list.shortlist')}}">@lang('global.Shortlist')</a><span class="pull-right">{{$countShortlists->count()}}</span></li>
							<li><a href="{{route('application.list.interview')}}">@lang('global.Interview')</a><span class="pull-right">{{$countInterviews->count()}}</span></li>
							<li><a href="{{route('application.list.not')}}">@lang('global.Not Suitable')</a><span class="pull-right">{{$countNots->count()}}</span></li>
							<li><a href="{{route('application.list.pass')}}">@lang('global.Pass')</a><span class="pull-right">{{$countPasss->count()}}</span></li>
							<li><a href="{{route('application.list.cancel')}}">@lang('global.Cancel')</a><span class="pull-right">{{$countCancels->count()}}</span></li>	
						@elseif(Route::is('application.list.shortlist'))
							<li><a href="{{route('application.list.unprocessed')}}">@lang('global.Unprocessed')</a><span class="pull-right">{{$countUnprocesseds->count()}}</span></li>
							<li><a href="{{route('application.list.interview')}}">@lang('global.Interview')</a><span class="pull-right">{{$countInterviews->count()}}</span></li>
							<li><a href="{{route('application.list.not')}}">@lang('global.Not Suitable')</a><span class="pull-right">{{$countNots->count()}}</span></li>
							<li><a href="{{route('application.list.pass')}}">@lang('global.Pass')</a><span class="pull-right">{{$countPasss->count()}}</span></li>
							<li><a href="{{route('application.list.cancel')}}">@lang('global.Cancel')</a><span class="pull-right">{{$countCancels->count()}}</span></li>						
						@elseif(Route::is('application.list.interview'))
							<li><a href="{{route('application.list.unprocessed')}}">@lang('global.Unprocessed')</a><span class="pull-right">{{$countUnprocesseds->count()}}</span></li>
							<li><a href="{{route('application.list.shortlist')}}">@lang('global.Shortlist')</a><span class="pull-right">{{$countShortlists->count()}}</span></li>
							<li><a href="{{route('application.list.not')}}">@lang('global.Not Suitable')</a><span class="pull-right">{{$countNots->count()}}</span></li>
							<li><a href="{{route('application.list.pass')}}">@lang('global.Pass')</a><span class="pull-right">{{$countPasss->count()}}</span></li>
							<li><a href="{{route('application.list.cancel')}}">@lang('global.Cancel')</a><span class="pull-right">{{$countCancels->count()}}</span></li>						
						@elseif(Route::is('application.list.not'))
							<li><a href="{{route('application.list.unprocessed')}}">@lang('global.Unprocessed')</a><span class="pull-right">{{$countUnprocesseds->count()}}</span></li>
							<li><a href="{{route('application.list.shortlist')}}">@lang('global.Shortlist')</a><span class="pull-right">{{$countShortlists->count()}}</span></li>
							<li><a href="{{route('application.list.interview')}}">@lang('global.Interview')</a><span class="pull-right">{{$countInterviews->count()}}</span></li>
							<li><a href="{{route('application.list.pass')}}">@lang('global.Pass')</a><span class="pull-right">{{$countPasss->count()}}</span></li>
							<li><a href="{{route('application.list.cancel')}}">@lang('global.Cancel')</a><span class="pull-right">{{$countCancels->count()}}</span></li>						
						@elseif(Route::is('application.list.pass'))
							<li><a href="{{route('application.list.unprocessed')}}">@lang('global.Unprocessed')</a><span class="pull-right">{{$countUnprocesseds->count()}}</span></li>
							<li><a href="{{route('application.list.shortlist')}}">@lang('global.Shortlist')</a><span class="pull-right">{{$countShortlists->count()}}</span></li>
							<li><a href="{{route('application.list.interview')}}">@lang('global.Interview')</a><span class="pull-right">{{$countInterviews->count()}}</span></li>
							<li><a href="{{route('application.list.not')}}">@lang('global.Not Suitable')</a><span class="pull-right">{{$countNots->count()}}</span></li>
							<li><a href="{{route('application.list.cancel')}}">@lang('global.Cancel')</a><span class="pull-right">{{$countCancels->count()}}</span></li>						
						@elseif(Route::is('application.list.cancel'))
							<li><a href="{{route('application.list.unprocessed')}}">@lang('global.Unprocessed')</a><span class="pull-right">{{$countUnprocesseds->count()}}</span></li>
							<li><a href="{{route('application.list.shortlist')}}">@lang('global.Shortlist')</a><span class="pull-right">{{$countShortlists->count()}}</span></li>
							<li><a href="{{route('application.list.interview')}}">@lang('global.Interview')</a><span class="pull-right">{{$countInterviews->count()}}</span></li>
							<li><a href="{{route('application.list.not')}}">@lang('global.Not Suitable')</a><span class="pull-right">{{$countNots->count()}}</span></li>
							<li><a href="{{route('application.list.pass')}}">@lang('global.Pass')</a><span class="pull-right">{{$countPasss->count()}}</span></li>
						@endif		
						</ul>
					</div>
				</div>
			</div>
			<!-- /Working Days -->
			<!-- Say Hello -->
			@if($ads->count()>0)
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
			@endif
		@endif
		@if(Route::is('application.message'))
			<!-- Make An Offer -->
			<div class="sidebar-container">
				<div class="sidebar-box">
					<span class="sidebar-status">{{__('application.Detail')}}</span>
						{{--<h4 class="flc-rate"></h4>--}}
					<div class="sidebar-inner-box">
						<div class="sidebar-box-thumb">
							<img src="{{ asset('storage/uploads/company/logo/'.$applications->vacancy->company->logo) }}" class="img-responsive img-circle"/>
						</div>
						<div class="sidebar-box-detail">
							<h4>{{$applications->vacancy->company->name}}</h4>
							{{--<span class="desination"></span>--}}
						</div>
					</div>
				{{--<div class="sidebar-box-extra">
						<ul>
							<li>Php</li>
							<li>Android</li>
							<li>Html</li>
							<li class="more-skill bg-primary">+3</li>
						</ul>
						<ul class="status-detail">
							<li class="br-1"><strong>$44/hr</strong>Hourly Rate</li>
							<li class="br-1"><strong>52 Jobs</strong>Done job</li>
							<li><strong>44</strong>Rehired</li>
						</ul>
					</div>--}}
				</div>
				{{--<a href="#" class="btn btn-sidebar bt-1 bg-success">{{__('application.Company Details')}}</a>--}}
			</div>
			<div class="sidebar-widgets">
				<div class="ur-detail-wrap">
					<div class="ur-detail-wrap-header">
						<h4>@lang('global.Application Status')</h4>
					</div>
					<div class="ur-detail-wrap-body">
						<ul class="follow-links">
							<li>
								<a href="{{route('application.list.unprocessed')}}">@lang('global.Unprocessed')</a><span class="pull-right">{{$countUnprocesseds->count()}}</span>	
							</li>
							<li>
								<a href="{{route('application.list.shortlist')}}">@lang('global.Shortlist')</a><span class="pull-right">{{$countShortlists->count()}}</span>
							</li>
							<li>
								<a href="{{route('application.list.interview')}}">@lang('global.Interview')</a><span class="pull-right">{{$countInterviews->count()}}</span>
							</li>
							<li>
								<a href="{{route('application.list.not')}}">@lang('global.Not Suitable')</a><span class="pull-right">{{$countNots->count()}}</span>
							</li>
							<li>
								<a href="{{route('application.list.pass')}}">@lang('global.Pass')</a><span class="pull-right">{{$countPasss->count()}}</span>
							</li>
							<li>
								<a href="{{route('application.list.cancel')}}">@lang('global.Cancel')</a><span class="pull-right">{{$countCancels->count()}}</span>
							</li>	
						</ul>
					</div>
				</div>
			</div>			
		<!-- /Say Hello -->
	@endif

	<!--  Sidebar Account -->
	@if(Route::is('account')or Route::is('account.base.edit')or Route::is('account.aboutme.edit')or Route::is('account.address.edit')
		or Route::is('account.aboutme.edit')or Route::is('account.education.edit')or Route::is('account.experience.index')
		or Route::is('account.resume.edit')or Route::is('account.job_interest.edit')or Route::is('account.socialmedia.edit')
		or Route::is('account.photo.edit'))
		<!-- Make An Offer -->
		<div class="sidebar-container">
			<div class="sidebar-box">
				@if(Route::is('account.photo.edit'))
				@else	
					<h4 class="flc-rate"><a href="{{route('account.photo.edit')}}"><i class="fa fa-pencil"></i></a></h4>
				@endif				
				<div class="sidebar-inner-box">
					<div class="sidebar-box-thumb">
						<img src="{{ asset('storage/uploads/member/photo/'.auth()->user()->userdescription->photo) }}" class="img-responsive"/>
					</div>
					<div class="sidebar-box-detail">
						<h4>{{ str_limit(strip_tags(ucwords(auth()->user()->name)), 24) }}</h4>
						<span class="desination">{{ str_limit(strip_tags(auth()->user()->email), 33) }}</span>
					</div>
				</div>
			</div>
		</div>
		<!-- Similar Profile -->
		<div class="sidebar-wrapper">
			<div class="ur-detail-wrap-body">
				<ul class="working-days">
					@if(Route::is('account'))
						<li><a href="{{route('account.base.edit')}}"><i class="fa fa-info"></i> {{__('account.Basic Information')}}</a><span></span></li>
						<li><a href="{{route('account.aboutme.edit')}}"><i class="fa fa-user"></i> {{__('account.About Me')}}</a><span></span></li>						
						<li><a href="{{route('account.address.edit')}}"><i class="fa fa-map-marker"></i> {{__('account.Address')}}</a><span></span></li>						
						<li><a href="{{route('account.education.edit')}}"><i class="fa fa-graduation-cap"></i> {{__('account.Education')}}</a><span></span></li>					
						<li><a href="{{route('account.experience.index')}}"><i class="fa fa-history"></i> {{__('account.Experience & Skill')}}</a><span></span></li>							
						<li><a href="{{route('account.resume.edit')}}"><i class="fa fa-file"></i> {{__('account.Curriculum Vitae')}}</a><span></span></li>
						<li><a href="{{route('account.job_interest.edit')}}"><i class="fa fa-briefcase"></i> {{__('account.Job Required')}}</a><span></span></li>
						<li><a href="{{route('account.socialmedia.edit')}}"><i class="fa fa-group"></i> {{__('account.Social Media')}}</a><span></span></li>				
					@elseif(Route::is('account.base.edit'))
						<li><a href="{{route('account')}}"><i class="fa fa-home"></i> {{__('account.My Account')}}</a><span></span></li>
						<li><a href="{{route('account.aboutme.edit')}}"><i class="fa fa-user"></i> {{__('account.About Me')}}</a><span></span></li>						
						<li><a href="{{route('account.address.edit')}}"><i class="fa fa-map-marker"></i> {{__('account.Address')}}</a><span></span></li>						
						<li><a href="{{route('account.education.edit')}}"><i class="fa fa-graduation-cap"></i> {{__('account.Education')}}</a><span></span></li>					
						<li><a href="{{route('account.experience.index')}}"><i class="fa fa-history"></i> {{__('account.Experience & Skill')}}</a><span></span></li>
						<li><a href="{{route('account.resume.edit')}}"><i class="fa fa-file"></i> {{__('account.Curriculum Vitae')}}</a><span></span></li>							
						<li><a href="{{route('account.job_interest.edit')}}"><i class="fa fa-briefcase"></i> {{__('account.Job Required')}}</a><span></span></li>
						<li><a href="{{route('account.socialmedia.edit')}}"><i class="fa fa-group"></i> {{__('account.Social Media')}}</a><span></span></li>						
					@elseif(Route::is('account.aboutme.edit'))
						<li><a href="{{route('account.base.edit')}}"><i class="fa fa-info"></i> {{__('account.Basic Information')}}</a><span></span></li>						
						<li><a href="{{route('account.address.edit')}}"><i class="fa fa-map-marker"></i> {{__('account.Address')}}</a><span></span></li>						
						<li><a href="{{route('account.education.edit')}}"><i class="fa fa-graduation-cap"></i> {{__('account.Education')}}</a><span></span></li>					
						<li><a href="{{route('account.experience.index')}}"><i class="fa fa-history"></i> {{__('account.Experience & Skill')}}</a><span></span></li>
						<li><a href="{{route('account.resume.edit')}}"><i class="fa fa-file"></i> {{__('account.Curriculum Vitae')}}</a><span></span></li>							
						<li><a href="{{route('account.job_interest.edit')}}"><i class="fa fa-briefcase"></i> {{__('account.Job Required')}}</a><span></span></li>						
						<li><a href="{{route('account.socialmedia.edit')}}"><i class="fa fa-group"></i> {{__('account.Social Media')}}</a><span></span></li>						
					@elseif(Route::is('account.address.edit'))
						<li><a href="{{route('account')}}"><i class="fa fa-home"></i> {{__('account.My Account')}}</a><span></span></li>
						<li><a href="{{route('account.base.edit')}}"><i class="fa fa-info"></i> {{__('account.Basic Information')}}</a><span></span></li>
						<li><a href="{{route('account.aboutme.edit')}}"><i class="fa fa-user"></i> {{__('account.About Me')}}</a><span></span></li>							
						<li><a href="{{route('account.education.edit')}}"><i class="fa fa-graduation-cap"></i> {{__('account.Education')}}</a><span></span></li>					
						<li><a href="{{route('account.experience.index')}}"><i class="fa fa-history"></i> {{__('account.Experience & Skill')}}</a><span></span></li>
						<li><a href="{{route('account.resume.edit')}}"><i class="fa fa-file"></i> {{__('account.Curriculum Vitae')}}</a><span></span></li>							
						<li><a href="{{route('account.job_interest.edit')}}"><i class="fa fa-briefcase"></i> {{__('account.Job Required')}}</a><span></span></li>							
						<li><a href="{{route('account.socialmedia.edit')}}"><i class="fa fa-group"></i> {{__('account.Social Media')}}</a><span></span></li>						
					@elseif(Route::is('account.education.edit'))
						<li><a href="{{route('account')}}"><i class="fa fa-home"></i> {{__('account.My Account')}}</a><span></span></li>						
						<li><a href="{{route('account.base.edit')}}"><i class="fa fa-info"></i> {{__('account.Basic Information')}}</a><span></span></li>
						<li><a href="{{route('account.aboutme.edit')}}"><i class="fa fa-user"></i> {{__('account.About Me')}}</a><span></span></li>						
						<li><a href="{{route('account.address.edit')}}"><i class="fa fa-map-marker"></i> {{__('account.Address')}}</a><span></span></li>							
						<li><a href="{{route('account.experience.index')}}"><i class="fa fa-history"></i> {{__('account.Experience & Skill')}}</a><span></span></li>
						<li><a href="{{route('account.resume.edit')}}"><i class="fa fa-file"></i> {{__('account.Curriculum Vitae')}}</a><span></span></li>							
						<li><a href="{{route('account.job_interest.edit')}}"><i class="fa fa-briefcase"></i> {{__('account.Job Required')}}</a><span></span></li>							
						<li><a href="{{route('account.socialmedia.edit')}}"><i class="fa fa-group"></i> {{__('account.Social Media')}}</a><span></span></li>						
					@elseif(Route::is('account.experience.index'))
						<li><a href="{{route('account')}}"><i class="fa fa-home"></i> {{__('account.My Account')}}</a><span></span></li>						
						<li><a href="{{route('account.base.edit')}}"><i class="fa fa-info"></i> {{__('account.Basic Information')}}</a><span></span></li>
						<li><a href="{{route('account.aboutme.edit')}}"><i class="fa fa-user"></i> {{__('account.About Me')}}</a><span></span></li>							
						<li><a href="{{route('account.address.edit')}}"><i class="fa fa-map-marker"></i> {{__('account.Address')}}</a><span></span></li>								
						<li><a href="{{route('account.education.edit')}}"><i class="fa fa-graduation-cap"></i> {{__('account.Education')}}</a><span></span></li>
						<li><a href="{{route('account.resume.edit')}}"><i class="fa fa-file"></i> {{__('account.Curriculum Vitae')}}</a><span></span></li>							
						<li><a href="{{route('account.job_interest.edit')}}"><i class="fa fa-briefcase"></i> {{__('account.Job Required')}}</a><span></span></li>							
						<li><a href="{{route('account.socialmedia.edit')}}"><i class="fa fa-group"></i> {{__('account.Social Media')}}</a><span></span></li>						
					@elseif(Route::is('account.resume.edit'))
						<li><a href="{{route('account')}}"><i class="fa fa-home"></i> {{__('account.My Account')}}</a><span></span></li>						
						<li><a href="{{route('account.base.edit')}}"><i class="fa fa-info"></i> {{__('account.Basic Information')}}</a><span></span></li>
						<li><a href="{{route('account.aboutme.edit')}}"><i class="fa fa-user"></i> {{__('account.About Me')}}</a><span></span></li>							
						<li><a href="{{route('account.address.edit')}}"><i class="fa fa-map-marker"></i> {{__('account.Address')}}</a><span></span></li>								
						<li><a href="{{route('account.education.edit')}}"><i class="fa fa-graduation-cap"></i> {{__('account.Education')}}</a><span></span></li>
						<li><a href="{{route('account.experience.index')}}"><i class="fa fa-history"></i> {{__('account.Experience & Skill')}}</a><span></span></li>							
						<li><a href="{{route('account.job_interest.edit')}}"><i class="fa fa-briefcase"></i> {{__('account.Job Required')}}</a><span></span></li>							
						<li><a href="{{route('account.socialmedia.edit')}}"><i class="fa fa-group"></i> {{__('account.Social Media')}}</a><span></span></li>
					@elseif(Route::is('account.job_interest.edit'))
						<li><a href="{{route('account')}}"><i class="fa fa-home"></i> {{__('account.My Account')}}</a><span></span></li>						
						<li><a href="{{route('account.base.edit')}}"><i class="fa fa-info"></i> {{__('account.Basic Information')}}</a><span></span></li>
						<li><a href="{{route('account.aboutme.edit')}}"><i class="fa fa-user"></i> {{__('account.About Me')}}</a><span></span></li>							
						<li><a href="{{route('account.address.edit')}}"><i class="fa fa-map-marker"></i> {{__('account.Address')}}</a><span></span></li>								
						<li><a href="{{route('account.education.edit')}}"><i class="fa fa-graduation-cap"></i> {{__('account.Education')}}</a><span></span></li>							
						<li><a href="{{route('account.experience.index')}}"><i class="fa fa-history"></i> {{__('account.Experience & Skill')}}</a><span></span></li>
						<li><a href="{{route('account.resume.edit')}}"><i class="fa fa-file"></i> {{__('account.Curriculum Vitae')}}</a><span></span></li>							
						<li><a href="{{route('account.socialmedia.edit')}}"><i class="fa fa-group"></i> {{__('account.Social Media')}}</a><span></span></li>						
					@elseif(Route::is('account.socialmedia.edit'))
						<li><a href="{{route('account')}}"><i class="fa fa-home"></i> {{__('account.My Account')}}</a><span></span></li>						
						<li><a href="{{route('account.base.edit')}}"><i class="fa fa-info"></i> {{__('account.Basic Information')}}</a><span></span></li>
						<li><a href="{{route('account.aboutme.edit')}}"><i class="fa fa-user"></i> {{__('account.About Me')}}</a><span></span></li>							
						<li><a href="{{route('account.address.edit')}}"><i class="fa fa-map-marker"></i> {{__('account.Address')}}</a><span></span></li>								
						<li><a href="{{route('account.education.edit')}}"><i class="fa fa-graduation-cap"></i> {{__('account.Education')}}</a><span></span></li>							
						<li><a href="{{route('account.experience.index')}}"><i class="fa fa-history"></i> {{__('account.Experience & Skill')}}</a><span></span></li>
						<li><a href="{{route('account.resume.edit')}}"><i class="fa fa-file"></i> {{__('account.Curriculum Vitae')}}</a><span></span></li>						
					@elseif(Route::is('account.photo.edit'))
						<li><a href="{{route('account')}}"><i class="fa fa-home"></i> {{__('account.My Account')}}</a><span></span></li>						
						<li><a href="{{route('account.base.edit')}}"><i class="fa fa-info"></i> {{__('account.Basic Information')}}</a><span></span></li>
						<li><a href="{{route('account.aboutme.edit')}}"><i class="fa fa-user"></i> {{__('account.About Me')}}</a><span></span></li>							
							<li><a href="{{route('account.address.edit')}}"><i class="fa fa-map-marker"></i> {{__('account.Address')}}</a><span></span></li>								
							<li><a href="{{route('account.education.edit')}}"><i class="fa fa-graduation-cap"></i> {{__('account.Education')}}</a><span></span></li>							
							<li><a href="{{route('account.experience.index')}}"><i class="fa fa-history"></i> {{__('account.Experience & Skill')}}</a><span></span></li>
							<li><a href="{{route('account.resume.edit')}}"><i class="fa fa-file"></i> {{__('account.Curriculum Vitae')}}</a><span></span></li>							
							<li><a href="{{route('account.socialmedia.edit')}}"><i class="fa fa-group"></i> {{__('account.Social Media')}}</a><span></span></li>							
						@endif
					</ul>
			</div>	
		</div>
@endif

@if(Route::is('manage.vacancies'))
		<!-- Follow Links -->
			<div class="sidebar-widgets">
				<div class="ur-detail-wrap">
					<div class="ur-detail-wrap-header">
						<h4>@lang('global.Application Status')</h4>
					</div>
					<div class="ur-detail-wrap-body">
						<ul class="follow-links">
							<li>
								<a href="{{route('application.list.unprocessed')}}">@lang('global.Unprocessed')</a><span class="pull-right">{{$countUnprocesseds->count()}}</span>	
							</li>
							<li>
								<a href="{{route('application.list.shortlist')}}">@lang('global.Shortlist')</a><span class="pull-right">{{$countShortlists->count()}}</span>
							</li>
							<li>
								<a href="{{route('application.list.interview')}}">@lang('global.Interview')</a><span class="pull-right">{{$countInterviews->count()}}</span>
							</li>
							<li>
								<a href="{{route('application.list.not')}}">@lang('global.Not Suitable')</a><span class="pull-right">{{$countNots->count()}}</span>
							</li>
							<li>
								<a href="{{route('application.list.pass')}}">@lang('global.Pass')</a><span class="pull-right">{{$countPasss->count()}}</span>
							</li>
							<li>
								<a href="{{route('application.list.cancel')}}">@lang('global.Cancel')</a><span class="pull-right">{{$countCancels->count()}}</span>
							</li>	
						</ul>
					</div>
				</div>
			</div>
			<!-- /Working Days -->
		<!-- /Working Days -->
								
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
@endif

	@if(Route::is('manage.vacancies.recommendet')or Route::is('manage.vacancies.offer'))
		<!-- Working Days -->
		<div class="sidebar-widgets">
			<div class="ur-detail-wrap">
				<div class="ur-detail-wrap-header">
					<h4>@lang('vacancy.Job Vacancy')</h4>
				</div>
				<div class="ur-detail-wrap-body">
					<ul class="working-days">
						<li><a href="{{route('manage.vacancies')}}">@lang('auth.Saved Vacancies')</a><span>{{$vacancySaveCounts}}</span></li>
						<li><a href="{{route('application.list.unprocessed')}}">@lang('auth.Job Application')<span>{{$applicationCounts}}</span></li>
					</ul>
				</div>
			</div>	
		</div>
		<!-- /Working Days -->
							
	@if($ads->count()>0)
		<!-- Say Hello -->
		<div class="sidebar-widgets">
			<div class="ur-detail-wrap">
				<div class="ur-detail-wrap-header">
					<h4>Get In Touch</h4>
				</div>
				<div class="ur-detail-wrap-body">
					<div class="side-widget">
						<h2 class="side-widget-title">Sponsor</h2>
						<div class="widget-text padd-0">
							@foreach($ads as $ad)
								<div class="ad-banner">
									<a href="http://{{url($ad->link)}}" target="_blank"><img src="{{ asset('storage/uploads/banner/'.$ad->banner) }}" class="img-responsive" alt="{{$ad->title}}"></a>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>						
		</div>
		<!-- /Say Hello -->
	@else
	@endif	
@endif
	</div>
</div>