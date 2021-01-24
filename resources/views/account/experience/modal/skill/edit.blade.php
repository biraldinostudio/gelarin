			<!-- Job Alert Code -->
			<div class="modal fade" id="editModalSkill" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog">
					
					<div class="modal-content">
						<div class="modal-header theme-bg">
							<h4 class="modal-title light">{{__('account.Change Skill')}}</h4>
						</div>
						<div class="modal-body padd-top-40">
							<div class="dapply-job-form">						
								<form id="createFormSkill" class="form-inline" action="{{route('account.skill.update')}}" method="POST" novalidate="novalidate">
									@csrf
									<div class="row no-mrg">
										<div class="col-md-10 col-sm-10">
											@if ($errors->has('skill')and old('checkErrorEditSkill')=='1')
												<div class="invalid-feedback">{{ $errors->first('skill') }}</div>
											@enderror
											@if ($errors->has('size')and old('checkErrorEditSkill')=='1')
												<div class="invalid-feedback">{{ $errors->first('size') }}</div>
											@enderror											
										</div>
										<div class="col-md-10 col-sm-10">
											<label>{{__('account.Skill')}}</label>
											<input type="hidden" class="form-control" name="idx" id="idskill_edit">
											<input type="text" id="skillskill_edit" name="skill" class="form-control @error('skill') is-invalid @enderror" value="{{old('skill')}}" maxlength="40" autofocus required>
										</div>
										<div class="col-md-2 col-sm-2">
											<label>{{__('account.Size')}}(%)</label>
											<input type="text" id="sizeskill_edit" name="size" class="form-control @error('size') is-invalid @enderror" value="{{old('size')}}" onKeyPress="return goodchars(event,'0123456789',this)" maxlength="3" required>
										</div>										
									</div>
									<div class="col-md-6 col-sm-6">
										<input type="hidden" name="checkErrorCreateSkill" value="1">										
										<button type="submit" id="createBtn" class="submit-btn"> {{__('account.Save')}} </button>
									</div>
									<div class="col-md-6 col-sm-6">
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
				$("#creatBtnSkill").click(function () {
					$("#createFormSkill").submit();
					return false;
				});
			});
			@if (isset($errors) and $errors->any())
				@if ($errors->any() and old('checkErrorEditSkill')=='1')
					$('#editModalSkill').modal();
				@endif
			@endif		
	</script>

@endpush