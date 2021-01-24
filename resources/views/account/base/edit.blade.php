@extends('layouts.app')

@section('content')
<!-- Title Header Start -->
<section class="kyt-header-content">
	<div class="container"></div>
</section>
<div class="clearfix"></div>
<section>
	<div class="container">
		<div class="col-md-8 col-sm-8">
			{{ Breadcrumbs::render('account.base.edit') }}
			<h3>{{__('account.Data')}} {{__('account.Basic Information')}}</h3>
			@if(session()->has('success'))
				<span class="full-time pull-left breadcrumb">{{session()->get('success')}}</span>					
			@endif
			@if(session()->has('error'))
				<span class="full-time pull-left breadcrumb">{{session()->get('error')}}</span>					
			@endif			
			<form role="form" files="true" enctype="multipart/form-data" method="POST" action="{{ route('account.base.update') }}" novalidate="novalidate">
			@csrf
				<div class="form-group">
					<div class="row extra-mrg">
						<div class="col-md-8 col-sm-8">
							<label>{{__('account.Full Name')}}</label>				
							<input class="form-control @error('name') is-invalid @enderror" placeholder="@lang('account.Full Name')" name="name" type="text" value="{{ old('name',auth()->user()->name) }}" maxlength="35" autofocus="autofocus" required>
							@error('name')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>					
					</div>
					<div class="row extra-mrg">
						<div class="col-md-3 col-sm-3">
							<label>{{__('account.Username')}}</label>
							@if(!empty(auth()->user()->userdescription->username))
								<input type="text" id="text-disabled" class="form-control @error('username') is-invalid @enderror" name="username" value="{{old('username',auth()->user()->userdescription->username)}}" readonly required>
							@else
								<input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{old('username',auth()->user()->userdescription->username)}}" required>
							@endif	
							@error('username')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
						<div class="col-md-4 col-sm-4">
							<label>{{__('account.Nickname')}}</label>						
							<input type="text" class="form-control @error('nickname') is-invalid @enderror" name="nickname" value="{{old('nickname',auth()->user()->userdescription->nickname)}}" maxlength="12" required>
							@error('nickname')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>						
					</div>
				</div>
				<div class="form-group">
					<div class="row extra-mrg">
						<div class="col-md-4 col-sm-4">
							<label>{{__('account.Gender')}}</label></br>					
							@foreach($genders as $gender)
						 		<input type="radio" name="gender" id="gender" value="{{$gender->translation_of}}"
								@if(old('gender',auth()->user()->userdescription->gender_id)==$gender->translation_of)checked="checked"
						   			@endif  > {{$gender->name}}&nbsp;
						     	@endforeach
							@error('gender')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>					
						<div class="col-md-3 col-sm-3">
							<label>{{__('account.Date of Birth')}}</label>
							<input name="date_birth" type="text" id="date_birth" placeholder="{{$myCountries->date_format}}" data-format="{{$myCountries->date_format}}" data-init-set="false" date-format="Y-m-d" link-format="Y-m-d" data-translate-mode="true" data-auto-lang="true" data-lang="{{app()->getLocale()}}" data-large-mode="true" data-default-date="01-01-1981" data-min-year="1960" data-max-year="<?php date('yyyy') ?>" data-id="datedropper-1" data-theme="my-style" class="form-control{{ $errors->has('date_birth') ? ' is-invalid' : '' }}" value="{{old('date_birth',date($myCountries->date_format, strtotime(auth()->user()->userdescription->date_birth)))}}" readonly="" required>
							@error('date_birth')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
						<div class="col-md-4 col-sm-4">
							<label>{{__('account.Phone Number')}} ({{__('account.without code')}} +{{$myCountries->phone}})</label>
							<input type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{old('phone',auth()->user()->userdescription->phone)}}" onKeyPress="return goodchars(event,'0123456789',this)" placeholder="{{__('account.Ex.')}} 81250923112" maxlength="13" required>
							@error('phone')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>							
					</div>
				</div>
				<div class="form-group">
					<div class="row extra-mrg">
						<div class="col-md-2 col-sm-2">
							<input type="submit" value="@lang('account.Save')" class="btn btn-login" data-loading-text="Loading...">	
						</div>						
					</div>				
				</div>
			</form>	
		</div>
		@includeWhen(auth()->check(), 'layouts.inc.sidebar')				
	</div>
</section>
@endsection	
@push('scripts')	
	<!--Untuk upload photo---->
    <script type="text/javascript">
		var $ = jQuery.noConflict();
            var $imageupload = $('.imageupload');
            $imageupload.imageupload();
            $('#imageupload-reset').on('click', function() {
                $imageupload.imageupload('reset');
                $(this).blur();
            });
	</script>
	<!--Untuk tanggal lahir-->
    <script type="text/javascript">
    var $ = jQuery.noConflict();
		$('#date_birth').dateDropper();	
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