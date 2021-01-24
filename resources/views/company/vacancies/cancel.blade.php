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
						<div class="col-md-6 col-sm-6">
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
						<div class="col-md-5 col-sm-5">
							<ol class="breadcrumb pull-right">
								<li><a href="{{route('company.dashboard')}}"><i class="fa fa-home"></i></a></li>
								<li>
									@lang('vacancy.Cancel Vacancies')																						
								</li>
							<li><a href="{{route('vacancies.active')}}" class="kyt-font-green" title="@lang('vacancy.Back')"><i class="fa fa-arrow-left"></i></a></li>							
							</ol>
						</div>
					</div>
				</div>
				<form role="form" files="true"  enctype="multipart/form-data" method="POST" action="{{ route('vacancies.cancel',$vacancies->id) }}" novalidate>
				@csrf				
				<div class="card-body">
					
					<article class="advance-search-job">
						<div class="row no-mrg">
							<div class="col-md-10 col-sm-10">
								<strong>@lang('vacancy.Subject'):</strong> <a href="{{ route('company.vacancies.detail',[$vacancies->id,$vacancies->slug]) }}" target="_blank">{{ str_limit(strip_tags(ucwords($vacancies->title)), 50) }}</a>
							</div>					
						</div>
					</article>	
					<article class="advance-search-job">
						<div class="row no-mrg">
							<div class="col-md-10 col-sm-10">
								<p style="text-align:left;">
									<input name="status" id="status" type="checkbox" class="form-check-input" value="0" {{ (old('status',$vacancies->active)=='0') ? 'checked="checked"' : '' }}> </label>@lang('vacancy.Cancel Vacancies')</label>
								</p>
								@if ($errors->has('status'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('status') }}</strong>
									</p>
								@endif
							</div>						
						</div>
						<div class="row no-mrg">
							<div class="col-md-10 col-sm-10">
								<textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ old('description',$vacancies->cancel_reason) }}</textarea>
								@if ($errors->has('description'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('description') }}</strong>
									</p>
								@endif										
							</div>
						</div>
					</article>
					<article class="advance-search-job">
						<div class="row no-mrg">
							<div class="col-md-10 col-sm-10">
								<p style="text-align:left;">
									<button type="submit" class="btn btn-m btn-primary"><i class="fa fa-save"></i> Submit</button>
									<a class="btn btn-warning" href="{{ route('vacancies.active') }}"><i class="fa fa-arrow-circle-left"></i> @lang('vacancy.Back')</a>										
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