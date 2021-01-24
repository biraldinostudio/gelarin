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
									@lang('global.Disabled Staff Account')																						
								</li>
							<li><a href="{{route('account.staff.list')}}" class="kyt-font-green" title="@lang('global.Back')"><i class="fa fa-arrow-left"></i></a></li>							
							</ol>
						</div>
					</div>
				</div>
				<form role="form" files="true"  enctype="multipart/form-data" method="POST" action="{{ route('account.staff.cancel.update',$staffs->id) }}" novalidate>
				@csrf				
				<div class="card-body">
					
					<article class="advance-search-job">
						<div class="row no-mrg">
							<div class="col-md-10 col-sm-10">
								@lang('global.You will deactivate the account') <strong>{{ str_limit(strip_tags(ucwords($staffs->name)), 35) }}</strong>
							</div>					
						</div>
					</article>	
					<article class="advance-search-job">
						<div class="row no-mrg">
							<div class="col-md-10 col-sm-10">
								<p style="text-align:left;">
									<input name="active" id="active" type="checkbox" class="form-check-input" value="0" {{ (old('active',$staffs->active)=='0') ? 'checked="checked"' : '' }}> </label>@lang('global.Inactive')</label>
								</p>
								@if ($errors->has('active'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('active') }}</strong>
									</p>
								@endif
							</div>						
						</div>
						<div class="row no-mrg">
							<div class="col-md-10 col-sm-10">
								<textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" required>{{ old('description',$staffs->companyofficer->cancel_reason) }}</textarea>
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
								@if($staffs->active=='1')
									<button type="submit" class="btn btn-m btn-primary"><i class="fa fa-save"></i> Submit</button>
								@endif	
									<a class="btn btn-warning" href="{{ URL::previous() }}"><i class="fa fa-arrow-circle-left"></i> @lang('global.Back')</a>										
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
		