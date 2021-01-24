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
									@lang('global.Add Staff')																					
								</li>
							<li><a href="{{route('account.staff.list')}}" class="kyt-font-green" title="@lang('global.Back')"><i class="fa fa-arrow-left"></i></a></li>							
							</ol>
						</div>
					</div>
				</div>
				<form role="form"  enctype="multipart/form-data" method="POST" action="{{ route('account.staff.store') }}" novalidate>				
				@csrf				
				<div class="card-body">
					
					<article class="advance-search-job">
						<div class="row no-mrg">
							<div class="col-md-5 col-sm-5">
								<input type="text" name="name" class="form-control input-lg{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="@lang('auth.Full Name')" required>
								@if ($errors->has('name'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('name') }}</strong>
									</p>
								@endif						
							</div>					
							<div class="col-md-5 col-sm-5">
								<input type="text" name="username" maxlength="16" class="form-control input-lg{{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{ old('username') }}" placeholder="@lang('auth.Username')" autofocus required>
								@if ($errors->has('username'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('username') }}</strong>
									</p>
								@endif
							</div>
								
						</div>					
						<div class="row no-mrg">					
							<div class="col-md-5 col-sm-5">
								<input type="text" name="email" class="form-control input-lg{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="@lang('auth.Email')"required>
								@if ($errors->has('email'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('email') }}</strong>
									</p>
								@endif
							</div>
							<div class="col-md-5 col-sm-5">
								<input class="form-control{{ $errors->has('number') ? ' is-invalid' : '' }}" name="number" type="text" value="{{ old('number') }}" placeholder="@lang('auth.Number')" maxlength="11" onKeyPress="return goodchars(event,'0123456789',this)" required>
								@if ($errors->has('number'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('number') }}</strong>
									</p>
								@endif					
							</div>						
						</div>
						<div class="row no-mrg">
							<div class="col-md-3 col-sm-3">
								<p style="text-align:left;">
									<input name="vacancy_access" id="vacancy_access" type="checkbox" class="form-check-input" value="1" {{ (old('vacancy_access')=='1') ? 'checked="checked"' : '' }}> <label>@lang('auth.Job Access')</label>	
								</p>	
							</div>
							<div class="col-md-3 col-sm-3">
								<p style="text-align:left;">
									<input name="vacancy_posting" id="vacancy_posting" type="checkbox" class="form-check-input" value="1" {{ (old('vacancy_posting')=='1') ? 'checked="checked"' : '' }}> <label>@lang('auth.Job Posting')</label>							
								</p>		
							</div>
							<div class="col-md-4 col-sm-4">
								<p style="text-align:left;">
									<input name="talent_search" id="talent_search" type="checkbox" class="form-check-input" value="1" {{ (old('talent_search')=='1') ? 'checked="checked"' : '' }}> <label>@lang('auth.Talent Search')</label>						
								</p>		
							</div>						
						</div>
						<div class="row no-mrg">
							<div class="col-md-3 col-sm-3">
								<p style="text-align:left;">
									<input name="staff_management" id="staff_management" type="checkbox" class="form-check-input" value="1" {{ (old('staff_management')=='1') ? 'checked="checked"' : '' }}> <label>@lang('auth.Staff Management')</label>						
								</p>		
							</div>
							<div class="col-md-3 col-sm-3">
								<p style="text-align:left;">
									<input name="credit_management" id="credit_management" type="checkbox" class="form-check-input" value="1" {{ (old('credit_management')=='1') ? 'checked="checked"' : '' }}> <label>@lang('auth.Credit Management')</label>								
								</p>		
							</div>
							<div class="col-md-4 col-sm-4">
								<p style="text-align:left;">
									<input name="receive_candidate_email" id="receive_candidate_email" type="checkbox" class="form-check-input" value="1" {{ (old('receive_candidate_email')=='1') ? 'checked="checked"' : '' }}> <label>@lang('auth.Receive Candidate Email')</label>							
								</p>		
							</div>						
						</div>
						<div class="row no-mrg">
							<div class="col-md-3 col-sm-3">
								<p style="text-align:left;">
									<input name="add_article" id="add_article" type="checkbox" class="form-check-input" value="1" {{ (old('add_article')=='1') ? 'checked="checked"' : '' }}> <label>@lang('global.Add Article')</label>						
								</p>		
							</div>						
						</div>						
					</article>

					<article class="advance-search-job">
						<div class="row no-mrg">
							<div class="col-md-10 col-sm-10">
								<p style="text-align:left;">
									<button type="submit" class="btn btn-m btn-primary"><i class="fa fa-save"></i> Submit</button>
									<a class="btn btn-warning" href="{{ route('account.staff.list') }}"><i class="fa fa-arrow-circle-left"></i> @lang('global.Back')</a>										
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
	<!-- Untuk isi nomor telepon -->
	<script src="{{asset('front/center/phone/js/bootstrap-formhelpers.min.js')}}"></script>		
	<script type="text/javascript">
		var $ = jQuery.noConflict();

		// Country
		$(".country").select2({
			placeholder: "{{trans('auth.Country')}}"
		});		
			
		//Agar hanya input Angka.
		function getkey(e){
			if (window.event)
				return window.event.keyCode;
			else if (e)
				return e.which;
			else
				return null;
		}
		function goodchars(e, goods, field){
			var key, keychar;
			key = getkey(e);
			if (key == null) return true;
				keychar = String.fromCharCode(key);
				keychar = keychar.toLowerCase();
				goods = goods.toLowerCase();
		 
			// check goodkeys
			if (goods.indexOf(keychar) != -1)
				return true;
			// control keys
			if ( key==null || key==0 || key==8 || key==9 || key==27 )
			return true;
			
			if (key == 13) {
				var i;
				for (i = 0; i < field.form.elements.length; i++)
				if (field == field.form.elements[i])
					break;
				i = (i + 1) % field.form.elements.length;
				field.form.elements[i].focus();
				return false;
			};
			// else return false
			return false;
		}
	</script>
@endpush