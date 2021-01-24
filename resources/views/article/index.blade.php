@extends('layouts.blog.app')
@section('meta')<meta name="keywords" content="{{ config('app.keyword') }}" />
	<meta name="description" content="{{ config('app.description') }}">
	<meta name="author" content="gelarin.com">	
	<title>{{ config('app.name', 'Gelarin') }} {{ config('app.title') }}</title>	
@endsection
@section('content')
<div class="container">
	<div class="jumbotron jumbotron-fluid mb-3 pt-0 pb-0 bg-lightblue position-relative">
		<div class="pl-4 pr-0 h-100 tofront">
			<div class="row justify-content-between">
				<div class="col-md-6 pt-6 pb-6 align-self-center">
					<h1 class="secondfont mb-3 font-weight-bold">
						@if(!empty($oneArticles))<a href="{{route('article.detail',[$oneArticles->id,$oneArticles->slug])}}">{{ str_limit(strip_tags(ucwords($oneArticles->title)), 63) }}</a> @endif
					</h1>
					<p class="mb-3">
						@if(!empty($oneArticles)) {{ str_limit(strip_tags($oneArticles->content),186) }} @endif
					</p>
					<p>
						@if(!empty($oneArticles))<a href="{{route('article.detail',[$oneArticles->id,$oneArticles->slug])}}" class="btn btn-dark">{{__('article.Read More')}}</a> @endif						
					</p>
					<br>
				</div>
				<div class="col-md-6 d-none d-md-block pr-0" style="background-size:cover;background-image:url(@if(!empty($oneArticles->cover)){{ asset('storage/uploads/article/'.$oneArticles->cover) }}@endif);">	</div>
			</div>
		</div>
	</div>

