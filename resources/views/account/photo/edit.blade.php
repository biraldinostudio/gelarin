@extends('layouts.app')

@section('content')
<!-- Title Header Start -->
<section class="kyt-header-content">
	<div class="container"></div>
</section>
<div class="clearfix"></div>
<section>
	<div class="container">
		<div class="col-md-8 col-sm-8">
			{{ Breadcrumbs::render('account.photo.edit') }}
			<h3>{{__('account.Data')}} {{__('account.Profile Picture')}} <i class="fa fa-camera"></i></h3>			
			<div class="container-detail-box">
				<div class="form-group">
					<div class="row extra-mrg">
						<div class="col-md-6 col-sm-6">						
							<form method="POST" name="formAvatar" action="{{ route('account.photo.update') }}" enctype="multipart/form-data" novalidate>
							@csrf						
								<label>{{__('account.Profile Picture')}}</label>
								<div class="d-flex justify-content-center mb-4">
									<div class="profile-image-outer-container">
										<div class="profile-image-inner-container bg-color-primary">
										@if(empty(auth()->user()->userdescription->photo))
											<img src="{{asset('front/img/default/photo.jpg') }}" class="imgCircle">
										@else
											<img src="{{asset('storage/uploads/member/photo/'.auth()->user()->userdescription->photo) }}" class="imgCircle">										
										@endif									
										{{--<span class="profile-image-button bg-color-dark">
												<i class="fa fa-camera text-light"></i>
										</span>--}}
										</div>
											<input type="file" name="photo" onchange="readURL(this);formAvatar.submit();" accept="image/*" class="profile-image-input inFile @error('file') is-invalid @enderror">
									</div>
								</div>
							</form>
							@if(session()->has('success'))
								<span class="full-time pull-center breadcrumb">{{session()->get('success')}}</span>					
							@endif
							@if(session()->has('error'))
								<span class="full-time pull-center breadcrumb">{{session()->get('error')}}</span>					
							@endif									
						</div>
						<div class="col-md-6 col-sm-6">
							<form method="POST" name="formCover" action="{{ route('account.cover.update') }}" enctype="multipart/form-data" novalidate>
							@csrf							
								<label>{{__('account.Background')}}</label>
								<div class="d-flex justify-content-center mb-4">
									<div class="profile-image-outer-containerCover">
										<div class="profile-image-inner-container bg-color-primary">
										@if(empty(auth()->user()->userdescription->cover))
											<img src="{{asset('front/img/default/cover.jpg') }}" class="imgCircleCover">
										@else
											<img src="{{ asset('storage/uploads/member/cover/'.auth()->user()->userdescription->cover) }}" class="imgCircleCover">										
										@endif									
										{{--<span class="profile-image-button bg-color-dark">
												<i class="fa fa-camera text-light"></i>
										</span>--}}
										</div>
											<input type="file" name="cover" onchange="readURLCover(this);formCover.submit();" accept="image/*" class="profile-image-input inFile @error('file') is-invalid @enderror">
									</div>
								</div>
							</form>
							@if(session()->has('successCover'))
								<span class="full-time pull-center breadcrumb">{{session()->get('successCover')}}</span>					
							@endif
							@if(session()->has('errorCover'))
								<span class="full-time pull-center breadcrumb">{{session()->get('errorCover')}}</span>					
							@endif									
						</div>						
					</div>
				</div>
			</div>	
		</div>
		@includeWhen(auth()->check(), 'layouts.inc.sidebar')				
	</div>
</section>
@endsection	
@push('styles')
<link href="{{asset('front/css/theme-elementsxx.css')}}" rel="stylesheet">		
@endpush
@push('scripts')	
	<script>
		var $ = jQuery.noConflict();	
			$(document.getElementById("photo").onchange = function() {
			document.getElementById("form").submit();
		});	
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('.imgCircle')
							.attr('src', e.target.result)
							.width(200)
							.height(200);
				};				
				reader.readAsDataURL(input.files[0]);
			}
		}
		function readURLCover(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('.imgCircleCover')
							.attr('src', e.target.result)
							.width(200)
							.height(200);
				};				
				reader.readAsDataURL(input.files[0]);
			}
		}		
	</script>	
@endpush		