@extends('layouts.app')	
<?php
          $storage="public/uploads/member/resume/";
            $public_path="storage/uploads/member/resume/";
?>
@section('content')
			<!-- bottom form section start -->
			<section class="kyt-header-content">
				<div class="container"></div>
			</section>
			<div class="clearfix"></div>
			<!-- Title Header End -->
			<!-- Freelancer Detail Start -->
			<section>
				<div class="container">
					<div class="col-md-8 col-sm-8">
						<!-- Similar Jobs -->
						<div class="container-detail-box">
						<div class="container-detail-box">
					
								<h3>{{__('application.Employer Message Box')}}</h3>
								<span>
									{{__('application.This is an incoming message from the company or employer for the job position offered in accordance with the job title')}}:
										<a href="{{ route('vacancies.detail',[$applications->vacancy->id,$applications->vacancy->slug]) }}" class="cl-success" target="_blank"><b>{{$applications->vacancy->title}}</b></a>
								</span>
				
						</div>						
							<div class="row">
								<div class="col-md-12">
									<h4>@lang('application.Message') (<i class="fa fa-comments-o"></i> {{$applMessages->count()}})</h4>
								</div>
							</div>
							<div class="row">
								<!-- Single Review -->
								@foreach($applMessages as $message)
							
								<div class="review-list">
									<div class="review-thumb">
									@if(!empty($message->photo))
										<img src="{{ asset('storage/uploads/member/photo/'.$message->photo) }}" class="img-responsive img-circle" alt="" />
									@else
										<img src="{{asset('front/img/default/photo.jpg') }}" class="img-responsive img-circle" alt="" />										
									@endif	
									</div>
									<div class="review-detail">
										<h4>{{$message->user}}<span>{{CountDay($message->created_at,date("Y-m-d"))}} @lang('home.Days Ago')</span></h4>										
										<span class="re-designation">@foreach($companyOfficers as $companyOfficer)@if($message->user_id==$companyOfficer->user_id) {{$companyOfficer->position}} @else @endif @endforeach</span>
										<p>{{$message->message}}</p>
									</div>
								</div>
								@endforeach
								{{$applMessages->render()}}
							</div>
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
									<form role="form" files="true" enctype="multipart/form-data" method="POST" action="{{route('application.message.store',$applications->id)}}" novalidate="novalidate">
									@csrf								
										<span class="re-designation">{{__('application.Reply Message')}}</span>
										<p>
											<textarea id="kyt-textareaMini" class="form-control @error('message') is-invalid @enderror" name="message"  placeholder="@lang('application.Write the contents of your message here')..." required>{{old('message')}}</textarea>										
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
					@includeWhen(auth()->check(), 'layouts.inc.sidebar')
					<!-- End Sidebar -->
					
				</div>
			</section>
			<!-- Freelancer Detail End -->

@endsection	
	@push('styles')
	<link href="{{asset('front/center/summernote/summernote-lite.css')}}" rel="stylesheet" /> 	
@endpush
@push('scripts')
	<script src="{{asset('front/center/file_upload/file-upload.js')}}"></script>
	<script src="{{asset('front/center/summernote/summernote-lite.js')}}" type="text/javascript"></script>
			<script type="text/javascript">
					var $ = jQuery.noConflict();
					$(document).ready(function() {
						$('#summernote').summernote({
							height: 150,
							tabsize: 2,
							toolbar: [
								['font', ['bold', 'italic']],
								['para', ['ul', 'ol']],
							],
							required:"required",
						placeholder: "{{trans('global.Tell the company why you are best suited for this position. Mention specific skills and how you contribute.')}}",  
						});
					});
			</script>	
@endpush	