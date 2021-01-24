<nav class="navbar navbar-toggleable-md navbar-light bg-white fixed-top mediumnavigation">
<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="container">
	<!-- Begin Logo -->
	<a class="navbar-brand" href="{{url('/')}}">
	<img src="{{asset('front/img/logo/logo.png')}}" alt="logo">
	</a>
	<!-- End Logo -->
	<div class="collapse navbar-collapse" id="navbarsExampleDefault">
		<!-- Begin Menu -->
		<ul class="navbar-nav mr-auto d-flex align-items-center">
			<li class="nav-item"><a href="{{route('article.lifestyle')}}" class="nav-link">{{__('header.Lifestyle')}}</a></li>			
			<li class="nav-item">
			<a class="nav-link" href="{{route('article.technology')}}">{{__('header.Technology & Knowledge')}}<span class="badge badge-secondary">Rekom</span></a>
			</li>			
			<li class="nav-item">
			<a class="nav-link" href="{{route('article.social')}}">{{__('header.Social')}}</a>
			</li>
			<li class="nav-item">
			<a class="nav-link" href="{{route('article.industry')}}">{{__('header.Industry & Employment')}}</a>
			</li> 						
			<li class="nav-item">
<a href="javascript:void(0)" data-toggle="modal" data-target="#apply-job" class="nav-link"><i class="fa fa-search"></i></a>
			</li>			
		</ul>
		@guest
		@else
		<ul class="navbar-nav ml-auto d-flex align-items-center">
			<li class="nav-item">
			<a class="nav-link" href="{{route('manage.article.index')}}">@lang('auth.My Articles')</a>
			</li>
			<li class="nav-item">
			<a href="{{ route('logout') }}" class="nav-link"><i class="fa fa-sign-out"></i></a>
			</li>
		</ul>
		@endguest
		<ul class="navbar-nav ml-auto d-flex align-items-center">
			<li class="nav-item highlight">
			<a class="nav-link" href="{{ route('manage.article.create') }}">{{__('article.Post Article')}}</a>
			</li>
		</ul>

	</div>
</div>
</nav>