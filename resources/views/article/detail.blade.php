@extends('layouts.blog.app')
@section('meta')
	<title>{{$articles->title}} - {{ config('app.name', 'Gelarin') }}</title>
	<meta name="keywords" content="{{$articles->keyword}}" />
	<meta name="description" content="{!! str_limit(strip_tags(ucwords($articles->description)), 255) !!}">
	<meta name="author" content="gelarin.com">	
	<link rel="canonical" href="{{$articles->title}}" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="{{$articles->title}}" />
	<meta property="og:description" content="{!! str_limit(strip_tags(ucwords($articles->description)), 255) !!}" />
	<meta property="og:url" content="{{route('article.detail',[$articles->id,$articles->slug])}}" />
	<meta property="og:site_name" content="{{ config('app.name', 'Gelarin') }}" />
	<meta property="article:publisher" content="https://www.facebook.com/gelarin.id/" />
	<meta property="article:tag" content="{{$articles->title}}" />
	<meta property="article:tag" content="{{$articles->title}}" />
	<meta property="article:section" content="{{$articles->title}}" />
	<meta property="article:published_time" content="{{$articles->created_at}}" />
	<meta property="article:modified_time" content="{{$articles->created_at}}" />
	<meta property="og:updated_time" content="{{$articles->created_at}}" />
	<meta property="og:image" content="{{ asset('storage/uploads/article/'.$articles->cover) }}" />
	<meta property="og:image:secure_url" content="{{ asset('storage/uploads/article/'.$articles->cover) }}" />
	{{--<meta property="og:image:width" content="1110" />
	<meta property="og:image:height" content="592" />--}}
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:description" content="{!! str_limit(strip_tags(ucwords($articles->description)), 255) !!}" />
	<meta name="twitter:title" content="{{$articles->title}}" />
	<meta name="twitter:site" content="{{route('article.detail',[$articles->id,$articles->slug])}}" />
	<meta name="twitter:image" content="{{ asset('storage/uploads/article/'.$articles->cover) }}" />
	<meta name="twitter:creator" content="{{ config('app.name', 'Gelarin') }}" />	
