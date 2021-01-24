@foreach($comments as $comment)

    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>

	{{--<strong>{{$comment->user}}</strong>--}}

        <p>{!! $comment->comment !!}</p>

        <a href="#createModal" data-toggle="modal" data-target="#createModal" data-id="{{$comment->id}}" data-article_id="{{$articles->id}}" class="reply" title="@lang('global.Add New')">ReplyBro</a>


		@includeWhen(auth()->check(), 'article.comment.list', ['comments' => $comment->replies])		

    </div>

@endforeach