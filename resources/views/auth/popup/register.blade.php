			<!-- Sign Up Window Code -->
			<div class="modal fade" id="quickRegister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog">
					<div class="modal-content">
							<div class="login-panel panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">@lang('auth.Member Registration Form')</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="reloadPage()">
									<span aria-hidden="true" style="font-size:16;color:#2867b2;">&times;</span>
								</button>
							</div>
								<div class="panel-body">
									<p class="kyt-remove-logo"><i class="fa fa-user-circle"></i></p>
									  <form id="registerForm" role="form" method="POST" action="{{ route('register') }}" novalidate="novalidate">
										@csrf
										<div class="form-group">
											<div class="row extra-mrg">
												<div class="col-md-12 col-sm-4">
													<input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="@lang('auth.Full Name')" name="name" type="text" value="{{ old('name') }}" maxlength="35" equired="required" autofocus="autofocus">
													@if ($errors->has('name'))
														<span class="invalid-feedback">
															<strong>{{ $errors->first('name') }}</strong>
														</span>
													@endif
												</div>
											</div>
										</div>																				
										<div class="form-group">
											<div class="row extra-mrg">
												<div class="col-md-12 col-sm-4">
												<input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="@lang('auth.Email')" id="email" name="email" value="{{ old('email') }}" type="email" maxlength="53" required="required">
													@if ($errors->has('email'))
														<span class="invalid-feedback">
															<strong>{{ $errors->first('email') }}</strong>
														</span>
													@endif												
												</div>
											</div>
										</div>																			
										<div class="form-group">
											<div class="row extra-mrg">
												<div class="col-md-8 col-sm-8">
													<input class="form-control{{ $errors->has('number') ? ' is-invalid' : '' }}" name="number" type="text" value="{{ old('number') }}" placeholder="@lang('auth.Mobile Phone Number') (@lang('auth.Ex:81250338118'))" maxlength="12" onKeyPress="return goodchars(event,'0123456789',this)" required>
													@if ($errors->has('number'))
														<span class="invalid-feedback">
															<strong>{{ $errors->first('number') }}</strong>
														</span>
													@endif												
												</div>
											</div>
										</div>

										<div class="form-group">
											<div class="row extra-mrg">
												<div class="col-md-6 col-sm-4">
													<input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" placeholder="@lang('auth.Password')" value="{{ old('password') }}" required="required">
													@if ($errors->has('password'))
														<span class="invalid-feedback">
															<strong>{{ $errors->first('password') }}</strong>
														</span>
													@endif
												</div>
												<div class="col-md-6 col-sm-4">
													<input class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" type="password" name="password_confirmation" placeholder="@lang('auth.Confirm Password')" required="required">
													@if ($errors->has('password_confirmation'))
														<span class="invalid-feedback">
															<strong>{{ $errors->first('password_confirmation') }}</strong>
														</span>
													@endif
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row extra-mrg">
												<div class="col-md-12 col-sm-4">
													<span style="color:#707c88;font-size:13px;">
														@lang('auth.By continuing, you acknowledge that you accept on Gelarin Privacy Policies and Terms & Conditions')
													</span>
												</div>
											</div>
										</div>										
																	
										<input type="hidden" name="quickRegisterForm" value="1">
											<input id="registerBtn" type="submit" value="@lang('auth.Register')" class="btn btn-login" data-loading-text="Loading...">											
											<div class="checkbox" style="text-align:center;">
												<span style="color:#707c88;text-align:center;">@lang('auth.Already registered?') <a href="javascript:void(0)" data-toggle="modal" data-target="#quickLogin" style="color:#2867b2;" onclick="hideRegister()"> @lang('auth.Login Now')</a></span>
											</div>
										</fieldset>
									</form>
								</div>
									<ul class="social-login">
										<li class="facebook-login"><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
										<span>@lang('auth.Or')</span>
										<li class="google-plus-login"><a href="#"><i class="fa fa-google-plus"></i>Facebook</a></li>
									</ul>								
							</div>
					</div>
				</div>
			</div>   
			<!-- End Sign Up Window -->	
	@section('scripts')	
		<script>
			$(document).ready(function () {
				$("#registerBtn").click(function () {
					$("#registerForm").submit();
					return false;
				});
			});
		</script>
	@endsection	