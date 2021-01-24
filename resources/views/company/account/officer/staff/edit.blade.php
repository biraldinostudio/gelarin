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
									@lang('global.Edit Staff')																					
								</li>
								<li><a href="{{route('account.staff.list')}}" class="kyt-font-green" title="@lang('global.Back')"><i class="fa fa-arrow-left"></i></a></li>						
							</ol>
						</div>
					</div>
				</div>
				<form role="form"  enctype="multipart/form-data" method="POST" action="{{ route('account.staff.update',$staffs->id) }}" novalidate>				
				{{ method_field('PUT') }}			
				@csrf				
				<div class="card-body">
					<article class="advance-search-job">
						@if($staffs->active=='0')
							<div class="row no-mrg">
								<div class="col-md-5 col-sm-5">
									<p style="text-align:left;">
										<input name="active" id="active" type="checkbox" class="form-check-input{{ $errors->has('active') ? ' is-invalid' : '' }}" value="1" {{ (old('active',$staffs->active)=='1') ? 'checked="checked"' : '' }}> </label>@lang('global.Active')</label>	
									</p>
									@if ($errors->has('active'))
										<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
											<strong>{{ $errors->first('active') }}</strong>
										</p>
									@endif
								</div>	
							</div>
						@endif
						<div class="row no-mrg">
							<div class="col-md-5 col-sm-5">
								<input type="text" name="name" class="form-control input-lg{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name',$staffs->name) }}" required>
								@if ($errors->has('name'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('name') }}</strong>
									</p>
								@endif						
							</div>						
							<div class="col-md-5 col-sm-5">
								<input type="text" name="username" maxlength="16" class="form-control input-lg{{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{ old('username',$staffs->userdescription->username) }}" autofocus required>
								@if ($errors->has('username'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('username') }}</strong>
									</p>
								@endif
							</div>
						</div>					
						<div class="row no-mrg">				
							<div class="col-md-5 col-sm-5">
								<input type="text" name="email" class="form-control input-lg{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email',$staffs->email) }}"required>
								@if ($errors->has('email'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('email') }}</strong>
									</p>
								@endif
							</div>
							<div class="col-md-5 col-sm-5">
								<input class="form-control{{ $errors->has('number') ? ' is-invalid' : '' }}" name="number" type="text" value="{{ old('number',$staffs->userdescription->phone) }}" placeholder="@lang('auth.Number')" maxlength="11" onKeyPress="return goodchars(event,'0123456789',this)" required>
								@if ($errors->has('number'))
									<p class="invalid-feedback" style="color:#ff0000;text-align:left;">
										<strong>{{ $errors->first('number') }}</strong>
									</p>
								@endif					
							</div>						
						</div>
						<div class="row no-mrg">
							<div class="col-md-3 col-sm-3">
								<p style="text-align:left;">
									<input name="vacancy_access" id="vacancy_access" type="checkbox" class="form-check-input" value="1" {{ (old('vacancy_access',$staffs->companyofficer->vacancy_access)=='1') ? 'checked="checked"' : '' }}> <label>@lang('auth.Job Access')</label>
								</p>	
							</div>
							<div class="col-md-3 col-sm-3">
								<p style="text-align:left;">
									<input name="vacancy_posting" id="vacancy_posting" type="checkbox" class="form-check-input" value="1" {{ (old('vacancy_posting',$staffs->companyofficer->vacancy_posting)=='1') ? 'checked="checked"' : '' }}> </label>@lang('auth.Job Posting')</label>						
								</p>		
							</div>
							<div class="col-md-3 col-sm-3">
								<p style="text-align:left;">
									<input name="talent_search" id="talent_search" type="checkbox" class="form-check-input" value="1" {{ (old('talent_search',$staffs->companyofficer->talent_search)=='1') ? 'checked="checked"' : '' }}> <label>@lang('auth.Talent Search')</label>						
								</p>		
							</div>						
						</div>
						<div class="row no-mrg">
							<div class="col-md-3 col-sm-3">
								<p style="text-align:left;">
									<input name="staff_management" id="staff_management" type="checkbox" class="form-check-input" value="1" {{ (old('staff_management',$staffs->companyofficer->user_management)=='1') ? 'checked="checked"' : '' }}> <label>@lang('auth.Staff Management')</label>						
								</p>		
							</div>
							<div class="col-md-3 col-sm-3">
								<p style="text-align:left;">
									<input name="credit_management" id="credit_management" type="checkbox" class="form-check-input" value="1" {{ (old('credit_management',$staffs->companyofficer->credit_management)=='1') ? 'checked="checked"' : '' }}> <label>@lang('auth.Credit Management')</label>							
								</p>		
							</div>
							<div class="col-md-4 col-sm-4">
								<p style="text-align:left;">
									<input name="receive_candidate_email" id="receive_candidate_email" type="checkbox" class="form-check-input" value="1" {{ (old('receive_candidate_email',$staffs->companyofficer->receive_candidate_email)=='1') ? 'checked="checked"' : '' }}> <label>@lang('auth.Receive Candidate Email')</label>							
								</p>		
							</div>						
						</div>
						<div class="row no-mrg">
							<div class="col-md-3 col-sm-3">
								<p style="text-align:left;">
									<input name="add_article" id="add_article" type="checkbox" class="form-check-input" value="1" {{ (old('add_article',$staffs->companyofficer->add_articles)=='1') ? 'checked="checked"' : '' }}> <label>@lang('global.Add Article')</label>							
								</p>		
							</div>						
						</div>					
					</article>
					<article class="advance-search-job">
						<div class="row no-mrg">
							<div class="col-md-10 col-sm-10">
								<p style="text-align:left;">
									<button type="submit" class="btn btn-m btn-primary"><i class="fa fa-save"></i> Submit</button>
									<a class="btn btn-warning" href="{{ route('account.staff.list') }}"><i class="fa fa-arrow-circle-left"></i> @lang('global.Back')</a>										
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
@push('scripts')
	<!-- Untuk isi nomor telepon -->
	<script src="{{asset('front/center/phone/js/bootstrap-formhelpers.min.js')}}"></script>		
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
			placeholder: "{{trans('global.Select Job Specialization')}}"
		});
		
		// Job Role
		$(".job-role").select2({
			placeholder: "{{trans('global.Select Job Role')}}"
		});
		
		// Level
		$(".level").select2({
			placeholder: "{{trans('global.Select Position Level')}}"
		});

		// Type
		$(".type").select2({
			placeholder: "{{trans('global.Select Job Type')}}"
		});			

		// Location
		$(".location").select2({
			placeholder: "{{trans('global.Select Location')}}"
		});			

		// City
		$(".city").select2({
			placeholder: "{{trans('global.Select City')}}"
		});
		
		// Education
		$(".education").select2({
			placeholder: "{{trans('global.Education Section')}}"
		});

		// Major
		$(".major").select2({
			placeholder: "{{trans('global.Select Major')}}"
		});
		
		// Experience
		$(".experience").select2({
			placeholder: "{{trans('global.Select Years Experience')}}"
		});
		
		// Gender
		$(".gender").select2({
			placeholder: "{{trans('global.Gender')}}"
		});

		// Salary
		$(".salary").select2({
			placeholder: "{{trans('global.Select Salary Type')}}"
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
			height : "400",
			placeholder:"xxxxx"

		});
    </script>
@endpush