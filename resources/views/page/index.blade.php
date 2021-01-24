@extends('layouts.app')
@section('meta')<meta name="keywords" content="{{ config('app.keyword') }}" />
	<meta name="description" content="{{ config('app.description') }}">
	<meta name="author" content="gelarin.com">	
	<title>{{ config('app.name', 'Gelarin') }} {{ config('app.title') }}</title>	
@endsection
@section('content')
			<!-- Title Header Start -->
			<section class="kyt-header-content">
				<div class="container">
				</div>
			</section>
			<div class="clearfix"></div>
			<section class="tab-sec gray">
				<div class="container">
					<div class="col-lg-8 col-md-8 col-sm-12 col-lg-offset-2 col-md-offset-2">
						<div class="kyt-page-static">
							<ul class="nav modern-tabs nav-tabs theme-bg" id="simple-design-tab">
								<li class="active"><img src="{{asset('front/img/logo/logo-white.png')}}"></li>
							</ul>
							<div class="tab-content">
								{!!ucfirst($pages->content)!!}
							</div>
						</div>
					</div>
				</div>			
			</section>
			<!-- Tab section End -->
			<section class="contact-page">
				<div class="container">
					<div class="col-md-4 col-sm-4">
						<div class="contact-box">
							<i class="fa fa-map-marker"></i>
							<span>Regional Indonesia</span>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="contact-box">
							<i class="fa fa-envelope"></i>
							<span>info@gelarin.com</span>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="contact-box">
							<i class="fa fa-phone"></i>
							<span>+6281952431678</span>
						</div>
					</div>
				</div>
			</section>					
@endsection