<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<form enctype="multipart/form-data" id="frmCreateLegal" action="#" method="POST" novalidate="novalidate">
				@csrf
				<div class="modal-header">
					<h4 class="modal-title" id="formModalLabel">@lang('auth.Add Legal Documents')</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="reloadPage()">&times;</button>
				</div>
				<div class="modal-body">
					<div class="box-content">
						<div class="form-row">
							<div class="form-group col-lg-12">
								<label class="font-weight-bold text-dark text-2">@lang('auth.Document Name')</label>
									<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" maxlength="50" required>
									@if ($errors->has('name')and old('hdnInputCreate')=='1')
										<span class="invalid-feedback" role="alert" style="color:#ff0000;text-align:center;">
											<strong>{{ $errors->first('name') }}</strong>
										</span>
									@endif															
							</div>
						</div>						
						<div class="form-row">
							<div class="form-group col-sm-4">
								<label class="font-weight-bold text-dark text-2">@lang('auth.Number')</label>
									<input type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{old('number')}}" maxlength="50" required>
									@if ($errors->has('number')and old('hdnInputCreate')=='1')
										<span class="invalid-feedback" role="alert" style="color:#ff0000;text-align:center;">
											<strong>{{ $errors->first('number') }}</strong>
										</span>
									@endif	
							</div>
							<div class="form-group col-lg-4">
								<label class="font-weight-bold text-dark text-2">@lang('auth.Expire Date')</label>						
								<input name="expire" type="text" id="expire" data-lang="{{app()->getLocale()}}" data-large-mode="true"  data-default-date="<?php date('yyyy') ?>" data-min-year="2018" data-max-year="5050" placeholder="{{$myCountries->date_format}}" data-format="{{$myCountries->date_format}}" data-init-set="false" date-format="Y-m-d" link-format="Y-m-d" data-translate-mode="true" data-auto-lang="true" data-disabled-days="08/17/2017,08/18/2017" data-id="datedropper-1" data-theme="my-style" class="form-control @error('expire') is-invalid @enderror" value="{{old('expire')}}" readonly="" required>						
								@if ($errors->has('expire')and old('hdnInputCreate')=='1')
									<span class="invalid-feedback" role="alert" style="color:#ff0000;text-align:center;">
										<strong>{{ $errors->first('expire') }}</strong>
									</span>
								@endif
							</div>
						</div>
						
						
						<div class="form-row">
							<div class="form-group col-lg-12">
								<label class="font-weight-bold text-dark text-2">@lang('auth.Document Name')</label>
									<input type="file" accept=".pdf" class="form-controlx @error('doc') is-invalid @enderror" name="doc" value="{{old('doc')}}" required>
									@if ($errors->has('doc')and old('hdnInputCreate')=='1')
										<span class="invalid-feedback" role="alert" style="color:#ff0000;text-align:center;">
											<strong>{{ $errors->first('doc') }}</strong>
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
	<script>
		$('#expire').dateDropper();
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
	</script>
@endpush