@extends('layouts.company.app')
@section('content')
			<!-- Tab Section Start -->
			<section class="simple-bg-screen big-wrap">
				<div class="container">
					<div class="error-page">
						<h3><span>{{__('error.Sory')}}</span></h3>
						<p>@lang('error.Please contact your company administrator to complete <b>company data</b>, <b>address data</b> and <b>legality data</b>. You cannot install jobs before the data is completed.')</p> 
						<a href="{{ URL::previous() }}" class="btn btn-success small-btn">@lang('error.Back')</a> 
					</div>
				</div>
			</section>
			<!-- Tab section End -->		
@stop
