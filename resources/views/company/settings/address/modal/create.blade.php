<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="frmCreateAddress" action="#" method="POST" novalidate="novalidate">
				@csrf
				<div class="modal-header">
					<h4 class="modal-title" id="formModalLabel">@lang('global.Add New Address')</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="reloadPage()">&times;</button>
				</div>
				<div class="modal-body">
					<div class="box-content">
						<div class="form-row">
							<div class="form-group col-lg-12">
								<label class="font-weight-bold text-dark text-2">@lang('auth.Address')</label>
									<textarea style="height:65px;" class="form-control inAddress @error('address') is-invalid @enderror" name="address" id="psgAddress" value="{{old('address')}}" required>{{old('address')}}</textarea>
									@if ($errors->has('address')and old('hdnInputCreate')=='1')
										<span class="invalid-feedback" role="alert" style="color:#ff0000;text-align:center;">
											<strong>{{ $errors->first('address') }}</strong>
										</span>
									@endif															
							</div>
						</div>						
						<div class="form-row">
							<div class="form-group col-lg-6">
								<label class="font-weight-bold text-dark text-2">@lang('global.Region')</label>

									<select id="prov" name="province" class="form-control @error('province') is-invalid @enderror" data-placeholder="@lang('global.Select Region')" required>
										<option value="" data-type=""
											@if (request('prov')=='' or request('province')==0)
												selected="selected"
											@endif
											>@lang('global.Select Region')
										</option>
										@foreach ($provinces as $province)
											<option value="{{ $province->code }}"
													@if (request('prov')==$province->code)
														selected="selected"
													@endif
													> {{ $province->name }} 
											</option>
										@endforeach
									</select>

								@if ($errors->has('province')and old('hdnInputCreate')=='1')
									<span class="invalid-feedback" role="alert" style="color:#ff0000;text-align:center;">
										<strong>{{ $errors->first('province') }}</strong>
									</span>
								@endif
							</div>
							<div class="form-group col-lg-6">
								<label class="font-weight-bold text-dark text-2">@lang('global.City or Sub District')</label>						
							<select id="city" name="city" class="form-control @error('city') is-invalid @enderror" required>
								<option value="" 
									@if (old('city')=='' or old('city')==0)
										selected="selected"
									@endif> @lang('global.Select City or Sub District')
								</option>
								@if(old('province'))
									@foreach ($cite as $c)
										@if(old('province')==$c->subadmin1_code)
											<option value="{{ $c->id}}"
												@if($c->id==old('city'))      
													selected="selected"
												@endif >
												{{ $c->name }}
											</option>
										@endif
									@endforeach
								@endif
							</select>								
								@if ($errors->has('city')and old('hdnInputCreate')=='1')
									<span class="invalid-feedback" role="alert" style="color:#ff0000;text-align:center;">
										<strong>{{ $errors->first('city') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-lg-1">
								<label class="font-weight-bold text-dark text-2">@lang('global.Postal Code')</label>
								<input type="text" class="form-control inPostalCode @error('postal_code') is-invalid @enderror" name="postal_code" value="{{old('postal_code')}}" maxlength="10" onKeyPress="return goodchars(event,'0123456789',this)" required>
								@if ($errors->has('postal_code')and old('hdnInputCreate')=='1')
									<span class="invalid-feedback" role="alert" style="color:#ff0000;text-align:center;">
										<strong>{{ $errors->first('postal_code') }}</strong>
									</span>
								@endif
							</div>						
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="hdnInputCreate" value="1">
					<input type="submit" value="@lang('global.Save')" class="btn btn-primary" data-loading-text="Loading...">
					<button type="button" class="btn btn-light" data-dismiss="modal" onclick="reloadPage()">@lang('global.Close')</button>
				</div>
			</form>
		</div>
	</div>
</div>
@push('scripts')
	<script src="{{asset('front/custom/number_only.js')}}"></script>
	<script>
		var $ = jQuery.noConflict();
							function reloadPage() {
						location.reload();
					}
					function hideLogin() {
						$("#createModaln").modal('hide');
					}
		@if (isset($errors) and $errors->any())
			@if ($errors->any() and old('hdnInputCreate')=='1')
				$('#createModal').modal();
			@endif
		@endif		
		
		
    	$('#prov').change(function(){
       	 	$.get('provinces/' + this.value + '/cities.json', function(cities){
				var $cito = $('#city');
				$cito.find('option').remove().end();
				$.each(cities, function(index, city) {
					$cito.append($('<option/>').attr('value', city.id).text(city.name)); 
				});
			});
    	});
		$(document).ready(function() {
			$("#prov option[value='0']").attr("disabled","disabled");
			$("#city option[value='0']").attr("disabled","disabled");
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