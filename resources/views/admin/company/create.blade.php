@extends('layouts.admin.app')
@section('content')
			<!-- /#page-wrapper -->
			<div id="page-wrapper">
				<div class="row page-titles">
					<div class="col-md-5 align-self-center">
						<h3 class="text-themecolor">Tambah Perusahaan</h3>
					</div>
					<div class="col-md-7 align-self-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{route('admin.home')}}">Beranda</a></li>
							<li class="breadcrumb-item"><a href="{{route('admin.company.index')}}">Manajemen Perusahaan</a></li>
							<li class="breadcrumb-item active">Tambah Perusahaan</li>
						</ol>
					</div>
				</div>
				<div class="container-fluid">
					<!-- /row -->
					<div class="row">
						<div class="col-md-12 col-sm-12">
							
							<!-- General Information -->
							<div class="card">
							
								<div class="card-header">
									<h4>General Information</h4>
								</div>
									<form enctype="multipart/form-data" method="POST" action="{{ route('admin.company.store') }}" novalidate>
									@csrf
									@if(session()->has('success'))
										<span class="kyt-font-white full-time bg-success pull-left breadcrumb">{{session()->get('success')}}</span><br>					
									@endif
									@if(session()->has('error'))
										<span class="kyt-font-white full-time bg-warning pull-left breadcrumb">{{session()->get('error')}}</span><br>					
									@endif					
								<div class="card-body">
									<div class="row">
										<div class="col-sm-2">
											<label>Kode</label>
											<input type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{old('code')}}" maxlength="5" required>
											@error('code')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror											
										</div>
										<div class="col-sm-4">
											<label>Nama Perusahaan</label>
											<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" maxlength="35" required>
											@error('name')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
										<div class="col-sm-4">
											<label>Email Perusahaan</label>
											<input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" maxlength="53" required>
											@error('email')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
										<div class="col-sm-2">
											<label>Telepon</label>
											<input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{old('phone')}}" onKeyPress="return goodchars(event,'0123456789',this)" maxlength="11" required>
											@error('phone')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
										<div class="col-sm-2">
											<label>Logo</label>
											<div class="profile-image-outer-container">
												<div class="profile-image-inner-container bg-color-primary">
														<img src="{{ asset('storage/uploads/company/logo/150x150.png') }}" class="imgCircle">	
												</div>
													<input type="file" name="logo" onchange="readURL(this);formAvatar.submit();" accept="image/*" class="profile-image-input inFile @error('file') is-invalid @enderror">
													@error('logo')
														<span class="invalid-feedback" role="alert">
															<strong>{{ $message }}</strong>
														</span>
													@enderror									
											</div>
											@error('phone')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>										
										<div class="col-sm-12 col-md-12">
											<label>Industri</label>
											<select name="industry[]" id="industry" class="form-control @error('industry') is-invalid @enderror" multiple="multiple" required>
													@foreach ($industries as $industry)                                                    
														<option value="{{ $industry->translation_of}}"
															@if(in_array($industry->translation_of , old('industry',[])))      
																selected="selected"
															@endif >{{ $industry->name }}</option>
													@endforeach
											</select>										
											
											@error('industry')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror											
										</div>
									</div>		
								</div>
							</div>
							<div class="card">
								<div class="card-header">
									<h4>Deskripsi</h4>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-sm-12">
											<label>Deskripsi Perusahaan</label>
											<textarea class="form-control height-120 textarea @error('description') is-invalid @enderror" id="about-company" name="description" placeholder="Deskripsi perusahaan" maxlength="500" required>{{old('description')}}</textarea>
											@error('description')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror										
										</div>
										
									</div>	
								</div>
							</div>
							<div class="card">
								<div class="card-header">
									<h4>Alamat Perusahaan</h4>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-sm-3">
											<label>Propinsi</label>
											<select name="subadmin1" id="subadmin1" class="location form-control{{ $errors->has('subadmin1') ? ' is-invalid' : '' }}" required>
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
											@error('subadmin1')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
										<div class="col-sm-3">
											<label>Kota</label>
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
											@error('cit')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
										<div class="col-sm-6">
											<label>Alamat</label>
											<input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{old('address')}}" maxlength="50" required>
											@error('address')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
									</div>		
								</div>
							</div>
							
							<!-- Social Accounts -->
							<div class="card">
								<div class="card-header">
									<h4>Petugas Rekrutmen Perusahaan</h4>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-sm-4">
											<label>Nama Petugas</label>
											<input type="text" class="form-control @error('officer') is-invalid @enderror" name="officer" value="{{old('officer')}}" maxlength="35" required>
											@error('officer')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
										<div class="col-sm-4">
											<label>Jabatan</label>
											<input type="text" class="form-control @error('position') is-invalid @enderror" name="position" value="{{old('position')}}" maxlength="35" required>
											@error('position')
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
@push('scripts')
	<script type="text/javascript">
		var $ = jQuery.noConflict();
		// Experience
		$("#industry").select2({
			placeholder: "Pilih industry"
		});
		
		// Location
		$(".location").select2({
			placeholder: "{{trans('vacancy.Select Location')}}"
		});			

		// City
		$(".city").select2({
			placeholder: "{{trans('vacancy.Select City')}}"
		});		
		
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

		  //Bagian avatar
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('.imgCircle')
							.attr('src', e.target.result)
							.width(200)
							.height(200);
				};
				reader.readAsDataURL(input.files[0]);
			}
		}		
</script>
@endpush