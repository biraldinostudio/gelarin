<!-- Apply Form Code -->
<div class="modal fade" id="apply-job" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">		
			<div class="modal-body">
				<div class="apply-job-box">
					<p><b>{{__('article.Article Search')}}</b> <button type="button" class="close" data-dismiss="modal">&times;</button></p>
				</div>
				<form role="form" method="POST" action="{{route('article.index')}}" novalidate="novalidate">
				@csrf	
					<div class="form-group">
						<div class="row extra-mrg">
							<div class="col-md-9 col-sm-8">
								<p>
									<input class="form-control @error('keyword') is-invalid @enderror" type="text" name="keyword" placeholder="@lang('article.Enter keywords')" value="{{ old('keyword') }}" required="required">
								</p>
									@if ($errors->has('keyword')and old('checkInputKeyword')=='1')
										<div class="invalid-feedback">{{ $errors->first('keyword') }}</div>
									@enderror								
							</div>				
							<div class="col-md-2 col-sm-1">
								<input type="hidden" name="checkInputKeyword" value="1">	
								<button type="submit" class="btn highlight" data-loading-text="Loading...">{{__('article.Search')}}</button>
							</div>
						</div>
					</div>		
				</form>
			</div>
		</div>
	</div>
</div>   
<!-- End Apply Form -->