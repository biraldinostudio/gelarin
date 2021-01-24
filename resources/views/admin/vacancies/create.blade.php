@extends('layouts.admin.app')
@section('content')
			<!-- /#page-wrapper -->
			<div id="page-wrapper">
				<div class="row page-titles">
					<div class="col-md-5 align-self-center">
						<h3 class="text-themecolor">Tambah Pekerjaan</h3>
					</div>
					<div class="col-md-7 align-self-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{route('admin.home')}}">Beranda</a></li>
							<li class="breadcrumb-item"><a href="{{route('admin.company.index')}}">Manajemen Pekerjaan</a></li>
							<li class="breadcrumb-item active">Tambah Pekerjaan</li>
						</ol>
					</div>
				</div>
				<div class="container-fluid">
					<!-- /row -->
					<div class="row">
						<div class="col-md-12 col-sm-12">
							@if(session()->has('success'))
								<div class="card">
									<div class="card-header">
										<span class="kyt-font-white full-time bg-success pull-left breadcrumb">{{session()->get('success')}}</span><br>					
									</div>
								</div>
							@endif
							@if(session()->has('error'))
								<div class="card">
									<div class="card-header">
										<span class="kyt-font-white full-time bg-warning pull-left breadcrumb">{{session()->get('error')}}</span><br>					
									</div>
								</div>
							@endif	
							<form enctype="multipart/form-data" method="POST" action="{{ route('admin.vacancies.store') }}" novalidate>
							@csrf								
							<div class="card">
								<div class="card-header">
									<h4>Perusahaan</h4>
								</div>
								<div class="card-body">
									<div class="row no-mrg">
										<div class="col-sm-4">
											<label>Daftar Perusahaan</label>
											<select name="company" id="company" class="form-control @error('company') is-invalid @enderror" required>
												<option value="" data-type=""@if (old('company')=='' or old('company')=='')selected="selected"@endif> Pilih Perusahaan</option>
													@foreach ($companies as $company)
														<option value="{{$company->id}}"@if (old('company')==$company->id)selected="selected"@endif> {{ $company->name }} </option>
													@endforeach
											</select>
											@error('company')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror									
										</div>									
									</div>	
								</div>
							</div>							
							<!-- General Information -->
							<div class="card">
							
								<div class="card-header">
									<h4>General Information</h4>									
								</div>			
								<div class="card-body">
									<div class="row no-mrg">
										<div class="col-sm-5 col-md-5">
											<label>Judul</label>
											<input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{old('subject')}}" placeholder="Isi judul pekerjaan"  maxlength="53" required>
											@error('subject')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror	
										</div>
										<div class="col-sm-3 col-md-3">
											<label>Jenis Pekerjaan</label>
											<select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
												<option value="" data-type=""@if (old('type')=='' or old('type')=='')selected="selected"@endif> Pilih Jenis Pekerjaan</option>
													@foreach ($working_types as $type)
														<option value="{{ $type->translation_of}}"@if (old('type')==$type->translation_of)selected="selected"@endif> {{ $type->name }} </option>
													@endforeach
											</select>
											@error('type')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
										<div class="col-sm-3 col-md-3">
											<label>Level Pekerjaan</label>
											<select name="level" id="level" class="form-control @error('level') is-invalid @enderror" required>
												<option value="" data-type=""@if (old('level')=='' or old('level')=='')selected="selected"@endif> Pilih Level Pekerjaan</option>
												@foreach ($working_levels as $level)
													<option value="{{ $level->translation_of}}"@if (old('level')==$level->translation_of)selected="selected"@endif> {{ $level->name }} </option>
												@endforeach
											</select>
											@error('level')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>									
									</div>
									<div class="row no-mrg">
										<div class="col-md-4 col-sm-4">
											<label>Spesialis Pekerjaan</label>
											<select name="parent" id="parent" class="form-control @error('parent') is-invalid @enderror" required>
												<option value="" data-type=""
													@if (old('parent')=='' or old('parent')==0)
															selected="selected"
													@endif
												>Pilih Spesialis Pekerjaan 
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
											@error('parent')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>	
										<div class="col-md-4 col-sm-4">
											<label>Peran Pekerjaan</label>
											<select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
												<option value="" 
													@if (old('category')=='' or old('category')==0)
														selected="selected"
													@endif> Pilih Peran Pekerjaan 
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
											@error('category')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>										
									</div>		
								</div>
							</div>

							<div class="card">
								<div class="card-header">
									<h4>Lokasi</h4>
								</div>
								<div class="card-body">
									<div class="row no-mrg">
										<div class="col-sm-3">
											<label>Propinsi</label>
											<select name="subadmin1" id="subadmin1" class="location form-control @error('subadmin1') is-invalid @enderror" required>
												<option value="" data-type=""
													@if (old('subadmin1')=='' or old('subadmin1')==0)
														selected="selected"
													@endif
												> Pilih Wilayah </option>
												@foreach ($sub_admin1s as $cat)
													<option value="{{ $cat->code}}"
														@if (old('subadmin1')==$cat->code)
															selected="selected"
														@endif
														> {{ $cat->name }} 
													</option>
												@endforeach
											</select>	
											@error('subadmin1')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror										
										</div>
										<div class="col-sm-3">
											<label>Kota</label>
											<select name="cit" id="cit" class="form-control city @error('cit') is-invalid @enderror" data-placeholder="Pilih Kota" required>
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
											@error('cit')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror										
										</div>
										<div class="col-sm-6">
											<label>Alamat Pekerjaan</label>
											<input type="text" id="address" maxlength="53" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Isi Alamat Pekerjaan" value="{{ old('address') }}" required>
											@error('address')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror										
										</div>										
										
									</div>	
								</div>
							</div>
							<div class="card">
								<div class="card-header">
									<h4>Jenjang Pendidikan</h4>
								</div>
								<div class="card-body">
									<div class="row no-mrg">
										<div class="col-sm-5">
											<label>Jenjang Pendidikan</label>
											<select name="educatione[]" id="educatione" class="education form-control @error('educatione') is-invalid @enderror" multiple="multiple" data-placeholder="Pilih Jenjang Pendidikan" required>
												@foreach ($educations as $education)                                                    
													<option value="{{ $education->translation_of}}"
														@if(in_array($education->translation_of , old('educatione',[])))      
															selected="selected"
														@endif >{{ $education->name }}</option>
												@endforeach
											</select>									
											@error('educatione')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror<br>									
										</div>										
									</div>	
								</div>
							</div>
							<div class="card">
								<div class="card-header">
									<h4>Program Studi/ Jurusan</h4>
								</div>
								<div class="card-body">
									<div class="row no-mrg">
										<div class="col-sm-5">
											<label>Program Studi</label>
											<select name="majorne[]" id="majorne" class="major form-control @error('majorne') is-invalid @enderror" multiple="multiple" required>
												@foreach ($majors as $majora)                                                    
													<option value="{{ $majora->translation_of}}"
														@if(in_array($majora->translation_of , old('majorne',[])))      
															selected="selected"
														@endif >{{ $majora->name }}
													</option>
												@endforeach
											</select>
											@error('majorne')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror<br>										
										</div>										
									</div>	
								</div>
							</div>
							<div class="card">
								<div class="card-header">
									<h4>Pengalaman Kerja/Maksimal Umur</h4>
								</div>
								<div class="card-body">
									<div class="row no-mrg">
										<div class="col-sm-3">
											<label>Pengalaman Kerja</label>
											<select name="experience" id="experience" class="form-control @error('experience') is-invalid @enderror" tabindex="-1" aria-hidden="true" value="{{ old('experience') }}" required>
												<option value="" data-type=""@if (old('experience')=='' or old('experience')==0)selected="disabled"@endif> Pilih Pengalaman Kerja</option>
												<option value="0" @if(old('experience') == '0')selected="selected"@endif>0</option>
												<option value="1" @if(old('experience') == '1')selected="selected"@endif>1</option>
												<option value="2" @if(old('experience') == '2')selected="selected"@endif>2</option>
												<option value="3" @if(old('experience') == '3')selected="selected"@endif>3</option>
												<option value="4" @if(old('experience') == '4')selected="selected"@endif>4</option>
												<option value="5" @if(old('experience') == '5')selected="selected"@endif>5</option>
												<option value="6" @if(old('experience') == '6')selected="selected"@endif>6</option>
												<option value="7" @if(old('experience') == '7')selected="selected"@endif>7</option>
												<option value="8" @if(old('experience') == '8')selected="selected"@endif>8</option>
												<option value="100" @if(old('experience') == '100')selected="selected"@endif>24 Tahun Keatas</option>													
											</select>
											@error('experience')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror										
										</div>
										<div class="col-sm-3">
											<label>Maksimal Umur</label>
											<input type="text" min="18" max="55" size="2" maxlength="2" id="age" name="age" onKeyPress="return goodchars(event,'0123456789',this)" class="form-control @error('age') is-invalid @enderror" placeholder="Isi maksimal umur" value="{{ old('age') }}" required>
											@error('age')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror										
										</div>
										<div class="col-sm-3">
											<label>Jenis Kelamin</label>
											<select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" required>
												<option value="" data-type=""@if (old('gender')=='' or old('gender')=='')selected="selected"@endif> Pilih Jenis Kelamin</option>
												@foreach ($genders as $gender)
													<option value="{{ $gender->translation_of}}"
														@if (old('gender')==$gender->translation_of)
															selected="selected"
														@endif> {{ $gender->name }} 
													</option>
												@endforeach
											</select>	
											@error('gender')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror										
										</div>										
									</div>	
								</div>
							</div>							
													
							
							<div class="card">
								<div class="card-header">
									<h4>Skala Upah</h4>
								</div>
								<div class="card-body">
									<div class="row no-mrg">
										<div class="col-sm-3">
											<label>Minimal Gaji</label>
											<input name="min_salary" id="min_salary" type="float" class="form-control @error('min_salary') is-invalid @enderror"  value="{{ old('min_salary') }}" onKeyPress="return goodchars(event,'0123456789',this)" placeholder="Isi minimal Gaji" required>
											@error('min_salary')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror										
										</div>
										<div class="col-sm-3">
											<label>Maksimal Gaji</label>
											<input name="max_salary" id="max_salary" type="float" class="form-control @error('max_salary') is-invalid @enderror"  value="{{ old('max_salary') }}" onKeyPress="return goodchars(event,'0123456789',this)" placeholder="Isi maksimal  Gaji" required>
											@error('max_salary')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror										
										</div>
										<div class="col-sm-3">
											<label>Jenis Gaji</label>
											<select name="salary" id="salary" class="form-control @error('salary') is-invalid @enderror"  tabindex="-1" aria-hidden="true" data-placeholder="Isi jenis penggajian" value="{{ old('salary') }}" required>
												<option value="" data-type=""@if (old('salary')=='' or old('salary')==0)selected="selected"@endif> Pilih jenis penggajian </option>
												@foreach ($salary_types as $sal)
													<option value="{{ $sal->translation_of}}"
														@if (old('salary')==$sal->translation_of)
															selected="selected"
														@endif> {{ $sal->name }} 
													</option>
												@endforeach
											</select>	
											@error('salary')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror										
										</div>
										<div class="col-sm-3">
											<input name="negotiable" id="negotiable" type="checkbox" class="form-check-input" value="1" {{ (old('negotiable')=='1') ? 'checked="checked"' : '' }}> </label>Negosiasi Gaji</label>										
										</div>
										<div class="col-sm-3">
											<input name="hide_salary" id="hide_salary" type="checkbox" class="form-check-input" value="1" {{ (old('hide_salary')=='1') ? 'checked="checked"' : '' }}> <label>Sembunyikan Gaji</label>									
										</div>										
									</div>	
								</div>
							</div>
							
							<div class="card">
								<div class="card-header">
									<h4>Tanggung Jawab Pekerjaan</h4>
								</div>
								<div class="card-body">
									<div class="row no-mrg">
										<div class="col-sm-12">
											<label>Responsibility</label>
											<textarea class="form-control height-120 textarea @error('description') is-invalid @enderror" id="about-company" name="description" placeholder="Isi deskripsi tanggung jawab pekerjaan" required>{{old('description')}}</textarea>
											@error('description')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror										
										</div>										
									</div>	
								</div>
							</div>
							<div class="card">
								<div class="card-header">
									<h4>Lain-lain</h4>
								</div>
								<div class="card-body">
									<div class="row no-mrg">
										<div class="col-sm-8">
											<label>Tautan Lowongan Kerja</label>
											<input name="url" id="url" type="text" class="form-control input-lg" placeholder="Jika ada tautan / link silahkan isi disini" value="{{old('url')}}">
											@error('url')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror										
										</div>
										<div class="col-sm-2">
											<label>Akhir Lowongan</label>
											<input name="end_date" type="text" id="end_date" placeholder="d M Y" data-format="d M Y" data-init-set="false" date-format="Y-m-d" link-format="Y-m-d" data-translate-mode="true" data-auto-lang="true" data-lang="id" data-large-mode="true" data-min-year="<?php date('Y') ?>" data-max-year="2100" data-id="datedropper-1" data-theme="my-style" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}" readonly="" required>
											@error('end_date')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror										
										</div>										
									</div>	
								</div>
							</div>
							<div class="text-center">
								<button type="submit" class="btn btn-m btn-success">Submit</button>
							</div>
							</form>
						</div>
					</div>
					<!-- /row -->
				</div>	
			</div>
			<!-- /#page-wrapper -->
