			<!-- Job Alert Code -->
			<div class="modal fade" id="editModalEdu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog">
					
					<div class="modal-content">
						<div class="modal-header theme-bg">
							<h4 class="modal-title light">{{__('account.Change Higher Education')}}</h4>
						</div>
						<div class="modal-body padd-top-40">
							<div class="dapply-job-form">
								<form id="createForm" class="form-inline" action="{{route('account.college.update')}}" method="POST" novalidate="novalidate">
									@csrf
									<div class="row no-mrg">
										<div class="col-md-11 col-sm-11">
											@if ($errors->has('level')and old('checkErrorEditEdu')=='1')
												<div class="invalid-feedback">{{ $errors->first('level') }}</div>
											@enderror
											@if ($errors->has('major')and old('checkErrorEditEdu')=='1')
												<div class="invalid-feedback">{{ $errors->first('major') }}</div>
											@enderror
											@if ($errors->has('school')and old('checkErrorEditEdu')=='1')
												<div class="invalid-feedback">{{ $errors->first('school') }}</div>
											@enderror
											@if ($errors->has('start_year')and old('checkErrorEditEdu')=='1')
												<div class="invalid-feedback">{{ $errors->first('start_year') }}</div>
											@enderror
											@if ($errors->has('last_year')and old('checkErrorEditEdu')=='1')
												<div class="invalid-feedback">{{ $errors->first('last_year') }}</div>
											@enderror											
										</div>
									</div>									
									<div class="row no-mrg">
										<div class="col-md-6 col-sm-8">
											<label>{{__('account.College Level')}}</label>
											<input type="hidden" class="form-control" name="idx" id="idcollege_edit">
											<select name="level" id="levelcollege_edit" class="form-control @error('level') is-invalid @enderror" required>
												<option value=""
													@if(old('level')=='' or old('level')==0)
														selected="selected"
													@endif> @lang('account.Select College Level') 
												</option>
												@foreach($educationLevels as $level)
													<option value="{{ $level->translation_of }}"
														@if(old('level')==$level->translation_of)
															selected="selected"
														@endif> {{$level->name}} 
													</option>
												@endforeach
											</select>
										</div>
									</div>									
									<div class="row no-mrg">
										<div class="col-md-10 col-sm-10">
											<label>{{__('account.Study Program')}}</label>
											<input type="text" id="majorcollege_edit" name="major" class="form-control @error('major') is-invalid @enderror" value="{{old('major')}}" maxlength="25" required>
										</div>
									</div>
									<div class="row no-mrg">
										<div class="col-md-10 col-sm-10">
											<label>{{__('account.College Name')}}</label>
											<input type="text" id="schoolcollege_edit" name="school" class="form-control @error('school') is-invalid @enderror" value="{{old('school')}}" maxlength="30" required>
										</div>
									</div>
									<div class="col-md-5 col-sm-10">
										<label>{{__('account.Start Year')}}</label>
										<input name="start_year" type="text" id="startcollege_edit" placeholder="YYYY" data-format="Y" data-init-set="false" date-format="Y-m-d" link-format="Y-m-d" data-translate-mode="true" data-auto-lang="true" data-lang="{{app()->getLocale()}}" data-large-mode="true" data-min-year="1970" data-id="datedropper-1" data-theme="my-style" class="form-control @error('start_year') is-invalid @enderror" value="{{ old('start_year') }}" readonly="" required>
									</div>
									<div class="col-md-5 col-sm-10">
										<label>{{__('account.Final Year')}}</label>
											<input name="last_year" type="text" id="lastcollege_edit" placeholder="YYYY" data-format="Y" data-init-set="false" date-format="Y-m-d" link-format="Y-m-d" data-translate-mode="true" data-auto-lang="true" data-lang="{{app()->getLocale()}}" data-large-mode="true" data-min-year="1970" data-id="datedropper-1" data-theme="my-style" class="form-control @error('last_year') is-invalid @enderror" value="{{ old('last_year') }}" readonly="" required>
									</div>							
									<div class="col-md-5 col-sm-5">
										<input type="hidden" name="checkErrorEditEdu" value="1">										
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
				@if ($errors->any() and old('checkErrorEditEdu')=='1')
					$('#editModalEdu').modal();
				@endif
			@endif

			//Bagian datedropper
			$('#startcollege_edit').dateDropper();
			$('#lastcollege_edit').dateDropper();		
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