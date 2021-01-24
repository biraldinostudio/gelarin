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
			{{ Breadcrumbs::render('account.job_interest.edit') }}
			<h3>{{__('account.Data')}} {{__('account.Job of Interest')}} <i class="fa fa-tasks"></i></h3>
			@if(session()->has('success'))
				<span class="full-time pull-left breadcrumb">{{session()->get('success')}}</span>					
			@endif
			@if(session()->has('error'))
				<span class="full-time pull-left breadcrumb">{{session()->get('error')}}</span>					
			@endif			
			<form role="form" files="true" enctype="multipart/form-data" method="POST" action="{{ route('account.job_interest.update') }}" novalidate="novalidate">
			@csrf
				<div class="container-detail-box">
					<h4>{{__('account.Job Required')}}</h4>
					<div class="row extra-mrg">
						<div class="col-md-8 col-sm-8">
							<select name="job_interest[]" id="job_interest" class="form-control @error('job_interest') is-invalid @enderror" multiple="multiple" data-placeholder="@lang('account.Job of Interest')" required>		
								@foreach ($categories as $category)
									<option value="{{ $category->translation_of}}"
										@foreach($vacancyInterests as $vacancyInterest)
											@if(in_array($category->translation_of , old('job_interest',[$vacancyInterest->category_id])))selected="selected"@endif 
										@endforeach>{{ $category->name }}</option>
								@endforeach
							</select>
							@error('job_interest')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>				
					</div>
				</div>
				<div class="form-group">
					<div class="row extra-mrg">
						<div class="col-md-3 col-sm-3">
							<input type="submit" value="@lang('account.Save')" class="btn btn-login" data-loading-text="Loading...">	
						</div>						
					</div>				
				</div>
			</form>
		</div>		
		@includeWhen(auth()->check(), 'layouts.inc.sidebar')			
	</div>
</section>
@endsection	
@push('styles')
		<link rel="stylesheet" href="{{asset('front/custom/custom.css')}}">
@endpush
@push('scripts')
	<script type="text/javascript">
		$('#job_interest').select2({
			language: {
				noResults: function (params) {
					return "{{trans('global.Data not found')}}";
				}
			}		
		});
	</script>		  
@endpush			