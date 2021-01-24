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
				<form enctype="multipart/form-data" method="POST" action="{{ route('company.article.update',$articles->id) }}" novalidate>
				{{ method_field('PATCH') }}
				@csrf				
				<div class="card-body">
					
					<article class="advance-search-job">
					
						<div class="row no-mrg">
							<div class="col-md-10 col-sm-10">
								<input type="text" id="title" maxlength="50" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="@lang('global.Input Article Title')" value="{{ old('title',$articles->title) }}" autofocus required>
									@error('title')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
							</div>
						</div>
						<div class="row no-mrg">
							<div class="col-md-5 col-sm-5">
								<select name="category" id="category" class="form-control category @error('category') is-invalid @enderror" required>
									<option value="" data-category=""@if (old('category', $articles->category_id)=='' or old('category',$articles->category_id)==0)selected="selected"@endif> @lang('global.Select Job category')</option>
									@foreach ($categories as $category)
										<option value="{{ $category->translation_of}}"@if (old('category',$articles->category_id)==$category->translation_of)selected="selected"@endif> {{ $category->name }} </option>
									@endforeach
								</select>
								@error('category')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror	
							</div>
						</div>						
					
						<div class="row no-mrg">
							<div class="col-md-12 col-sm-12">
								<textarea id="summernote" class="form-control summernote @error('detail') is-invalid @enderror" name="detail" required>{{old('detail',$articles->content)}}</textarea>
								@error('detail')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<p>
						<div class="row no-mrg">
							<div class="col-md-5 col-sm-5">
								<div class="input-group">
								
										<div class="profile-image-outer-container">
											<div class="profile-image-inner-container bg-color-primary">
												@if(empty($articles->cover))
													<img id="profile-img-tag" src="{{asset('front/img/default/cover.jpg') }}" style="height:100px;" class="img-responsive">
												@else
													<img id="profile-img-tag" src="{{asset('storage/uploads/article/'.$articles->cover) }}" style="height:100px;" class="img-responsive">										
												@endif	
											</div>
												<input type="file" name="cover" onchange="readURL(this);formAvatar.submit();" accept="image/*" class="profile-image-input inFile @error('cover') is-invalid @enderror">
												@error('cover')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror								
									
									</div>
								</div>
							</div>					
						</div>
						</p>
						<div class="row no-mrg">
							<div class="col-md-4 col-sm-4">
								<select name="type" id="type" class="form-control type @error('type') is-invalid @enderror" required>
									<option value="" data-type=""@if (old('type', $articles->article_type_id)=='' or old('type',$articles->article_type_id)==0)selected="selected"@endif> @lang('global.Select Job type')</option>
									@foreach ($articleTypes as $type)
										<option value="{{ $type->translation_of}}"@if (old('type',$articles->article_type_id)==$type->translation_of)selected="selected"@endif> {{ $type->name }} </option>
									@endforeach
								</select>							
									@error('type')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
							</div>
						</div>
						<div class="row no-mrg">
							<div class="col-md-10 col-sm-10">
								<input type="text" class="form-control @error('reference') is-invalid @enderror" placeholder="@lang('global.Article reference ex:') http://www/domain/article/01" value="{{old('reference',$articles->reference_link)}}" name="reference">
									@error('reference')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
							</div>
						</div>
						<div class="row no-mrg">
							<h2 class="detail-title">@lang('global.Search Engine Optimization')</h2>					
							<div class="col-md-6 col-sm-6">
								<input id="form-tags-1" type="text" class="form-control @error('keyword') is-invalid @enderror" placeholder="@lang('global.Keyword')" name="keyword" value="{{old('keyword',$articles->keyword)}}" required>
									@error('keyword')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror		
							</div>
							<div class="col-md-6 col-sm-6">
								<textarea class="form-control @error('description') is-invalid @enderror" placeholder="@lang('global.Description')" name="description" required>{{old('description', $articles->description)}}</textarea>
								@error('description')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror							
							</div>						
						</div>
						<p>					
						<div class="row no-mrg">
							<div class="col-md-10 col-sm-10">
								<input type="radio" name="active" value="1" @if(old('active',$articles->active) ==  1) checked="checked" @endif > @lang('global.Active')
								<input type="radio" name="active" value="0" @if(old('active',$articles->active) ==  0) checked="checked" @endif> @lang('global.Inactive')<br>  
								@error('active')
								   <span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						</p>
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
@endpush
@push('scripts')
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