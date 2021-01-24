@extends('layouts.app')

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
									<h3 class="panel-title">@lang('auth.Resetting Your Password')</h3>
								</div>
								<div class="panel-body">
									<p>&nbsp;</p>
									  <form method="POST" action="{{ route('password.request') }}">
									@csrf
										<input type="hidden" name="token" value="{{ $token }}">
										<fieldset>
											<div class="form-group">
												<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="@lang('auth.Enter Your Email')" value="{{ $email or old('email') }}" required autofocus>
													@if ($errors->has('email'))
														<span class="invalid-feedback">
															<strong>{{ $errors->first('email') }}</strong>
														</span>
													@endif
											</div>
											<div class="form-group">
												<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="@lang('auth.Enter New Password')" required>
													@if ($errors->has('password'))
														<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
															<strong>{{ $errors->first('password') }}</strong>
														</span>
													@endif
											</div>
											<div class="form-group">
												<input id="password-confirm" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" placeholder="@lang('auth.Repeat New Password')" required>
													@if ($errors->has('password_confirmation'))
														<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
															<strong>{{ $errors->first('password_confirmation') }}</strong>
														</span>
													@endif
											</div>											
											<!-- Change this to a button or input when using this as a form -->
											<input type="submit" value="@lang('auth.Reset Password')" class="btn btn-login" data-loading-text="Loading..."></br> 
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
