@extends('layouts.company.app')

@section('content')
<!-- Title Header Start -->
<section class="kyt-header-content">
	<div class="container"></div>
</section>
<div class="clearfix"></div>
<!-- Title Header End -->
			<!-- Freelancer Detail Start -->
			<section>
				<div class="container">
					<div class="col-md-8 col-sm-8">
						<div class="container-detail-box">
							<div class="container-detail-box">
								<div class="col-md-6 col-sm-6">
									<a href="job-detail-3.html" title="job Detail">
										<div class="advance-search-img-box">
											@if(!empty($applMessageTitles->id))
												<img src="{{ asset('storage/uploads/member/photo/'.$applMessageTitles->photo) }}" class="img-responsive" alt="{{$applMessageTitles->name}}"/>
											@else
												<img src="{{ asset('storage/uploads/member/photo/150x150.png')}}" class="img-responsive" alt="" />									
											@endif
										</div>
									</a>
									<div class="advance-search-caption">
										<a href="job-detail-3.html" title="Job Dtail"><h4>{{$applMessageTitles->name}}</h4></a>
										<span>{{$applMessageTitles->profession}}</span>												
									</div>
								</div>
							</div>
							<div class="apply-job-header">
								<h4>{{$title}}</h4>
							</div>
							@if($applMessages->count()>0)
							<div class="row">
								<div class="col-md-12">
									<h4>@lang('application.Message') (<i class="fa fa-comments-o"></i> {{$applMessages->count()}})</h4>
								</div>
							</div>
							<div class="row">
								<!-- Single Review -->
								@foreach($applMessages as $applMessage)				
								<div class="review-list">
									<div class="review-thumb">
										@if(!empty($applMessage->photo))
											<img src="{{ asset('storage/uploads/member/photo/'.$applMessage->photo) }}" class="img-responsive img-circle"/>
										@else
											<img src="{{asset('front/img/default/photo.jpg')}}" class="img-responsive img-circle">									
										@endif										
									</div>
									<div class="review-detail">
										<h4>{{$applMessage->user}}<span>({{CountDay($applMessageTitles->created_at,date("Y-m-d"))}} @lang('application.Days Ago'))</span></h4>
										<span class="re-designation">{{$applMessage->profession}}</span>
										<p>{{$applMessage->message}}</p>
									</div>
								</div>
								@endforeach
								{{$applMessages->render()}}								
							</div>
						@endif
							<div class="row">
								<div class="review-list">
									<div class="col-md-11 col-sm-11">
									@if(session()->has('success'))
										<span class="full-time pull-left breadcrumb">{{session()->get('success')}}</span>					
									@endif
									@if(session()->has('error'))
										<span class="full-time pull-left breadcrumb">{{session()->get('error')}}</span>					
									@endif
									</br>								
									<form role="form" files="true" enctype="multipart/form-data" method="POST" action="{{route('message.store',$applMessageTitles->id)}}" novalidate="novalidate">
									@csrf								
										<span class="re-designation">{{__('application.Reply Message')}}</span>
										<p>
											<textarea id="kyt-textareaMini" class="form-control @error('message') is-invalid @enderror" name="message"  placeholder="@lang('application.Write the contents of your message here')..." required="required">{{old('message')}}</textarea>										
										</p>
										<p>
											@error('message')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror							
										</p>
										<p>
										<button class="btn btn-info fa fa-plus" type="submit"> @lang('application.Send')</button>
										</p>
										</form>
									</div>
								</div>
							</div>							
						</div>
					</div>
					
					<!-- Sidebar Start-->
		@section('sidebar')
			@include('layouts.company.inc.sidebar')
		@show
					<!-- End Sidebar -->
					
				</div>
			</section>
			<!-- Freelancer Detail End -->
@endsection	
		