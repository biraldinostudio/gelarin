@extends('layouts.company.app')

@section('content')
<!-- Title Header Start -->
<section class="kyt-header-content">
	<div class="container"></div>
</section>
<div class="clearfix"></div>
<!-- Title Header End -->
						
<!-- ========== Begin: Brows job Category ===============  -->
<section class="brows-job-category gray-bg">
	<div class="container">			
		<div class="col-md-9 col-sm-12">
			<div class="full-card">		
				<div class="card-header">
					<div class="row mrg-0">		
						<div class="col-md-7 col-sm-7">
							@if(session()->has('message'))
								<ol class="breadcrumb pull-left">
									<li class="active">
										<i class="fa fa-check"></i> {{ session()->get('message') }}
									</li>
								</ol>	
							@endif					
						</div>
						<!--<div class="col-md-3 col-sm-3">
							<select class="form-control">
								<option>By Category</option>
								<option>Information Technology</option>
								<option>Mechanical</option>
								<option>Hardware</option>
								</select>
						</div>-->									
						<div class="col-md-1 col-sm-1">
						</div>									
						<div class="col-md-4 col-sm-4">
							<ol class="breadcrumb pull-right">
								<li><a href="{{route('company.dashboard')}}"><i class="fa fa-home"></i></a></li>
								<li>
									@lang('global.Add Articles')																					
								</li>
							<li><a href="{{route('company.article.active')}}" class="kyt-font-green" title="@lang('global.Back')"><i class="fa fa-arrow-left"></i></a></li>							
							</ol>
						</div>
					</div>
				</div>
				<form enctype="multipart/form-data" method="POST" action="{{ route('company.article.store') }}" novalidate>
				@csrf				
				<div class="card-body">
					
					<article class="advance-search-job">
					
						<div class="row no-mrg">
							<div class="col-md-10 col-sm-10">
								<input type="text" id="title" maxlength="50" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="@lang('global.Input Article Title')" value="{{ old('title') }}" autofocus required>
								@if ($errors->has('title'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('title') }}</strong>
									</p>
								@endif
							</div>
						</div>
						<div class="row no-mrg">
							<div class="col-md-5 col-sm-5">
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
								@if ($errors->has('category'))
									<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
										<strong>{{ $errors->first('category') }}</strong>
									</span>
								@endif	
							</div>
						</div>						
					
						<div class="row no-mrg">
							<div class="col-md-12 col-sm-12">
								<textarea id="summernote" class="form-control summernote{{ $errors->has('detail') ? ' is-invalid' : '' }}" name="detail" required>{{old('detail')}}</textarea>
								@if ($errors->has('detail'))
									<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
										<strong>{{ $errors->first('detail') }}</strong>
									</span>
								@endif
							</div>
						</div>					
						<div class="row no-mrg">
							<div class="col-md-10 col-sm-10">
								<div class="input-group">
									<div class="imageupload panel panel-default" >
										<div class="file-tab panel-body text-right">
											<div class="dz-default dz-message">
												<label class="btn btn-default btn-file">
												<i class="fa fa-cloud-upload"></i>
												<span style="color:green;">Browser</span>
													<input type="file" name="cover" class="form-control img-circle inPhoto{{$errors->has('cover') ? ' is-invalid' : '' }}" value="{{old('cover')}}" required>
												</label>
											</div>															
										</div>
										@if ($errors->has('cover'))
											<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
												<strong>{{ $errors->first('cover') }}</strong>
											</span>
										@endif										
									</div>							
								</div>	
							</div>
						</div>
						<div class="row no-mrg">
							<div class="col-md-4 col-sm-4">
								<select name="type" id="type" class="form-control type" required>
									<option value="" data-type=""
										@if (old('type')=='' or old('type')==0)
											selected="selected"
										@endif
									> @lang('global.Select Type') </option>
									@foreach ($aritcleTypes as $cat)
										<option value="{{ $cat->translation_of }}"
											@if (old('type')==$cat->translation_of)
												selected="selected"
											@endif
										> {{ $cat->name }} </option>
									@endforeach
								</select>
								@if ($errors->has('type'))
									<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
										<strong>{{ $errors->first('type') }}</strong>
									</span>
								@endif	
							</div>
						</div>

						<div class="row no-mrg">
							<div class="col-md-10 col-sm-10">
								<input type="text" class="form-control{{ $errors->has('reference') ? ' is-invalid' : '' }}" placeholder="@lang('global.Article reference ex:') http://www/domain/article/01" value="{{old('reference')}}" name="reference">
								@if ($errors->has('reference'))
									<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
										<strong>{{ $errors->first('reference') }}</strong>
									</span>
								@endif							

							</div>
						</div>
						<div class="row no-mrg">
							<h2 class="detail-title">@lang('global.Search Engine Optimization')</h2>					
							<div class="col-md-6 col-sm-6">
								<input id="form-tags-1" type="text" class="form-control{{ $errors->has('keyword') ? ' is-invalid' : '' }}" placeholder="@lang('global.Keyword')" name="keyword" value="{{old('keyword')}}" required>
								@if ($errors->has('keyword'))
									<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
										<strong>{{ $errors->first('keyword') }}</strong>
									</span>
								@endif		
							</div>
							<div class="col-md-6 col-sm-6">
								<textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="@lang('global.Description')" name="description" required>{{old('description')}}</textarea>
								@if ($errors->has('description'))
									<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
										<strong>{{ $errors->first('description') }}</strong>
									</span>
								@endif							
							</div>						
						</div>
					</article>
					<article class="advance-search-job">
						<div class="row no-mrg">
							<div class="col-md-10 col-sm-10">
								<p style="text-align:left;">
									<button type="submit" class="btn btn-m btn-primary"><i class="fa fa-save"></i> Submit</button>
									<a class="btn btn-warning" href="{{ route('vacancies.active') }}"><i class="fa fa-arrow-circle-left"></i> @lang('global.Back')</a>										
								</p>
							</div>
						</div>
					</article>					
				</div></form>
			</div>
		</div>
		<!-- Sidebar Start -->
		@section('sidebar')
			@include('layouts.company.inc.sidebar')
		@show
		<!-- Sidebar End -->	
	</div>
