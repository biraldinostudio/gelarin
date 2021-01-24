@extends('layouts.company.app')
@section('meta')<meta name="keywords" content="{{ config('app.keyword') }}" />
	<meta name="description" content="{{ config('app.description') }}">
	<meta name="author" content="gelarin.com">	
	<title>{{ config('app.name', 'Gelarin') }} {{ config('app.title') }}</title>	
@endsection
@section('content')
<!-- Title Header Start -->
<section class="kyt-header-content">
	<div class="container"></div>
</section>
<div class="clearfix"></div>
<!-- Title Header End -->
<!-- ========== Begin: Brows job Category ===============  -->
<section class="brows-job-category gray-bg">
	<div class="container">
					<div class="col-md-9 col-sm-12">
						<div class="full-card">		
							<div class="card-header">
								<div class="row mrg-0">
					
									@if(Route::is('company.article.active'))
										<form role="form" name="yo" files="true"  enctype="multipart/form-data" method="GET" action="{{ route('company.article.active') }}" role="search">
									@endif
									@if(Route::is('company.article.pending'))
										<form role="form" name="yo" files="true"  enctype="multipart/form-data" method="GET" action="{{ route('company.article.pending') }}" role="search">
									@endif
									@if(Route::is('company.article.inactive'))
										<form role="form" name="yo" files="true"  enctype="multipart/form-data" method="GET" action="{{ route('company.article.inactive') }}" role="search">
									@endif															
									@csrf				
									<div class="col-md-6 col-sm-6">
										<input type="text" id="keyword" name="keyword" class="form-control" value="{{old('keyword')}}" placeholder="@lang('global.Input keyword')...">
									</div>
									<!--<div class="col-md-3 col-sm-3">
										<select class="form-control">
											<option>By Category</option>
											<option>Information Technology</option>
											<option>Mechanical</option>
											<option>Hardware</option>
											</select>
									</div>-->									
									<div class="col-md-1 col-sm-1">
										<?php
											if ($_SERVER['REQUEST_METHOD'] === 'GET') {
												if (isset($_GET['search'])) {
													?>
													<button type="submit" class="btn btn-primary" id="refresh" name="refresh"><i class="fa fa-refresh"></i></button>
													<?php
												} else {
													?>
													<button type="submit" class="btn btn-primary" id="search" name="search"><i class="fa fa-search"></i></button>
													<?php
												}
											}
											else{
												?>
												<button type="submit" class="btn btn-primary" id="search" name="search"><i class="fa fa-search"></i></button>
												<?php
											}
											?>
									</div>									
									<div class="col-md-5 col-sm-5">
										<ol class="breadcrumb pull-right">
											<li><a href="{{route('company.dashboard')}}"><i class="fa fa-home"></i></a></li>
											@if(Route::is('company.article.active')or Route::is('company.article.pending') or Route::is('company.article.inactive'))	
											<li><a href="{{route('company.article.create')}}"><i class="fa fa-plus"></i></a></li>
											@endif
												@if(Route::is('company.article.active'))
													<li>@lang('global.Active Articles')</li>
												@endif
												@if(Route::is('company.article.pending'))
													<li>@lang('global.Pending Articles')</li>
													<li><a href="{{route('company.article.active')}}" class="kyt-font-green" title="@lang('global.Back')"><i class="fa fa-arrow-left"></i></a></li>								
												@endif
												@if(Route::is('company.article.inactive'))
													<li>@lang('global.Inactive Articles')</li>
													<li><a href="{{route('company.article.active')}}" class="kyt-font-green" title="@lang('global.Back')"><i class="fa fa-arrow-left"></i></a></li>								
												@endif																						
											
											@if(Route::is('company.article.active'))
											<li><a href="{{route('company.article.trash')}}"><i class="fa fa-trash"></i> ({{$countArticleTrash}})</a></li>
											@endif
											@if(Route::is('company.article.trash'))
											<li><i class="fa fa-trash"></i> ({{$countArticleTrash}})</li>								
											<li><a href="{{route('company.article.active')}}" class="kyt-font-green" title="@lang('global.Back')"><i class="fa fa-arrow-left"></i></a></li>
											@endif						
										</ol>
									</div>
								</form>				
								</div>
							</div>
							<div class="card-body">
							@if(!empty($countArticles))
								@foreach($articles as $article)	

									<div class="item-click">
										<article>
											<div class="brows-company">
												<div class="col-md-6 col-sm-6">
													<div class="item-fl-box">
														<div class="brows-company-pic">
														@if(!empty($article->cover))
															<a href="{{route('company.article.detail',[$article->id,$article->slug])}}"><img src="{{ asset('storage/uploads/article/'.$article->cover) }}" class="img-responsive" title="{{ str_limit(strip_tags(ucwords($article->title)), 53) }}"></a>
														@else
															<img src="http://via.placeholder.com/150x150" class="img-responsive" title="{{ str_limit(strip_tags(ucwords($article->title)), 53) }}" />											
														@endif
														</div>
														<div class="brows-company-name">
															<h5><a href="{{route('company.article.detail',[$article->id,$article->slug])}}" target="_blank">{{ str_limit(strip_tags(ucwords($article->title)), 53) }}</a></h5>
															<span class="brows-company-tagline">({{$article->articlecomment->count()}} @lang('global.Comment'))</span>
														</div>
													</div>
												</div>
												<div class="col-md-4 col-sm-4">
													<div class="brows-company-location">
														<p><i class="fa fa-eye"></i> ({{$article->visits}}x @lang('global.Visits'))</p>
													</div>
												</div>
												<div class="col-md-2 col-sm-2">
													<div class="brows-company-position">
														<p>
															@if(Route::is('company.article.active')or Route::is('company.article.pending')or Route::is('company.article.inactive'))
																			<a href="{{route('company.article.edit',[$article->id,$article->slug])}}" data-toggle="tooltip" title="@lang('global.Edit')"><i class="fa fa-edit"></i></a>&nbsp;								
															<a href="{{route('company.article.delete',$article->id)}}" onclick="return confirm('@lang('global.Do you want to delete it?')')" data-toggle="tooltip" title="@lang('global.Delete')"><i class="fa fa-remove"></i></a>
															@endif
															@if(Route::is('company.article.trash'))
															<a href="{{route('company.article.restore',[$article->id,$article->slug])}}" onclick="return confirm('@lang('global.Do you want to restore it?')')" data-toggle="tooltip" title="@lang('global.Restore')"><i class="fa fa-undo"></i></a>&nbsp;												
															<a href="{{route('company.article.destroy',$article->id)}}" onclick="return confirm('@lang('global.Do you want to delete it?')')" data-toggle="tooltip" title="@lang('global.Delete')"><i class="fa fa-trash"></i></a>
															@endif											
														</p>
													</div>
													
												</div>
															
								
											</div>
										</article>
									</div>
							@endforeach
										@else
										<article class="advance-search-job">
											<div class="row no-mrg">
												<div class="col-md-10 col-sm-10">
													<div class="advance-search-caption">
														<h4>@lang('global.Sorry') ,</h4>
														<p class="kyt-color-text">@lang('global.There is no data yet')!</p>											
													</div>
												</div>
											</div>
										</article>	
										@endif
							</div>
						</div>			
						<div class="row">
							{{$articles->render()}}
						</div>			
						<!-- Ad banner -->
						<!--
						<div class="row">
							<div class="ad-banner">
								<img src="" class="img-responsive" alt="">
							</div>
						</div>
						-->
					</div>
					<!-- Sidebar Start -->
						@section('sidebar')
							@include('layouts.company.inc.sidebar')
						@show
					<!-- Sidebar End -->
					
				</div>
			</section>
			<!-- ========== Begin: Brows job Category End ===============  -->
@endsection	
		