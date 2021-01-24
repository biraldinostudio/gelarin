@extends('layouts.company.app')
@section('meta')<meta name="keywords" content="{{ config('app.keyword') }}" />
	<meta name="description" content="{{ config('app.description') }}">
	<meta name="author" content="gelarin.com">	
	<title>{{ config('app.name', 'Gelarin') }} {{ config('app.title') }}</title>	
@endsection
@section('content')
			<!-- Sign Up Window Code -->
			<!-- Title Header Start -->
			<section class="login-plane-sec">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							@if (session('status'))
								<div class="alert alert-success">
									{{ session('status') }}
								</div>
							@endif
							@if (session('warning'))
								<div class="alert alert-warning">
									{{ session('warning') }}
								</div>
							@endif						
							<div class="login-panel panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">@lang('auth.Sign In As Company')</h3>
								</div>
								<div class="panel-body">
									<p class="kyt-remove-logo"></p>
									  <form method="POST" action="{{ route('company.login') }}" novalidate>
										 @csrf
										<fieldset>
											<div class="form-group">
												<input id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="@lang('auth.Email')" name="email" type="email" value="{{ old('email') }}" required autofocus>
											    @if ($errors->has('email'))
												<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
													<strong>{{ $errors->first('email') }}</strong>
												</span>
												@endif
											</div>
											<div class="form-group">
												<input id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="@lang('auth.Password')" name="password" type="password" required>
												@if ($errors->has('password'))
												<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
													<strong>{{ $errors->first('password') }}</strong>
												</span>
												@endif
											</div>
											<div class="checkbox">
												<label>
													<input name="remember" type="checkbox" value="Remember Me">@lang('auth.Remember Me')
												</label>
											</div>
											<!-- Change this to a button or input when using this as a form -->
											<input type="submit" value="@lang('auth.Login')" class="btn btn-login" data-loading-text="Loading..."></br> 
											<div class="checkbox" id="kyt-div-textcenter">
												<span class="kyt-label-font13">@lang('auth.You Have No Account?') <a href="{{route('company.register')}}"> @lang('auth.Create An Account')</a></span>
											</div>
											<div class="checkbox" id="kyt-div-textcenter">
												<span class="kyt-label-font13"><a href="{{ route('company.password.request') }}"> @lang('auth.Forget Password?')</a></span>
											</div>
										</fieldset>
									</form>
									{{--<ul class="social-login">
										<li class="facebook-login"><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
										<span>@lang('auth.Or')</span>
										<li class="google-plus-login"><a href="#"><i class="fa fa-google-plus"></i>Facebook</a></li>
									</ul>--}}
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- End Sign Up Window -->
			
@endsection	
		