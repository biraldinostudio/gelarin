@extends('layouts.app')
@section('content')
			<!-- Title Header Start -->
			<section class="inner-header-title" style="background-image:url({{asset('front/img/content/banner-10.jpg')}});">
				<div class="container">
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- Title Header End -->
			
			<!-- Freelancer Detail Start -->
			<section>
				<div class="container">
					<div class="col-md-8 col-sm-8">
						<form enctype="multipart/form-data" role="form" id="form" method="POST" action="{{ route('manage.article.store') }}" novalidate>
						@csrf						
						<div class="row bottom-mrg extra-mrg">
							<form>
								<h2 class="detail-title">@lang('global.Add Article')</h2> 
									@if(session()->has('message'))
									<p class="kyt-message-success">
										{{ session()->get('message') }}
									</p>
								@endif							
								<div class="col-md-11 col-sm-11">
									<input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="@lang('global.Subject')" name="title" value="{{old('title')}}" maxlength="50" required autofocus>
									@error('title')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								
								<div class="col-md-6 col-sm-6">
												<select name="category" id="category" class="form-control category" required>
													<option value="" data-type=""
														@if (old('category')=='' or old('category')==0)
															selected="selected"
														@endif
													> @lang('global.Select Category') </option>
													@foreach ($categories as $cat)
														<option value="{{ $cat->translation_of }}"
															@if (old('category')==$cat->translation_of)
																selected="selected"
															@endif
														> {{ $cat->name }} </option>
													@endforeach
												</select>
									@error('category')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							<div class="fileUpload btn btn-primary" style="display:none;">
								<span>Select Image</span>
								<input type="file" class="upload" id=profile-img name="profile-img" />
							</div>
							<div class="form-row">							
								<div class="form-group col-lg-2">
									<div class="d-flex justify-content-center mb-4">
										<div class="profile-image-outer-containerCover">
											<div class="profile-image-inner-container bg-color-primary">
												<img src="{{asset('front/img/default/cover.jpg') }}" class="imgCircleCover">
											</div>
												<input type="file" name="cover" onchange="readURLCover(this);formCover.submit();" accept="image/*" class="profile-image-input inFile @error('file') is-invalid @enderror">
										</div>
									</div>




								
									@error('cover')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>	</div>									
								<div class="col-md-12 col-sm-12">
									<textarea id="summernote" class="form-control summernote @error('detail') is-invalid @enderror" name="detail" required>{{old('detail')}}</textarea>
									@error('detail')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
		
								<div class="col-md-6 col-sm-6"><br>
												<select name="type" id="type" class="form-control type" required>
													<option value="" data-type=""
														@if (old('type')=='' or old('type')==0)
															selected="selected"
														@endif
													> @lang('global.Select Type') </option>
													@foreach ($articleTypes as $cat)
														<option value="{{ $cat->translation_of }}"
															@if (old('type')==$cat->translation_of)
																selected="selected"
															@endif
														> {{ $cat->name }} </option>
													@endforeach
												</select>							
									@error('type')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror	
								</div>
								<div class="col-md-12 col-sm-12">
									<input type="text" class="form-control @error('reference') is-invalid @enderror" placeholder="http://www/domain/article/01" value="{{old('reference')}}" name="reference">
										@error('reference')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror	
								</div>
						</div>
						<div class="row bottom-mrg extra-mrg">	
							<h2 class="detail-title">@lang('global.Search Engine Optimization')</h2>							
							<div class="col-md-12 col-sm-12">
					
									<input id="form-tags-1" type="text" class="form-control @error('keyword') is-invalid @enderror" placeholder="@lang('global.Keyword')" name="keyword" value="{{old('keyword')}}" required>
									@error('keyword')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror	<br>
							
							</div>
							<div class="col-md-12 col-sm-12">
							<textarea class="form-control @error('description') is-invalid @enderror" placeholder="@lang('global.Description')" name="description" required>{{old('description')}}</textarea>
                            @error('description')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
                            @enderror

							</div>
						</div>						
						<div class="row bottom-mrg extra-mrg">
							<button type="submit" class="btn btn-success" data-loading-text="Loading..."><i class="fa fa-save fa-lg"></i> @lang('global.Post Articles')</button>&nbsp;
							<a href="{{ route('manage.article.index') }}" class="btn btn-warning"><i class="fa fa-times-circle" ></i> @lang('global.Back')</a>
						</div>		
					</form>
					</div>
					<!-- Sidebar Start-->
					<div class="col-md-4 col-sm-4">
					
								<!-- Company overview -->
								<div class="sidebar-container">
									<div class="sidebar-box">
										<span class="sidebar-status kyt-sidebar-status"><a href="{{route('manage.article.index')}}"><i class="fa fa-arrow-left"></i> @lang('global.Back')</a></span>
									</div>
									<div class="sidebar-box-extra">
									<ul class="status-detail">
										<li class="br-1"><strong>{{ $articles->sum('visits') }}</strong>@lang('global.Visits')</li>
										<li class="br-1"><strong>{{ $artActiveCounts+$artWaitingCounts }}</strong>@lang('global.Article')</li>
										<li><strong>{{ $artActiveCounts}}</strong>@lang('global.Approved')</li>
									</ul>
								</div>								
								</div>
								<!-- /Company overview -->							
								<!-- Working Days -->
								<div class="sidebar-widgets">
								
									<div class="ur-detail-wrap">
										<div class="ur-detail-wrap-header">
											<h4>@lang('global.Review Status')</h4>
										</div>
										<div class="ur-detail-wrap-body">
											<ul class="working-days">
												
										<li>
											<a href="{{route('manage.article.index')}}">@lang('global.Approved')</a>
											<span>{{ $artActiveCounts}}</span>
										</li>
										<li>
											<a href="{{route('manage.article.pending')}}">@lang('global.Waiting')</a>
											<span>{{ $artWaitingCounts}}</span>
										</li>
										<li>
											<a href="{{route('manage.article.archived')}}">@lang('global.Archive')</a>
											<span>{{ $artArchiveCounts}}</span>
										</li>
										<li>
											<a href="{{route('manage.article.inactived')}}">@lang('global.Non-active')</a>
											<span>{{$artUnactiveCounts}}</span>
										</li>
												
											</ul>
										</div>
									</div>
									
								</div>
								<!-- /Working Days -->
								<!-- Company overview -->
								<div class="sidebar-container">
									<div class="sidebar-box">
										<span class="sidebar-status kyt-sidebar-status"><a href="{{route('manage.article.trash')}}"><i class="fa fa-trash"></i> @lang('global.Trash')</a></span>

									</div>
								</div>
								<!-- /Company overview -->	
								@if($ads->count()>0)
								<!-- Say Hello -->
								<div class="sidebar-widgets">
								
									<div class="ur-detail-wrap">
										<div class="ur-detail-wrap-header">
											<h4>Sponsor</h4>
										</div>
										<div class="ur-detail-wrap-body">
									@foreach($ads as $ad)
										<div class="ad-banner">
											<a href="http://{{url($ad->link)}}" target="_blank"><img src="{{ asset('storage/uploads/banner/'.$ad->banner) }}" class="img-responsive" alt="{{$ad->title}}"></a>
										</div>
									@endforeach
										</div>
									</div>
									
								</div>
								<!-- /Say Hello -->
								@else
								@endif									
					</div>
					<!-- End Sidebar -->
					
				</div>
			</section>
			<!-- Freelancer Detail End -->
  	<div class="modal" id="uploadimageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-header" style="display: block;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Upload & Crop Image</h4>
                  </div>
                  <div class="modal-body">
                   <div class="col-sm-12">
                          <div class="col-md-8 text-center">
                              <div id="image_demo" style="width:350px; margin-top:30px"></div>
                          </div>
                    </div>
					
                    <div class="col-sm-12">
                        <a class="fa fa-undo" id="left-rotate-icon"></a>
                        <a class="fa fa-repeat" id="right-rotate-icon"></a>
                    </div>
                  </div>
                  <div class="modal-footer">
                        <button class="btn btn-success crop_image">Crop & Upload Image</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
            </div>
        </div>
    </div>	 
	