<!-- End Site Title
================================================== -->

	<!-- Begin Featured
	================================================== -->
	<section class="featured-posts">
	<div class="section-title">
		<h2><span>{{__('article.Popular article')}}</span></h2>
	</div>
	<div class="card-columns listfeaturedtag">

		<!-- begin post -->
		@if(!empty($featArticles))
		@foreach($featArticles as $featArticle)
		<div class="card">
			<div class="row">
				<div class="col-md-5 wrapthumbnail">
					<a href="@if(Route::is('article.index')) {{route('article.detail',[$featArticle->id,$featArticle->slug])}} @endif @if(Route::is('article.byCategory')) {{route('article.detailByCat',[$featArticle->category_id,$featArticle->category_slug,$featArticle->id,$featArticle->slug])}} @endif @if(Route::is('article.byGroup')) {{route('article.detail',[$featArticle->id,$featArticle->slug])}} @endif">
						<div class="thumbnail" style="background-image:url({{ asset('storage/uploads/article/'.$featArticle->cover) }});">
						</div>
					</a>
				</div>
				<div class="col-md-7">
					<div class="card-block">
						<h2 class="card-title">
							@if(Route::is('article.index'))	
								<a href="{{route('article.detail',[$featArticle->id,$featArticle->slug])}}">{{ str_limit(strip_tags(ucwords($featArticle->title)), 50) }}</a>
							@endif
							@if(Route::is('article.byCategory'))
								<a href="{{route('article.detailByCat',[$featArticle->category_id,$featArticle->category_slug,$featArticle->id,$featArticle->slug])}}">{{ str_limit(strip_tags(ucwords($featArticle->title)), 50) }}</a>											
							@endif
							@if(Route::is('article.lifestyle')or Route::is('article.technology') or Route::is('article.social') or Route::is('article.industry'))	
								<a href="{{route('article.detail',[$featArticle->id,$featArticle->slug])}}">{{ str_limit(strip_tags(ucwords($featArticle->title)), 50) }}</a>
							@endif							
							@if(Route::is('article.index.search'))	
								<a href="{{route('article.detail',[$featArticle->id,$featArticle->slug])}}">{{ str_limit(strip_tags(ucwords($featArticle->title)), 50) }}</a>
							@endif						
						</h2>
						<h4 class="card-text">{{ str_limit(strip_tags($featArticle->content),115) }}</h4>
						<div class="metafooter">
							<div class="wrapfooter">
								<span class="meta-footer-thumb">
								<a href="{{route('article.authors',[$crypto->encodeHex($featArticle->user_id),str_slug($featArticle->user_name)])}}"><img class="author-thumb" src="{{ asset('storage/uploads/member/photo/'.$featArticle->user_photo) }}"></a>
								</span>
								<span class="author-meta">
								<span class="post-name"><a href="{{route('article.authors',[$crypto->encodeHex($featArticle->user_id),str_slug($featArticle->user_name)])}}">{{ str_limit(strip_tags(ucwords($featArticle->user_name)), 25) }}</a></span><br/>
								<span class="post-date">{{date($featArticle->date_format, strtotime($featArticle->created_at))}}</span><span class="dot"></span><span class="post-read">{{$featArticle->visits}} {{__('article.x is read')}}</span>
								</span>
								<span class="post-read-more"><a href="{{route('article.detail',[$featArticle->id,$featArticle->slug])}}" title="Read Story"><svg class="svgIcon-use" width="25" height="25" viewbox="0 0 25 25"><path d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z" fill-rule="evenodd"></path></svg></a></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
		@endif
		<!-- end post -->
	</div>
	</section>
	<!-- End Featured
	================================================== -->

	<!-- Begin List Posts
	================================================== -->
	<section class="recent-posts">
	<div class="section-title">
		<h2><span>{{__('article.All Stories')}}</span></h2>
	</div>
	<div class="card-columns listrecent">

	@if(!empty($articles))
		@foreach($articles as $article)
		<!-- begin post -->
		<div class="card">
			<a href="@if(Route::is('article.index')) {{route('article.detail',[$article->id,$article->slug])}} @endif @if(Route::is('article.byCategory')) {{route('article.detailByCat',[$article->category_id,$article->category_slug,$article->id,$article->slug])}} @endif @if(Route::is('article.byGroup')) {{route('article.detail',[$article->id,$article->slug])}} @endif">
				<img class="img-fluid" style="height:237px;" src="{{ asset('storage/uploads/article/'.$article->cover) }}" alt="">
			</a>
			<div class="card-block">
				<h2 class="card-title">
					@if(Route::is('article.index'))	
						<a href="{{route('article.detail',[$article->id,$article->slug])}}">{{ str_limit(strip_tags(ucwords($article->title)), 50) }}</a>
					@endif
					@if(Route::is('article.byCategory'))
						<a href="{{route('article.detailByCat',[$article->category_id,$article->category_slug,$article->id,$article->slug])}}">{{ str_limit(strip_tags(ucwords($article->title)), 50) }}</a>											
					@endif
					@if(Route::is('article.lifestyle')or Route::is('article.technology') or Route::is('article.social') or Route::is('article.industry'))	
						<a href="{{route('article.detail',[$article->id,$article->slug])}}">{{ str_limit(strip_tags(ucwords($article->title)), 50) }}</a>
					@endif
					@if(Route::is('article.index.search'))	
						<a href="{{route('article.detail',[$article->id,$article->slug])}}">{{ str_limit(strip_tags(ucwords($article->title)), 50) }}</a>
					@endif					
				</h2>
				<h4 class="card-text">{{ str_limit(strip_tags($article->content),110) }}</h4>
				<div class="metafooter">
					<div class="wrapfooter">
						<span class="meta-footer-thumb">
						<a href="{{route('article.authors',[$crypto->encodeHex($article->user_id),str_slug($article->user_name)])}}"><img class="author-thumb" src="{{ asset('storage/uploads/member/photo/'.$article->user_photo) }}"></a>
						</span>
						<span class="author-meta">
						<span class="post-name"><a href="{{route('article.authors',[$crypto->encodeHex($article->user_id),str_slug($article->user_name)])}}">{{ str_limit(strip_tags(ucwords($article->user_name)), 25) }}</a></span><br/>
						<span class="post-date">{{date($article->date_format, strtotime($article->created_at))}}</span><span class="dot"></span><span class="post-read">{{$article->visits}} {{__('article.x is read')}}</span>
						</span>
						<span class="post-read-more"><a href="{{route('article.detail',[$article->id,$article->slug])}}" title="Read Story"><svg class="svgIcon-use" width="25" height="25" viewbox="0 0 25 25"><path d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z" fill-rule="evenodd"></path></svg></a></span>
					</div>
				</div>
			</div>
		</div>
		<!-- end post -->
		@endforeach
		@endif
		<div class="row">
			{{$articles->render()}}
		</div>
	</div>
	</section>
	<!-- End List Posts -->
</div>	
<div class="alertbar">
	<div class="container text-center">
		<img src="{{asset('front/img/favicon/android-icon-36x36.png')}}"><a href="{{ route('article.index') }}" class="btn subscribe">{{__('article.Article')}}</a> <a href="{{ route('manage.article.create') }}" class="btn subscribe">{{__('article.Post Article')}}</a>
	</div>
</div>
@include('article.modal.search')
@endsection
@push('scripts')	
<script type="text/javascript">
		var $ = jQuery.noConflict();	
		@if (isset($errors) and $errors->any())
			@if ($errors->any() and old('checkInputKeyword')=='1')
				$('#apply-job').modal();
			@endif
		@endif	
</script>
@endpush