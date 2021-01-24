@extends('layouts.app')
@section('content')
			<section class="kyt-header-content">
				<div class="container" >
				</div>
			</section>
			<!-- Title Header Start -->
			<section class="login-plane-sec">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<div class="login-panel panel panel-default">
								<div class="panel-heading" style="text-align:left;">
									<a href="{{ route('vacancies.detail',[$applications->vacancy->id,$applications->vacancy->slug]) }}" target="_blank" style="color:#2867b2;"><b>{{ucwords($applications->vacancy->title)}}</b></a> | 
									@if($applications->application_status=='Shortlist')
										<span class="alert-success"> @lang('global.Application has been seen') </span>
									@elseif($applications->application_status=='Not Suitable')
										<span class="alert-danger"> @lang('global.Not passed') </span>
									@elseif($applications->application_status=='Interview')
										<span class="alert-success"> @lang('global.Interview Process') </span>
									@elseif($applications->application_status=='Pass')
										<span class="alert-success"> @lang('global.You are accepted') </span>
									@elseif($applications->application_status=='Cancel')
										<span class="alert-warning"> @lang('global.Application has been canceled') </span>																		
									@else <span class="alert-info"> @lang('global.Application not yet processed') </span> 
									@endif | <b>{{ucwords($applications->vacancy->company->name)}}</b>								
								</div>
								<div class="panel-body">
									<form role="form" files="true"  enctype="multipart/form-data" method="POST" action="{{ route('application.cancel',$applications->id) }}" novalidate>
										@csrf
										<fieldset>
										<div class="form-group">
										</div>								
											<div class="form-group{ $errors->has('reason') ? ' is-invalid' : '' }}">
												<select name="reason" id="reason" class="form-control"  tabindex="-1" aria-hidden="true" required>
													<option value="" data-type=""@if (old('reason',$applications->reason_cancel_id)=='' or old('reason')==0)selected="selected"@endif> @lang('global.Choose Reason for Cancellation') </option>
													@foreach ($reasons as $reason)
													<option value="{{ $reason->translation_of}}"@if (old('reason',$applications->reason_cancel_id)==$reason->translation_of)selected="selected"@endif> {{ $reason->name }} </option>
													@endforeach
												</select>
											@if ($errors->has('reason'))
												<span class="invalid-feedback" style="color:#ff0000;text-align:center;">
													<strong>{{ $errors->first('reason') }}</strong>
												</span>
											@endif  												
											</div>
											<p><span class="span-umum">@lang('global.By pressing the Cancel Application button,') @lang('global.You will cancel the application').</span></p>
											<input type="submit" value="@lang('global.Cancel Application')" class="btn btn-primary" data-loading-text="Loading..."> 
											<a href="{{ URL::previous() }}" class="btn btn-kuning"><i class="fa fa-times-circle" ></i> @lang('global.Closed')</a>
										</fieldset>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
@endsection	
		