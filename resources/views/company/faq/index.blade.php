@extends('layouts.company.app')
@section('meta')<meta name="keywords" content="{{ config('app.keyword') }}" />
	<meta name="description" content="{{ config('app.description') }}">
	<meta name="author" content="gelarin.com">	
	<title>{{ config('app.name', 'Gelarin') }} {{ config('app.title') }}</title>	
@endsection
@section('content')
			<!-- Title Header Start -->
			<section class="inner-header-title" style="background-image:url({{asset('front/img/blog/banner-10.jpg')}});">
				<div class="container">
					<h1>@lang('faq.Help Center')</h1>
				</div>
			</section>
			<div class="clearfix"></div>
			
			<!-- Accordion Design Start -->
			<section class="accordion">
				<div class="container">
					<!-- search filter -->
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="search-filter">
							<form role="form" method="POST" enctype="multipart/form-data" action="{{route('company.faq.index')}}" id="search">
							@csrf	
								<div class="col-md-6 col-sm-7">
									<div class="filter-form">
										<div class="input-group">
											<input type="text" id="keyword" class="form-control" placeholder="{{__('faq.Keyword')}}" name="keyword" value="{{old('name')}}">
											<span class="input-group-btn">
											<?php
												if ($_SERVER['REQUEST_METHOD'] === 'POST') {
													if (isset($_POST['search'])) {
														?>
														<button type="submit" id="refresh" name="refresh" class="btn btn-default">Refresh</button>
														<?php
													} else {
														?>
														<button type="submit" id="search" name="search" class="btn btn-default">Go</button>
														<?php
													}
												}
												else{
													?>

													<button type="submit" id="search" name=""search class="btn btn-default">Go</button>
													<?php
												}
												?>
											</span>
										</div>
									</div>
								</div>
								{{--<div class="col-md-8 col-sm-7">
									<div class="short-by pull-right">
										Short By
										<div class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <i class="fa fa-angle-down" aria-hidden="true"></i></a>
										<ul class="dropdown-menu">
											<li><a href="#">Short By Date</a></li>
											<li><a href="#">Short By Views</a></li>
											<li><a href="#">Short By Popular</a></li>
										</ul>
										</div>
									</div>
								</div>--}}
								</form>
							</div>
						</div>
					</div>
					@if(count($faqs)>0)	
					<div class="col-md-12 col-sm-12">
						<div class="simple-tab">
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							@foreach($faqs as $faq)
								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="{{$faq->translation_of}}">
										<h4 class="panel-title">
											<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$faq->translation_of}}" aria-expanded="true" aria-controls="collapse{{$faq->translation_of}}">
												{{$faq->title}}
											</a>
										</h4>
									</div>
									<div id="collapse{{$faq->translation_of}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="{{$faq->translation_of}}">
										<div class="panel-body">
											<p>{!!$faq->content!!}</p>
										</div>
									</div>
								</div>
							@endforeach	
							</div>
						</div>
						<div class="row">
							{{$faqs->render()}}
						</div>						
					</div>
					@else
					<div class="col-md-12 col-sm-12">
						<div class="simple-tab">
						{{__('faq.There are no content with these keywords')}}!
						</div>
					
					</div>						
					
					@endif	
				</div>
			</section>
			<!-- Accordion Design End -->	
@endsection