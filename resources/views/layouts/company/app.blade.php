<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="{{ app()->getLocale() }}">
<head>
	<!-- Basic Page Needs
	================================================== -->
	<meta name="csrf-token" content="{{ csrf_token() }}">	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="google-site-verification" content="google-site-verification=KKEmyIKy2PeHegcuDZBr_SknLDZz3W1TCDdWubURt14">	
	@yield('meta')	
	<!-- CSS
	================================================== -->
	<link rel="stylesheet" href="{{asset('front/plugins/css/plugins.css')}}">
    <link href="{{asset('front/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/colors/blue-style.css')}}" rel="stylesheet">		
    <link href="{{asset('front/css/all.css')}}" rel="stylesheet">		
	@stack('styles')
	<link rel="shortcut icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon">
	<link rel="icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon">
</head>

	<body>
	<div class="Loader"></div>
		<div class="wrapper">  
			
			<!-- Start Navigation -->
			<nav class="navbar navbar-default navbar-fixed navbar-light white bootsnav">
				@section('header')
					@include('layouts.company.inc.header')
				@show  
			</nav>   
			<!-- End Navigation -->
			<div class="clearfix"></div>
			
				@yield('content')
			
			<!-- Footer Section Start -->
			@section('footer')
				@include('layouts.company.inc.footer')
			@show
			<div class="clearfix"></div>
			<!-- Footer Section End -->
			
			<!-- Scripts
			================================================== -->
			<script type="text/javascript" src="{{asset('front/plugins/js/jquery.min.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/viewportchecker.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/bootstrap.min.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/bootsnav.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/select2.min.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/wysihtml5-0.3.0.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/bootstrap-wysihtml5.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/datedropper.min.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/dropzone.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/loader.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/owl.carousel.min.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/slick.min.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/gmap3.min.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/jquery.easy-autocomplete.min.js')}}"></script>
			<!-- Custom Js -->
			<script src="{{asset('front/js/custom.js')}}"></script>
@stack('scripts')			
		</div>
	</body>
</html>