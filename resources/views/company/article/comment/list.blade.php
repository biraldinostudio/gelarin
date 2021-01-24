<ul>
	@foreach($childs as $child)
	<li>
		<div class="avatar">
			@if(!empty($child->user->userdescription->photo))
				<img src="{{ asset('storage/uploads/member/photo/'.$child->user->userdescription->photo) }}" class="kyt-avatar-comment" title="{{$child->user}}">
			@else
				<img src="{{ asset('front/img/default/photo.jpg') }}" class="kyt-avatar-comment" title="{{$child->user}}">											
			@endif
		</div>
		<div class="comment-content"><div class="arrow-comment"></div>
		<div class="comment-by">{{ str_limit(strip_tags(ucwords($child->user->name)), 21) }}<span class="date rateing">{{date($articles->date_format, strtotime($child->created_at))}}
		@if($child->value=='1')
			(<i class="fa fa-star filled"></i>
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>)									
		@elseif($child->value=='2')
			(<i class="fa fa-star filled"></i>
			<i class="fa fa-star filled"></i>
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>)
		@elseif($child->value=='3')
			(<i class="fa fa-star filled"></i>
			<i class="fa fa-star filled"></i>
			<i class="fa fa-star filled"></i>
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>)
		@elseif($child->value=='4')
			(<i class="fa fa-star filled"></i>
			<i class="fa fa-star filled"></i>
			<i class="fa fa-star filled"></i>
			<i class="fa fa-star filled"></i>
			<i class="fa fa-star"></i>)	
		@elseif($child->value=='5')
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
			<a href="#createModal" data-toggle="modal" data-target="#createModal" data-id="{{$child->id}}" data-article_id="{{$articles->id}}" class="reply kyt-reply-button" title="@lang('global.Add New')"><i class="fa fa-reply"></i> {{__('article.Reply')}}</a>
		</div>
			<p>{!!$child->comment!!}</p>
		</div>
		@if(count($child->childs))
			@include('company.article.comment.list',['childs' => $child->childs])
		@endif
		
	</li>
	@endforeach	
</ul>