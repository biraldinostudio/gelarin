			<!-- Start Navigation -->
			<nav class="navbar navbar-default navbar-fixed navbar-light white bootsnav">

				<div class="container">            
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
						<i class="fa fa-bars"></i>
					</button>
					<!-- Start Header Navigation -->
					<div class="navbar-header">
						<a class="navbar-brand" href="{{url('')}}">
							<img src="{{asset('front/img/logo/logo.png')}}" class="logo logo-display" alt="">
							<img src="{{asset('front/img/logo/logo.png')}}" class="logo logo-scrolled" alt="">
						</a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="navbar-menu">
						<ul class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp">
							<li class="dropdown megamenu-fw"><a href="#" class="dropdown-toggle" data-toggle="dropdown">{{__('header.Jobs')}}</a>
								<ul class="dropdown-menu megamenu-content" role="menu">
									<li>
										<div class="row">
											<div class="col-menu col-md-2">
												<h6 class="title">{{__('header.Creative')}}</h6>
												<div class="content">
													<ul class="menu-col">
														@foreach($menu_vacancies1 as $menu_vacancy)
															<li><a href="{{url('vacancies',[$menu_vacancy->translation_of,$menu_vacancy->slug])}}">{{$menu_vacancy->name}}</a></li>
														@endforeach
													</ul>
												</div>
											</div><!-- end col-3 -->
											<div class="col-menu col-md-2">
												<h6 class="title">{{__('header.Management')}}</h6>
												<div class="content">
													<ul class="menu-col">
														@foreach($menu_vacancies2 as $menu_vacancy)
															<li><a href="{{url('vacancies',[$menu_vacancy->translation_of,$menu_vacancy->slug])}}">{{$menu_vacancy->name}}</a></li>
														@endforeach													
													</ul>
												</div>
											</div><!-- end col-3 -->
											<div class="col-menu col-md-2">
												<h6 class="title">{{__('header.Service')}}</h6>
												<div class="content">
													<ul class="menu-col">
														@foreach($menu_vacancies3 as $menu_vacancy)
															<li><a href="{{url('vacancies',[$menu_vacancy->translation_of,$menu_vacancy->slug])}}">{{$menu_vacancy->name}}</a></li>
														@endforeach
													</ul>
												</div>
											</div> 
											<div class="col-menu col-md-2">
												<h6 class="title">{{__('header.Resource')}} {{--<span class="new-offer">New</span>--}}</h6>
												<div class="content">
													<ul class="menu-col">
														@foreach($menu_vacancies4 as $menu_vacancy)
															<li><a href="{{url('vacancies',[$menu_vacancy->translation_of,$menu_vacancy->slug])}}">{{$menu_vacancy->name}}</a></li>
														@endforeach
													</ul>
												</div>
											</div><!-- end col-3 -->
											<div class="col-menu col-md-2">
												<h6 class="title">{{__('header.Others')}} {{--<span class="new-offer">New</span>--}}</h6>
												<div class="content">
													<ul class="menu-col">
														@foreach($menu_vacancies5 as $menu_vacancy)
															<li><a href="{{url('vacancies',[$menu_vacancy->translation_of,$menu_vacancy->slug])}}">{{$menu_vacancy->name}}</a></li>
														@endforeach
													</ul>
												</div>
											</div><!-- end col-3 -->											
										</div><!-- end row -->
									</li>
								</ul>
							</li>
							<li class="dropdown megamenu-fw"><a href="#" class="dropdown-toggle" data-toggle="dropdown">{{__('header.Article')}}</a>
								<ul class="dropdown-menu megamenu-content" role="menu">
									<li>
										<div class="row">
											<div class="col-menu col-md-3">
												<h6 class="title">{{__('header.Lifestyle')}}</h6>
												<div class="content">
													<ul class="menu-col">
														@foreach($menu_articles1 as $menu_article)
															<li><a href="{{route('article.byCategory',[$menu_article->translation_of,$menu_article->slug])}}">{{$menu_article->name}}</a></li>
														@endforeach
													</ul>
												</div>
											</div><!-- end col-3 -->
											<div class="col-menu col-md-4">
												<h6 class="title">{{__('header.Technology & Knowledge')}}</h6>
												<div class="content">
													<ul class="menu-col">
														@foreach($menu_articles2 as $menu_article)
															<li><a href="{{route('article.byCategory',[$menu_article->translation_of,$menu_article->slug])}}">{{$menu_article->name}}</a></li>
														@endforeach
													</ul>
												</div>
											</div><!-- end col-3 -->
											<div class="col-menu col-md-2">
												<h6 class="title">{{__('header.Social')}}</h6>
												<div class="content">
													<ul class="menu-col">
														@foreach($menu_articles3 as $menu_article)
															<li><a href="{{route('article.byCategory',[$menu_article->translation_of,$menu_article->slug])}}">{{$menu_article->name}}</a></li>
														@endforeach
													</ul>
												</div>
											</div><!-- end col-3 -->
											<div class="col-menu col-md-3">
												<h6 class="title">{{__('header.Industry & Employment')}}</h6>
												<div class="content">
													<ul class="menu-col">
														@foreach($menu_articles4 as $menu_article)
															<li><a href="{{route('article.byCategory',[$menu_article->translation_of,$menu_article->slug])}}">{{$menu_article->name}}</a></li>
														@endforeach
													</ul>
												</div>
											</div><!-- end col-3 -->											
										</div><!-- end row -->
									</li>
								</ul>
							</li>							
							<li><a href="{{route('infoCovid19')}}">{{__('header.Info Covid19')}}</a></li>					
						</ul>
						<ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
						@guest
							<li><a href="{{route('login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i>@lang('global.Signin')</a></li>						
						{{--<li><a href="javascript:void(0)" data-toggle="modal" data-target="#quickLogin" id="aLogin"><i class="fa fa-sign-in" aria-hidden="true"></i>@lang('global.Signin')</a></li>--}}
							<li><a href="{{route('register')}}" id="aRegister"><i class="fa fa-user-plus" aria-hidden="true"></i>@lang('global.Signup')</a></li>							
							<!--<li><a href="{{ route('register') }}"><i class="fa fa-pencil" aria-hidden="true"></i>@lang('global.Signup')</a></li>-->
							<li class="left-br"><a href="{{ route('company.login') }}"  data-toggle="modalxx" data-target="#signupxx" class="signin">@lang('global.Employer Site')</a></li>	
						@else
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#"> 
									@if(auth()->user()->userdescription->nickname=='')
										{{auth()->user()->name}}
									@else
										{{auth()->user()->userdescription->nickname}}
									@endif
								</a>
								<ul class="dropdown-menu dropdown-user right-swip">
									<li><a href="{{route('account')}}"><i class="fa fa-user fa-fw"></i> @lang('auth.My Account')</a></li>
									<li><a href="{{route('password.change')}}"><i class="fa fa-key fa-fw"></i> @lang('auth.Change Password')</a></li>
									<li><a href="{{route('application.list.unprocessed')}}"><i class="fa fa-align-left fa-fw"></i>  @lang('auth.Job Application')</a></li>
									<li><a href="{{route('manage.vacancies')}}"><i class="fa fa-codepen fa-fw"></i>  @lang('auth.Saved Vacancies')</a></li>
									<li><a href="{{route('manage.vacancies.recommendet')}}"> <i class="fa fa-file fa-fw"></i>  @lang('global.Job recommendations')</a></li>
									<li><a href="{{route('manage.vacancies.offer')}}"> <i class="fa fa-tasks fa-fw"></i>  @lang('header.Job Offer')</a></li>										
									<li><a href="{{route('manage.article.index')}}"><i class="fa fa-newspaper-o fa-fw"></i>  @lang('auth.My Articles')</a></li>
									<li><a href="{{route('extra.gift')}}"><i class="fa fa-gift fa-fw"></i>  @lang('header.Extra Page')</a></li>									
									<li><a href="{{ route('logout') }}"><i class="fa fa-sign-out fa-fw"></i>  @lang('auth.Logout')</a></li>
								</ul>
								<!-- /.dropdown-user -->
							</li>					
							<li class="left-br"><a href="{{ route('manage.article.create') }}" alt="@lang('global.Post Articles')" class="signin">@lang('global.Post Articles')</a></li>						
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