@extends('layouts.admin.app')
@section('content')
			<!-- /#page-wrapper -->
			<div id="page-wrapper">
				<div class="row page-titles">
					<div class="col-md-5 align-self-center">
						<h3 class="text-themecolor">Create Your New Job</h3>
					</div>
					<div class="col-md-7 align-self-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
							<li class="breadcrumb-item"><a href="javascript:void(0)">For Employer</a></li>
							<li class="breadcrumb-item active">Create Job</li>
						</ol>
					</div>
				</div>
				<div class="container-fluid">
					<!-- /row -->
					<div class="row">
					
					<form enctype="multipart/form-data" method="POST" action="{{ route('admin.page.update',$pages->id) }}" novalidate>
					@csrf
					
						<div class="col-md-12 col-sm-12">
							<!-- General Information -->
							<div class="card">
								<div class="card-header">
									<h4>General Information</h4>
									
									@if(session()->has('success'))
										<span class="kyt-font-white full-time bg-success pull-left breadcrumb">{{session()->get('success')}}</span>					
									@endif
									@if(session()->has('error'))
										<span class="kyt-font-white full-time bg-warning pull-left breadcrumb">{{session()->get('error')}}</span>					
									@endif										
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-sm-3">
											<label>Jenis</label>
											<select class="form-control @error('type') is-invalid @enderror" name="type" required>
												<option value="">Pilih Jenis</option>
												<option value="page" {{ $pages->type == 'page' ? 'selected' : '' }}>Umum</option>
												<option value="aboutme" {{ $pages->type == 'aboutme' ? 'selected' : '' }}>Tentang Kami</option>
												<option value="privacy" {{ $pages->type == 'privacy' ? 'selected' : '' }}>Kebijakan Privasi</option>
												<option value="terms" {{ $pages->type == 'terms' ? 'selected' : '' }}>Syarat & Ketentuan</option>
												<option value="help" {{ $pages->type == 'help' ? 'selected' : '' }}>Bantuan</option>
											</select>
											@error('type')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror										
										</div>
										<div class="col-sm-4">
											<label>Judul</label>
											<input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{old('title',$pages->title)}}" required>
											@error('title')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror										
										</div>										
										
										<div class="col-sm-5">
											<label>Deskripsi</label>
											<input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{old('description',$pages->description)}}" required>
											@error('description')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror										
										</div>
										<div class="col-sm-3 m-clear">
											<label>Letak</label>
											<select class="form-control @error('position') is-invalid @enderror" name="position" required>
												<option value="">Pilih Letak</option>
												<option value="nav" {{ $pages->position == 'nav' ? 'selected' : '' }}>Bagian Navigator</option>
												<option value="lsidebar" {{ $pages->position == 'lsidebar' ? 'selected' : '' }}>Bagian LSidebar</option>
												<option value="rsidebar" {{ $pages->position == 'rsidebar' ? 'selected' : '' }}>Bagian RSidebar</option>
												<option value="footer" {{ $pages->position == 'footer' ? 'selected' : '' }}>Bagian Footer</option>
											</select>
											@error('position')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror											
										</div>									
										<div class="col-sm-4 m-clear">
											<label>Tautan</label>
											<input type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{old('url',$pages->link)}}">
											@error('url')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
										<div class="col-sm-5">
											<label>Keyword</label>
											<input type="text" class="form-control @error('keyword') is-invalid @enderror" id="form-tags-1" name="keyword" value="{{old('keyword',$pages->keyword)}}" required>
											@error('keyword')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror										
										</div>
									</div>		
								</div>
							</div>
							<div class="card">
								<div class="card-header">
									<h4>Detail Halaman</h4>
								</div>
								<div class="card-body">
									<div class="row">
								
										<div class="col-sm-12">
										{{--<label></label>--}}
											<textarea class="form-control @error('content') is-invalid @enderror" id="summernote" placeholder="Isi Konten Lengkap Halaman" name="content" required>{!!old('content',$pages->content)!!}</textarea>
											@error('content')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror											
										</div>
										
									</div>	
								</div>
							</div>
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-sm-4 m-clear">
											<label>Cover</label>
											<div class="input-group">
												<div class="profile-image-outer-container">
													<div class="profile-image-inner-container bg-color-primary">
														@if(empty($pages->picture))
															<img id="profile-img-tag" src="{{asset('front/img/default/cover.jpg') }}" class="img-responsive img-circle">
														@else
															<img id="profile-img-tag" src="{{asset('storage/uploads/page/'.$pages->picture) }}" class="img-responsive">										
														@endif	
													</div>
													<input type="file" name="cover" onchange="readURL(this);formAvatar.submit();" accept="image/*" class="profile-image-input inFile @error('cover') is-invalid @enderror">
													@error('cover')
														<div class="invalid-feedback">{{ $message }}</div>
													@enderror
												</div>
											</div>
										</div>								
										<div class="col-sm-2">
											<label>Status Aktif</label>
											<select class="form-control @error('active') is-invalid @enderror" name="active" required>
												<option value="">Pilih Status</option>
												<option value="1" {{ $pages->active == '1' ? 'selected' : '' }}>Aktif</option>
												<option value="0" {{ $pages->active == '0' ? 'selected' : '' }}>Non Aktif</option>
											</select>
											@error('active')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror											
										</div>
										
									</div>	
								</div>
							</div>							
							<div class="text-center">
								<button type="submit" class="btn btn-m btn-success">Submit</button>
							</div>
							
						</div></form>
					</div>
					<!-- /row -->
				</div>	
			</div>
			<!-- /#page-wrapper -->
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