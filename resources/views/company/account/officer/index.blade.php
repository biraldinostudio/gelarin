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
							<li><a href="{{route('account.edit')}}" class="kyt-font-green"><i class="fa fa-edit"></i></a></li>						
							<li>@lang('auth.My Account')</li>
							<li>
								<a href="{{route('settings.index')}}" class="kyt-font-green">@lang('auth.Settings')</a>																						
							</li>					
						</ol>
						</div>
					</div>
				</div>			
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
								<li><span>@lang('auth.Name')</span>: {{$users->name}} ({{$userdescriptions->nickname}})</li>
								<li><span>@lang('auth.Email')</span>: {{$users->email}}</li>
								<li><span>@lang('auth.Address')</span>: {{$userdescriptions->address}},{{$userdescriptions->postal_code}}</li>											
								<li><span>@lang('auth.City')</span>: @if(!empty($userdescriptions->city_id)) {{$userdescriptions->city->name}},{{$userdescriptions->city->subadmin1->name}} @else @endif</li>	
								<li><span>@lang('auth.Position')</span>: {{$companyOfficers->position}}</li>	
								<li><span>@lang('auth.Telephone')</span>: (+{{$phoneCodes}}){{$userdescriptions->phone}}</li>
								<li><span>@lang('auth.Gender')</span>: @if(!empty($genders)){{$genders->name}} @else @endif</li>						
								<li>
								@if(!empty($userdescriptions->photo))
									<img src="{{ asset('storage/uploads/member/photo/'.$userdescriptions->photo) }}" class="img" alt="" />							
								@else
									<img src="{{asset('front/img/default/photo.jpg') }}" width="40px" height="40px"/>								
								@endif	
								</li>
							</ul>
						</div>
					</article>
				</div>
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