@endsection	
@section('content')
<div class="container">
	<div class="row">

		<!-- Begin Fixed Left Share -->
		<div class="col-md-2 col-xs-12">
			<div class="share">
				<p>
					Share
				</p>
				<ul>
					<li>
					<a target="_blank" href="https://twitter.com/home?status=http%3A//www.gelarin.com">
					<svg class="svgIcon-use" width="29" height="29" viewbox="0 0 29 29"><path d="M21.967 11.8c.018 5.93-4.607 11.18-11.177 11.18-2.172 0-4.25-.62-6.047-1.76l-.268.422-.038.5.186.013.168.012c.3.02.44.032.6.046 2.06-.026 3.95-.686 5.49-1.86l1.12-.85-1.4-.048c-1.57-.055-2.92-1.08-3.36-2.51l-.48.146-.05.5c.22.03.48.05.75.08.48-.02.87-.07 1.25-.15l2.33-.49-2.32-.49c-1.68-.35-2.91-1.83-2.91-3.55 0-.05 0-.01-.01.03l-.49-.1-.25.44c.63.36 1.35.57 2.07.58l1.7.04L7.4 13c-.978-.662-1.59-1.79-1.618-3.047a4.08 4.08 0 0 1 .524-1.8l-.825.07a12.188 12.188 0 0 0 8.81 4.515l.59.033-.06-.59v-.02c-.05-.43-.06-.63-.06-.87a3.617 3.617 0 0 1 6.27-2.45l.2.21.28-.06c1.01-.22 1.94-.59 2.73-1.09l-.75-.56c-.1.36-.04.89.12 1.36.23.68.58 1.13 1.17.85l-.21-.45-.42-.27c-.52.8-1.17 1.48-1.92 2L22 11l.016.28c.013.2.014.35 0 .52v.04zm.998.038c.018-.22.017-.417 0-.66l-.498.034.284.41a8.183 8.183 0 0 0 2.2-2.267l.97-1.48-1.6.755c.17-.08.3-.02.34.03a.914.914 0 0 1-.13-.292c-.1-.297-.13-.64-.1-.766l.36-1.254-1.1.695c-.69.438-1.51.764-2.41.963l.48.15a4.574 4.574 0 0 0-3.38-1.484 4.616 4.616 0 0 0-4.61 4.613c0 .29.02.51.08.984l.01.02.5-.06.03-.5c-3.17-.18-6.1-1.7-8.08-4.15l-.48-.56-.36.64c-.39.69-.62 1.48-.65 2.28.04 1.61.81 3.04 2.06 3.88l.3-.92c-.55-.02-1.11-.17-1.6-.45l-.59-.34-.14.67c-.02.08-.02.16 0 .24-.01 2.12 1.55 4.01 3.69 4.46l.1-.49-.1-.49c-.33.07-.67.12-1.03.14-.18-.02-.43-.05-.64-.07l-.76-.09.23.73c.57 1.84 2.29 3.14 4.28 3.21l-.28-.89a8.252 8.252 0 0 1-4.85 1.66c-.12-.01-.26-.02-.56-.05l-.17-.01-.18-.01L2.53 21l1.694 1.07a12.233 12.233 0 0 0 6.58 1.917c7.156 0 12.2-5.73 12.18-12.18l-.002.04z"></path></svg>
					</a>
					</li>
					<li>
					<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A//www.gelarin.com">
					<svg class="svgIcon-use" width="29" height="29" viewbox="0 0 29 29"><path d="M16.39 23.61v-5.808h1.846a.55.55 0 0 0 .546-.48l.36-2.797a.551.551 0 0 0-.547-.62H16.39V12.67c0-.67.12-.813.828-.813h1.474a.55.55 0 0 0 .55-.55V8.803a.55.55 0 0 0-.477-.545c-.436-.06-1.36-.116-2.22-.116-2.5 0-4.13 1.62-4.13 4.248v1.513H10.56a.551.551 0 0 0-.55.55v2.797c0 .304.248.55.55.55h1.855v5.76c-4.172-.96-7.215-4.7-7.215-9.1 0-5.17 4.17-9.36 9.31-9.36 5.14 0 9.31 4.19 9.31 9.36 0 4.48-3.155 8.27-7.43 9.15M14.51 4C8.76 4 4.1 8.684 4.1 14.46c0 5.162 3.75 9.523 8.778 10.32a.55.55 0 0 0 .637-.543v-6.985a.551.551 0 0 0-.55-.55H11.11v-1.697h1.855a.55.55 0 0 0 .55-.55v-2.063c0-2.02 1.136-3.148 3.03-3.148.567 0 1.156.027 1.597.06v1.453h-.924c-1.363 0-1.93.675-1.93 1.912v1.78c0 .3.247.55.55.55h2.132l-.218 1.69H15.84c-.305 0-.55.24-.55.55v7.02c0 .33.293.59.623.54 5.135-.7 9.007-5.11 9.007-10.36C24.92 8.68 20.26 4 14.51 4"></path></svg>
					</a>
					</li>
				</ul>
				<div class="sep">
				</div>
				<p>
					Talk
				</p>
				<ul>
					<li>
					<a href="#comments">
					{{$commentCounts}}<br/>
					<svg class="svgIcon-use" width="29" height="29" viewbox="0 0 29 29"><path d="M21.27 20.058c1.89-1.826 2.754-4.17 2.754-6.674C24.024 8.21 19.67 4 14.1 4 8.53 4 4 8.21 4 13.384c0 5.175 4.53 9.385 10.1 9.385 1.007 0 2-.14 2.95-.41.285.25.592.49.918.7 1.306.87 2.716 1.31 4.19 1.31.276-.01.494-.14.6-.36a.625.625 0 0 0-.052-.65c-.61-.84-1.042-1.71-1.282-2.58a5.417 5.417 0 0 1-.154-.75zm-3.85 1.324l-.083-.28-.388.12a9.72 9.72 0 0 1-2.85.424c-4.96 0-8.99-3.706-8.99-8.262 0-4.556 4.03-8.263 8.99-8.263 4.95 0 8.77 3.71 8.77 8.27 0 2.25-.75 4.35-2.5 5.92l-.24.21v.32c0 .07 0 .19.02.37.03.29.1.6.19.92.19.7.49 1.4.89 2.08-.93-.14-1.83-.49-2.67-1.06-.34-.22-.88-.48-1.16-.74z"></path></svg>
					</a>
					</li>
				</ul>
			</div>
		</div>
		<!-- End Fixed Left Share -->

		<!-- Begin Post -->
		<div class="col-md-8 col-md-offset-2 col-xs-12">
			<div class="mainheading">

				<!-- Begin Top Meta -->
				<div class="row post-top-meta">
					<div class="col-md-2">
						<a href="{{route('article.authors',[$crypto->encodeHex($articles->user->id),str_slug($articles->user->name)])}}"><img class="author-thumb" src="{{ asset('storage/uploads/member/photo/'.$articles->user->userdescription->photo) }}"></a>
					</div>
					<div class="col-md-10">
						<a class="link-dark" href="{{route('article.authors',[$crypto->encodeHex($articles->user->id),str_slug($articles->user->name)])}}">{{ str_limit(strip_tags(ucwords($articles->user->name)), 25) }}</a><a href="https://twitter.com/{{$articles->user->userdescription->twitter}}" class="btn follow">Follow</a>
						<span class="author-description">{{ str_limit(strip_tags(ucwords($articles->user->userdescription->about)), 171) }}</span>
						<span class="post-date">{{date($articles->date_format, strtotime($articles->created_at))}}</span><span class="dot"></span><span class="post-read">{{$articles->visits}} {{__('article.x is read')}}</span>
					</div>
				</div>
				<!-- End Top Menta -->

				<h1 class="posttitle">{{ str_limit(strip_tags(ucwords($articles->title)), 50) }}</h1>

			</div>

			<!-- Begin Featured Image -->
			<img class="featured-image img-fluid" src="{{ asset('storage/uploads/article/'.$articles->cover) }}" alt="">
			<!-- End Featured Image -->

			<!-- Begin Post Content -->
			<div class="article-post">
				<p>
					{!!$articles->content!!}
				</p>
			</div>
			<!-- End Post Content -->
			<!-- Begin Tags -->
			<div class="after-post-tags">
				<ul class="tags">
					@foreach(explode(",",$articles->keyword) as $keyword)
					<li><a href="">{{$keyword}}</a></li>
					@endforeach				
				</ul>
			</div>
			<!-- End Tags -->
		</div>
		<!-- End Post -->

	</div>
