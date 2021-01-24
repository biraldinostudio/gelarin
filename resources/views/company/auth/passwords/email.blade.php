@extends('layouts.company.app')

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
									<h3 class="panel-title">@lang('auth.Password Reset Link')</h3>
								</div>
								<div class="panel-body">
									<p>&nbsp;</p>
									  <form method="POST" action="{{ route('company.password.email') }}" novalidate>
										 @csrf
										<fieldset>
											<div class="form-group">
												<input id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="@lang('auth.Enter Your Email')" name="email" type="email" value="{{ old('email') }}" required autofocus>
											    @if ($errors->has('email'))
												<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
													<strong>{{ $errors->first('email') }}</strong>
												</span>
												@endif
											</div>
											<!-- Change this to a button or input when using this as a form -->
											<input type="submit" value="@lang('auth.Send Password Reset Link')" class="btn btn-login" data-loading-text="Loading..."></br> 
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
		