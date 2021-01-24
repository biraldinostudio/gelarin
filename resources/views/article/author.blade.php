@extends('layouts.blog.app')
@section('meta')<meta name="keywords" content="{{ config('app.keyword') }}" />
	<meta name="description" content="{{ config('app.description') }}">
	<meta name="author" content="gelarin.com">	
	<title>{{ config('app.name', 'Gelarin') }} {{ config('app.title') }}</title>	
@endsection
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8 col-md-offset-2">
			<div class="mainheading">
				<div class="row post-top-meta authorpage">
					<div class="col-md-10 col-xs-12">
						<h1>{{ str_limit(strip_tags(ucwords($users->name)), 21) }}</h1>
						<span class="author-description">
						{{ str_limit(strip_tags(ucwords($users->userdescription->about)), 229) }}
						
						</span>
						<div class="sociallinks"><a target="_blank" href="https://www.facebook.com/{{$users->userdescription->facebook}}"><i class="fa fa-facebook"></i></a> <span class="dot"></span> <a target="_blank" href="https://www.linkedin.com/{{$users->userdescription->linkedin}}"><i class="fa fa-linkedin"></i></a></div>
						<a target="_blank" href="https://twitter.com/{{$users->userdescription->twitter}}" class="btn follow">Follow</a>
					</div>
					<div class="col-md-2 col-xs-12">
						@if(!empty($users->userdescription->photo))
							<img src="{{ asset('storage/uploads/member/photo/'.$users->userdescription->photo) }}" class="author-thumb" title="{{$users->name}}">
						@else
							<img src="{{ asset('front/img/default/photo.jpg') }}" class="author-thumb" title="{{$users->name}}">											
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Top Author Meta
================================================== -->

<!-- Begin Author Posts
================================================== -->
<div class="graybg authorpage">
	<div class="container">
		<div class="listrecent listrelated">
				<!-- begin post -->
				@if(!empty($articles))
				@foreach($articles as $article)	
				<div class="authorpostbox">
					<div class="card">
						<a href="author.html">
						<img class="img-fluid img-thumb" src="{{ asset('storage/uploads/article/'.$article->cover) }}" alt="">
						</a>
						<div class="card-block">
							<h2 class="card-title"><a href="{{route('article.detail',[$article->id,$article->slug])}}">{{ str_limit(strip_tags(ucwords($article->title)), 50) }}</a></h2>
							<h4 class="card-text">{{ str_limit(strip_tags($article->content),175) }}</h4>
							<div class="metafooter">
								<div class="wrapfooter">
									<span class="meta-footer-thumb">
									<a href="{{route('article.authors',[$crypto->encodeHex($article->user_id),str_slug($article->user->name)])}}">
										@if(!empty($article->user->userdescription->photo))
											<img src="{{ asset('storage/uploads/member/photo/'.$article->user->userdescription->photo) }}" class="author-thumb" title="{{$article->user->name}}">
										@else
											<img src="{{ asset('front/img/default/photo.jpg') }}" class="author-thumb" title="{{$users->name}}">											
										@endif
									</a>	
									</span>
									<span class="author-meta">
									<span class="post-name"><a href="{{route('article.authors',[$crypto->encodeHex($article->user_id),str_slug($article->user->name)])}}">{{ str_limit(strip_tags(ucwords($article->user->name)), 25) }}</a></span><br/>
									<span class="post-date">{{date($article->country->date_format, strtotime($article->created_at))}}</span><span class="dot"></span><span class="post-read">{{$article->visits}} {{__('article.x is read')}}</span>
									</span>
									<span class="post-read-more"><a href="{{route('article.detail',[$article->id,$article->slug])}}" title="Read Story"><svg class="svgIcon-use" width="25" height="25" viewbox="0 0 25 25"><path d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z" fill-rule="evenodd"></path></svg></a></span>
								</div>
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
	</div>
</div>
<div class="alertbar">
	<div class="container text-center">
		<img src="{{asset('front/img/favicon/android-icon-36x36.png')}}"><a href="{{ route('article.index') }}" class="btn subscribe">{{__('article.Article')}}</a> <a href="{{ route('manage.article.create') }}" class="btn subscribe">{{__('article.Post Article')}}</a>
	</div>
</div>
@include('article.modal.search')
@endsection