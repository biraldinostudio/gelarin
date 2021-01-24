			<!-- Start Navigation -->
			<nav class="navbar navbar-default navbar-fixed navbar-light white bootsnav">

				<div class="container">            
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
						<i class="fa fa-bars"></i>
					</button>
					<!-- Start Header Navigation -->
					<div class="navbar-header">
						@guest
						<a class="navbar-brand" href="{{route('company.login')}}">
							<img src="{{asset('front/img/logo/logo.png')}}" class="logo logo-display" alt="">
							<img src="{{asset('front/img/logo/logo.png')}}" class="logo logo-scrolled" alt="">
						</a>						
						@else
						<a class="navbar-brand" href="{{route('company.dashboard')}}">
							<img src="{{asset('front/img/logo/logo.png')}}" class="logo logo-display" alt="">
							<img src="{{asset('front/img/logo/logo.png')}}" class="logo logo-scrolled" alt="">
						</a>
						@endif
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="navbar-menu">
						<ul class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp">

							<li class="dropdown megamenu-fw"><a href="#" class="dropdown-toggle" data-toggle="dropdown">{{__('header.Article')}}</a>
								<ul class="dropdown-menu megamenu-content" role="menu">
									<li>
										<div class="row">
											<div class="col-menu col-md-3">
												<h6 class="title">{{__('header.Lifestyle')}}</h6>
												<div class="content">
													<ul class="menu-col">
														@foreach($menu_articles1 as $menu_article)
															<li><a href="{{route('company.article.byCategory',[$menu_article->translation_of,$menu_article->slug])}}">{{$menu_article->name}}</a></li>
														@endforeach
													</ul>
												</div>
											</div><!-- end col-3 -->
											<div class="col-menu col-md-4">
												<h6 class="title">{{__('header.Technology & Knowledge')}}</h6>
												<div class="content">
													<ul class="menu-col">
														@foreach($menu_articles2 as $menu_article)
															<li><a href="{{route('company.article.byCategory',[$menu_article->translation_of,$menu_article->slug])}}">{{$menu_article->name}}</a></li>
														@endforeach
													</ul>
												</div>
											</div><!-- end col-3 -->
											<div class="col-menu col-md-2">
												<h6 class="title">{{__('header.Social')}}</h6>
												<div class="content">
													<ul class="menu-col">
														@foreach($menu_articles3 as $menu_article)
															<li><a href="{{route('company.article.byCategory',[$menu_article->translation_of,$menu_article->slug])}}">{{$menu_article->name}}</a></li>
														@endforeach
													</ul>
												</div>
											</div><!-- end col-3 -->
											<div class="col-menu col-md-3">
												<h6 class="title">{{__('header.Industry & Employment')}}</h6>
												<div class="content">
													<ul class="menu-col">
														@foreach($menu_articles4 as $menu_article)
															<li><a href="{{route('company.article.byCategory',[$menu_article->translation_of,$menu_article->slug])}}">{{$menu_article->name}}</a></li>
														@endforeach
													</ul>
												</div>
											</div><!-- end col-3 -->											
										</div><!-- end row -->
									</li>
								</ul>
							</li>							
						@guest
							<li><a href="{{url('')}}"><i class="fa fa-users" aria-hidden="true"></i>@lang('header.Member Page')</a></li>						
						@else
							<li><a href="{{route('vacancies.active')}}"><i class="fa fa-bullhorn" aria-hidden="true"></i>@lang('header.Job Listings')</a></li>
							<li><a href="{{route('talents.pages.index')}}"><i class="fa fa-search" aria-hidden="true"></i>@lang('header.Talent Search')</a></li>							

							@endif							
						</ul>
						<ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
						@guest
							<li><a href="{{route('company.login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i>@lang('global.Signin')</a></li>						
							<li><a href="{{route('company.register')}}" id="aRegister"><i class="fa fa-user-plus" aria-hidden="true"></i>@lang('global.Signup')</a></li>							
							<li class="kyt-left-br"><a class="kyt-signin">@lang('global.Employer Site')</a></li>	
						@else
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#"> 
									@if(auth()->user()->type=='Company')
										<i class="fa fa-building-o"></i>
										@if(empty(auth()->user()->companyofficer->company->code))
										?
										@else
										{{auth()->user()->companyofficer->company->code}}
										@endif
									@else
																		<i class="fa fa-user"></i>
										@if(auth()->user()->userdescription->nickname=='')
											{{auth()->user()->name}}
										@else
											{{auth()->user()->userdescription->nickname}}
										@endif										
									@endif	
								</a>
								<ul class="dropdown-menu dropdown-user right-swip">
									<li><a href="{{route('account.index')}}"><i class="fa fa-user fa-fw"></i> @lang('header.My Account')</a>
									</li>
									<li><a href="{{route('company.password.change')}}"><i class="fa fa-key fa-fw"></i> @lang('auth.Change Password')</a></li>								
									@if(auth()->user()->companyofficer->type=='Creator')
									<li><a href="{{ route('settings.index') }}"><i class="fa fa-gear fa-fw"></i> @lang('header.Settings')</a></li>
									@endif
									<li><a type="button" href="{{route('company.testimonial')}}"><i class="fa fa-quote-left"></i> @lang('header.Testimonial')</a>
									</li>
									<li><a href="{{ route('logout') }}"><i class="fa fa-sign-out fa-fw"></i>  @lang('header.Logout')</a>
									</li>
								</ul>
								<!-- /.dropdown-user -->
							</li>
							<li class="left-br"><a href="{{route('vacancies.create')}}"  class="signin">@lang('header.Post Vacancies')</a></li>						
						@endguest
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<img class="flag-icon" src="{{asset('front/icon/'.app()->getLocale().'.png')}}" class="flag flag-@lang('global.Lang')" title="@lang('global.Lang')">								
								</a>
								<ul class="dropdown-menu animated fadeOutUp">
									@if(app()->getLocale()!='id')
										<li><a href="{{url('locale/id')}}"><img src="{{asset('front/icon/id.png')}}"> @lang('global.Lang')</a></li>
									@else
										<li><a href="{{url('locale/en')}}"><img src="{{asset('front/icon/en.png')}}"> @lang('global.Lang')</a></li>		
									@endif
								</ul>
							</li>							
						</ul>
					</div><!-- /.navbar-collapse -->
				</div>   
			</nav>
			<!-- End Navigation -->