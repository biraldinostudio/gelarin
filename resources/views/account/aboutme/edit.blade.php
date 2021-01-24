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
			{{ Breadcrumbs::render('account.aboutme.edit') }}
			<h3>{{__('account.Data')}} {{__('account.About Me')}}</h3>
			@if(session()->has('success'))
				<span class="full-time pull-left breadcrumb">{{session()->get('success')}}</span>					
			@endif
			@if(session()->has('error'))
				<span class="full-time pull-left breadcrumb">{{session()->get('error')}}</span>					
			@endif			
			<form role="form" files="true" enctype="multipart/form-data" method="POST" action="{{ route('account.aboutme.update') }}" novalidate="novalidate">
			@csrf
				<div class="form-group">
					<div class="row extra-mrg">				
						<div class="col-md-11 col-sm-11">
							<label>{{__('account.About Me')}}</label>
							<textarea style="height:175px;" class="form-control @error('aboutme') is-invalid @enderror" name="aboutme" required> {!! old('aboutme',auth()->user()->userdescription->about) !!}</textarea>					
							@error('aboutme')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>						
					</div>
					<div class="row extra-mrg">
						<div class="col-md-7 col-sm-7">
							<label>{{__('account.Profession')}}</label>
							<input type="text" name="profession" class="form-control @error('profession') is-invalid @enderror" value="{{old('profession',auth()->user()->userdescription->profession)}}" placeholder="{{__('account.Ex.')}} Web Developer" maxlength="55" required>
							@error('profession')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>							
					</div>					
				</div>
				<div class="form-group">
					<div class="row extra-mrg">
						<div class="col-md-2 col-sm-2">
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