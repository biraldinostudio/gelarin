			<!-- Sign Up Window Code -->
			<div class="modal fade" id="quickLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body">
							<div class="apply-job-box">
								<h4>@lang('auth.Sign In As Member')</h4>
							</div>
							<div class="apply-job-form">
								<form class="form-inline" id="loginForm" method="POST" action="{{ route('login') }}" novalidate="novalidate">
								@csrf								
									<div class="col-sm-12">
										<div class="form-group">
											<input id="email" class="form-control @error('email') is-invalid @enderror" placeholder="@lang('auth.Email')" name="email" type="email" value="{{ old('email') }}" required="required" autofocus="autofocus">
											@if ($errors->has('email')and old('quickLoginForm')=='1')
												<p class="invalid-feedback">
													<strong>{{ $errors->first('email') }}</strong>
												</p>
											@endif
										</div>
										<div class="form-group">
											<input id="password" class="form-control @error('password') is-invalid @enderror" placeholder="@lang('auth.Password')" name="password" type="password" required="required">
											@if ($errors->has('password')and old('quickLoginForm')=='1')
												<p class="invalid-feedback">
													<strong>{{ $errors->first('password') }}</strong>
												</p>
											@endif
										</div>
										<div class="row">
											<div class="col-xs-12 mrg-top-5">
												<span class="custom-checkbox">
													<input name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
													<label for="1"></label>
												</span> @lang('auth.Remember Me')
											</div>
										</div>
										<input type="hidden" name="quickLoginForm" value="1">
									</div>
									<div class="col-md-6 col-sm-12">
									<input type="hidden" name="quickLoginForm" value="1">
										<button  id="loginBtn" type="submit" class="submit-btn"> @lang('auth.Login') </button>
									</div>
									<div class="col-md-6 col-sm-12">
										<button type="button" class="dismis-btn" data-dismiss="modal" onclick="reloadPage()">@lang('global.Close')</button>
									</div>
									<div class="col-md-12 col-sm-12">
									<hr></hr>									
									</div>									
									<div class="col-md-12 col-sm-12">
										<div class="row">
											<div class="col-xs-12 mrg-top-5">
												@lang('auth.Forget Password?') <a href="{{ route('password.request') }}" class="cl-success">@lang('auth.Click Here')</a>
											</div>
										</div>	
									</div>										
									<div class="col-md-12 col-sm-12">
										<div class="row">
											<div class="col-xs-12 mrg-top-5">
												@lang('auth.You Have No Account?') <a href="{{ route('register') }}" class="cl-success">@lang('auth.Create An Account')</a>
											</div>
										</div>	
									</div>	
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>   
			<!-- End Apply Form -->
	@section('after_scripts')
		<script>
			$(document).ready(function () {
				$("#loginBtn").click(function () {
					$("#loginForm").submit();
					return false;
				});
			});
		</script>
	@endsection