</div>
<!-- End Article
================================================== -->

<div class="hideshare"></div>

<!-- Begin Related
================================================== -->
<div class="graybg">
	<div class="container">
		<div class="row listrecent listrelated">
		@if(!empty($featArticles))
		@foreach($featArticles as $featArticle)
			<!-- begin post -->
			<div class="col-md-4">
				<div class="card">
					<a href="{{route('article.detail',[$featArticle->id,$featArticle->slug])}}">
					<img class="img-fluid img-thumb" src="{{ asset('storage/uploads/article/'.$featArticle->cover) }}" alt="">
					</a>
					<div class="card-block">
						<h2 class="card-title">
							<a href="{{route('article.detail',[$featArticle->id,$featArticle->slug])}}">{{ str_limit(strip_tags(ucwords($featArticle->title)), 50) }}</a>						
						</h2>
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
			<!-- end post -->
		@endforeach
		@endif
		</div>
	</div>
</div>
	<div id="comment" class="comments-container">
		<h1>{{__('article.Comment')}} ({{$commentCounts}})</h1>
		
		<ul id="comments-list" class="comments-list">
		@foreach($comments as $comment)
			<li>
				<div class="card">
					<div class="row">
						<div class="col-md-7">
							<div class="card-block">
								<div class="metafooter">
									<div class="wrapfooter">
										<span class="meta-footer-thumb">
											@if(!empty($comment->user->userdescription->photo))
												<img src="{{ asset('storage/uploads/member/photo/'.$comment->user->userdescription->photo) }}" class="author-thumb" title="{{$comment->user->name}}">
											@else
												<img src="{{ asset('front/img/default/photo.jpg') }}" class="author-thumb" title="{{$comment->user->name}}">											
											@endif
										</span>
										<span class="author-meta">
										<span class="post-name"><a href="{{route('article.authors',[$crypto->encodeHex($comment->user->id),str_slug($comment->user->name)])}}">{{ str_limit(strip_tags(ucwords($comment->user->name)), 21) }}</a></span><br/>
										<span class="post-date">{{CountDay($comment->created_at,date("Y-m-d"))}} </span><span class="dot"></span><span class="post-read">@lang('vacancy.Days Ago')</span>
										@if($comment->value=='1')
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>									
										@elseif($comment->value=='2')
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										@elseif($comment->value=='3')
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										@elseif($comment->value=='4')
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star"></i>	
										@elseif($comment->value=='5')
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
										@guest @else<span class="post-read-more"><a href="#createModal" data-toggle="modal" data-target="#createModal" data-id="{{$comment->id}}" data-article_id="{{$articles->id}}" class="reply kyt-reply-button" title="@lang('article.Add New')"><i class="fa fa-reply"></i></a></span>@endguest
										
										
										<p class="card-text">{!!$comment->comment!!}</p>									
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<p>
				@if(count($comment->childs))<p>
					@include('article.comment.list',['childs' => $comment->childs])
					</p>
				@endif	