@endsection
@push('styles')
		<link rel="stylesheet" href="{{asset('front/custom/custom.css')}}">
<style>
.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    background-color: #f5f1f1;
    opacity: 1;
}

div.datedropper.my-style {
  border-radius: 8px;
  width: 180px;
}
div.datedropper.my-style .picker {
  border-radius: 8px;
  box-shadow: 0 0 32px 0px rgba(0, 0, 0, 0.1);
}
div.datedropper.my-style .pick-l {
  border-bottom-left-radius: 8px;
  border-bottom-right-radius: 8px;
}
div.datedropper.my-style:before,
div.datedropper.my-style .pick-submit,
div.datedropper.my-style .pick-lg-b .pick-sl:before,
div.datedropper.my-style .pick-m,
div.datedropper.my-style .pick-lg-h {
  background-color:#1cc100;
}
div.datedropper.my-style .pick-y.pick-jump,
div.datedropper.my-style .pick li span,
div.datedropper.my-style .pick-lg-b .pick-wke,
div.datedropper.my-style .pick-btn {
  color: #1cc100;
}
div.datedropper.my-style .picker,
div.datedropper.my-style .pick-l {
  background-color: #FFF;
}
div.datedropper.my-style .picker,
div.datedropper.my-style .pick-arw,
div.datedropper.my-style .pick-l {
  color: #3a465e;
}
div.datedropper.my-style .pick-m,
div.datedropper.my-style .pick-m .pick-arw,
div.datedropper.my-style .pick-lg-h,
div.datedropper.my-style .pick-lg-b .pick-sl,
div.datedropper.my-style .pick-submit {
  color: #FFF;
}
div.datedropper.my-style.picker-tiny:before,
div.datedropper.my-style.picker-tiny .pick-m {
  background-color: #FFF;
}
div.datedropper.my-style.picker-tiny .pick-m,
div.datedropper.my-style.picker-tiny .pick-m .pick-arw {
  color: #3a465e;
}
div.datedropper.my-style.picker-lkd .pick-submit {
  background-color: #FFF;
  color: #3a465e;
}
</style>		
@endpush
@push('scripts')
	<script src="{{asset('front/center/money/simple.money.format.js')}}" type="text/javascript"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/datedropper.min.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/dropzone.js')}}"></script>	
	<script type="text/javascript">
		var $ = jQuery.noConflict();
	
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
		$("#educatione").select2({
			placeholder: "Pilih jenjang pendidikan"
		});
		
		// Job Special
		$("#majorne").select2({
			placeholder: "Pilih program studi"
		});		

		// Job Special
		$("#company").select2({
			placeholder: "Pilih perusahaan"
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
</script>	
@endpush		