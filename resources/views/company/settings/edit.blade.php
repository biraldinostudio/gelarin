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
						<li>@lang('auth.Settings')</li>	
						<li>
							<a href="{{route('settings.address.index')}}" class="kyt-font-green">@lang('auth.Address')</a>																						
						</li>
						<li>
							<a href="{{route('settings.legal.index')}}" class="kyt-font-green">@lang('auth.Legal')</a>																						
						</li>
						<li><a href="{{route('settings.index')}}" class="kyt-font-green" title="@lang('global.Back')"><i class="fa fa-arrow-left"></i></a></li>						
					</ol>
					</div>
				</div>
			</div>
			<form enctype="multipart/form-data" method="POST" action="{{ route('company.settings.update',auth()->user()->companyofficer->company->id) }}" novalidate>

			@csrf				
			<div class="card-body">
				
				<article class="advance-search-job">
					@if(session()->has('message'))
						<div class="row no-mrg kyt-font-green">
							<div class="col-md-8 col-sm-8">
								<i class="fa fa-check"></i> {{ session()->get('message') }} 
							</div>
						</div>	
						<br>
					@endif	
					<div class="row no-mrg">
						<div class="col-md-2 col-sm-2">
							<input type="text" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="@lang('auth.Code')" value="{{ old('code',$companies->code) }}" maxlength="5" autofocus required>
							@if ($errors->has('code'))
								<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
									<strong>{{ $errors->first('code') }}</strong>
								</p>
							@endif
						</div>					
						<div class="col-md-7 col-sm-7">
							<input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="@lang('auth.Name')" value="{{ old('name',$companies->name) }}" maxlength="191" required>
							@if ($errors->has('name'))
								<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
									<strong>{{ $errors->first('name') }}</strong>
								</p>
							@endif
						</div>
					</div>
					<p>
					<div class="row no-mrg">
						<div class="col-md-10 col-sm-10">
							<textarea type="text" id="description" name="description" class="form-control tinymce @error('description') is-invalid @enderror" placeholder="@lang('global.Description')" maxlength="500" required>{{ old('description',$companies->description) }}</textarea>						
							@if ($errors->has('description'))
								<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
									<strong>{{ $errors->first('description') }}</strong>
								</p>
							@endif
						</div>
					</div>
					</p>

					<div class="row no-mrg">
						<div class="col-md-5 col-sm-5">
							<input type="text" name="email1" class="form-control @error('email1') is-invalid @enderror" placeholder="@lang('auth.Company Email')" value="{{ old('email1',$companies->email1) }}" maxlength="53" required>
							@if ($errors->has('email1'))
								<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
									<strong>{{ $errors->first('email1') }}</strong>
								</p>
							@endif
						</div>
						<div class="col-md-5 col-sm-5">
							<input type="text" name="email2" class="form-control @error('email2') is-invalid @enderror" placeholder="@lang('auth.Company Email 2')" value="{{ old('email2',$companies->email2) }}" maxlength="53" required>
							@if ($errors->has('email2'))
								<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
									<strong>{{ $errors->first('email2') }}</strong>
								</p>
							@endif
						</div>						
					</div>

					<div class="row no-mrg">
						<div class="col-md-5 col-sm-5">
							<span style="font-size:11px;">@lang('auth.Ex:') 2123915</span>
							<input type="text" name="phone1" class="form-control @error('phone1') is-invalid @enderror" placeholder="@lang('auth.Company Telephone')" value="{{ old('phone1',$companies->phone1) }}" maxlength="11" onKeyPress="return goodchars(event,'0123456789',this)" required>
							@if ($errors->has('phone1'))
								<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
									<strong>{{ $errors->first('phone1') }}</strong>
								</p>
							@endif
						</div>					
						<div class="col-md-5 col-sm-5">
							<span style="font-size:11px;">@lang('auth.Ex:') 2123418</span>						
							<input type="text" id="phone2" name="phone2" class="form-control @error('phone2') is-invalid @enderror" placeholder="@lang('auth.Company Telephone 2')" value="{{ old('phone2',$companies->phone2) }}" maxlength="11" onKeyPress="return goodchars(event,'0123456789',this)" required>
							@if ($errors->has('phone2'))
								<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
									<strong>{{ $errors->first('phone2') }}</strong>
								</p>
							@endif
						</div>
					</div>

					<div class="row no-mrg">
						<div class="col-md-5 col-sm-5">
							<span style="font-size:11px;">@lang('auth.Ex:') 2123661</span>						
							<input type="text" name="fax1" class="form-control @error('fax1') is-invalid @enderror" placeholder="@lang('auth.Company Fax')" value="{{ old('fax1',$companies->fax1) }}" maxlength="11" onKeyPress="return goodchars(event,'0123456789',this)" required>
							@if ($errors->has('fax1'))
								<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
									<strong>{{ $errors->first('fax1') }}</strong>
								</p>
							@endif
						</div>					
						<div class="col-md-5 col-sm-5">
							<span style="font-size:11px;">@lang('auth.Ex:') 2123551</span>						
							<input type="text" id="fax2" name="fax2" class="form-control @error('fax2') is-invalid @enderror" placeholder="@lang('auth.Company Fax 2')" value="{{ old('fax2',$companies->fax2) }}" maxlength="11" onKeyPress="return goodchars(event,'0123456789',this)" required>
							@if ($errors->has('fax2'))
								<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
									<strong>{{ $errors->first('fax2') }}</strong>
								</p>
							@endif
						</div>
					</div>
					
					<div class="row no-mrg">
						<div class="col-md-3 col-sm-3">
							<span style="font-size:11px;">&nbsp;</span>						
							<input name="hide_email" id="hide_email" type="checkbox" class="form-check-input" value="1" {{ (old('hide_email',$companies->hide_email)=='1') ? 'checked="checked"' : '' }}> <label>@lang('company.Hide Email')</label>
							@if ($errors->has('hide_email'))
								<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
									<strong>{{ $errors->first('hide_email') }}</strong>
								</p>
							@endif
						</div>					
						<div class="col-md-3 col-sm-3">
							<span style="font-size:11px;">&nbsp;</span>							
							<input name="hide_phone" id="hide_phone" type="checkbox" class="form-check-input" value="1" {{ (old('hide_phone',$companies->hide_phone)=='1') ? 'checked="checked"' : '' }}> <label>@lang('company.Hide Phone')</label>
							@if ($errors->has('hide_phone'))
								<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
									<strong>{{ $errors->first('hide_phone') }}</strong>
								</p>
							@endif
						</div>
						<div class="col-md-3 col-sm-3">
							<span style="font-size:11px;">&nbsp;</span>							
							<input name="hide_address" id="hide_address" type="checkbox" class="form-check-input" value="1" {{ (old('hide_address',$companies->hide_address)=='1') ? 'checked="checked"' : '' }}> <label>@lang('company.Hide Address')</label>
							@if ($errors->has('hide_address'))
								<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
									<strong>{{ $errors->first('hide_address') }}</strong>
								</p>
							@endif
						</div>						
					</div>					
					
					
					
					<p>
					<div class="row no-mrg">
						<div class="col-md-3 col-sm-3">
							<select name="employee" id="employee" class="employee form-control @error('employee') is-invalid @enderror" required>
							<option value="">@lang('auth.Number of Employees')</option>
							<option value="5" {{ $companies->size == 5 ? 'selected' : '' }}> > 5</option>
							<option value="50" {{ $companies->size == 50 ? 'selected' : '' }}> > 50</option>
							<option value="100" {{ $companies->size == 100 ? 'selected' : '' }}> > 100</option>
							<option value="500" {{ $companies->size == 500 ? 'selected' : '' }}> > 500</option>
							<option value="1000" {{ $companies->size == 1000 ? 'selected' : '' }}> > 1000</option>
							<option value="5000" {{ $companies->size == 5000 ? 'selected' : '' }}> > 5000</option>											
							</select>
							@if ($errors->has('employee'))
								<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
									<strong>{{ $errors->first('employee') }}</strong>
								</p>
							@endif	
						</div>
						<div class="col-md-7 col-sm-7">
							<select name="industry[]" id="industry" class="industry form-control @error('industry') is-invalid @enderror" multiple="multiple" data-placeholder="@lang('auth.Select Industry')" required>
							<option value="">@lang('auth.Select Industry')</option>
								@foreach ($categories as $industry)
									<option value="{{ $industry->translation_of}}"
									@foreach($companies->companycategory as $companyCat)
										@if(in_array($industry->translation_of , old('industry',[$companyCat->category_id])))      
											selected="selected"
										@endif @endforeach>{{ $industry->name }}</option>
								@endforeach
							</select>
							@if ($errors->has('industry'))
								<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
									<strong>{{ $errors->first('industry') }}</strong>
								</p>
							@endif						
						</div>						
					</div>
