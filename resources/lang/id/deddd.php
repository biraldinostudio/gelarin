												<select name="parent" id="parent" class="form-control input-lg sselecter">
													<option value="" data-type=""
															@if (old('parent')=='' or old('parent')==0)
																selected="selected"
															@endif
													> @lang('global.Select Region') </option>
													@foreach ($parents as $par)
														<option value="{{ $par->translation_of}}"
																@if (old('parent')==$par->translation_of)
																	selected="selected"
																@endif
														> {{ $par->name }} </option>
													@endforeach
												</select>