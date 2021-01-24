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
					<h1>@lang('article.Article Page')</h1>
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- Title Header End -->
			
			<!-- All blog List Start -->
			<section class="section">
				<div class="container">
					<div class="row .no-mrg">
						<!-- Start Blogs -->
						<div class="col-md-8">
						@if(count($articles)>0)
							@foreach($articles as $article)							
							<article class="blog-news">
								<div class="short-blog">
									<figure class="img-holder">
										@if(Route::is('company.article.index'))									
												<a href="{{route('company.article.detail',[$article->id,$article->slug])}}"><img src="{{ asset('storage/uploads/article/'.$article->cover) }}" class="img-responsive" alt="{{ str_limit(strip_tags(ucwords($article->title)), 50) }}"></a>
										@endif
										@if(Route::is('company.article.byCategory'))
												<a href="{{route('company.article.detailByCat',[$article->category_id,$article->category_slug,$article->id,$article->slug])}}"><img src="{{ asset('storage/uploads/article/'.$article->cover) }}" class="img-responsive" alt="{{ str_limit(strip_tags(ucwords($article->title)), 50) }}"></a>										
										@endif	
										<div class="blog-post-date">
											{{date($article->date_format, strtotime($article->created_at))}}
										</div>
									</figure>
									<div class="blog-content">
										<div class="post-meta">
											<span class="author"><i class="ti-user"></i><a href="{{route('company.article.authors.pages.profiles',[$crypto->encodeHex($article->user_id),str_slug($article->user_name)])}}" title="{{$article->user_name}}">{{ str_limit(strip_tags(ucwords($article->user_name)), 50) }}</a></span>
											<span class="author"><a href="{{route('company.article.byCategory',[$article->category_id,$article->category_slug])}}"><i class="fa fa-list-alt"></i>{{ str_limit(strip_tags(ucwords($article->category)), 21) }}</a></span>
											<span class="author"><i class="ti-comment-alt"></i>{{$article->articlecomment->count()}} @lang('article.Comment')</span>
										</div>
										<h2 class="blog-sing-title">
											@if(Route::is('company.article.index'))	
												<a href="{{route('company.article.detail',[$article->id,$article->slug])}}">{{ str_limit(strip_tags(ucwords($article->title)), 50) }}</a>
											@endif
											@if(Route::is('company.article.byCategory'))
												<a href="{{route('company.article.detailByCat',[$article->category_id,$article->category_slug,$article->id,$article->slug])}}">{{ str_limit(strip_tags(ucwords($article->title)), 50) }}</a>											
											@endif										
										</h2>
										<div class="blog-text">
											<p>{{ str_limit(strip_tags($article->content),400) }}</p>
											<div class="post-meta">@lang('article.Keyword'): <span class="category">{{$article->keyword}}</span></div>
										</div>
									</div>
								</div>
							</article>
						@endforeach
						@else					
							<article class="blog-news">
								<div class="short-blog">
									<div class="blog-content">
										<div class="blog-text">
											<div class="post-meta">
												<div class="error-page">
													<h2><span>@lang('article.Sorry'),</span></h2>
													<p>@lang('article.The article page is being repaired')!</p> 
													<a href="{{route('company.article.index')}}" class="btn btn-success small-btn">@lang('article.See another article')</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</article>	
						@endif	
						</div>
						<!-- End Blogs -->
						
					@include('layouts.company.inc.sidebarBlog')
					</div>
					<div class="row">
					{{$articles->render()}}
					</div>
				</div>
			</section>
			<!-- All Blog List End -->
@endsection