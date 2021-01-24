		<ul class="comments-list reply-list">
			@foreach($childs as $child)
			<li>
				<div class="card">
					<div class="row">
						<div class="col-md-7">
							<div class="card-block">
								<div class="metafooter">
									<div class="wrapfooter">
										<span class="meta-footer-thumb">
											@if(!empty($child->user->userdescription->photo))
												<img src="{{ asset('storage/uploads/member/photo/'.$child->user->userdescription->photo) }}" class="author-thumb" title="{{$child->user}}">
											@else
												<img src="{{ asset('front/img/default/photo.jpg') }}" class="author-thumb" title="{{$child->user}}">											
											@endif
										</span>
										<span class="author-meta">
										<span class="post-name"><a href="{{route('article.authors',[$crypto->encodeHex($child->user->id),str_slug($child->user->name)])}}">{{ str_limit(strip_tags(ucwords($child->user->name)), 21) }}</a></span><br/>
										<span class="post-date">{{CountDay($child->created_at,date("Y-m-d"))}} </span><span class="dot"></span><span class="post-read">@lang('vacancy.Days Ago')</span>
										@if($child->value=='1')
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>									
										@elseif($child->value=='2')
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										@elseif($child->value=='3')
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										@elseif($child->value=='4')
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star filled"></i>
											<i class="fa fa-star"></i>	
										@elseif($child->value=='5')
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
										@guest @else<span class="post-read-more"><a href="#createModal" data-toggle="modal" data-target="#createModal" data-id="{{$child->id}}" data-article_id="{{$articles->id}}" class="reply kyt-reply-button" title="@lang('article.Add New')"><i class="fa fa-reply"></i></a></span>@endguest
										
										
										<p class="card-text">{!!$child->comment!!}</p>									
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<p>
				@if(count($child->childs))<p>
					@include('article.comment.list',['childs' => $child->childs])
					</p>
				@endif
</p>				
			</li>
			@endforeach
		</ul>