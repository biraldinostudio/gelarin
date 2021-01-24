@extends('layouts.app')
@section('meta')<meta name="keywords" content="{{ config('app.keyword') }}" />
	<meta name="description" content="{{ config('app.description') }}">
	<meta name="author" content="gelarin.com">	
	<title>{{ config('app.name', 'Gelarin') }} {{ config('app.title') }}</title>	
@endsection
@section('content')			
			<!-- Title Header Start -->
			<section class="inner-header-title" style="background-image:url({{asset('front/img/content/banner-10.jpg')}});">
				<div class="container">
					<h1>Manage Company</h1>
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- Title Header End -->
			
			<!-- Manage Company List Start -->
			<section class="manage-company gray">
				<div class="container">
				
					<!-- search filter -->
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="search-filter">
								<div class="col-md-6 col-sm-7">
									<div class="filter-form">
										<form role="form" name="yo" files="true"  enctype="multipart/form-data" method="GET" action="{{ route('employers.pages.index') }}" role="search">
										<div class="input-group">
											<input type="text" class="form-control" name="keyword" value="{{old('keyword')}}" placeholder="@lang('global.Input keyword')...">
											<span class="input-group-btn">

												
												
						<?php
							if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    							if (isset($_GET['search'])) {
        							?>
									<button type="submit" class="btn btn-default" id="refresh" name="refresh"><i class="fa fa-refresh"></i></button>
       								<?php
    							} else {
       								?>
									<button type="submit" class="btn btn-default" id="search" name="search"><i class="fa fa-search"></i></button>
       								<?php
   								}
							}
							else{
								?>
								<button type="submit" class="btn btn-default" id="search" name="search"><i class="fa fa-search"></i></button>
								<?php
							}
							?>												
												
												
												
											</span>
										
										</div></form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- search filter End -->
					
					<div class="row">
						<div class="col-md-12">
						@if($companies->count()>0)
							@foreach($companies as $company)
							<article>
								<div class="mng-company">
									<div class="col-md-8 col-sm-8">
										<div class="item-fl-box">
											<div class="mng-company-pic">
											@if(!empty($company->logo))
												<img src="{{ asset('storage/uploads/company/logo/'.$company->logo) }}" class="img-responsive" title="{{$company->name}}" />
											@else
												<img src="{{asset('front/img/default/cover.jpg') }}" class="img-responsive" title="{{$company->name}}" />												
											@endif	
											</div>
											<div class="mng-company-name">
												<h4><a href="{{route('employers.pages.profiles',[$crypto->encodeHex($company->id),$company->slug])}}">{{ str_limit(strip_tags(ucwords($company->name)), 30) }}</a> <br><span class="cmp-tagline">({{str_limit(strip_tags(ucwords(str_replace($removeWords,'',$company->industry))),50)}})</span></h4>
												<span class="cmp-time rateing">
													@if($company->rating>0 and $company->rating<=5)
														<i class="fa fa-star filled"></i>														
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
													@elseif($company->rating>5 and $company->rating<=10)	
														<i class="fa fa-star filled"></i>
														<i class="fa fa-star filled"></i>														
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
													@elseif($company->rating>10 and $company->rating<=50)
														<i class="fa fa-star filled"></i>
														<i class="fa fa-star filled"></i>														
														<i class="fa fa-star filled"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
													@elseif($company->rating>50 and $company->rating<=100)
														<i class="fa fa-star filled"></i>
														<i class="fa fa-star filled"></i>														
														<i class="fa fa-star filled"></i>
														<i class="fa fa-star filled"></i>
														<i class="fa fa-star"></i>
													@elseif($company->rating>100)
														<i class="fa fa-star filled"></i>
														<i class="fa fa-star filled"></i>														
														<i class="fa fa-star filled"></i>
														<i class="fa fa-star filled"></i>
														<i class="fa fa-star filled"></i>
													@else		
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
													@endif														
												</span>
											</div>
										</div>
									</div>
									<div class="col-md-4 col-sm-4">
										<div class="mng-company-location">
											<p><i class="fa fa-map-marker"></i> {{str_limit(strip_tags(ucwords($company->address)),40)}},{{str_limit(strip_tags(ucwords($company->city)),30)}},{{str_limit(strip_tags(ucwords($company->province)),30)}}</p>
										</div>
									</div>
								</div>
							</article>
						@endforeach	
						@else
							<article>
								<div class="mng-company">
									<div class="row">
										<div class="container">
											<div class="error-page">
												<p><span style="color:red;"><b>Oops...</b></span></span>@lang('global.No results found')!</p> 
											</div>
										</div>
									</div>
														</div>
							</article>							
						@endif		
							

							
						</div>
					</div>
					
					<div class="row">
						{{$companies->render()}}
					</div>
					
				</div>
			</section>
			<!-- Manage Company List End -->
@endsection
@push('styles')
@endpush
@push('scripts')

@endpush