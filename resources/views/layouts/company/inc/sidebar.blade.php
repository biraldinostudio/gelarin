					<!-- Sidebar Start -->
					<div class="col-md-3 col-sm-12">
						<div class="sidebar right-sidebar">
						@if(Route::is('talents.pages.profiles'))
								<div class="side-widget">
							<div class="sidebar-box">
								<span class="sidebar-status">Available</span>
								<h4 class="flc-rate">$17/hr</h4>
								<div class="sidebar-inner-box">
									<div class="sidebar-box-thumb">
										@if(!empty($users->userdescription->photo))
											<img src="{{ asset('storage/uploads/member/photo/'.$users->userdescription->photo) }}" class="img-responsive img-circle" title="{{ str_limit(strip_tags(ucwords($users->name)), 21) }}" />
										@else
											<img src="{{asset('front/img/default/photo.jpg')}}" class="img-responsive img-circle" title="{{ str_limit(strip_tags(ucwords($users->name)), 21) }}" />											
										@endif										
									</div>
									<div class="sidebar-box-detail">
										<h4>Daniel Disroyer</h4>
										<span class="desination">App Designer</span>
									</div>
								</div>
								<div class="sidebar-box-extra">
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
								</div>
							</div>
							<a href="#" class="btn btn-sidebar bt-1 bg-success">Shortlist</a>
								</div>							
						@endif	
							@if(auth()->user()->companyofficer->vacancy_posting=='1' and auth()->user()->companyofficer->vacancy_access=='1')						
								<div class="side-widget">
									<h2 class="side-widget-title"><a href="#job_management" data-toggle="collapse"><i class="fa fa-building"></i> @lang('global.Manage Jobs')<i class="pull-right fa fa-angle-double-down" aria-hidden="true"></i></a></h2>
									<div class="widget-text padd-0 @if(Route::is('vacancies.active')or Route::is('vacancies.pending')or Route::is('vacancies.inactive')or Route::is('vacancies.trash')or Route::is('vacancies.expire')or Route::is('vacancies.create')or Route::is('vacancies.edit')or Route::is('vacancies.cancel')or Route::is('unprocessed')or Route::is('message')or Route::is('company.dashboard')) @else collapse @endif" id="job_management">
										<ul>
											<li>
												<a href="{{route('vacancies.create')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i> @lang('global.Add Jobs')</a>
												<span class="pull-right"></span>
											</li>									
											<li>
												<a href="{{route('vacancies.active')}}"><i class="fa fa-check-circle" aria-hidden="true"></i> @lang('global.Active Jobs')</a>
												<span class="pull-right">@if($countVacActives->count()>0){{$countVacActives->count()}} @else 0 @endif</span>
											</li>
											<li>
												<a href="{{route('vacancies.pending')}}"><i class="fa fa-clock-o" aria-hidden="true"></i> @lang('global.Pending Jobs')</a>
												<span class="pull-right">@if($countVacPendings->count()>0){{$countVacPendings->count()}} @else 0 @endif</span>
											</li>
											<li>
												<a href="{{route('vacancies.expire')}}"><i class="fa fa-warning" aria-hidden="true"></i> @lang('global.Expire Jobs')</a>
												<span class="pull-right">@if($countVacExpires->count()>0){{$countVacExpires->count()}} @else 0 @endif</span>
											</li>
											<li>
												<a href="{{route('vacancies.inactive')}}"><i class="fa fa-ban" aria-hidden="true"></i> @lang('global.Inactive Jobs')</a>
												<span class="pull-right">@if($countVacInactives->count()>0){{$countVacInactives->count()}} @else 0 @endif</span>
											</li>
										</ul>
									</div>
								</div>
							@elseif(auth()->user()->companyofficer->vacancy_posting=='1')								
								
								<div class="side-widget">
									<h2 class="side-widget-title"><a href="#job_management" data-toggle="collapse"><i class="fa fa-users"></i> @lang('global.Company Staff')<i class="pull-right fa fa-angle-double-down" aria-hidden="true"></i></a></h2>
									<div class="widget-text padd-0 @if(Route::is('vacancies.active')or Route::is('vacancies.pending')or Route::is('vacancies.inactive')or Route::is('vacancies.trash')or Route::is('vacancies.expire')or Route::is('vacancies.create')or Route::is('vacancies.edit')or Route::is('vacancies.cancel')) @else collapse @endif" id="job_management">
										<ul>
											<li>
												<a href="{{route('vacancies.create')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i> @lang('global.Add Jobs')</a>
												<span class="pull-right"></span>
											</li>									
										</ul>
									</div>
								</div>								
								
							@elseif(auth()->user()->companyofficer->vacancy_access=='1')	
								<div class="side-widget">
									<h2 class="side-widget-title"><a href="#job_management" data-toggle="collapse"><i class="fa fa-users"></i> @lang('global.Company Staff')<i class="pull-right fa fa-angle-double-down" aria-hidden="true"></i></a></h2>
									<div class="widget-text padd-0 @if(Route::is('vacancies.active')or Route::is('vacancies.pending')or Route::is('vacancies.inactive')or Route::is('vacancies.trash')or Route::is('vacancies.expire')or Route::is('vacancies.create')or Route::is('vacancies.edit')or Route::is('vacancies.cancel')) @else collapse @endif" id="job_management">
										<ul>									
											<li>
												<a href="{{route('vacancies.active')}}"><i class="fa fa-check-circle" aria-hidden="true"></i> @lang('global.Active Jobs')</a>
												<span class="pull-right">@if($countVacActives->count()>0){{$countVacActives->count()}} @else 0 @endif</span>
											</li>
											<li>
												<a href="{{route('vacancies.pending')}}"><i class="fa fa-clock-o" aria-hidden="true"></i> @lang('global.Pending Jobs')</a>
												<span class="pull-right">@if($countVacPendings->count()>0){{$countVacPendings->count()}} @else 0 @endif</span>
											</li>
											<li>
												<a href="{{route('vacancies.expire')}}"><i class="fa fa-warning" aria-hidden="true"></i> @lang('global.Expire Jobs')</a>
												<span class="pull-right">@if($countVacExpires->count()>0){{$countVacExpires->count()}} @else 0 @endif</span>
											</li>
											<li>
												<a href="{{route('vacancies.inactive')}}"><i class="fa fa-ban" aria-hidden="true"></i> @lang('global.Inactive Jobs')</a>
												<span class="pull-right">@if($countVacInactives->count()>0){{$countVacInactives->count()}} @else 0 @endif</span>
											</li>
										</ul>
									</div>
								</div>								
							@else	
							@endif						

							@if(auth()->user()->companyofficer->user_management=='1')							
								<div class="side-widget">
									<h2 class="side-widget-title"><a href="#company_staff" data-toggle="collapse"><i class="fa fa-users"></i> @lang('global.Company Staff')<i class="pull-right fa fa-angle-double-down" aria-hidden="true"></i></a></h2>
									<div class="widget-text padd-0 @if(Route::is('account.staff.list')or Route::is('account.staff.trash')or Route::is('account.staff.create')or Route::is('account.staff.edit')) @else collapse @endif" id="company_staff">
										<ul>
											<li>
												<a href="{{route('account.staff.create')}}"><i class="fa fa-plus-circle"></i> @lang('global.Add Staff')</a>
												<span class="pull-right"></span>
											</li>
											<li>
												<a href="{{route('account.staff.list')}}"><i class="fa fa-users"></i> @lang('global.Staff List')</a>
												<span class="pull-right">{{$countCompStaffs}}</span>
											</li>
										</ul>
									</div>
								</div>
							@endif							

							
							@if(auth()->user()->companyofficer->add_articles=='1')						
								<div class="side-widget">
									<h2 class="side-widget-title"><a href="#company_article" data-toggle="collapse"><i class="fa fa-newspaper-o"></i> @lang('global.Company Articles')<i class="pull-right fa fa-angle-double-down" aria-hidden="true"></i></a></h2>
									<div class="widget-text padd-0 @if(Route::is('company.article.active')or Route::is('company.article.pending')or Route::is('company.article.inactive')or Route::is('company.article.create')or Route::is('company.article.edit')or Route::is('company.article.trash')) @else collapse @endif" id="company_article">
											<ul>
												<li>
													<a href="{{route('company.article.create')}}"><i class="fa fa-plus-circle"></i> @lang('global.Add Article')</a>
													<span class="pull-right"></span>
												</li>
												<li>
													<a href="{{route('company.article.active')}}"><i class="fa fa-check"></i> @lang('global.Active Article')</a>
													<span class="pull-right">{{$countMyArticleActives}}</span>
												</li>
												<li>
													<a href="{{route('company.article.pending')}}"><i class="fa fa-clock-o"></i> @lang('global.Pending Article')</a>
													<span class="pull-right">{{$countMyArticlePendings}}</span>
												</li>
												<li>
													<a href="{{route('company.article.inactive')}}"><i class="fa fa-ban"></i> @lang('global.Inactive Article')</a>
													<span class="pull-right">{{$countMyArticleInactives}}</span>
												</li>											
											</ul>
									</div>
								</div>
							@endif
						</div>

					</div>
					<!-- Sidebar End -->
