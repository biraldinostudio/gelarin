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
					</div>								
					<div class="col-md-1 col-sm-1">
					</div>									
					<div class="col-md-12 col-sm-5">
					 <ol class="breadcrumb pull-right">
						<li><a href="{{route('company.dashboard')}}" class="kyt-font-green"><i class="fa fa-home"></i></a></li>
						<li>@lang('testimonial.Testimonial')</li>	
						<li>
							<a href="{{route('settings.address.index')}}" class="kyt-font-green">@lang('testimonial.Address')</a>																						
						</li>
						<li>
							<a href="{{route('settings.legal.index')}}" class="kyt-font-green">@lang('testimonial.Legal')</a>																						
						</li>					
					</ol>
					</div>
				</div>
			</div>			
			<div class="card-body">
			@if(!empty($testimonials))
			<form enctype="multipart/form-data" method="POST" action="{{ route('company.testimonial.update') }}" novalidate>

			@csrf				
				<article class="advance-search-job">
					@if(session()->has('success'))
						<div class="row no-mrg"><div class="col-md-8 col-sm-8"><span class="full-time pull-left breadcrumb">{{session()->get('success')}}</span></div></div>					
					@endif
					@if(session()->has('error'))
						<div class="row no-mrg"><div class="col-md-8 col-sm-8"><span class="full-time pull-left breadcrumb">{{session()->get('error')}}</span></div></div>				
					@endif


					
					@error('testimonial')
						<div class="invalid-feedback">{{ $message }}</div>
					@enderror
					@error('value')
						<div class="invalid-feedback">{{ $message }}</div>
					@enderror
					<div class="row no-mrg">
						<div class="col-md-8 col-sm-8">
							<label>{{__('testimonial.Testimonial')}}</label>
							<textarea id="kyt-textareaMini" class="form-control @error('testimonial') is-invalid @enderror" name="testimonial" maxlength="300" required>{{old('testimonial',$testimonials->comment)}}</textarea>
						</div>
					</div>
					<div class="row no-mrg">
						<div class="col-md-3 col-sm-3">
							<label>{{__('testimonial.Testimonial')}}</label>
							<select name="value" id="value" class="employee form-control @error('value') is-invalid @enderror" required>
							<option value="">@lang('testimonial.Number of Employees')</option>
							<option value="1" {{ $testimonials->value== 1 ? 'selected' : '' }}> 1</option>
							<option value="2" {{ $testimonials->value== 2 ? 'selected' : '' }}> 2</option>
							<option value="3" {{ $testimonials->value== 3 ? 'selected' : '' }}> 3</option>
							<option value="4" {{ $testimonials->value== 4 ? 'selected' : '' }}> 4</option>
							<option value="5" {{ $testimonials->value== 5 ? 'selected' : '' }}> 5</option>											
							</select>
						</div>
					</div>
					
				</article>
				
				<article class="advance-search-job">
					<div class="row no-mrg">
						<div class="col-md-10 col-sm-10">
							<p style="text-align:left;">
								<button type="submit" class="btn btn-m btn-primary"><i class="fa fa-save"></i> Submit</button>
								<a class="btn btn-warning" href="{{ URL::previous() }}"><i class="fa fa-arrow-circle-left"></i> @lang('global.Back')</a>										
							</p>
						</div>
					</div>
				</article>
			</form>
			@else
				<article class="advance-search-job">
					<div class="row no-mrg">
						<div class="col-md-8 col-sm-8">
							<div class="sidebar-box">
								<span class="sidebar-status kyt-sidebar-status"><a href="#createModalTestimonial" class="edit-modal" data-toggle="modal" data-target="#createModalTestimonial"><i class="fa fa-plus"></i> @lang('testimonial.Add Testimonial')</a></span>
							</div>							
						</div>						
					
					</div>
				</article>	
			@endif			
			</div>
		</div>
	</div>
		<!-- Sidebar Start -->
		@section('sidebar')
			@include('layouts.company.inc.sidebar')
		@show
	<!-- Sidebar End -->	
	</div>
</section>
@includeWhen(auth()->check(), 'company.testimonial.create')
@endsection			