@extends('layouts.company.app')
<?php
if ($addresses->city) {
    if ($addresses->city->subadmin1_code == 0) {
        $postSubAdmin1Id = $addresses->city->subadmin1_code;
    } else {
        $postSubAdmin1Id = $addresses->city->subadmin1_code;
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
						<div class="col-md-1 col-sm-1">					
						</div>									
						<div class="col-md-12 col-sm-5">
						 <ol class="breadcrumb pull-right">
								<li><a href="{{route('company.dashboard')}}"><i class="fa fa-gear fa-fw"></i></a></li>
								<li>
									@lang('auth.Address')																					
								</li>
								<li class="active">
									<a href="{{route('settings.legal.index')}}" class="kyt-font-green">@lang('auth.Legal')</a>																						
								</li>
							<li><a href="{{route('settings.address.index')}}" class="kyt-font-green" title="@lang('global.Back')"><i class="fa fa-arrow-left"></i></a></li>								
						</ol>
						</div>
					</div>
				</div>
				<form enctype="multipart/form-data" method="POST" action="{{ route('settings.address.update',$addresses->id) }}" novalidate>
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
							<div class="col-md-8 col-sm-8">
								<textarea style="height:65px;" class="form-control inAddress @error('address') is-invalid @enderror" name="address" required>{{old('address',$addresses->address)}}</textarea>
								@if ($errors->has('address'))
									<span class="invalid-feedback" role="alert" style="color:#ff0000;text-align:center;">
										<strong>{{ $errors->first('address') }}</strong>
									</span>
								@endif	
							</div>
						</div>
						<p>
						<div class="row no-mrg">
							<div class="col-md-2 col-sm-2">
								<input type="text" class="form-control inPostalCode @error('postal_code') is-invalid @enderror" name="postal_code" value="{{old('postal_code',$addresses->postal_code)}}" maxlength="10" onKeyPress="return goodchars(event,'0123456789',this)" required>
								@if ($errors->has('postal_code')and old('hdnInputCreate')=='1')
									<span class="invalid-feedback" role="alert" style="color:#ff0000;text-align:center;">
										<strong>{{ $errors->first('postal_code') }}</strong>
									</span>
								@endif					
								@if ($errors->has('postal_code'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('postal_code') }}</strong>
									</p>
								@endif
							</div>
						</div>
						</p>					
						<div class="row no-mrg">
							<div class="col-md-5 col-sm-5">
								<select name="province" id="province" class="form-control province{{ $errors->has('province') ? ' is-invalid' : '' }}" required>
									<option value=""
										@if (old('province',$postSubAdmin1Id)=='' or old('province',$postSubAdmin1Id)==0)
											selected="selected"
										@endif
										> @lang('global.Select Region') </option>
									@foreach ($provinces as $cat)
										<option value="{{ $cat->code}}"
											@if (old('province',$postSubAdmin1Id)==$cat->code)
												selected="selected"
											@endif
											> {{ $cat->name }} </option>
									@endforeach
								</select>
								@if ($errors->has('province'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('province') }}</strong>
									</p>
								@endif	
							</div>
							<div class="col-md-5 col-sm-5">
								<select name="cit" id="cit" class="form-control city{{ $errors->has('cit') ? ' is-invalid' : '' }}" required>
									<option value="" 
										@if (old('cit',$addresses->city_id)=='' or old('cit',$addresses->city_id)==0)
											selected="selected"
										@endif> @lang('global.Select Location') </option>
										@if(old('province',$postSubAdmin1Id))
											@foreach ($cite as $c)
												@if(old('province',$postSubAdmin1Id)==$c->subadmin1_code)
													<option value="{{ $c->id}}"
														@if($c->id==old('cit',$addresses->city_id))      
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

				
					</article>
					<article class="advance-search-job">
						<div class="row no-mrg">
							<div class="col-md-10 col-sm-10">
								<p style="text-align:left;">
									<button type="submit" class="btn btn-m btn-primary"><i class="fa fa-save"></i> Submit</button>
									<a class="btn btn-warning" href="{{route('settings.address.index')}}"><i class="fa fa-arrow-circle-left"></i> @lang('global.Back')</a>										
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

@endpush		