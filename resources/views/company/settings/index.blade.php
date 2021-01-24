@extends('layouts.company.app')
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
<!-- Title Header End -->
			
<!-- ========== Begin: Brows job Category ===============  -->
<section class="brows-job-category gray-bg">
	<div class="container">
	<div class="col-md-9 col-sm-12">
		<div class="full-card">		
			<div class="card-header">
				<div class="row mrg-0">		
					<div class="col-md-7 col-sm-7">
					
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
					<div class="col-md-12 col-sm-5">
					 <ol class="breadcrumb pull-right">
						<li><a href="{{route('company.dashboard')}}" class="kyt-font-green"><i class="fa fa-home"></i></a></li>
						<li><a href="{{route('settings.edit',$crypto->encodeHex(auth()->user()->companyofficer->company->id))}}" class="kyt-font-green"><i class="fa fa-edit"></i></a></li>
						<li>@lang('auth.Settings')</li>	
						<li>
							<a href="{{route('settings.address.index')}}" class="kyt-font-green">@lang('auth.Address')</a>																						
						</li>
						<li>
							<a href="{{route('settings.legal.index')}}" class="kyt-font-green">@lang('auth.Legal')</a>																						
						</li>					
					</ol>
					</div>
				</div>
			</div>

			@if(session()->has('blocks'))	
				<div class="container-detail-box">
					<span><label class="enternship pull-left breadcrumb">{{session()->get('blocks')}}</label></span>
					<div class="col-md-7 col-sm-7">
						<div class="apply-job-detail">
							<ul class="job-requirements">
								@if(auth()->user()->companyofficer->company->working_time_id=='' or auth()->user()->companyofficer->company->working_uniform_id=='' 
									or auth()->user()->companyofficer->company->email1=='' or auth()->user()->companyofficer->company->phone1==''
									or auth()->user()->companyofficer->company->logo=='' or auth()->user()->companyofficer->company->size==''
									)
									<li><a href="{{route('settings.edit',$crypto->encodeHex(auth()->user()->companyofficer->company->id))}}" target="_blank"><i class="fa fa-gear"></i> {{__('setting.Company Identity')}}</a></li>			
								@endif
								@if(empty($companyAddresses))
									<li><a href="{{route('settings.address.index')}}" target="_blank"><i class="fa fa-map-marker"></i> {{__('setting.Company\'s Address')}}</a></li>										
								@endif
								@if(empty($companyLegals))
									<li><a href="{{route('settings.legal.index')}}" target="_blank"><i class="fa fa-legal"></i> {{__('setting.The legality of the Company')}} ({{__('setting.Example')}} {{__('setting.Business license')}})</a></li>										
								@endif								
							</ul>
						</div>
					</div>
				</div>
			@else
			<div class="card-body">
				<article class="advance-search-job">
					@if(session()->has('message'))
						<div class="row no-mrg kyt-font-green">
							<div class="col-md-8 col-sm-8">
								<i class="fa fa-check"></i> {{ session()->get('message') }} 
							</div>
						</div>	
						<br>
					@endif	
					<div class="row no-mrg">
					<ul class="job-detail-des kyt-text-align-left">
						<li><span>@lang('auth.Name')</span>: {{$companies->name}} ({{$companies->code}})</li>
						<li><span>@lang('auth.Email')</span>: {{$companies->email1}} / {{$companies->email2}}</li>
						<li><span>@lang('auth.Telephone')</span>: @if(!empty($companies->phone1))+{{$phoneCodes}}-{{$companies->phone1}} @endif / @if(!empty($companies->phone2))+{{$phoneCodes}}-{{$companies->phone2}} @endif</li>
						<li><span>@lang('auth.Fax')</span>: @if(!empty($companies->fax1))+{{$phoneCodes}}-{{$companies->fax1}} @endif / @if(!empty($companies->fax2))+{{$phoneCodes}}-{{$companies->fax2}}@endif</li>
						<li><span>@lang('auth.Number of Employees')</span>: {{$companies->size}}</li>											
						<li><span>@lang('auth.Working Uniform')</span>: @if(!empty($companyUniforms)){{$companyUniforms->name}} @else @endif</li>	
						<li><span>@lang('auth.Working Time')</span>: @if(!empty($companyTimes)){{$companyTimes->name}} @else @endif</li>	
						<li><span>@lang('auth.Industry Sector')</span>: @if(!empty($industries)){{str_replace($removeWords,'',$industries->industry)}} @else @endif</li>										
						<li>{!!$companies->description!!}</li>
					</ul>
					</div>
				</article>
			</div>@endif
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