@endsection
@push('styles')
	<link rel="stylesheet" href="{{asset('front/center/summernote/summernote.css')}}" />
	<style>
		.note-toolbar.panel-heading{
			z-index: 1;
		}

	</style>
	<link href="{{asset('front/custom/autocomplete/chosen.css')}}" rel="stylesheet">	

	<link rel="stylesheet" href="{{asset('front/center/keyword/css/jquery.tagsinput-revisited.css')}}" />	
	<link href="{{asset('front/center/crop/croppie.css') }}" rel="stylesheet" type="text/css" />		
@endpush
@push('scripts')
	<script type="text/javascript" src="{{asset('front/center/summernote/summernote.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/custom/autocomplete/chosen.jquery.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/custom/autocomplete/init.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/custom/upload_image/bootstrap-imageupload.js')}}"></script>
	<script src="{{asset('front/center/keyword/js/jquery.tagsinput-revisited.js')}}"></script>
	<script src="{{asset('front/center/crop/croppie.js')}}"></script>
	<script src="{{asset('front/js/view/view.shop.js')}}"></script>	
	<script type="text/javascript">
		 var $ = jQuery.noConflict();
			$('.summernote').summernote({
				toolbar: [
					// [groupName, [list of button]]
					['style', ['style']],
					['style', ['bold', 'italic', 'underline', 'clear']],
					//['font', ['strikethrough', 'superscript', 'subscript']],
					['fontsize', ['fontsize']],
					['height', ['height']],
					['fontname', ['fontname']],					
					['color', ['color']],
					['para', ['ul', 'ol', 'paragraph']],
					['insert', ['link', 'picture', 'video','hr']],
					['table', ['table']],
				],
			  height: 400,
			  popatmouse: true,
			  placeholder: "{{trans('global.Please write your article properly and correctly')}}...",
			  
	    callbacks : {
        onMediaDelete : function ($target, $editable) {
            console.log($target.attr('src'));   // get image url 
        }
    }		  
			  
			});
			
			//Bagian Category
		$(".category").select2({
			placeholder: "{{trans('global.Select Category')}}"
		});
		
		$(".type").select2({
			placeholder: "{{trans('global.Select Type')}}"
		});			
       

//Bagian Keyword
			$(function() {
				$('#form-tags-1').tagsInput({
					placeholder: "{{trans('global.Keyword')}}..."
				});
				
			});		
			
			
	</script>

	<script>
		var $ = jQuery.noConflict();	
			$(document.getElementById("photo").onchange = function() {
			document.getElementById("form").submit();
		});	
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