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
							<div class="login-panel panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">@lang('auth.Member Registration Form') <span class="new-offer">{{__('auth.Free')}}</span></h3>
									{{__('auth.This page is not for')}} <a href="{{route('company.register')}}" class="kyt-font-green"><b>{{__('auth.Company')}}</b></a>
								</div>
								<div class="panel-body">
									<p class="kyt-remove-logo"><i class="fa fa-user-circle"></i></p>
									  <form id="registerForm" role="form" method="POST" action="{{ route('register') }}" novalidate="novalidate">
										@csrf
										<div class="form-group">
											<div class="row extra-mrg">
												<div class="col-md-12 col-sm-4">
													<input class="form-control @error('name') is-invalid @enderror" placeholder="@lang('auth.Full Name')" name="name" type="text" value="{{ old('name') }}" maxlength="35" equired="required" autofocus="autofocus">
													@error('name')
														<div class="invalid-feedback">{{ $message }}</div>
													@enderror
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row extra-mrg">
												<div class="col-md-12 col-sm-4">
												<input class="form-control @error('email') is-invalid @enderror" placeholder="@lang('auth.Email')" id="email" name="email" value="{{ old('email') }}" type="email" maxlength="53" required="required">
													@error('email')
														<div class="invalid-feedback">{{ $message }}</div>
													@enderror											
												</div>
											</div>
										</div>																			
										
										<div class="form-group">
											<div class="row extra-mrg">
												<div class="col-md-4 col-sm-4">
												<input class="form-control" type="text" name="code" placeholder="+{{$countriesByIP->phone}}" readonly>												
												</div>
												<div class="col-md-8 col-sm-8">
													<input class="form-control @error('number') is-invalid @enderror" name="number" type="text" value="{{ old('number') }}" placeholder="@lang('auth.Mobile Phone Number') (@lang('auth.Ex:81250338118'))" maxlength="12" onKeyPress="return goodchars(event,'0123456789',this)" required>
													@error('number')
														<div class="invalid-feedback">{{ $message }}</div>
													@enderror	
												</div>
											</div>
										</div>										
										<div class="form-group">
											<div class="row extra-mrg">
												<div class="col-md-6 col-sm-4">
													<input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="@lang('auth.Password')" value="{{ old('password') }}" required="required">
													@error('password')
														<div class="invalid-feedback">{{ $message }}</div>
													@enderror	
												</div>
												<div class="col-md-6 col-sm-4">
													<input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" placeholder="@lang('auth.Confirm Password')" required="required">
													@error('password_confirmation')
														<div class="invalid-feedback">{{ $message }}</div>
													@enderror
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row extra-mrg">
												<div class="col-md-12 col-sm-4">
													<span class="kyt-label-font13">
														@lang('auth.By continuing, you acknowledge that you accept on Gelarin Privacy Policies and Terms & Conditions')
													</span>
												</div>
											</div>
										</div>
											<input id="registerBtn" type="submit" value="@lang('auth.Register')" class="btn btn-login" data-loading-text="Loading...">											
											<div class="checkbox" id="kyt-div-textcenter">
												<span class="kyt-label-font13">@lang('auth.Already registered?') <a href="{{route('login')}}" class="kyt-label-font13"> @lang('auth.Login Now')</a></span>
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