												<select name="cat" id="cat" class="form-control input-lg sselecter" required>
													<option value="" 
														@if (old('cat')=='' or old('cat')==0)
															selected="selected"
														@endif> @lang('global.Select Job Role') </option>
														@if(old('parent'))
															@foreach ($cates as $c)
																@if(old('parent')==$c->parent_id)
																	<option value="{{ $c->translation_of}}"
																		@if($c->translation_of==old('cat'))      
																			selected="selected"
																		@endif >
																		{{ $c->name }}
																	</option>
																@endif
															@endforeach
														@endif
											</select>