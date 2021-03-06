@extends('layouts.company.app')

@section('content')
<!-- Title Header Start -->
<section class="kyt-header-content">
	<div class="container"></div>
</section>
<div class="clearfix"></div>
<!-- Title Header End -->
			
<!-- ========== Begin: Brows job Category ===============  -->
<section class="brows-job-category gray-bg">
	<div class="container">
		<div class="col-md-9 col-sm-12">
			<div class="full-card">		
				<div class="card-header">
					<div class="row mrg-0">		
						<div class="col-md-7 col-sm-7">
							@if(session()->has('message'))
								<ol class="breadcrumb pull-left">
									<li class="active">
										<i class="fa fa-check"></i> {{ session()->get('message') }}
									</li>
								</ol>	
							@endif					
						</div>
						<!--<div class="col-md-3 col-sm-3">
							<select class="form-control">
								<option>By Category</option>
								<option>Information Technology</option>
								<option>Mechanical</option>
								<option>Hardware</option>
								</select>
						</div>-->									
						<div class="col-md-1 col-sm-1">
						</div>									
						<div class="col-md-4 col-sm-4">
							<ol class="breadcrumb pull-right">
								<li><a href="{{route('company.dashboard')}}"><i class="fa fa-home"></i></a></li>
								<li>
									@lang('vacancy.Add Jobs')																						
								</li>
							<li><a href="{{route('vacancies.active')}}" class="kyt-font-green" title="@lang('vacancy.Back')"><i class="fa fa-arrow-left"></i></a></li>							
							</ol>
						</div>
					</div>
				</div>
				<form enctype="multipart/form-data" method="POST" action="{{ route('vacancies.store') }}" novalidate>
				@csrf				
				<div class="card-body">
					
					<article class="advance-search-job">
						<div class="row no-mrg">
							<div class="col-md-10 col-sm-10">
								<input type="text" id="subject" maxlength="53" name="subject" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" placeholder="@lang('vacancy.Input Job Title')" value="{{ old('subject') }}" autofocus required>
								@if ($errors->has('subject'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('subject') }}</strong>
									</p>
								@endif
							</div>
						</div>
						<div class="row no-mrg">
							<div class="col-md-5 col-sm-5">
								<select name="type" id="type" class="form-control type{{ $errors->has('type') ? ' is-invalid' : '' }}" required>
									<option value="" data-type=""@if (old('type')=='' or old('type')=='')selected="selected"@endif> @lang('vacancy.Select Job Type')</option>
										@foreach ($working_types as $type)
											<option value="{{ $type->translation_of}}"@if (old('type')==$type->translation_of)selected="selected"@endif> {{ $type->name }} </option>
										@endforeach
								</select>
								@if ($errors->has('type'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('type') }}</strong>
									</p>
								@endif	
							</div>
							<div class="col-md-5 col-sm-5">
								<select name="level" id="level" class="form-control level{{ $errors->has('level') ? ' is-invalid' : '' }}" required>
									<option value="" data-type=""@if (old('level')=='' or old('level')=='')selected="selected"@endif> @lang('vacancy.Select Position Level')</option>
									@foreach ($working_levels as $level)
										<option value="{{ $level->translation_of}}"@if (old('level')==$level->translation_of)selected="selected"@endif> {{ $level->name }} </option>
									@endforeach
								</select>
								@if ($errors->has('level'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('level') }}</strong>
									</p>
								@endif						
							</div>						
						</div>					
						<div class="row no-mrg">
							<div class="col-md-5 col-sm-5">
								<select name="parent" id="parent" class="form-control job-special{{ $errors->has('parent') ? ' is-invalid' : '' }}" required>
									<option value="" data-type=""
										@if (old('parent')=='' or old('parent')==0)
												selected="selected"
										@endif
									> @lang('vacancy.Select Job Specialization') 
									</option>
									@foreach ($parents as $cat)
										<option value="{{ $cat->translation_of }}"
											@if (old('parent')==$cat->translation_of)
												selected="selected"
											@endif
										> {{ $cat->name }} 
										</option>
									@endforeach
								</select>
								@if ($errors->has('parent'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('parent') }}</strong>
									</p>
								@endif
							</div>
							<div class="col-md-5 col-sm-5">
								<select name="category" id="category" class="form-control job-role{{ $errors->has('category') ? ' is-invalid' : '' }}" required>
									<option value="" 
										@if (old('category')=='' or old('category')==0)
											selected="selected"
										@endif> @lang('vacancy.Select Job Role') 
									</option>
									@if(old('parent'))
										@foreach ($categories as $c)
											@if(old('parent')==$c->parent_id)
												<option value="{{ $c->translation_of}}"
													@if($c->translation_of==old('category'))      
														selected="selected"
													@endif >
													{{ $c->name }}
												</option>
											@endif
										@endforeach
									@endif
								</select>								
								@if ($errors->has('category'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('category') }}</strong>
									</p>
								@endif	
							</div>					
						</div>
						<div class="row no-mrg">
							<div class="col-md-5 col-sm-5">
								<select name="subadmin1" id="subadmin1" class="location form-control{{ $errors->has('subadmin1') ? ' is-invalid' : '' }}">
									<option value="" data-type=""
										@if (old('subadmin1')=='' or old('subadmin1')==0)
											selected="selected"
										@endif
									> @lang('vacancy.Select Region') </option>
									@foreach ($sub_admin1s as $cat)
										<option value="{{ $cat->code}}"
											@if (old('subadmin1')==$cat->code)
												selected="selected"
											@endif
											> {{ $cat->name }} 
										</option>
									@endforeach
								</select>											
								@if ($errors->has('subadmin1'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('subadmin1') }}</strong>
									</p>
								@endif	
							</div>
							<div class="col-md-5 col-sm-5">
								<select name="cit" id="cit" class="form-control city{{ $errors->has('cit') ? ' is-invalid' : '' }}" data-placeholder="@lang('vacancy.Select Location') " required>
									<option value="" 
										@if (old('cit')=='' or old('cit')==0)
											selected="selected"
										@endif> 
									</option>
									@if(old('subadmin1'))
										@foreach ($cite as $c)
											@if(old('subadmin1')==$c->subadmin1_code)
												<option value="{{ $c->id}}"
													@if($c->id==old('cit'))      
														selected="selected"
													@endif >
													{{ $c->name }}
												</option>
											@endif
										@endforeach
									@endif
								</select>			
								@if ($errors->has('cit'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('cit') }}</strong>
									</p>
								@endif					
							</div>						
						</div>	<p>
						<div class="row no-mrg">
							<div class="col-md-10 col-sm-10">
								<input type="text" id="address" maxlength="53" name="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="@lang('vacancy.Work Address')" value="{{ old('address') }}" required>
								@if ($errors->has('address'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('address') }}</strong>
									</p>
								@endif
							</div>
						</div>					
						<div class="row no-mrg">
							<div class="col-md-5 col-sm-5">
							<select name="educatione[]" id="educatione" class="education form-control{{ $errors->has('educatione') ? ' is-invalid' : '' }}" multiple="multiple" data-placeholder="@lang('vacancy.Select Level Education')" required>
									@foreach ($educations as $education)                                                    
										<option value="{{ $education->translation_of}}"
											@if(in_array($education->translation_of , old('educatione',[])))      
												selected="selected"
											@endif >{{ $education->name }}</option>
									@endforeach
							</select>
							
						
								@if ($errors->has('educatione'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('educatione') }}</strong>
									</p>
								@endif
							</div>
							<div class="col-md-5 col-sm-5">
								<select name="majorne[]" id="majorne" class="major form-control{{ $errors->has('majorne') ? ' is-invalid' : '' }}" multiple="multiple" required>
									@foreach ($majors as $majora)                                                    
										<option value="{{ $majora->translation_of}}"
											@if(in_array($majora->translation_of , old('majorne',[])))      
												selected="selected"
											@endif >{{ $majora->name }}
										</option>
									@endforeach
								</select>
								@if ($errors->has('majorne'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('majorne') }}</strong>
									</p>
								@endif
								@if(session()->has('messageNotDeleteMajor'))
									<p class="invalid-feedback" style="color:#ff0000;">
										<strong>{{ session()->get('messageNotDeleteMajor') }}</strong>
									</p>	
								@endif							
							</div>						
						</div>
						</p>
						
						<div class="row no-mrg">
							<div class="col-md-5 col-sm-5">
								<select name="experience" id="experience" class="form-control experience{{ $errors->has('experience') ? ' is-invalid' : '' }}" tabindex="-1" aria-hidden="true" value="{{ old('experience') }}" required>
									<option value="" data-type=""@if (old('experience')=='' or old('experience')==0)selected="disabled"@endif> @lang('vacancy.Select Years Experience')</option>
									<option value="0" @if(old('experience') == '0')selected="selected"@endif>0</option>
									<option value="1" @if(old('experience') == '1')selected="selected"@endif>1</option>
									<option value="2" @if(old('experience') == '2')selected="selected"@endif>2</option>
									<option value="3" @if(old('experience') == '3')selected="selected"@endif>3</option>
									<option value="4" @if(old('experience') == '4')selected="selected"@endif>4</option>
									<option value="5" @if(old('experience') == '5')selected="selected"@endif>5</option>
									<option value="6" @if(old('experience') == '6')selected="selected"@endif>6</option>
									<option value="7" @if(old('experience') == '7')selected="selected"@endif>7</option>
									<option value="8" @if(old('experience') == '8')selected="selected"@endif>8</option>
									<option value="100" @if(old('experience') == '100')selected="selected"@endif>@lang('vacancy.More then 24')</option>													
								</select>
								@if ($errors->has('experience'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('experience') }}</strong>
									</p>
								@endif
							</div>
							<div class="col-md-3 col-sm-3">
								<input type="text" min="18" max="55" size="2" maxlength="2" id="age" name="age" onKeyPress="return goodchars(event,'0123456789',this)" class="form-control{{ $errors->has('age') ? ' is-invalid' : '' }}" placeholder="@lang('vacancy.Input Maximum Age')" value="{{ old('age') }}" required>
								@if ($errors->has('age'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('age') }}</strong>
									</p>
								@endif					
							</div>
							<div class="col-md-3 col-sm-3">
								<select name="gender" id="gender" class="form-control gender{{ $errors->has('gender') ? ' is-invalid' : '' }}" required>
									<option value="" data-type=""@if (old('gender')=='' or old('gender')=='')selected="selected"@endif> @lang('vacancy.Gender')</option>
									@foreach ($genders as $gender)
										<option value="{{ $gender->translation_of}}"
											@if (old('gender')==$gender->translation_of)
												selected="selected"
											@endif> {{ $gender->name }} 
										</option>
									@endforeach
								</select>
								@if ($errors->has('gender'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('gender') }}</strong>
									</p>
								@endif		
							</div>						
						</div>
						<div class="row no-mrg">
							<div class="col-md-2 col-sm-2">
								<input name="currency" type="text" class="form-control" value="{{$countries->currency_code}}" readonly="readonly">		
							</div>
							<div class="col-md-3 col-sm-3">
								<input name="min_salary" id="min_salary" type="float" class="form-control{{ $errors->has('min_salary') ? ' is-invalid' : '' }}"  value="{{ old('min_salary') }}" onKeyPress="return goodchars(event,'0123456789',this)" placeholder="{{__('vacancy.Min. Salary')}}" required>
								@if ($errors->has('min_salary'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('min_salary') }}</strong>
									</p>
								@endif						
							</div>
							<div class="col-md-3 col-sm-3">
								<input name="max_salary" id="max_salary" type="float" class="form-control{{ $errors->has('max_salary') ? ' is-invalid' : '' }}"  value="{{ old('max_salary') }}" onKeyPress="return goodchars(event,'0123456789',this)" placeholder="{{__('vacancy.Max. Salary')}}" required>
								@if ($errors->has('max_salary'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('max_salary') }}</strong>
									</p>
								@endif						
							</div>	
							<div class="col-md-3 col-sm-3">
								<select name="salary" id="salary" class="form-control salary"  tabindex="-1" aria-hidden="true" data-placeholder="@lang('vacancy.Select Salary Type')" value="{{ old('salary') }}" required>
									<option value="" data-type=""@if (old('salary')=='' or old('salary')==0)selected="selected"@endif> @lang('vacancy.Select Salary Type') </option>
									@foreach ($salary_types as $sal)
										<option value="{{ $sal->translation_of}}"
											@if (old('salary')==$sal->translation_of)
												selected="selected"
											@endif> {{ $sal->name }} 
										</option>
									@endforeach
								</select>
								@if ($errors->has('salary'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('salary') }}</strong>
									</p>
								@endif							
							</div>						
						</div>
						<div class="row no-mrg">
							<div class="col-md-2 col-sm-2">
								<p style="text-align:left;">
									<input name="negotiable" id="negotiable" type="checkbox" class="form-check-input" value="1" {{ (old('negotiable')=='1') ? 'checked="checked"' : '' }}> </label>@lang('vacancy.Negotiable')</label>
								</p>	
							</div>
							<div class="col-md-5 col-sm-5">
								<p style="text-align:left;">
									<input name="hide_salary" id="hide_salary" type="checkbox" class="form-check-input" value="1" {{ (old('hide_salary')=='1') ? 'checked="checked"' : '' }}> <label>@lang('vacancy.Hide Salary')</label>						
								</p>		
							</div>						
						</div>									
					</article>
					<article class="advance-search-job">
						<div class="row no-mrg">
							<div class="col-md-11 col-sm-11">
								<label>{{__('vacancy.Responsibility & Expertise')}}</label>
								<textarea id="ed" class="form-control tinymce{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description"> {{ old('description') }}</textarea>
								@if ($errors->has('description'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('description') }}</strong>
									</p>
								@endif										
							</div>
						</div>
					</article>
					<article class="advance-search-job">
						<div class="row no-mrg">
							<div class="col-md-8 col-sm-8">
								<label>{{__('vacancy.Job link')}}</label>							
								<input name="url" id="url" type="text" class="form-control input-lg" placeholder="@lang('vacancy.Job link')" value="{{old('url')}}">
								@if ($errors->has('url'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('url') }}</strong>
									</p>
								@endif	
							</div>
							<div class="col-md-3 col-sm-3">
								<label>{{__('vacancy.Close Vacancies')}}</label>
								<input name="end_date" type="text" id="end_date" placeholder="{{$countries->date_format}}" data-format="{{$countries->date_format}}" data-init-set="false" date-format="Y-m-d" link-format="Y-m-d" data-translate-mode="true" data-auto-lang="true" data-lang="{{app()->getLocale()}}" data-large-mode="true" data-min-year="2018" data-max-year="2100" data-disabled-days="08/17/2017,08/18/2017" data-id="datedropper-1" data-theme="my-style" class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}" value="{{ old('end_date') }}" readonly="" required>	
								@if ($errors->has('end_date'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('end_date') }}</strong>
									</p>
								@endif						
							</div>						
						</div>
					</article>
					<article class="advance-search-job">
						<div class="row no-mrg">
							<div class="col-md-10 col-sm-10">
								<p style="text-align:left;">
									<button type="submit" class="btn btn-m btn-primary"><i class="fa fa-save"></i> Submit</button>
									<a class="btn btn-warning" href="{{ route('vacancies.active') }}"><i class="fa fa-arrow-circle-left"></i> @lang('vacancy.Back')</a>										
								</p>
							</div>
						</div>
					</article>					
				</div></form>
			</div>
		</div>
	<!-- Sidebar Start -->
	@section('sidebar')
		@include('layouts.company.inc.sidebar')
	@show
	<!-- Sidebar End -->	
	</div>
