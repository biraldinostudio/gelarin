<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="{{ app()->getLocale() }}">
<html lang="en">
	<head>
		<meta name="csrf-token" content="{{ csrf_token() }}">		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
		<meta name="keywords" content="{{ config('app.keyword') }}" />
		<meta name="description" content="{{ config('app.description') }}">
		<meta name="author" content="gelarin.com">	
		<title>{{ config('app.name', 'Gelarin') }} {{ config('app.title') }}</title>

		<!-- All Plugins Css -->
		<link rel="stylesheet" href="{{asset('admin/plugins/css/plugins.css')}}">

		<!-- Custom CSS -->
		<link rel="stylesheet" href="{{asset('admin/css/style.css')}}">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')}}"></script>
		<![endif]-->

	</head>
	
	<body class="login-bg">
		 <div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="login-panel panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Silahkan Login</h3>
						</div>
						<div class="panel-body">
							<img src="{{asset('admin/img/logo/logo-white.png')}}" class="img-responsive" alt=""/>
							<form method="POST" action="{{ route('admin.login') }}" novalidate>
							@csrf							
								<fieldset>
									<div class="form-group">
										<input class="form-control @error('email') is-invalid @enderror" placeholder="E-mail" name="email" type="email" value="{{old('email')}}" autofocus>
										@error('email')
											<div class="invalid-feedback">{{ $message }}</div>
										@enderror										
									</div>
									<div class="form-group">
										<input class="form-control @error('password') is-invalid @enderror" placeholder="Kata sandi" name="password" type="password" required autocomplete="current-password">
										@error('password')
											<div class="invalid-feedback">{{ $message }}</div>
										@enderror										
									</div>
									<div class="checkboxs">
										<span class="custom-checkbox">
											<input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>										
											<label for="checkbox1"></label>Ingat Saya
										</span>
									</div>
									<!-- Change this to a button or input when using this as a form -->
									<input type="submit" value="Masuk" class="btn btn-login">
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

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

		<!-- Custom Theme JavaScript -->
		<script src="{{asset('admin/js/custom.js')}}"></script>

	</body>
</html>

