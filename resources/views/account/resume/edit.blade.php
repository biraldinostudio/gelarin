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
			<h3>{{__('account.Data')}} {{__('account.Curriculum Vitae')}} <i class="fa fa-file"></i></h3>			
			<div class="container-detail-box">
				<div class="form-group">
					<div class="row extra-mrg">
						<div class="col-md-12 col-sm-12">
							@if(!empty(auth()->user()->userdescription->resume))
								<div><a href="{{route('account.download_resume')}}"><b>{{substr(auth()->user()->userdescription->resume,7)}}</b> ({{__('account.Date Updated')}} {{date($myCountries->date_format, strtotime(auth()->user()->userdescription->resume_at))}})</a></div>
							@endif
							<form method="POST" name="form" action="{{ route('account.resume.update') }}" enctype="multipart/form-data" novalidate>
							@csrf							
							
								<input onchange="readURL(this);form.submit();" class="form-control @error('resume') is-invalid @enderror" type="file" id="file" name="resume" accept=".pdf,.doc,.docx" title="@lang('global.Curiculum Vitae')" value="{{old('resume',auth()->user()->userdescription->resume)}}" required="required"/>							
							</form>
							
							@if(session()->has('success'))
								<span class="full-time pull-center breadcrumb">{{session()->get('success')}}</span>					
							@endif
							@if(session()->has('error'))
								<span class="full-time pull-center breadcrumb">{{session()->get('error')}}</span>					
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
				};				
				reader.readAsDataURL(input.files[0]);
			}
		}		
	</script>	
@endpush		