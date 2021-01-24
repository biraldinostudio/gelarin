@extends('layouts.admin.app')
@section('content')
			<!-- /#page-wrapper -->
			<div id="page-wrapper">
				<div class="row page-titles">
					<div class="col-md-5 align-self-center">
						<h3 class="text-themecolor">Manajemen Perusahaan</h3>
					</div>
					<div class="col-md-7 align-self-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="javascript:void(0)">Beranda</a></li>
							<li class="breadcrumb-item active">Manajemen Perusahaan</li>
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
										<a href="{{route('admin.company.create')}}" class="btn btn-info">Tambah Perusahaan</a>
									</div>
									<input type="text" class="form-control wide-width" placeholder="Search & type" />
								</div>
								
								<div class="card-body">
									<ul class="list">
										@foreach($companies as $company)
										<li class="manage-list-row clearfix">
											<div class="job-info">
												<div class="job-img">
													@if(empty($company->logo))
														<img src="{{asset('front/img/default/150x150.png')}}" class="attachment-thumbnail" alt="{{ str_limit(strip_tags(ucwords($company->name)), 20) }}"/>
													@else
														<img src="{{ asset('storage/uploads/company/logo/'.$company->logo) }}" class="attachment-thumbnail" alt="{{ str_limit(strip_tags(ucwords($company->name)), 20) }}"/>								
													@endif														
												</div>
												<div class="job-details">
													<h3 class="c-name"><a class="job_name_tag" href="#">{{ str_limit(strip_tags(ucwords($company->name)), 50) }}</a></h3>
													<small class="c-place"><i class="ti-location-pin"></i>{{$company->city}},{{$company->province}},{{$company->country}}</small>
													<small class="c-employee"><i class="ti-user"></i>{{$company->size}}</small>
													<small class="c-est"><i class="ti-email"></i>{{$company->email1}}</small>
													<small class="c-est"><i class="fa fa-phone"></i>{{$company->phone1}}</small>
													<span class="j-type part-time">{{$company->created_at}}</span>													
													@if($company->partner=='1')<span class="j-type full-time">Partner</span>@endif
												</div>
											</div>
											<div class="job-buttons">
												<a href="#" class="btn btn-gary manage-btn" data-toggle="tooltip" data-placement="top" title="Edit"><i class="ti-pencil-alt"></i></a> 
												<a href="#" class="btn btn-cancel manage-btn" data-toggle="tooltip" data-placement="top" title="Remove"><i class="ti-close"></i></a>
											</div>
										</li>
										@endforeach

									
									</ul>
									
									<div class="flexbox padd-10">
									{{$companies->render()}}
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