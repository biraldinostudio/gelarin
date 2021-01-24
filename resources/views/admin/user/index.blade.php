@extends('layouts.admin.app')
@section('content')
			<div id="page-wrapper">
				<div class="row page-titles">
					<div class="col-md-5 align-self-center">
						<h3 class="text-themecolor">Manajemen Member</h3>
					</div>
					<div class="col-md-7 align-self-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
							<li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
							<li class="breadcrumb-item active">Manage Member</li>
						</ol>
					</div>
				</div>
				<div class="container-fluid">
					<!-- /row -->
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="card">
							
								<div class="card-header">
									<div class="pull-right">
										<a href="add-freelancer.html" class="btn btn-info">Add Freelancer</a>
									</div>
									<input type="text" class="form-control wide-width" placeholder="Search & type" />
								</div>
								
								<div class="card-body">
									<ul class="list">
									@foreach($users as $user)
										<li class="manage-list-row clearfix">
											<div class="job-info">
												<div class="job-img">
													@if(empty($user->photo))
														<img src="{{asset('front/img/default/150x150.png')}}" class="attachment-thumbnail" alt="{{ str_limit(strip_tags(ucwords($user->name)), 20) }}"/>
													@else
														<img src="{{ asset('storage/uploads/member/photo/'.$user->photo) }}" class="attachment-thumbnail" alt="{{ str_limit(strip_tags(ucwords($user->name)), 20) }}"/>								
													@endif														
												</div>
												<div class="job-details">
													<h3 class="job-name"><a class="job_name_tag" href="#">{{ str_limit(strip_tags(ucwords($user->name)), 20) }}</a></h3>
													<small class="job-sallery"><i class="ti-email"></i>{{$user->email}}</small>
													<small class="job-sallery"><i class="ti-location-pin"></i>{{$user->city}},{{$user->province}},{{$user->country}}</small>
													{{--<small class="job-sallery"><i class="ti-credit-card"></i>$60/h</small>--}}
													@if($user->verified=='1')
														<div class="shortlisted-can">Verifikasi</div>
													@endif
													<p>
													<span class="j-type part-time">{{$user->created_at}}</span></p>														
													{{--<div class="candi-skill">
														<span class="skill-tag">css</span>
														<span class="skill-tag">HTML</span>
														<span class="skill-tag">Photoshop</span>
													</div>--}}
												</div>
											</div>
											<div class="job-buttons">
												<a href="#" class="btn btn-gary manage-btn" data-toggle="tooltip" data-placement="top" title="Download Resume"><i class="ti-download"></i></a>
												<a href="#SendMessage"  data-toggle="modal" class="btn btn-blue manage-btn" data-toggle="tooltip" data-placement="top" title="Message"><i class="ti-email"></i></a>												
												<a href="#" class="btn btn-cancel manage-btn" data-toggle="tooltip" data-placement="top" title="Remove"><i class="ti-close"></i></a>
											</div>
										</li>
									@endforeach	
									</ul>
									
									<div class="flexbox padd-10">
									@if(Route::is('admin.user.index'))
										{{$users->render()}}
									@endif
									@if(Route::is('admin.user.company'))
										{{$companies->render()}}
									@endif									
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>	
			</div>
			<!-- /#page-wrapper -->
@endsection	