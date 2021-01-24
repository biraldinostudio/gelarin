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
			{{ Breadcrumbs::render('account.socialmedia.edit') }}
			<h3>{{__('account.Data')}} {{__('account.Social Media')}}</h3>
			@if(session()->has('success'))
				<span class="full-time pull-left breadcrumb">{{session()->get('success')}}</span>					
			@endif
			@if(session()->has('error'))
				<span class="full-time pull-left breadcrumb">{{session()->get('error')}}</span>					
			@endif			
			<form role="form" files="true" enctype="multipart/form-data" method="POST" action="{{ route('account.socialmedia.update') }}" novalidate="novalidate">
			@csrf
				<div class="form-group">
					<div class="row extra-mrg">				
						<div class="col-md-6 col-sm-6">
							<label>Facebook</label>
							<input type="text" name="facebook" class="form-control @error('facebook') is-invalid @enderror" value="{{old('facebook',auth()->user()->userdescription->facebook)}}" placeholder="{{__('account.Ex.')}} kayetanusbiraldino" maxlength="200" autofocus>
							@error('facebook')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
						<div class="col-md-6 col-sm-6">
							<label>Google</label>
							<input type="text" name="google" class="form-control @error('google') is-invalid @enderror" value="{{old('google',auth()->user()->userdescription->google)}}" placeholder="{{__('account.Ex.')}} kayetanusbiraldino" maxlength="200">
							@error('google')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>						
					</div>
					<div class="row extra-mrg">				
						<div class="col-md-6 col-sm-6">
							<label>Twitter</label>
							<input type="text" name="twitter" class="form-control @error('twitter') is-invalid @enderror" value="{{old('twitter',auth()->user()->userdescription->twitter)}}" placeholder="{{__('account.Ex.')}} kayetanusbiraldino" maxlength="200">
							@error('twitter')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>					
						<div class="col-md-6 col-sm-6">
							<label>Linkedin</label>
							<input type="text" name="linkedin" class="form-control @error('linkedin') is-invalid @enderror" value="{{old('linkedin',auth()->user()->userdescription->linkedin)}}" placeholder="{{__('account.Ex.')}} kayetanusbiraldino" maxlength="200">
							@error('linkedin')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>							
					</div>
					<div class="row extra-mrg">
						<div class="col-md-6 col-sm-6">
							<label>Instagram</label>
							<input type="text" name="instagram" class="form-control @error('instagram') is-invalid @enderror" value="{{old('instagram',auth()->user()->userdescription->instagram)}}" placeholder="{{__('account.Ex.')}} kayetanusbiraldino" maxlength="200">
							@error('instagram')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>						
						<div class="col-md-6 col-sm-6">
							<label>Pinterest</label>
							<input type="text" name="pinterest" class="form-control @error('pinterest') is-invalid @enderror" value="{{old('pinterest',auth()->user()->userdescription->pinterest)}}" placeholder="{{__('account.Ex.')}} kayetanusbiraldino" maxlength="200">
							@error('pinterest')
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