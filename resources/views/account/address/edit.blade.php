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
			{{ Breadcrumbs::render('account.address.edit') }}
			<h3>{{__('account.Data')}} {{__('account.Address')}} <i class="fa fa-map-marker"></i></h3>
			@if(session()->has('success'))
				<span class="full-time pull-left breadcrumb">{{session()->get('success')}}</span>					
			@endif
			@if(session()->has('error'))
				<span class="full-time pull-left breadcrumb">{{session()->get('error')}}</span>					
			@endif			
			<form role="form" files="true" enctype="multipart/form-data" method="POST" action="{{ route('account.address.update') }}" novalidate="novalidate">
			@csrf			
				<div class="form-group">
					<div class="row extra-mrg">
						<div class="col-md-3 col-sm-3">				
							<label>@lang('account.Country')</label>
							<select style="width:100%;" name="country" id="country" class="form-control @error('country') is-invalid @enderror" data-placeholder="@lang('account.Country')" value="{{ old('country') }}" required>
								<option value="" data-type=""@if (old('country',$myCountries->code)=='' or old('country')==0)selected="selected"@endif> @lang('account.Select Country') </option>
								@foreach ($countryAlls as $country)
									<option value="{{ $country->code}}"@if (old('country',auth()->user()->userdescription->country_code)==$country->code)selected="selected"@endif> {{ $country->asciiname }} </option>
								@endforeach
							</select>
							@error('country')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
						<div class="col-md-5 col-sm-5">				
							<label>@lang('account.Province')</label>
							<select name="province" id="province" class="form-control @error('province') is-invalid @enderror" required>
								<option value="" 
									@if (old('province',$myProvinces->code)=='' or old('province',$myProvinces->code)==0)selected="selected"
									@endif> @lang('global.Select City or Sub District') 
								</option>
								@if(old('country',$myProvinces->country_code))
									@foreach ($provinceAlls as $province)
										@if(old('country',$myProvinces->country_code)==$province->country_code)
											<option value="{{ $province->code}}"
												@if($province->code==old('province',$myProvinces->code))selected="selected"
												@endif >{{ $province->name }}
											</option>
										@endif
									@endforeach
								@endif
							</select> 
							@error('province')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="col-md-4 col-sm-4">				
							<label>@lang('account.City')</label>
							<select name="city" id="city" class="form-control @error('city') is-invalid @enderror" required>
								<option value="" 
									@if (old('city',$myCities->id)=='' or old('city',$myCities->id)==0)selected="selected"
									@endif> @lang('global.Select City or Sub District') 
								</option>
								@if(old('province',$myCities->subadmin1_code))
									@foreach ($cityAlls as $c)
										@if(old('province',$myCities->subadmin1_code)==$c->subadmin1_code)
											<option value="{{ $c->id}}"
												@if($c->id==old('city',$myCities->id))selected="selected"
												@endif >{{ $c->name }}
											</option>
										@endif
									@endforeach
								@endif
							</select> 
							@error('city')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>						
					</div>
					<div class="row extra-mrg">
						<div class="col-md-8 col-sm-8">
							<label>{{__('account.Address')}}</label>
							<input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{old('address',auth()->user()->userdescription->address)}}" maxlength="200"  required>
							@error('address')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
						<div class="col-md-3 col-sm-3">
							<label>{{__('account.Postal Code')}}</label>						
							<input type="postal_code" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" value="{{old('postal_code',auth()->user()->userdescription->postal_code)}}" maxlength="10" required>
							@error('postal_code')
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
	<link href="{{asset('front/custom/autocomplete/select2.css')}}" rel="stylesheet" />	
@endpush
@push('scripts')
	<script type="text/javascript" src="{{asset('front/custom/autocomplete/init.js')}}"></script>
	<script src="{{asset('front/custom/autocomplete/select2.min.js')}}"></script>		

	<script type="text/javascript">
	 var $ = jQuery.noConflict();
		  $('#country').select2({
			language: {
				noResults: function (params) {
					return "{{trans('global.Data not found')}}";
				}
			}		
		  });	 
		  $('#province').select2({
			language: {
				noResults: function (params) {
					return "{{trans('global.Data not found')}}";
				}
			}		
		  });
		  $('#city').select2({

			language: {
				noResults: function (params) {
					return "{{trans('global.Data not found')}}";
				}
			}		
		  });		  

    	$('#country').change(function(){
       	 	$.get('countries/' + this.value + '/provinces.json', function(provinces){
				var $province = $('#province');
				$province.find('option').remove().end();
				$.each(provinces, function(index, prov) {
					$province.append($('<option/>').attr('value', prov.code).text(prov.name)); 
				});
			});
    	});
		$(document).ready(function() {
			$("#country option[value='0']").attr("disabled","disabled");
			$("#province option[value='0']").attr("disabled","disabled");
		});			  

    	$('#province').change(function(){
       	 	$.get('provinces/' + this.value + '/cities.json', function(cities){
				var $city = $('#city');
				$city.find('option').remove().end();
				$.each(cities, function(index, cit) {
					$city.append($('<option/>').attr('value', cit.id).text(cit.name)); 
				});
			});
    	});
		$(document).ready(function() {
			$("#province option[value='0']").attr("disabled","disabled");
			$("#city option[value='0']").attr("disabled","disabled");
		});	
</script>
@endpush			