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
					<form role="form" name="yo" files="true"  enctype="multipart/form-data" method="GET" action="{{route('account.staff.list')}}" role="search">
					@csrf
					<div class="row mrg-0">		
						<div class="col-md-7 col-sm-7">
							<input type="text" id="keyword" name="keyword" class="form-control" value="{{old('keyword')}}" placeholder="@lang('global.Input keyword')...">
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
							<?php
								if ($_SERVER['REQUEST_METHOD'] === 'GET') {
									if (isset($_GET['search'])) {
										?>
										<button type="submit" class="btn btn-primary" id="refresh" name="refresh"><i class="fa fa-refresh"></i></button>
										<?php
									} else {
										?>
										<button type="submit" class="btn btn-primary" id="search" name="search"><i class="fa fa-search"></i></button>
										<?php
									}
								}
								else{
									?>
									<button type="submit" class="btn btn-primary" id="search" name="search"><i class="fa fa-search"></i></button>
									<?php
								}
								?>
						</div>									
						<div class="col-md-4 col-sm-4">
							<ol class="breadcrumb pull-right">
								<li><a href="{{route('company.dashboard')}}"><i class="fa fa-home"></i></a></li>
								@if(Route::is('account.staff.list'))							
								<li><a href="{{route('account.staff.create')}}"><i class="fa fa-plus"></i></a></li>							
								<li>@lang('global.Staff')</li>
								<li><a href="{{route('account.staff.trash')}}"><i class="fa fa-trash"></i> ({{$countStaffTrash}})</a></li>								
								@endif
								@if(Route::is('account.staff.trash'))
								<li><i class="fa fa-trash"></i> ({{$countStaffTrash}})</li>								
								<li><a href="{{route('account.staff.list')}}" class="kyt-font-green" title="@lang('global.Back')"><i class="fa fa-arrow-left"></i></a></li>
								@endif							
							</ol>
						</div>
					</div>
					</form>
				</div>			
				<div class="card-body">
					@if(count($companyOfficers)>0)
						@foreach($companyOfficers as $staff)
							<article class="advance-search-job">
								<div class="row no-mrg">
									<div class="col-md-10 col-sm-10">
										<a href="#" title="{{ str_limit(strip_tags(ucwords($staff->nama)), 35) }}">
											<div class="advance-search-img-box">
											@if($staff->photo!='')
												<img src="{{ asset('storage/uploads/member/photo/'.$staff->photo) }}" class="img-responsive" alt="{{ str_limit(strip_tags(ucwords($staff->nama)), 35) }}" />
											@else
												<img src="{{asset('front/img/default/photo.jpg')}}" class="img-responsive" alt="" />
											@endif	
											</div>
										</a>								
										<div class="advance-search-caption">
											<h4>{{ str_limit(strip_tags(ucwords($staff->name)), 35) }}</h4>
											<span><i class="fa fa-envelope"></i> {{$staff->email}}</span>
											<small> 
												( @if($staff->active==1)
													@lang('global.Active')
												@else
													@lang('global.Inactive')
												@endif )
											</small>
											<p style="font-size:12px;">											
												@if($staff->vacancy_access=='1')
													@lang('global.Job Access'),												
												@endif													
												@if($staff->vacancy_posting=='1')
													@lang('global.Job Posting'),												
												@endif
												@if($staff->talent_search=='1')
													@lang('global.Talent Search')												
												@endif													
												@if($staff->user_management=='1')
													@lang('global.User Management'),
												@endif
												@if($staff->credit_management=='1')
													@lang('global.Credit Management'),											
												@endif
												@if($staff->receive_candidate_email=='1')
													@lang('global.Receive Candidate Email')												
												@endif
											</p>
										</div>
									</div>
									<div class="col-md-2 col-sm-2">
										<div class="mng-resume-action">
											<a href="{{ route('account.staff.edit',$staff->id) }}" data-toggle="tooltip" title="@lang('global.Change')"><i class="fa fa-edit" style="color:green;font-size:20px;"></i></a>&nbsp;
											@if($staff->active=='1')				
												<a href="{{ route('account.staff.cancel',$staff->id) }}" data-toggle="tooltip" title="@lang('global.Inactive')"><i class="fa fa-remove" style="color:orange;font-size:20px;"></i></a>									
											@endif											
										</div>
									</div>
								</div>
							</article>
						@endforeach
					@else
							<article class="advance-search-job">
								<div class="row no-mrg">
									<div class="col-md-10 col-sm-10">
										<div class="advance-search-caption">
											<h4>@lang('global.Sorry') ,</h4>
											<span>@lang('global.Empty jobs').</span>												
										</div>
									</div>
								</div>
							</article>					
					@endif						
				</div>
			</div>			
			<div class="row">
				{{$companyOfficers->render()}}
			</div>			
			<!-- Ad banner -->
			<!--
			<div class="row">
				<div class="ad-banner">
					<img src="http://via.placeholder.com/728x90" class="img-responsive" alt="">
				</div>
			</div>
			-->
		</div>
		<!-- Sidebar Start -->
		@section('sidebar')
			@include('layouts.company.inc.sidebar')
		@show
	<!-- Sidebar End -->	
	</div>
</section>	
@endsection	
		