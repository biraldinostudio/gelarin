@extends('layouts.app')
@section('meta')<meta name="keywords" content="{{ config('app.keyword') }}" />
	<meta name="description" content="{{ config('app.description') }}">
	<meta name="author" content="gelarin.com">	
	<title>{{ config('app.name', 'Gelarin') }} {{ config('app.title') }}</title>	
@endsection
@section('content')
<!-- Title Header Start -->
<section class="kyt-header-content">
	<div class="container"></div>
</section>
<div class="clearfix"></div>
<section>
	<div class="container">
		<div class="col-md-8 col-sm-8">
			{{ Breadcrumbs::render('account.experience.index') }}
			<h3>{{__('account.Data')}} {{__('account.Experience & Skill')}} <i class="fa fa-history"></i></h3>	
			<div class="container-detail-box">
				<h4>{{__('account.Skill')}}</h4>
				@if(session()->has('successSkills'))
					<span class="full-time pull-left breadcrumb">{{session()->get('successSkills')}}</span>					
				@endif
				@if(session()->has('errorSkills'))
					<span class="full-time pull-left breadcrumb">{{session()->get('errorSkills')}}</span>					
				@endif					
				<div class="row extra-mrg">
					<div class="col-md-12 col-sm-12">
						<ul class="working-days">
							@foreach($skills as $skill)
								<li>{{str_limit(strip_tags(ucwords($skill->skill)), 30) }} | {{$skill->value}}%<span> <a type="button" href="#editModalSkill" class="edit-modal" data-toggle="modal" data-target="#editModalSkill" data-idskill="{{$skill->id}}" data-skillskill="{{$skill->skill}}" data-sizeskill="{{$skill->value}}"><i class="fa fa-pencil-square-o"></i></a></span></li>
							@endforeach	
						</ul>
					</div>
					<div class="col-md-11 col-sm-11">
						<div class="sidebar-box">
							<span class="sidebar-status kyt-sidebar-status"><a href="#createModalSkill" data-toggle="modal" data-target="#createModalSkill"><i class="fa fa-plus"></i> @lang('account.Add Skill')</a></span>
						</div>
					</div>						
				</div>
			</div>				
			<div class="container-detail-box">
				<h4>{{__('account.Experience')}}</h4>
				@if(session()->has('success'))
					<span class="full-time pull-left breadcrumb">{{session()->get('success')}}</span>					
				@endif
				@if(session()->has('error'))
					<span class="full-time pull-left breadcrumb">{{session()->get('error')}}</span>					
				@endif					
				<div class="row extra-mrg">
					<div class="col-md-12 col-sm-12">
						<ul class="working-days">
							@foreach($experiences as $experience)
								<li>{{str_limit(strip_tags(ucwords($experience->job_position)), 25) }} | <b>{{str_limit(strip_tags(ucwords($experience->company)), 25) }}</b><span>{{date($countries->date_format, strtotime($experience->start_working))}} - {{date($countries->date_format, strtotime($experience->last_working))}} <a type="button" href="#editModalExp" class="edit-modal" data-toggle="modal" data-target="#editModalExp" data-idexp="{{$experience->id}}" data-positionexp="{{$experience->job_position}}" data-companyexp="{{$experience->company}}" data-startexp="{{date($countries->date_format, strtotime($experience->start_working))}}" data-lastexp="{{date($countries->date_format, strtotime($experience->last_working))}}"><i class="fa fa-pencil-square-o"></i></a></span></li>
							@endforeach	
						</ul>
					</div>
					<div class="col-md-11 col-sm-11">
						<div class="sidebar-box">
							<span class="sidebar-status kyt-sidebar-status"><a href="#createModalExp" data-toggle="modal" data-target="#createModalExp"><i class="fa fa-plus"></i> @lang('account.Add Experience')</a></span>
						</div>
					</div>						
				</div>
			</div>		
		</div>		
		@includeWhen(auth()->check(), 'layouts.inc.sidebar')			
	</div>
</section>
@includeWhen(auth()->check(), 'account.experience.modal.create')
@includeWhen(auth()->check(), 'account.experience.modal.edit')
@includeWhen(auth()->check(), 'account.experience.modal.skill.create')
@includeWhen(auth()->check(), 'account.experience.modal.skill.edit')
<!-- Freelancer Detail End -->	

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
		<script type="text/javascript">
		var $ = jQuery.noConflict();
        $(document).on('click', '.edit-modal', function() {	
            $('#idexp_edit').val($(this).data('idexp'));				
            $('#positionexp_edit').val($(this).data('positionexp'));
            $('#companyexp_edit').val($(this).data('companyexp'));				
            $('#startexp_edit').val($(this).data('startexp'));
            $('#lastexp_edit').val($(this).data('lastexp'));			
			
            id = $('#idexp_edit').val();

            $('#idskill_edit').val($(this).data('idskill'));				
            $('#skillskill_edit').val($(this).data('skillskill'));
            $('#sizeskill_edit').val($(this).data('sizeskill'));							
			
            id = $('#ideskill_edit').val();			
			//$('#editModalExp').modal('show');            
            //$('#editModalSkill').modal('show');			
        });				
	</script>
@endpush			