</p>				
			</li>
			@endforeach
		</ul>
		@guest
		@else		
			<!-- Comment Form -->				
			<div class="comments-form"> 
				<div class="section-title2">
					<h3 class="mrg-top-40">@lang('article.Leave a Comment')</h3>
				</div>
				<form role="form" files="true" enctype="multipart/form-data" method="POST" action="{{route('article.comment',$articles->id)}}" novalidate="novalidate">
				@csrf			
					<div class="form-group">
						<label >@lang('article.Value'):</label>
						<label class="radio-inline"><input type="radio" name="value" value="1" @if(old('value')=='1') checked="checked" @endif >1</label>
						<label class="radio-inline"><input type="radio" name="value" value="2" @if(old('value')=='2') checked="checked" @endif>2</label>
						<label class="radio-inline"><input type="radio" name="value" value="3" @if(old('value')=='3') checked="checked" @endif >3</label>
						<label class="radio-inline"><input type="radio" name="value" value="4" @if(old('value')=='4') checked="checked" @endif>4</label>
						<label class="radio-inline"><input type="radio" name="value" value="5" @if(old('value')=='5') checked="checked" @endif >5</label>
						@error('value')
							<div class="invalid-feedback"><p>{{ $message }}</p></div>
						@enderror
						<textarea class="form-control @error('comment') is-invalid @enderror" placeholder="@lang('article.Fill in the comment')" name="comment" required>{{old('comment')}}</textarea>
						@error('comment')
							<div class="invalid-feedback"><p>{{ $message }}</p></div>
						@enderror
					</div>
					<div class="form-group">
						<input type="hidden" name="article_id" value="{{ $articles->id }}" />
						<button type="submit" class="btn subscribe" data-loading-text="Loading...">@lang('article.Send Comment')</button>
					</div>
				</form>
			</div>
		@endguest		
		@includeWhen(auth()->check(), 'article.modal.reply')		
	</div>
<div class="alertbar">
	<div class="container text-center">
		<img src="{{asset('front/img/favicon/android-icon-36x36.png')}}"> {{__('article.Publishing your article or writing your business statement?')}} <a href="{{ route('manage.article.create') }}" class="btn subscribe">{{__('article.Post Article')}}</a> <a href="{{ route('article.index') }}" class="btn subscribe">{{__('article.Article')}}</a>
	</div>
</div>
@include('article.modal.search')
@endsection
@push('styles')
    <link href="{{asset('front/blog/css/comment.css')}}" rel="stylesheet">
@endpush
@push('scripts')
    <script type="text/javascript">
        // Edit a post
		var $ = jQuery.noConflict();		
        $(document).on('click', '.reply', function() {
            $('#id_edit').val($(this).data('id'));
            $('#article_id_edit').val($(this).data('article_id'));		
            id = $('#id_edit').val();
            article_id = $('#article_id_edit').val();			
            $('#createModal').modal('show');
        });		
	</script>
@endpush