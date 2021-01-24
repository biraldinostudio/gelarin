<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="{{ app()->getLocale() }}">
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="google-site-verification" content="google-site-verification=KKEmyIKy2PeHegcuDZBr_SknLDZz3W1TCDdWubURt14">
	@yield('meta')
	<link rel="icon" href="{{asset('front/img/favicon//favicon.ico')}}">
	<!-- Bootstrap core CSS -->
	<link href="{{asset('front/blog/css/bootstrap.min.css')}}" rel="stylesheet">
	<!-- Fonts -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="{{asset('front/blog/css/mediumish.css')}}" rel="stylesheet">
		<link href="{{asset('front/blog/css/custom.css')}}" rel="stylesheet">
		@stack('styles')
</head>
<body>

<!-- Begin Nav
================================================== -->
			@section('header')
				@include('layouts.blog.inc.header')
			@show
<!-- End Nav
================================================== -->

<!-- Begin Site Title
================================================== -->
			@yield('content')

	<!-- Begin Footer
	================================================== -->
			@section('footer')
				@include('layouts.blog.inc.footer')
			@show
	<!-- End Footer
	================================================== -->
<!-- /.container -->

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{asset('front/blog/js/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js')}}" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="{{asset('front/blog/js/bootstrap.min.js')}}"></script>
<script src="{{asset('front/blog/js/ie10-viewport-bug-workaround.js')}}"></script>
<script type="text/javascript">
	var $ = jQuery.noConflict();									
	@if (isset($errors) and $errors->any())
		@if ($errors->any() and old('hdnInputCreate')=='1')
			$('#createModal').modal();
		@endif						
	@endif
</script>
@stack('scripts')				
</body>
</html>
