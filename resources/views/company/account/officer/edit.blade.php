@extends('layouts.company.app')
<?php
if ($userdescriptions->city) {
    if ($userdescriptions->city->subadmin1_code == 0) {
        $postSubAdmin1Id = $userdescriptions->city->subadmin1_code;
    } else {
        $postSubAdmin1Id = $userdescriptions->city->subadmin1_code;
    }
} else {
    $postSubAdmin1Id = 0;
}
?>
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
							<li>@lang('account.My Account')</li>
							<li><a href="{{route('settings.index')}}" class="kyt-font-green">@lang('account.Settings')</a></li>
							<li><a href="{{route('account.index')}}" class="kyt-font-green" title="@lang('global.Back')"><i class="fa fa-arrow-left"></i></a></li>						
						</ol>
						</div>
					</div>
				</div>
				<form enctype="multipart/form-data" method="POST" action="{{ route('account.update') }}" novalidate>
					{{-- {{ method_field('PUT') }} --}}
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
							<div class="col-md-6 col-sm-6">
							<label>{{__('account.Full Name')}}</label>							
								<input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="@lang('account.Full Name')" value="{{ old('name',$users->name) }}" maxlength="35" autofocus required>
								@if ($errors->has('name'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('name') }}</strong>
									</p>
								@endif
							</div>					
							<div class="col-md-3 col-sm-3">
							<label>{{__('account.Nickname')}}</label>							
								<input type="text" name="nickname" class="form-control @error('nickname') is-invalid @enderror" placeholder="@lang('account.Nickname')" value="{{ old('nickname',$userdescriptions->nickname) }}" maxlength="12" required>
								@if ($errors->has('nickname'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('nickname') }}</strong>
									</p>
								@endif
							</div>					
						</div>
						
						<div class="row no-mrg">
							<div class="col-md-5 col-sm-5">
							<label>{{__('account.Email')}}</label>							
								<input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="@lang('account.Email')" value="{{ old('email',$users->email) }}" maxlength="53" readonly required>	
								@error('email')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror					
							</div>
							<div class="col-md-6 col-sm-6">
							<label>{{__('account.Position')}}</label>							
								<input type="text" name="position" class="form-control @error('position') is-invalid @enderror" placeholder="@lang('account.Position')" value="{{ old('position',$companyOfficers->position) }}" maxlength="20" required>	
								@error('position')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror						
							</div>						
						</div>

						<div class="row no-mrg">
							<div class="col-md-7 col-sm-7">
							<label>{{__('account.Address')}}</label>							
								<input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="@lang('account.Address')" value="{{ old('address',$userdescriptions->address) }}" maxlength="100" required>	
								@error('address')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror					
							</div>
							<div class="col-md-2 col-sm-2">
							<label>{{__('account.Postal Code')}}</label>							
								<input type="text" id="postal_code" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror" placeholder="@lang('account.Postal Code')" value="{{ old('postal_code',$userdescriptions->postal_code) }}" maxlength="5" onKeyPress="return goodchars(event,'0123456789',this)" required>	
								@error('postal_code')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror						
							</div>						
						</div>
						<div class="row no-mrg">
							<div class="col-md-5 col-sm-5">
							<label>{{__('account.Province')}}</label>							
								<select name="province" id="province" class="form-control province{{ $errors->has('province') ? ' is-invalid' : '' }}" required>
									<option value=""
										@if (old('province',$postSubAdmin1Id)=='' or old('province',$postSubAdmin1Id)==0)
											selected="selected"
										@endif
										> @lang('global.Select Region') </option>
									@foreach ($provinces as $prov)
										<option value="{{ $prov->code}}"
											@if (old('province',$postSubAdmin1Id)==$prov->code)
												selected="selected"
											@endif
											> {{ $prov->name }} </option>
									@endforeach
								</select>
								@if ($errors->has('province'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('province') }}</strong>
									</p>
								@endif	
							</div>
							<div class="col-md-4 col-sm-4">
							<label>{{__('account.City')}}</label>							
								<select name="cit" id="cit" class="city form-control{{ $errors->has('cit') ? ' is-invalid' : '' }}" required>
									<option value="" 
										@if (old('cit',$userdescriptions->city_id)=='' or old('cit',$userdescriptions->city_id)==0)
											selected="selected"
										@endif> @lang('global.Select Location') </option>
										@if(old('province',$postSubAdmin1Id))
											@foreach ($cities as $c)
												@if(old('province',$postSubAdmin1Id)==$c->subadmin1_code)
													<option value="{{ $c->id}}"
														@if($c->id==old('cit',$userdescriptions->city_id))      
															selected="selected"
														@endif >
														{{ $c->name }}
													</option>
												@endif
											@endforeach
										@endif
								</select>	
								@if ($errors->has('cit'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('cit') }}</strong>
									</p>
								@endif						
							</div>						
						</div>
						<div class="row no-mrg">
							<div class="col-md-5 col-sm-5">
							<label>{{__('account.Gender')}}</label></br>
							@foreach($genders as $gender)
						 		<input type="radio" name="gender" id="gender" value="{{$gender->translation_of}}"
								@if(old('gender',auth()->user()->userdescription->gender_id)==$gender->translation_of)checked="checked"
						   			@endif  > {{$gender->name}}&nbsp;
						     	@endforeach
							@error('gender')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
							</div>

							<div class="col-md-2 col-sm-2">
							<label>{{__('account.Code')}}</label>
								<input type="text" class="form-control" value="{{ old('phone','+'.$countries->phone) }}" readonly>
							</div>							
							
							
							<div class="col-md-4 col-sm-4">
						
								<label class="kyt-font-kecil">@lang('account.Ex:')81250338118</label>						
								<input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="@lang('account.Phone Number')" value="{{ old('phone',$userdescriptions->phone) }}" maxlength="12" onKeyPress="return goodchars(event,'0123456789',this)" required>
								@if ($errors->has('phone'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('phone') }}</strong>
									</p>
								@endif
								<input type="hidden" name="phone_code" value="{{$countries->phone}}">				
							</div>						
						</div>						
											
						<div class="row no-mrg">
							<div class="col-md-5 col-sm-5">
								<div class="profile-image-outer-container">
									<div class="profile-image-inner-container bg-color-primary">
										@if(empty($userdescriptions->photo))
											<img src="{{asset('front/img/default/photo.jpg') }}" class="imgCircle">
										@else
											<img src="{{ asset('storage/uploads/member/photo/'.$userdescriptions->photo) }}" class="imgCircle">										
										@endif	
									</div>
										<input type="file" name="photo" onchange="readURL(this);formAvatar.submit();" accept="image/*" class="profile-image-input inFile @error('file') is-invalid @enderror">
								@if ($errors->has('photo'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('photo') }}</strong>
									</p>
								@endif									
								</div>
							</div>					
						</div>			
					</article>
					<article class="advance-search-job">
						<div class="row no-mrg">
							<div class="col-md-10 col-sm-10">
								<p style="text-align:left;">
									<button type="submit" class="btn btn-m btn-primary"><i class="fa fa-save"></i> Submit</button>
									<a class="btn btn-warning" href="{{route('account.index')}}"><i class="fa fa-arrow-circle-left"></i> @lang('global.Back')</a>										
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
@push('scripts')
	<script src="{{asset('front/custom/number_only.js')}}"></script>
	<script>
		var $ = jQuery.noConflict();		
		//Bagian Lokasi
    	$('#province').change(function(){
       	 	$.get('sub_admin1s/' + this.value + '/cities.json', function(cities){
				var $city = $('#cit');
				$city.find('option').remove().end();
				$.each(cities, function(index, cit) {
					$city.append($('<option/>').attr('value', cit.id).text(cit.name)); 
				});
			});
    	});
		$(document).ready(function() {
			$(".province option[value='0']").attr("disabled","disabled");
			$(".cit option[value='0']").attr("disabled","disabled");
		});	
		
		// Industry
		$(".province").select2({
			placeholder: "{{trans('global.Select Region')}}"
		});
		
		// Industry
		$(".city").select2({
			placeholder: "{{trans('global.Select City or Sub District')}}"
		});			
	</script>


	
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