</p>					
					<div class="row no-mrg">
						<div class="col-md-5 col-sm-5">
							<select name="working" id="working" class="working form-control @error('working') is-invalid @enderror" required>
								<option value="" data-type=""@if (old('working', $companies->working_time_id)=='' or old('working',$companies->working_time_id)==0)selected="selected"@endif> @lang('auth.Select Working Hours')</option>
									@foreach ($workingTimes as $working)
										<option value="{{ $working->translation_of}}"@if (old('working',$companies->working_time_id)==$working->translation_of)selected="selected"@endif> {{ $working->name }} </option>
									@endforeach
							</select>
							@if ($errors->has('working'))
								<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
									<strong>{{ $errors->first('working') }}</strong>
								</p>
							@endif
						</div>
						<div class="col-md-5 col-sm-5">
							<select name="uniform" id="uniform" class="form-control uniform @error('uniform') is-invalid @enderror" required>
								<option value="" data-type=""@if (old('uniform', $companies->uniform_type_id)=='' or old('uniform',$companies->uniform_type_id)==0)selected="selected"@endif> @lang('auth.Select Uniform')</option>
									@foreach ($workingUniforms as $uniform)
										<option value="{{ $uniform->translation_of}}"@if (old('uniform',$companies->working_uniform_id)==$uniform->translation_of)selected="selected"@endif> {{ $uniform->name }} </option>
									@endforeach
							</select>								
							@if ($errors->has('uniform'))
								<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
									<strong>{{ $errors->first('uniform') }}</strong>
								</p>
							@endif	
						</div>					
					</div>
					<div class="row no-mrg">
						<div class="col-md-5 col-sm-5">
							<div class="profile-image-outer-container">
								<div class="profile-image-inner-container bg-color-primary">
									@if(empty($companies->logo))
										<img src="{{ asset('storage/uploads/company/logo/150x150.png') }}" class="imgCircle">
									@else
										<img src="{{ asset('storage/uploads/company/logo/'.$companies->logo) }}" class="imgCircle">										
									@endif	
								</div>
									<input type="file" name="logo" onchange="readURL(this);formAvatar.submit();" accept="image/*" class="profile-image-input inFile @error('file') is-invalid @enderror">
									@error('logo')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror									
							</div>
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
		<link rel="stylesheet" href="{{asset('front/custom/custom.css')}}">
@endpush
@push('scripts')

	<script src="{{asset('front/center/money/simple.money.format.js')}}" type="text/javascript"></script>
    <script src="{{asset('front/center/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('front/center/tinymce/jquery.tinymce.min.js')}}"></script> 	
	<script type="text/javascript">
		var $ = jQuery.noConflict();

		// Industry
		$(".industry").select2({
			//placeholder: "{{trans('auth.Select Industry')}}"
		});	

		  //Bagian avatar
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('.imgCircle')
							.attr('src', e.target.result)
							.width(200)
							.height(200);
				};
				reader.readAsDataURL(input.files[0]);
			}
		}
		
		//Text Editor
		tinymce.init({
			selector: "textarea.tinymce",
			menubar:false,
			statusbar: false,
			toolbar: 'undo redo | formatselect | bold italic strikethrough forecolor backcolor permanentpen formatpainter | alignleft aligncenter alignright alignjustify  | numlist bullist',
			skin: "dick-light",
			plugins: ["link,anchor,textcolor"],
			content_css: [
				'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
				'//www.tiny.cloud/css/codepen.min.css',
			],
			height : "200",
			placeholder:"xxxxx"

		});
    </script>

@endpush		