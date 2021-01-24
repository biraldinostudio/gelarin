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
					<div class="col-md-12 col-sm-5">
					 <ol class="breadcrumb pull-right">
						<li><a href="{{route('company.dashboard')}}" class="kyt-font-green"><i class="fa fa-home"></i></a></li>
						<li>
							@lang('auth.Legal')																						
						</li>						
						<li class="active">
							<a href="{{route('settings.address.index')}}" class="kyt-font-green">@lang('auth.Address')</a>																						
						</li>
						<li><a href="{{route('settings.legal.index')}}" class="kyt-font-green" title="@lang('global.Back')"><i class="fa fa-arrow-left"></i></a></li>						
					</ol>
					</div>
				</div>
			</div>
			<form enctype="multipart/form-data" method="POST" action="{{ route('settings.legal.update',$legals->id) }}" novalidate>
			 {{ method_field('PUT') }}
			@csrf				
			<div class="card-body">
				
				<article class="advance-search-job">
					<div class="row no-mrg">
						<div class="col-md-7 col-sm-7">
							@if(session()->has('success'))
								<ol class="breadcrumb pull-left">
									<li class="active">
										<i class="fa fa-check"></i> {{ session()->get('success') }}
									</li>
								</ol>	
							@endif
							@if(session()->has('warning'))
								<ol class="breadcrumb pull-left">
									<li>
										<i class="fa fa-exclamation-triangle"></i> {{ session()->get('warning') }}
									</li>
								</ol>	
							@endif
						</div>
					</div>
					<div class="row no-mrg">
						<div class="col-md-7 col-sm-7">
							<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="@lang('auth.Document Name')" value="{{ old('name',$legals->name) }}" maxlength="50" autofocus required>
							@if ($errors->has('name'))
								<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
									<strong>{{ $errors->first('name') }}</strong>
								</p>
							@endif
						</div>
					</div>
					<div class="row no-mrg">					
						<div class="col-md-7 col-sm-7">
							<input type="text" id="number" name="number" class="form-control @error('number') is-invalid @enderror" placeholder="@lang('auth.Document Number')" value="{{ old('number',$legals->number) }}" maxlength="50" required>
							@if ($errors->has('number'))
								<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
									<strong>{{ $errors->first('number') }}</strong>
								</p>
							@endif
						</div>
					</div>					

					<div class="row no-mrg">
						<div class="col-md-3 col-sm-3">
							<input name="expire" type="text" id="expire" placeholder="{{$myCountries->date_format}}" data-default-date="<?php date('yyyy') ?>" data-format="{{$myCountries->date_format}}" data-init-set="false" date-format="Y-m-d" link-format="Y-m-d" data-translate-mode="true" data-auto-lang="true" data-lang="{{app()->getLocale()}}" data-large-mode="true" data-min-year="2018" data-max-year="5050" data-disabled-days="08/17/2017,08/18/2017" data-id="datedropper-1" data-theme="my-style" class="form-control{{ $errors->has('expire') ? ' is-invalid' : '' }}" value="{{old('expire',date($myCountries->date_format, strtotime($legals->expire)))}}" readonly="" required>						
							@if ($errors->has('expire'))
								<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
									<strong>{{ $errors->first('expire') }}</strong>
								</p>
							@endif
						</div>
					</div>
					<div class="row no-mrg">
						<div class="col-md-5 col-sm-5 kyt-text-align-left">
							@if(!empty($legals->file) and !empty(file_exists(public_path('storage/uploads/company/legal/'.$legals->file))))
							<p><a href="{{route('settings.legal.download_file',$legals->id)}}" style="color:#2867b2;"><i class="fa fa-file-pdf-o"></i> {{substr($legals->file,13)}}</a></p>			
							@endif
						</div>				
					</div>
					<div class="row no-mrg">
						<div class="col-md-5 col-sm-5">
							<input type="file" accept=".pdf" class="form-controlx @error('doc') is-invalid @enderror" name="doc" value="{{old('doc',$legals->file)}}" required>
							@if ($errors->has('doc'))
								<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
									<strong>{{ $errors->first('doc') }}</strong>
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
								<a class="btn btn-warning" href="{{route('settings.legal.index')}}"><i class="fa fa-arrow-circle-left"></i> @lang('global.Back')</a>										
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
	<script type="text/javascript">
		var $ = jQuery.noConflict();
		$('#expire').dateDropper();
    </script>

@endpush		