</section>
@endsection	
@push('styles')
		<link rel="stylesheet" href="{{asset('front/custom/custom.css')}}">
@endpush
@push('scripts')

	<script src="{{asset('front/center/money/simple.money.format.js')}}" type="text/javascript"></script>
    <script src="{{asset('front/center/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('front/center/tinymce/jquery.tinymce.min.js')}}"></script> 	
	<script type="text/javascript">
		var $ = jQuery.noConflict();
		//Bagian datedropper
		$('#end_date').dateDropper();
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
		//Batas datedropper
	
		//Bagian kategori pekerjaan
    	$('#parent').change(function(){
       	 	$.get('categories/' + this.value + '/subcategories.json', function(subcategories){
				var $subcategory = $('#category');
				$subcategory.find('option').remove().end();
				$.each(subcategories, function(index, category) {
					$subcategory.append($('<option/>').attr('value', category.translation_of).text(category.name)); 
				});
			});
    	});
		$(document).ready(function() {
			$(".parent option[value='0']").attr("disabled","disabled");
			$(".category option[value='0']").attr("disabled","disabled");
		});
		//Batas kategori pekerjaan
		
		//Bagian Lokasi
    	$('#subadmin1').change(function(){
       	 	$.get('sub_admin1s/' + this.value + '/cities.json', function(cities){
				var $city = $('#cit');
				$city.find('option').remove().end();
				$.each(cities, function(index, cit) {
					$city.append($('<option/>').attr('value', cit.id).text(cit.name)); 
				});
			});
    	});
		$(document).ready(function() {
			$(".subadmin1 option[value='0']").attr("disabled","disabled");
			$(".cit option[value='0']").attr("disabled","disabled");
		});	
		
		// Job Special
		$(".job-special").select2({
			placeholder: "{{trans('vacancy.Select Job Specialization')}}"
		});
		
		// Job Role
		$(".job-role").select2({
			placeholder: "{{trans('vacancy.Select Job Role')}}"
		});
		
		// Level
		$(".level").select2({
			placeholder: "{{trans('vacancy.Select Position Level')}}"
		});

		// Type
		$(".type").select2({
			placeholder: "{{trans('vacancy.Select Job Type')}}"
		});		

		// Location
		$(".location").select2({
			placeholder: "{{trans('vacancy.Select Location')}}"
		});			

		// City
		$(".city").select2({
			placeholder: "{{trans('vacancy.Select City')}}"
		});
		
		// Education
		$(".education").select2({
			placeholder: "{{trans('vacancy.Education Section')}}"
		});

		// Major
		$(".major").select2({
			placeholder: "{{trans('vacancy.Select Major')}}"
		});
		
		// Experience
		$(".experience").select2({
			placeholder: "{{trans('vacancy.Select Years Experience')}}"
		});
		
		// Gender
		$(".gender").select2({
			placeholder: "{{trans('vacancy.Gender')}}"
		});

		// Salary
		$(".salary").select2({
			placeholder: "{{trans('vacancy.Select Salary Type')}}"
		});			
			
		//Agar hanya input Angka.
		function getkey(e){
			if (window.event)
				return window.event.keyCode;
			else if (e)
				return e.which;
			else
				return null;
		}
		function goodchars(e, goods, field){
			var key, keychar;
			key = getkey(e);
			if (key == null) return true;
				keychar = String.fromCharCode(key);
				keychar = keychar.toLowerCase();
				goods = goods.toLowerCase();
		 
			// check goodkeys
			if (goods.indexOf(keychar) != -1)
				return true;
			// control keys
			if ( key==null || key==0 || key==8 || key==9 || key==27 )
			return true;
			
			if (key == 13) {
				var i;
				for (i = 0; i < field.form.elements.length; i++)
				if (field == field.form.elements[i])
					break;
				i = (i + 1) % field.form.elements.length;
				field.form.elements[i].focus();
				return false;
			};
			// else return false
			return false;
		} 	
	
		//Salary
		$('#min_salary').simpleMoneyFormat();
		$('#max_salary').simpleMoneyFormat();
		
	</script>
    <script type="text/javascript">
		var $ = jQuery.noConflict();
		tinymce.init({
			selector: "textarea.tinymce",
			menubar:false,
			statusbar: false,
		  //toolbar: 'undo redo | formatselect | bold italic backcolor  | color| alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | link',	
			toolbar: 'undo redo | formatselect | bold italic strikethrough forecolor backcolor permanentpen formatpainter | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | emoticons',
			skin: "dick-light",
			plugins: ["link,anchor,textcolor,emoticons"],
			content_css: [
				'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
				'//www.tiny.cloud/css/codepen.min.css',
			],
			height : "300",
			placeholder:"xxxxx"

		});
    </script>
@endpush		