			<!-- Job Alert Code -->
			<div class="modal fade" id="createModalExp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog">
					
					<div class="modal-content">
						<div class="modal-header theme-bg">
							<h4 class="modal-title light">{{__('account.Add Experience')}}</h4>
						</div>
						<div class="modal-body padd-top-40">
							<div class="dapply-job-form">
								<form id="createForm" class="form-inline" action="{{route('account.experience.store')}}" method="POST" novalidate="novalidate">
									@csrf
									<div class="row no-mrg">
										<div class="col-md-11 col-sm-11">
											@if ($errors->has('position')and old('checkErrorCreateExp')=='1')
												<div class="invalid-feedback">{{ $errors->first('position') }}</div>
											@enderror
											@if ($errors->has('company')and old('checkErrorCreateExp')=='1')
												<div class="invalid-feedback">{{ $errors->first('company') }}</div>
											@enderror
											@if ($errors->has('start_year')and old('checkErrorCreateExp')=='1')
												<div class="invalid-feedback">{{ $errors->first('start_year') }}</div>
											@enderror
											@if ($errors->has('last_year')and old('checkErrorCreateExp')=='1')
												<div class="invalid-feedback">{{ $errors->first('last_year') }}</div>
											@enderror											
										</div>
									</div>
									<div class="row no-mrg">
										<div class="col-md-10 col-sm-10">
											<label>{{__('account.Job Position')}}</label>
											<input type="text"  name="position" class="form-control @error('position') is-invalid @enderror" value="{{old('position')}}" maxlength="30" required>
										</div>
									</div>
									<div class="row no-mrg">
										<div class="col-md-10 col-sm-10">
											<label>{{__('account.Company')}}</label>
											<input type="text" name="company" class="form-control @error('company') is-invalid @enderror" value="{{old('company')}}" maxlength="30" required>
										</div>
									</div>
									<div class="col-md-5 col-sm-10">
										<label>{{__('account.Start Year')}}</label>
										<input name="start_year" type="text" id="start_expcreate" placeholder="{{$countries->date_format}}" data-format="{{$countries->date_format}}" data-init-set="false" date-format="Y-m-d" link-format="Y-m-d" data-translate-mode="true" data-auto-lang="true" data-lang="{{app()->getLocale()}}" data-large-mode="true" data-min-year="1960" data-max-year="2100" data-id="datedropper-1" data-theme="my-style" class="form-control @error('start_year') is-invalid @enderror" value="{{old('start_year')}}" readonly="" required>
									</div>
									<div class="col-md-5 col-sm-10">
										<label>{{__('account.Final Year')}}</label>
										<input name="last_year" type="text" id="last_expcreate" placeholder="{{$countries->date_format}}" data-format="{{$countries->date_format}}" data-init-set="false" date-format="Y-m-d" link-format="Y-m-d" data-translate-mode="true" data-auto-lang="true" data-lang="{{app()->getLocale()}}" data-large-mode="true" data-min-year="1960" data-max-year="2100" data-id="datedropper-1" data-theme="my-style" class="form-control @error('last_year') is-invalid @enderror" value="{{old('last_year')}}" readonly="" required>
									</div>
									<div class="col-md-5 col-sm-5">
										<input type="hidden" name="checkErrorCreateExp" value="1">										
										<button type="submit" id="createBtn" class="submit-btn"> {{__('account.Save')}} </button>
									</div>
									<div class="col-md-5 col-sm-5">
										<button type="button" class="dismis-btn" data-dismiss="modal" onclick="reloadPage()">{{__('account.Close')}}</button>
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
				@if ($errors->any() and old('checkErrorCreateExp')=='1')
					$('#createModalExp').modal();
				@endif
			@endif

			//Bagian datedropper
			$('#start_expcreate').dateDropper();
			$('#last_expcreate').dateDropper();		
			var monthNames = [ "January", "February", "March", "April", "May", "June",
				"July", "August", "September", "October", "November", "December" ];
			for (i = new Date().getFullYear(); i > 1900; i--){
				$('#years').append($('<option />').val(i).html(i));
			}	
			for (i = 1; i < 13; i++){
				$('#months').append($('<option />').val(i).html(i));
			}
			 updateNumberOfDays();
			$('#years, #months').on("change", function(){
				updateNumberOfDays(); 
			});
			function updateNumberOfDays(){
				$('#days').html('');
				month=$('#months').val();
				year=$('#years').val();
				days=daysInMonth(month, year);

				for(i=1; i < days+1 ; i++){
						$('#days').append($('<option />').val(i).html(i));
				}
				$('#message').html(monthNames[month-1]+" in the year "+year+" has <b>"+days+"</b> days");
			}

			function daysInMonth(month, year) {
				return new Date(year, month, 0).getDate();
			}		
	</script>

@endpush