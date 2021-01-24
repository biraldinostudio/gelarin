			<!-- Job Alert Code -->
			<div class="modal fade" id="createModalTestimonial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog">
					
					<div class="modal-content">
						<div class="modal-header theme-bg">
							<h4 class="modal-title light">{{__('testimonial.Sharing Testimonials')}}</h4>
						</div>
						<div class="modal-body padd-top-40">
							<div class="dapply-job-form">
								<form id="createForm" class="form-inline" action="{{route('company.testimonial.store')}}" method="POST" novalidate="novalidate">
									@csrf
									<div class="row no-mrg">
										<div class="col-md-11 col-sm-11">
											@if ($errors->has('testimonial')and old('checkErrorCreateTestimonial')=='1')
												<div class="invalid-feedback">{{ $errors->first('testimonial') }}</div>
											@enderror
											@if ($errors->has('value')and old('checkErrorCreateTestimonial')=='1')
												<div class="invalid-feedback">{{ $errors->first('value') }}</div>
											@enderror											
										</div>
									</div>									
									<div class="row no-mrg">
										<div class="col-md-10 col-sm-10">
											<label>{{__('testimonial.Testimonial')}}</label>
										<textarea id="kyt-textareaMini" class="form-control @error('testimonial') is-invalid @enderror" name="testimonial" maxlength="300" required>{{old('testimonial')}}</textarea>
										</div>
									</div>									
									<div class="row no-mrg">
										<div class="col-md-4 col-sm-4">
											<label>{{__('testimonial.Value')}}</label>
								<select name="value" id="value" class="form-control @error('value') is-invalid @enderror" value="{{ old('value') }}" required>
									<option value="" data-type=""@if (old('value')=='' or old('value')==0)selected="disabled"@endif> @lang('testimonial.Select Value')</option>
									<option value="1" @if(old('value') == '1')selected="selected"@endif>1</option>
									<option value="2" @if(old('value') == '2')selected="selected"@endif>2</option>
									<option value="3" @if(old('value') == '3')selected="selected"@endif>3</option>
									<option value="4" @if(old('value') == '4')selected="selected"@endif>4</option>
									<option value="5" @if(old('value') == '5')selected="selected"@endif>5</option>												
								</select>
										</div>
									</div>							
									<div class="col-md-5 col-sm-5">
										<input type="hidden" name="checkErrorCreateTestimonial" value="1">										
										<button type="submit" id="createBtn" class="submit-btn"> {{__('testimonial.Save')}} </button>
									</div>
									<div class="col-md-5 col-sm-5">
										<button type="button" class="dismis-btn" data-dismiss="modal" onclick="reloadPage()">{{__('testimonial.Close')}}</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>   
			<!-- End Job Alert -->
	@push('scripts')
	<script src="{{asset('front/custom/number_only.js')}}"></script>	
		<script>
			var $ = jQuery.noConflict();	
			$(document).ready(function () {
				$("#creatBtn").click(function () {
					$("#createForm").submit();
					return false;
				});
			});
			@if (isset($errors) and $errors->any())
				@if ($errors->any() and old('checkErrorCreateTestimonial')=='1')
					$('#createModalTestimonial').modal();
				@endif
			@endif		
	</script>

@endpush