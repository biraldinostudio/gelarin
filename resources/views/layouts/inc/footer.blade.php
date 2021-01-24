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
								<li><a href="{{route('faq.index')}}" title="">{{__('footer.Help Center')}}</a></li>								
								@if (isset($pages) and $pages->count() > 0)
								@foreach($pages as $page)
								@if (isset($page->name))
									<li><a href="{{url('page',$page->slug)}}" title="">{{$page->name}}</a></li>
								@endif
								@endforeach
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
							{{--<p>Tahunan UH 3 no 9<br>
							Umbulharjo, Yogyakarta</p>--}}
							<p><strong>Email:</strong> info@gelarin.com</p>
							{{--<p><strong>Call:</strong> <a href="tel:+6281952431678">0819-5243-1678</a></p>--}}
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
						
						<div class="col-md-3 col-sm-4">
							<div class="footer-widget">
							<h3 class="widgettitle widget-title">@lang('footer.Candidate')</h3>
							<div class="textwidget">
								<div class="textwidget">
								<ul class="footer-navigation">
								@guest
									<li><a href="{{route('faq.index')}}" title="@lang('footer.Help Center')">@lang('footer.Help Center')</a></li>								
									<li><a href="{{route('register')}}" title="@lang('footer.Signup')">@lang('footer.Signup')</a></li>
									<li><a href="{{url('vacancies')}}" title="@lang('footer.Job Vacancy')">@lang('footer.Job Vacancy')</a></li>
									<li><a href="{{route('employers.pages.index')}}" title="@lang('footer.Employers')">@lang('footer.Employers')</a></li>
									<li><a href="{{route('article.index')}}" title="@lang('footer.Article')">@lang('footer.Article')</a></li>									
									{{--<li><a href="#" title="@lang('footer.Internship')">@lang('footer.Internship')</a></li>--}}
									{{--<li><a href="#" title="@lang('footer.Scholarship'">@lang('footer.Scholarship')</a></li>--}}
									{{--<li><a href="#" title="@lang('footer.Training & Certification')">@lang('footer.Training & Certification')</a></li>--}}
									{{--<li><a href="#" title="@lang('footer.Entrepreneurship')">@lang('footer.Entrepreneurship')</a></li>--}}									
									{{--<li><a href="#" title="@lang('footer.Career Tips')">@lang('footer.Career Tips')</a></li>--}}									
								@else	
									<li><a href="{{route('faq.index')}}" title="@lang('footer.Help Center')">@lang('footer.Help Center')</a></li>									
									<li><a href="{{url('vacancies')}}" title="@lang('footer.Job Vacancy')">@lang('footer.Job Vacancy')</a></li>
									<li><a href="{{route('employers.pages.index')}}" title="@lang('footer.Employers')">@lang('footer.Employers')</a></li>
									<li><a href="{{route('article.index')}}" title="@lang('footer.Article')">@lang('footer.Article')</a></li>								
									{{--<li><a href="#" title="@lang('footer.Internship')">@lang('footer.Internship')</a></li>--}}
									{{--<li><a href="#" title="@lang('footer.Scholarship'">@lang('footer.Scholarship')</a></li>--}}
									{{--<li><a href="#" title="@lang('footer.Training & Certification')">@lang('footer.Training & Certification')</a></li>--}}
									{{--<li><a href="#" title="@lang('footer.Entrepreneurship')">@lang('footer.Entrepreneurship')</a></li>--}}									
									{{--<li><a href="#" title="@lang('footer.Career Tips')">@lang('footer.Career Tips')</a></li>--}}
								@endguest
								</ul>
							</div>
							</div>
							</div>
						</div>
						@guest
						<div class="col-md-3 col-sm-4">
							<div class="footer-widget">
							<h3 class="widgettitle widget-title">@lang('footer.Company')</h3>
							<div class="textwidget">
								<ul class="footer-navigation">
				
									<li><a href="{{route('company.register')}}" title="@lang('footer.Signup')">@lang('footer.Signup')</a></li>
									<li>
										<a href="{{ route('company.login') }}" title="@lang('footer.Post a Job')">@lang('footer.Post a Job')</a>						

									</li>
									<li><a href="{{route('company.login')}}" title="@lang('footer.Find Candidates')">@lang('footer.Find Candidates')</a></li>
									{{--<li><a href="#" title="@lang('footer.Recruitment Products')">@lang('footer.Recruitment Products')</a></li>--}}
									<li><a href="{{route('company.login')}}" title="@lang('footer.Business Review'">@lang('footer.Business Review')</a></li>
								</ul>
							</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-4">
							<div class="footer-widget">
							<h3 class="widgettitle widget-title">*****</h3>
							<div class="textwidget">
								@lang('footer.Gelarin focuses on information on office vacancies, freelancers, internships, business reviews and Business HUB.')
							</div>
							</div>
						</div>						
						@else
						<div class="col-md-3 col-sm-4">
							<div class="footer-widget">
							<h3 class="widgettitle widget-title">{{__('home.Contact Gelarin')}}</h3>
							<div class="textwidget">
								<form class="footer-form" method="POST" action="{{route('home.contact.send')}}" novalidate="novalidate">
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
			<!-- Footer Section End -->
			
			<script>
				var msgSuccess = '{{Session::get('alert')}}';
				var existMessage = '{{Session::has('alert')}}';

				if(existMessage){
					alert(msgSuccess);
		}

	
  </script>