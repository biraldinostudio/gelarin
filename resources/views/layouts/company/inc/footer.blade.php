			<!-- Footer Section Start -->
			<footer class="footer light-footer">
				<div class="row lg-menu">
					<div class="container">
						<div class="col-md-4 col-sm-4">
							<img src="{{asset('front/img/logo/logo.png')}}" class="img-responsive" alt="" /> 
						</div>
						<div class="col-md-8 co-sm-8 pull-right">
							<ul>
								<li><a href="{{url('/')}}" title="">@lang('footer.Home')</a></li>
								<li><a href="{{route('company.faq.index')}}" title="">@lang('footer.Help Center')</a></li>								
								@guest
									@if (isset($pages) and $pages->count() > 0)
									@foreach($pages as $page)
									@if (isset($page->name))
										<li><a href="{{route('page.show',$page->slug)}}" target="_blank" title="">{{$page->name}}</a></li>
									@endif
									@endforeach
									@endif								
								@else
									@if (isset($pages) and $pages->count() > 0)
									@foreach($pages as $page)
									@if (isset($page->name))
										<li><a href="{{route('company.page.show',$page->slug)}}" title="">{{$page->name}}</a></li>
									@endif
									@endforeach
									@endif									
								@endif
							</ul>
						</div>
					</div>
				</div>
				<div class="row no-padding">
					<div class="container">
						<div class="col-md-3 col-sm-12">
							<div class="footer-widget">
							<h3 class="widgettitle widget-title">@lang('footer.About Gelarin')</h3>
							<div class="textwidget">
							<p>@lang('footer.Information media for office work, freelance, business reviews and business HUB.')</p>
							<p><strong>Email:</strong> info@gelarin.com</p>							
							<ul class="footer-social">
								<li><a href="https://www.facebook.com/gelarin.id" target="_blank"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#" target="_blank"><i class="fa fa-instagram"></i></a></li>
								<li><a href="#" target="_blank"><i class="fa fa-linkedin"></i></a></li>
							</ul>
							</div>
							</div>
						</div>
						
						@guest
						<div class="col-md-3 col-sm-4">
							<div class="footer-widget">
							<h3 class="widgettitle widget-title">@lang('footer.Company')</h3>
							<div class="textwidget">
								<ul class="footer-navigation">
									<li><a href="{{route('company.faq.index')}}" title="@lang('footer.Help Center')">@lang('footer.Help Center')</a></li>								
									<li><a href="{{route('company.register')}}" title="@lang('footer.Signup')">@lang('footer.Signup')</a></li>									
									<li>
										<a href="{{ route('company.login') }}" title="@lang('footer.Post a Job')">@lang('footer.Post a Job')</a>								
									</li>
									<li><a href="{{route('company.login')}}" title="@lang('footer.Find Candidates')">@lang('footer.Find Candidates')</a></li>
									<li><a href="{{route('company.login')}}" title="@lang('footer.Business Review'">@lang('footer.Business Review')</a></li>
								</ul>
							</div>
							</div>
						</div>						
						@else
						<div class="col-md-3 col-sm-4">
							<div class="footer-widget">
							<h3 class="widgettitle widget-title">@lang('footer.Company')</h3>
							<div class="textwidget">
								<ul class="footer-navigation">
									<li><a href="{{route('company.faq.index')}}" title="@lang('footer.Help Center')">@lang('footer.Help Center')</a></li>								
									<li>
										<a href="{{ route('vacancies.create') }}" title="@lang('footer.Post a Job')">@lang('footer.Post a Job')</a>								
									</li>
									<li><a href="{{route('talents.pages.index')}}" title="@lang('footer.Find Candidates')">@lang('footer.Find Candidates')</a></li>
									<li><a href="{{route('company.article.create')}}" title="@lang('footer.Business Review'">@lang('footer.Business Review')</a></li>
									<li><a href="{{route('company.article.index')}}" title="@lang('footer.Article')">@lang('footer.Article')</a></li>
								</ul>
							</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-4">
							<div class="footer-widget">
							<h3 class="widgettitle widget-title">{{__('home.Contact Gelarin')}}</h3>
							<div class="textwidget">
							<form class="footer-form" method="POST" action="{{route('company.home.contact.send')}}" novalidate="novalidate">
								@csrf
								<textarea id="kyt-textareaMini" name="message" class="form-control @error('message') is-invalid @enderror" placeholder="{{__('home.Write your message')}}" required>{{old('message')}}</textarea>
								@error('message')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror 								
								<button type="submit" class="btn btn-primary">{{__('home.Send')}}</button>
							</form>
							</div>
							</div>
						</div>						
						@endguest
					</div>
				</div>
				<div class="row copyright">
					<div class="container">
						<p>Copyright {{ config('app.name', 'Gelarin') }} © <?php echo date('Y'); ?>. All Rights Reserved </p>
					</div>
				</div>
			</footer>
			<div class="clearfix"></div>
			
			<!-- End Signin Window -->
			<script>
				var msgSuccess = '{{Session::get('alert')}}';
				var existMessage = '{{Session::has('alert')}}';
				if(existMessage){
					alert(msgSuccess);
				}
			</script>			