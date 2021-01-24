			<!-- Sign Up Window Code -->
			<div class="modal fade" id="signup" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body">
							<div class="tab" role="tabpanel">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#login" role="tab" data-toggle="tab">@lang('auth.Login')</a></li>
								<li role="presentation"><a href="#register" role="tab" data-toggle="tab">@lang('auth.Register')</a></li>
							</ul>
							<!-- Tab panes -->
							<div class="tab-content" id="myModalLabel2">
								<div role="tabpanel" class="tab-pane fade in active" id="login">
									<div class="subscribe wow fadeInUp">
										<form class="form-inline" method="post" action="{{ route('login') }}" novalidate>
										@csrf
											<div class="col-sm-12">
												<div class="form-group">
													<input id="email" type="email"  name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="@lang('auth.Email')" value="{{ old('email') }}" required autofocus>
													@if ($errors->has('email'))
													<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
														<strong>{{ $errors->first('email') }}</strong>
													</span>
													@endif
													<input id="password" type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"  placeholder="@lang('auth.Password')" required>
													@if ($errors->has('password'))
													<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
														<strong>{{ $errors->first('password') }}</strong>
													</span>
													@endif
													<div class="center">
													<button type="submit" id="login-btn" class="submit-btn"> @lang('auth.Login') </button>
													</div>
													<div class="center">
														<br>
														<span style="color:#707c88;text-align:center;">@lang('auth.You Have No Account?') <a href="#register" role="tab" data-toggle="tab" style="color:#2867b2;"> @lang('auth.Create An Account')</a></span>
													</div>
													<div class="center">
														<span><a href="{{ route('password.request') }}" style="color:#2867b2;"> @lang('auth.Forget Password?')</a></span>
													</div>													
												</div>
											</div>
										</form>
									</div>
								</div>

								<div role="tabpanel" class="tab-pane fade" id="register">
								<img src="assets/img/logo.png" class="img-responsive" alt="" />
									<form class="form-inline" method="post" action="{{ route('register') }}" novalidate>
									@csrf
									<div class="col-sm-12">
										<div class="form-group">
											<div class="row extra-mrg">
												<div class="col-md-12 col-sm-4">
													<input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="@lang('auth.Your Name')" name="name" type="text" value="{{ old('name') }}" required autofocus>
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
												<div class="col-md-12 col-sm-4">
													<input id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="@lang('auth.Email')" name="email" type="email" value="{{ old('email') }}" required>
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
												<div class="col-md-12 col-sm-4">
													<input id="nickname" class="form-control{{ $errors->has('nickname') ? ' is-invalid' : '' }}" placeholder="@lang('auth.Nick Name')" name="nickname" type="text" value="{{ old('nickname') }}" required>
													@if ($errors->has('nickname'))
														<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
															<strong>{{ $errors->first('nickname') }}</strong>
														</span>
													@endif												
												</div>
											</div>
										</div>													
										<div class="form-group">
											<div class="row extra-mrg">
												<div class="col-md-6 col-sm-4">
													<input id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" placeholder="@lang('auth.Password')" required>
													@if ($errors->has('password'))
													<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
														<strong>{{ $errors->first('password') }}</strong>
													</span>
													@endif													
												</div>
												<div class="col-md-6 col-sm-4">
													<input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="@lang('auth.Confirm Password')" required>
												</div>
											</div>
										</div>													
										<div class="center">
											<button type="submit" id="subscribe" class="submit-btn"> @lang('auth.Register') </button>
										</div>
										<div class="center">
											<br>
											<span style="color:#707c88;text-align:center;">@lang('auth.Already registered?') <a href="#login" role="tab" data-toggle="tab" style="color:#2867b2;"> @lang('auth.Login Now')</a></span>
										</div>											
									</div>
								</form>
								</div>
							</div>
							</div>
						</div>
						</div>
				</div>
			</div>   
			<!-- End Sign Up Window -->