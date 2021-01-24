@extends('layouts.app')
@section('content')

			<!-- Title Header Start -->
			<section class="inner-header-title">
			</section>
			<div class="clearfix"></div>
			<!-- Title Header End -->
			
			<!-- Job Detail Start -->
			<section class="detail-desc advance-detail-pr gray-bg">
				<div class="container white-shadow">
					<div class="row bottom-mrg mrg-0">
						<div class="col-md-12 col-sm-12">
							<div class="advance-detail detail-desc-caption">
								<ul>
									<li><strong class="j-view">{{ $active_counts->sum('visits') }}</strong>@lang('global.Visits')</li>
									<li><strong class="j-applied">{{ $active_counts->count()+$waiting_counts->count() }}</strong>@lang('global.Article')</li>
									<li><strong class="j-shared">{{ $active_counts->count()}}</strong>@lang('global.Approved')</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- Job Detail End -->
			
			<!-- Job full detail Start -->
			<section class="full-detail-description full-detail gray-bg">
				<div class="container">
			
					<!-- Job Description -->
					<div class="col-md-9 col-sm-12">
						<form role="form" files="true" enctype="multipart/form-data" method="POST" action="{{ route('article.edit',[$articles->id,$articles->slug]) }}" novalidate="novalidate">
						@csrf
						<div class="full-card">
						
							<div class="row row-bottom mrg-0">
								<h2 class="detail-title">Job Detail</h2>
								@if(session()->has('message'))
									<div class="alert alert-success">
									{{ session()->get('message') }}
									</div>
								@endif								
								<div class="col-md-12 col-sm-12">
									<div class="input-group">
										<input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="@lang('global.Subject')" name="title" value="{{old('title',$articles->title)}}" required autofocus>
										@if ($errors->has('title'))
											<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
												<strong>{{ $errors->first('title') }}</strong>
											</span>
										@endif										
									</div>	
								</div>
								<div class="col-md-4 col-sm-4">
									<div class="input-group">
										<select name="category" id="category" class="form-control chosen-select" required>
											<option value="" data-category=""@if (old('category', $articles->category_id)=='' or old('category',$articles->category_id)==0)selected="selected"@endif> @lang('global.Select Job category')</option>
											@foreach ($categories as $category)
												<option value="{{ $category->translation_of}}"@if (old('category',$articles->category_id)==$category->translation_of)selected="selected"@endif> {{ $category->name }} </option>
											@endforeach
										</select>
										@if ($errors->has('category'))
											<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
												<strong>{{ $errors->first('category') }}</strong>
											</span>
										@endif										
									</div>	
								</div>
								<div class="col-md-12 col-sm-12">
									<textarea id="summernote" class="summernote{{ $errors->has('detail') ? ' is-invalid' : '' }}" name="detail" required>{{old('detail',$articles->content)}}</textarea>
									@if ($errors->has('detail'))
										<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
											<strong>{{ $errors->first('detail') }}</strong>
										</span>
									@endif
								</div>
								<div class="col-md-11 col-sm-12">
									<div class="input-group{{$errors->has('cover') ? ' is-invalid' : '' }}">
										<input id="profile-img" type="file" name="cover" value="{{old('cover',$articles->cover)}}" required>
										<img id="profile-img-tag" src="{{asset('storage/uploads/article/'.$articles->cover) }}" style="height:100px;" class="img-responsive">
										@if ($errors->has('cover'))
											<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
												<strong>{{ $errors->first('cover') }}</strong>
											</span>
										@endif	
									</div>	
								</div>

								<div class="col-md-11 col-sm-12">
									<div class="input-group">
										<div class="imageupload panel panel-default" >
										<input type="text" name="coverTitle" class="form-control{{$errors->has('coverTitle') ? ' is-invalid' : '' }}" placeholder="@lang('global.Cover Description')" value="{{old('coverTitle',$articles->cover_description)}}" required>
										@if ($errors->has('coverTitle'))
											<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
												<strong>{{ $errors->first('coverTitle') }}</strong>
											</span>
										@endif								
										</div>							
									</div>	
								</div>								
								<div class="col-md-4 col-sm-4">
									<div class="input-group">
										<select name="type" id="type" class="form-control chosen-select" required>
											<option value="" data-type=""@if (old('type', $articles->article_type_id)=='' or old('type',$articles->article_type_id)==0)selected="selected"@endif> @lang('global.Select Job type')</option>
											@foreach ($article_types as $type)
												<option value="{{ $type->translation_of}}"@if (old('type',$articles->article_type_id)==$type->translation_of)selected="selected"@endif> {{ $type->name }} </option>
											@endforeach
										</select>
										@if ($errors->has('type'))
											<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
												<strong>{{ $errors->first('type') }}</strong>
											</span>
										@endif		
									</div>	
								</div>
								<div class="col-md-8 col-sm-8">
									<div class="input-group">
										<input type="text" class="form-control{{ $errors->has('reference') ? ' is-invalid' : '' }}" placeholder="http://www/domain/article/01" value="{{old('reference',$articles->reference_link)}}" name="reference">
										@if ($errors->has('reference'))
											<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
												<strong>{{ $errors->first('reference') }}</strong>
											</span>
										@endif		
									</div>	
								</div>
								
							</div>
							
							<div class="row row-bottom mrg-0">
								<h2 class="detail-title">Search Engine Optimization</h2>
								<div class="col-md-10 col-sm-10">
									<div class="input-group">
										<input id="form-tags-1" type="text" class="form-control{{ $errors->has('keyword') ? ' is-invalid' : '' }}" placeholder="@lang('global.Keyword')" name="keyword" value="{{old('keyword',$articles->keyword)}}" required>
										@if ($errors->has('keyword'))
											<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
												<strong>{{ $errors->first('keyword') }}</strong>
											</span>
										@endif	
									</div>								
								</div>							
								<div class="col-md-12 col-sm-12">
									<div class="input-group">
										<textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="@lang('global.Description')" name="description" required>{{old('description',$articles->keyword)}}</textarea>
										@if ($errors->has('description'))
											<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
												<strong>{{ $errors->first('description') }}</strong>
											</span>
										@endif								
									</div>	
								</div>	
							</div>
							<div class="row row-bottom mrg-0">
								<div class="col-md-4 col-sm-4">
									<label class="form-check-label"><input name="active" id="active" type="checkbox" class="form-check-input" value="1" {{ (old('active',$articles->active)=='1') ? 'checked="checked"' : '' }}> @lang('global.Active')</label>
								</div>
								<div class="col-md-4 col-sm-4">
									<label class="form-check-label"><input name="archived" id="archived" type="checkbox" class="form-check-input" value="1" {{ (old('archived',$articles->archived)=='1') ? 'checked="checked"' : '' }}> @lang('global.Archive')</label>
								</div>								
							</div>						
							<div class="row row-bottom mrg-0">
								<h2 class="detail-title"></h2>
								<div class="col-md-10 col-sm-10">
								<button type="submit" class="btn btn-success" data-loading-text="Loading..."><i class="fa fa-save fa-lg"></i> @lang('global.Post Articles')</button>&nbsp;
									<a href="{{ url()->previous() }}" class="btn btn-warning"><i class="fa fa-times-circle" ></i> @lang('global.Closed')</a>	
								</div>
							</div>
						</div></form>
					</div>
					
					<!-- End Job Description -->
					
					<!-- Start Sidebar -->
					<div class="col-md-3 col-sm-12">
						<div class="sidebar right-sidebar">
							<div class="side-widget">
								<h2 class="side-widget-title">@lang('global.Review Status')</h2>
								<div class="widget-text padd-0">
									<ul>
										<li>
											<a href="{{route('my_article')}}">@lang('global.Approved')</a>
											<span class="pull-right">{{ $active_counts->count() }}</span>
										</li>
										<li>
											<a href="{{route('my_article.pending')}}">@lang('global.Waiting')</a>
											<span class="pull-right">{{ $waiting_counts->count() }}</span>
										</li>
										<li>
											@lang('global.Archive')
											<span class="pull-right">{{ $archive_counts->count() }}</span>
										</li>
										<li>
											@lang('global.Non-active')
											<span class="pull-right">{{ $unactive_counts->count() }}</span>
										</li>										
									</ul>
								</div>
							</div>
							
							@if($ads->count()>0)
								<div class="side-widget">
									<h2 class="side-widget-title">Sponsor</h2>
									<div class="widget-text padd-0">
									@foreach($ads as $ad)
										<div class="ad-banner">
											<a href="http://{{url($ad->link)}}" target="_blank"><img src="{{ asset('storage/uploads/banner/'.$ad->banner) }}" class="img-responsive" alt="{{$ad->title}}"></a>
										</div>
									@endforeach
									</div>
								</div>
							@else
							@endif
						</div>
					</div>
					<!-- End Sidebar -->
				</div>
			</section>
			<!-- Job full detail End -->
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