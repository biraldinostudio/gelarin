@extends('layouts.app')
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
									<h3 class="panel-title">@lang('auth.Sign In As Member')</h3>
									{{__('auth.This page is not for')}} <a href="{{route('company.login')}}" class="kyt-font-green"><b>{{__('auth.Company')}}</b></a>									
								</div>
								<div class="panel-body">
									<p class="kyt-remove-logo"><i class="fa fa-user-circle"></i></p>
									  <form method="POST" action="{{ route('login') }}" novalidate="novalidate">
										@csrf
										<fieldset>
											<div class="form-group">
												<input id="email" class="form-control @error('email') is-invalid @enderror" placeholder="@lang('auth.Email')" name="email" type="email" value="{{ old('email') }}" required="required" autofocus="autofocus">
												@error('email')
													<div class="invalid-feedback">{{ $message }}</div>
												@enderror
											</div>
											<div class="form-group">
												<input id="password" class="form-control @error('password') is-invalid @enderror" placeholder="@lang('auth.Password')" name="password" type="password" required="required">
												@error('password')
													<div class="invalid-feedback">{{ $message }}</div>
												@enderror
											</div>
											<div class="checkbox">
												<label>
													<input name="remember" type="checkbox" value="Remember Me">@lang('auth.Remember Me')
												</label>
											</div>
											<!-- Change this to a button or input when using this as a form -->
											<input type="submit" value="@lang('auth.Login')" class="btn btn-login" data-loading-text="Loading..."></br> 
											<div class="checkbox" id="kyt-div-textcenter">
												<span class="kyt-label-font13">@lang('auth.You Have No Account?') <a href="{{route('register')}}"> @lang('auth.Create An Account')</a></span>
											</div>
											<div class="checkbox" id="kyt-div-textcenter">
												<span class="kyt-label-font13"><a href="{{route('password.request')}}"> @lang('auth.Forget Password?')</a></span>
											</div>
										</fieldset>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- End Sign Up Window -->
			
@endsection	
		