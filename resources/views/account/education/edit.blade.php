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
			{{ Breadcrumbs::render('account.education.edit') }}
			<h3>{{__('account.Data')}} {{__('account.Education')}} <i class="fa fa-graduation-cap"></i></h3>
			@if(session()->has('success'))
				<span class="full-time pull-left breadcrumb">{{session()->get('success')}}</span>					
			@endif
			@if(session()->has('error'))
				<span class="full-time pull-left breadcrumb">{{session()->get('error')}}</span>					
			@endif			
			<form role="form" files="true" enctype="multipart/form-data" method="POST" action="{{ route('account.education.update') }}" novalidate="novalidate">
			@csrf
				<div class="container-detail-box">
					<h5>{{__('account.Junior High School')}}</h5>
					<div class="row extra-mrg">
						<div class="col-md-8 col-sm-8">
							<label>{{__('account.School Name')}}</label>
							<input type="text" class="form-control @error('jun_sch_name') is-invalid @enderror" name="jun_sch_name" value="{{old('jun_sch_name',auth()->user()->userdescription->jun_school_name)}}" maxlength="50" autofocus required>
							@error('jun_sch_name')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>				
					</div>
					<div class="row extra-mrg">
						<div class="col-md-4 col-sm-4">	
							<label>{{__('account.Start Year')}}</label>
							<input name="start_edujun" type="text" id="start_edujun" placeholder="YYYY" data-format="Y" data-init-set="false" date-format="Y-m-d" link-format="Y-m-d" data-translate-mode="true" data-auto-lang="true" data-lang="{{app()->getLocale()}}" data-large-mode="true" data-min-year="1970" data-id="datedropper-1" data-theme="my-style" class="form-control @error('start_edujun') is-invalid @enderror" value="{{ old('start_edujun',auth()->user()->userdescription->jun_school_start)}}" readonly="" required>
							@error('start_edujun')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
						<div class="col-md-4 col-sm-4">
							<label>{{__('account.Final Year')}}</label>
							<input name="last_edujun" type="text" id="last_edujun" placeholder="YYYY" data-format="Y" data-init-set="false" date-format="Y-m-d" link-format="Y-m-d" data-translate-mode="true" data-auto-lang="true" data-lang="{{app()->getLocale()}}" data-large-mode="true" data-min-year="1970" data-id="datedropper-1" data-theme="my-style" class="form-control @error('last_edujun') is-invalid @enderror" value="{{ old('last_edujun',auth()->user()->userdescription->jun_school_last)}}" readonly="" required>
							@error('last_edujun')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>						
					</div>
				</div>
				<div class="container-detail-box">
					<h5>{{__('account.Senior High School')}}</h5>
					<div class="row extra-mrg">
						<div class="col-md-8 col-sm-8">
							<label>{{__('account.School Name')}}</label>
							<input type="text" class="form-control @error('sen_sch_name') is-invalid @enderror" name="sen_sch_name" value="{{old('sen_sch_name',auth()->user()->userdescription->sen_school_name)}}" maxlength="50" required>
							@error('sen_sch_name')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>				
					</div>
					<div class="row extra-mrg">
						<div class="col-md-4 col-sm-4">	
							<label>{{__('account.Start Year')}}</label>
							<input name="start_edusen" type="text" id="start_edusen" placeholder="YYYY" data-format="Y" data-init-set="false" date-format="Y-m-d" link-format="Y-m-d" data-translate-mode="true" data-auto-lang="true" data-lang="{{app()->getLocale()}}" data-large-mode="true" data-min-year="1970" data-id="datedropper-1" data-theme="my-style" class="form-control @error('start_edusen') is-invalid @enderror" value="{{ old('start_edusen',auth()->user()->userdescription->sen_school_start)}}" readonly="" required>
							@error('start_edusen')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
						<div class="col-md-4 col-sm-4">
							<label>{{__('account.Final Year')}}</label>
							<input name="last_edusen" type="text" id="last_edusen" placeholder="YYYY" data-format="Y" data-init-set="false" date-format="Y-m-d" link-format="Y-m-d" data-translate-mode="true" data-auto-lang="true" data-lang="{{app()->getLocale()}}" data-large-mode="true" data-min-year="1970" data-id="datedropper-1" data-theme="my-style" class="form-control @error('last_edusen') is-invalid @enderror" value="{{ old('last_edusen',auth()->user()->userdescription->sen_school_last)}}" readonly="" required>
							@error('last_edusen')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>						
					</div>
				</div>
				<div class="form-group">
					<div class="row extra-mrg">
						<div class="col-md-3 col-sm-3">
							<input type="submit" value="@lang('account.Save')" class="btn btn-login" data-loading-text="Loading...">	
						</div>						
					</div>				
				</div>
			</form>				
				<div class="container-detail-box">
					<h5>{{__('account.Higher Education')}}</h5>
					<div class="row extra-mrg">
						<div class="col-md-12 col-sm-12">
							<ul class="working-days">
								@foreach($educations as $education)
									<li>{{str_limit(strip_tags(ucwords($education->education)), 25) }} | <b>{{str_limit(strip_tags(ucwords($education->major)), 25) }}</b> | {{str_limit(strip_tags(ucwords($education->school)), 30) }}<span>{{$education->start_year}} - {{$education->last_year}} <a type="button" href="#editModalEdu" class="edit-modal" data-toggle="modal" data-target="#editModalEdu" data-idcollege="{{$education->id}}" data-levelcollege="{{$education->education_id}}" data-majorcollege="{{$education->major}}" data-schoolcollege="{{$education->school}}" data-startcollege="{{$education->start_year}}" data-lastcollege="{{$education->last_year}}"><i class="fa fa-pencil-square-o"></i></a></span></li>
								@endforeach	
							</ul>
						</div>
						<div class="col-md-11 col-sm-11">
							<div class="sidebar-box">
								<span class="sidebar-status kyt-sidebar-status"><a href="#createModalEdu" data-toggle="modal" data-target="#createModalEdu"><i class="fa fa-plus"></i> @lang('account.Add Higher Education')</a></span>
							</div>
						</div>						
					</div>
				</div>
		</div>		
		@includeWhen(auth()->check(), 'layouts.inc.sidebar')			
	</div>
</section>
@includeWhen(auth()->check(), 'account.education.college.create')
@includeWhen(auth()->check(), 'account.education.college.edit')
<!-- Freelancer Detail End -->	

@endsection	
@push('scripts')
	<!--Untuk tanggal sekolah-->
    <script type="text/javascript">
    var $ = jQuery.noConflict();
		$('#start_edujun').dateDropper();
		$('#last_edujun').dateDropper();
		$('#start_edusen').dateDropper();
		$('#last_edusen').dateDropper();	
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
		<script type="text/javascript">
		var $ = jQuery.noConflict();
        $(document).on('click', '.edit-modal', function() {
            $('#idcollege_edit').val($(this).data('idcollege'));				
            $('#levelcollege_edit').val($(this).data('levelcollege'));
            $('#majorcollege_edit').val($(this).data('majorcollege'));	
            $('#schoolcollege_edit').val($(this).data('schoolcollege'));			
            $('#startcollege_edit').val($(this).data('startcollege'));
            $('#lastcollege_edit').val($(this).data('lastcollege'));			
            id = $('#idcollege_edit').val();			
			$('#editModalEdu').modal('show');			
        });				
	</script>
@endpush			