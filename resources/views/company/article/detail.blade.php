@extends('layouts.company.app')
@section('meta')
	<meta name="keywords" content="{{$articles->keyword}}" />
	<meta name="description" content="{!! str_limit(strip_tags(ucwords($articles->description)), 255) !!}">
	<meta name="author" content="gelarin.com">	
	<title>{{$articles->title}} - {{ config('app.name', 'Gelarin') }}</title>	
@endsection	
@section('content')
			<!-- Title Header Start -->
			<section class="inner-header-title" style="background-image:url({{asset('front/img/header-content/banner-10.jpg')}});">
				<div class="container">
					<h1>{{__('article.Article Detail')}}</h1>
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- Title Header End -->
			
			<!-- Blog Detail -->
			<section class="section">
				<div class="container">
					<div class="row no-mrg">
						<div class="col-md-8">
							<article class="blog-news">
								<div class="full-blog">
								
									<figure class="img-holder">
										<img src="{{ asset('storage/uploads/article/'.$articles->cover) }}" class="img-responsive" alt="News">
										<div class="blog-post-date">
											{{date($articles->date_format, strtotime($articles->created_at))}}
										</div>
									</figure>
									<span style="color:#999;font-style: italic;">{{ str_limit(strip_tags(ucwords($articles->cover_description)), 150) }}</span>									
									<div class="full blog-content">
										<div class="post-meta">
											<span class="author"><i class="ti-user"></i><a href="{{route('company.article.authors.pages.profiles',[$crypto->encodeHex($articles->user->id),str_slug($articles->user->name)])}}" title="{{ str_limit(strip_tags(ucwords($articles->user->name)), 50) }}">{{ str_limit(strip_tags(ucwords($articles->user->name)), 50) }}</a></span>
											<span class="author"><i class="fa fa-list-alt"></i><a href="{{route('company.article.byCategory',[$articles->category_id,$articles->cat_slug])}}">{{ str_limit(strip_tags(ucwords($articles->category)), 21) }}</a></span>
											{<span class="author"><i class="ti-comment-alt"></i>{{$articles->articlecomment->count()}} @lang('article.Comment')</span>
										</div>
										<h2 class="blog-sing-title">{{ str_limit(strip_tags(ucwords($articles->title)), 50) }}</h2>
										<div class="blog-text">
											<p>{!!$articles->content!!}</p>
											<div class="post-tags">
												<strong>@lang('article.Keyword'):</strong>
												{{$articles->keyword}}
											</div>
											@if(!empty($articles->reference_link))
											<div class="post-tags">
												<strong>@lang('article.Source'):</strong>												
												<p><a href="{!!$articles->reference_link!!}" target="_blank">{!! str_limit(strip_tags(ucwords($articles->reference_link)), 80) !!}</a></p>
											</div>
											@endif
										</div>
										<div class="row no-mrg">
											<div class="blog-footer-social">
												<span>@lang('article.Share') <i class="fa fa-share-alt"></i></span>
												<ul class="list-inline social">
													<li><a href="#"><i class="fa fa-facebook"></i></a></li>
													<li><a href="#"><i class="fa fa-twitter"></i></a></li>
													<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
													<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									
								</div>
							</article>
				
							<!-- Comment -->
							<div class="row no-mrg">
								<div class="comments">
									<h3 class="mrg-top-40">@lang('article.Comment') <span class="comments-amount">({{$commentCounts}})</span></h3>
							@guest
							 @else		
							<!-- Comment Form -->
							<div class="row no-mrg">
								<div class="comments-form"> 
									<div class="section-title2">
										<h3 class="mrg-top-40">@lang('article.Leave a Comment')</h3>
									</div>
									<form role="form" files="true" enctype="multipart/form-data" method="POST" action="{{route('company.article.comment',$articles->id)}}" novalidate="novalidate">
									@csrf
									<div class="col-md-10 col-sm-10 @error('value') is-invalid @enderror">
										<label >@lang('article.Value'):</label>
										<label class="radio-inline"><input type="radio" name="value" value="1" @if(old('value')=='1') checked="checked" @endif >1</label>
										<label class="radio-inline"><input type="radio" name="value" value="2" @if(old('value')=='2') checked="checked" @endif>2</label>
										<label class="radio-inline"><input type="radio" name="value" value="3" @if(old('value')=='3') checked="checked" @endif >3</label>
										<label class="radio-inline"><input type="radio" name="value" value="4" @if(old('value')=='4') checked="checked" @endif>4</label>
										<label class="radio-inline"><input type="radio" name="value" value="5" @if(old('value')=='5') checked="checked" @endif >5</label>
										@error('value')
										<p>
										   <span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											<p>
										@enderror
									</div>
									<div class="col-md-12 col-sm-12">
										<textarea class="form-control @error('comment') is-invalid @enderror" placeholder="@lang('article.Fill in the comment')" name="comment" required>{{old('comment')}}</textarea>
										@error('comment')
										   <span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
									 <input type="hidden" name="article_id" value="{{ $articles->id }}" />
									<button type="submit" class="thm-btn btn-comment" data-loading-text="Loading..."><i class="fa fa-save fa-lg"></i> @lang('article.Send Comment')</button>
									</form>
								</div>
							</div>@endguest
							<ul>
								@foreach($comments as $comment)
								<li>
									<div class="avatar">
										@if(!empty($comment->user->userdescription->photo))
											<img src="{{ asset('storage/uploads/member/photo/'.$comment->user->userdescription->photo) }}" class="kyt-avatar-comment" title="{{$comment->user}}">
										@else
											<img src="{{ asset('front/img/default/photo.jpg') }}" class="kyt-avatar-comment" title="{{$comment->user}}">											
										@endif
									</div>
									<div class="comment-content"><div class="arrow-comment"></div>
									<div class="comment-by">{{ str_limit(strip_tags(ucwords($comment->user->name)), 21) }}<span class="date rateing">{{date($articles->date_format, strtotime($comment->created_at))}}
									@if($comment->value=='1')
										(<i class="fa fa-star filled"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>)									
									@elseif($comment->value=='2')
										(<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>)
									@elseif($comment->value=='3')
										(<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>)
									@elseif($comment->value=='4')
										(<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star"></i>)	
									@elseif($comment->value=='5')
										(<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>
										<i class="fa fa-star filled"></i>)
									@else
										(<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>)
									@endif <span>			
										<a href="#createModal" data-toggle="modal" data-target="#createModal" data-id="{{$comment->id}}" data-article_id="{{$articles->id}}" class="reply kyt-reply-button" title="@lang('article.Add New')"><i class="fa fa-reply"></i> {{__('article.Reply')}}</a>
									</div>
										<p>{!!$comment->comment!!}</p>
									</div>
									@if(count($comment->childs))
										@include('company.article.comment.list',['childs' => $comment->childs])
									@endif
								</li>
								@endforeach	
							</ul>
	
									@includeWhen(auth()->check(), 'company.article.modal.reply')
								</div>
							</div>
						</div>
						
					@include('layouts.company.inc.sidebarBlog')
					</div>
				</div>
			</section>
			<!-- Blog Detail End -->		
@endsection
@push('styles')
	
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
            $('#editModal').modal('show');
        });		
	</script>
@endpush