</section>
@endsection	
@push('styles')
	<link rel="stylesheet" href="{{asset('front/center/summernote/summernote.css')}}" />
	<style>
		.note-toolbar.panel-heading{
			z-index: 1;
		}
	</style>
	<link href="{{asset('front/custom/autocomplete/chosen.css')}}" rel="stylesheet">	
	<link href="{{asset('front/custom/upload_image/bootstrap-imageupload.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('front/center/keyword/css/jquery.tagsinput-revisited.css')}}" />
@endpush
@push('scripts')
	<script type="text/javascript" src="{{asset('front/center/summernote/summernote.js')}}"></script>
	<script type="text/javascript">
		 var $ = jQuery.noConflict();
			$('#summernote').summernote({
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
	</script>
	<script type="text/javascript" src="{{asset('front/custom/autocomplete/chosen.jquery.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/custom/autocomplete/init.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/custom/upload_image/bootstrap-imageupload.js')}}"></script>
    <script type="text/javascript">
		var $ = jQuery.noConflict();
		
		$(".category").select2({
			placeholder: "{{trans('global.Select Category')}}"
		});
		
		$(".type").select2({
			placeholder: "{{trans('global.Select Type')}}"
		});			
            var $imageupload = $('.imageupload');
            $imageupload.imageupload();
            $('#imageupload-reset').on('click', function() {
                $imageupload.imageupload('reset');
                $(this).blur();
            });
	
		function readURL(input) {

			if (input.files && input.files[0]) {

				var reader = new FileReader();

				$imageupload.imageupload('reset');

				reader.onload = function (e) {

					$('#profile-img-tag').attr('src', e.target.result);

				}

				reader.readAsDataURL(input.files[0]);

			}

		}

		$("#profile-img").change(function(){

			readURL(this);

		});			
	</script>
	
		<script src="{{asset('front/center/keyword/js/jquery-3.3.1.min.js')}}"></script>
		<script src="{{asset('front/center/keyword/js/jquery-ui.min.js')}}"></script>
	

		<script src="{{asset('front/center/keyword/js/jquery.tagsinput-revisited.js')}}"></script>	
	
		<script type="text/javascript">
		var $ = jQuery.noConflict();		
			$(function() {
				$('#form-tags-1').tagsInput({
					placeholder: "{{trans('global.Keyword')}}..."
				});
				
			});
	</script>
@endpush		