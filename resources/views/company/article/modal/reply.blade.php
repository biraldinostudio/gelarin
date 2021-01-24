
			<!-- Apply Form Code -->
			<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog">
					<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="formModalLabel">@lang('article.Leave a Comment')</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>					
						<div class="modal-body">
							<div class="apply-job-form">
								<form class="form-horizontal" action="{{route('company.article.comment.reply')}}" method="POST" role="form" novalidate>
								@csrf
									<div class="col-sm-12">
										<div class="form-group">
											<input type="hidden" class="form-control" name="idx" id="id_edit">
											<input type="hidden" class="form-control" name="article_id" id="article_id_edit">												
											<label>@lang('article.Value'):</label>
											<label class="radio-inline"><input type="radio" name="value" value="1" @if(old('value')=='1') checked="checked" @endif >1</label>
											<label class="radio-inline"><input type="radio" name="value" value="2" @if(old('value')=='2') checked="checked" @endif>2</label>
											<label class="radio-inline"><input type="radio" name="value" value="3" @if(old('value')=='3') checked="checked" @endif >3</label>
											<label class="radio-inline"><input type="radio" name="value" value="4" @if(old('value')=='4') checked="checked" @endif>4</label>
											<label class="radio-inline"><input type="radio" name="value" value="5" @if(old('value')=='5') checked="checked" @endif >5</label>
											@error('value')
											<p>
											   <span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											</p>	
											@enderror										
											<textarea class="form-control @error('comment') is-invalid @enderror" placeholder="@lang('article.Fill in the comment')" name="comment" required>{{old('comment')}}</textarea>
											@error('comment')
											   <span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
											<div class="center">
												<input type="hidden" name="hdnInputCreate" value="1">											
												<button type="submit" class="thm-btn btn-comment submit-btn" data-loading-text="Loading..."><i class="fa fa-save fa-lg"></i> @lang('article.Send Comment')</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>   
			<!-- End Apply Form -->
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
	</script>
@endpush