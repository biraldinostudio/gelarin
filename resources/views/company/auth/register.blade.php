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
						<div class="col-md-8 col-md-offset-2">
							<div class="login-panel panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">@lang('auth.Create Company Account') <span class="new-offer">{{__('auth.Free')}}</span></h3>
								</div>
								<div class="panel-body">
									<p class="kyt-remove-logo"></p>
									  <form role="form" method="POST" action="{{ route('company.register') }}" novalidate>
										@csrf									
										<div class="form-group">
											<div class="row extra-mrg">
												<div class="col-md-6 col-sm-4">
													<label id="kyt-label-font11">@lang('auth.The company name matches the legality document')</label>
													<input class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" placeholder="@lang('auth.Company Name')" name="company" type="text" value="{{ old('company') }}" maxlength="35" required>
													@if ($errors->has('company'))
														<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
															<strong>{{ $errors->first('company') }}</strong>
														</span>
													@endif
												</div>
												<div class="col-md-6 col-sm-4">
													<label id="kyt-label-font11">@lang('auth.Email')</label>
													<input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="@lang('auth.Email')" id="email" name="email" value="{{ old('email') }}" type="email" required>
													@if ($errors->has('email'))
														<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
															<strong>{{ $errors->first('email') }}</strong>
														</span>
													@endif		
												</div>
											</div>
										</div>									
										<div class="form-group">
											<div class="row extra-mrg">
												<div class="col-md-6 col-sm-4">
													<label id="kyt-label-font11">@lang('auth.Your Mobile Number')</label>												
													<input class="form-control{{ $errors->has('number') ? ' is-invalid' : '' }}" name="number" type="text" value="{{ old('number') }}" placeholder="@lang('auth.Number')" maxlength="11" required>
													@if ($errors->has('number'))
														<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
															<strong>{{ $errors->first('number') }}</strong>
														</span>
													@endif	
												</div>											
												<div class="col-md-6 col-sm-4">
													<label id="kyt-label-font11">@lang('auth.Your Name (Contact Person)')</label>												
													<input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="@lang('auth.Contact Person Name')" name="name" type="text" value="{{ old('name') }}" maxlength="35" autofocus required>
													@if ($errors->has('name'))
														<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
															<strong>{{ $errors->first('name') }}</strong>
														</span>
													@endif
												</div>
											</div>
										</div>									
										<div class="form-group">
											<div class="row extra-mrg">
												<div class="col-md-6 col-sm-4">
													<label id="kyt-label-font11">@lang('auth.Password')</label>												
													<input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" placeholder="@lang('auth.Password')" value="{{ old('password') }}" required>
													@if ($errors->has('password'))
														<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
															<strong>{{ $errors->first('password') }}</strong>
														</span>
													@endif
												</div>
												<div class="col-md-6 col-sm-4">
													<label id="kyt-label-font11">@lang('auth.Confirm Password')</label>													
													<input class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" type="password" name="password_confirmation" placeholder="@lang('auth.Confirm Password')" required>
													@if ($errors->has('password_confirmation'))
														<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
															<strong>{{ $errors->first('password_confirmation') }}</strong>
														</span>
													@endif
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row extra-mrg">
												<div class="col-md-12 col-sm-4">
													<span class="kyt-label-font13">
														@lang('auth.You will be the administrator and contact person for the account.')
													</span>
													<span class="kyt-label-font13">
														@lang('auth.By continuing, you know that you accept') <a href="{{url('page/privacy')}}" target="_blank">@lang('auth.policy and privacy')</a> @lang('auth.and')  <a href="{{url('page/terms')}}" target="_blank">@lang('auth.terms and conditions')</a> {{config('app.name')}}
													</span>													
												</div>
											</div>
										</div>
									
																						
											<!-- Change this to a button or input when using this as a form -->
											<!--<a href="index.html" class="btn btn-login">@lang('auth.Register')</a></br>-->
											<input type="submit" value="@lang('auth.Register')" class="btn btn-login" data-loading-text="Loading...">											
											<div class="checkbox" style="text-align:center;">
												<span class="kyt-label-font13">@lang('auth.Already registered?') <a href="{{ route('company.login') }}" class="kyt-label-font13"> @lang('auth.Login')</a> @lang('auth.to Gelarin Recruitment Centre.')</span>
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
		