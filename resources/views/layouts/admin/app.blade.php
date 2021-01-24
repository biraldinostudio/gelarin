<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="{{ app()->getLocale() }}">
	<head>
		<meta name="csrf-token" content="{{ csrf_token() }}">	
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>{{ config('app.name', 'Gelarin') }}</title>

		<!-- All Plugins Css -->
		<link rel="stylesheet" href="{{asset('admin/plugins/css/plugins.css')}}">

		<!-- Custom CSS -->
		<link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
    <link href="{{asset('admin/css/custom.css')}}" rel="stylesheet">
	    <link href="{{asset('front/css/all.css')}}" rel="stylesheet">	
	@stack('styles')		
	<link rel="shortcut icon" href="{{asset('front/img/favicon/favicon.ico')}}" type="image/x-icon">
	<link rel="icon" href="{{asset('front/img/favicon/favicon.ico')}}" type="image/x-icon">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')}}"></script>
		<![endif]-->
		

	</head>
	
	<body>
	
		<div id="wrapper" class="">
		{{--<div class="fakeLoader"></div>--}}
			<!-- Navigation -->
			<nav class="navbar navbar-default navbar-static-top"  style="margin-bottom: 0">
			@section('header')
				@include('layouts.admin.inc.header')
			@show
				
			@section('sidebarLeft')
				@include('layouts.admin.inc.sidebarLeft')
			@show
			</nav>
			<!-- Sidebar Navigation -->
			@yield('content')
			
			@section('sidebarRight')
				@include('layouts.admin.inc.sidebarRight')
			@show
			@section('footer')
				@include('layouts.admin.inc.footer')
			@show
		</div>
		<!-- /#wrapper -->

		<!-- jQuery -->
		<script src="{{asset('admin/plugins/js/jquery.min.js')}}"></script>
		<script src="{{asset('admin/plugins/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('admin/plugins/js/metisMenu.min.js')}}"></script>	
		<script src="{{asset('admin/plugins/js/jquery.slimscroll.js')}}"></script>
		<script src="{{asset('admin/plugins/js/sweetalert.js')}}"></script>
		<script src="{{asset('admin/plugins/js/datepicker.js')}}"></script>
		<script src="{{asset('admin/plugins/js/ckeditor.js')}}"></script>
		<script src="{{asset('admin/plugins/js/select2.min.js')}}"></script>
		<script src="{{asset('admin/js/loader.js')}}"></script>
		
		<!-- Morris.js charts -->
		<script src="{{asset('admin/plugins/js/raphael.min.js')}}"></script>
		<script src="{{asset('admin/plugins/js/morris.min.js')}}"></script>

		<!-- Custom Theme JavaScript -->
		<script src="{{asset('admin/js/custom.js')}}"></script>
		<script src="{{asset('admin/js/dashboard-4.js')}}"></script>
@stack('scripts')
	</body>
</html>


