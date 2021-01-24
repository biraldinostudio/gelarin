@extends('layouts.admin.app')
@section('content')
			<!-- /#page-wrapper -->
			<div id="page-wrapper">
				<div class="row page-titles">
					<div class="col-md-5 align-self-center">
						<h3 class="text-themecolor">Manajemen Pekerjaan</h3>
					</div>
					<div class="col-md-7 align-self-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
							<li class="breadcrumb-item">
								<a href="{{route('admin.vacancies.index')}}">
									Menejemen Pekerjaan
								</a>
							</li>
							<li class="breadcrumb-item active">
								@if(Route::is('admin.vacancies.index'))Belum direview
								@elseif(Route::is('admin.vacancies.reviewed'))Sudah direview
								@elseif(Route::is('admin.vacancies.inactived'))Sudah nonaktif	
								@elseif(Route::is('admin.vacancies.expired'))Sudah expire
								@elseif(Route::is('admin.vacancies.trash'))Sudah dihapus
								@endif								
							</li>
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
										<a href="{{route('admin.vacancies.create')}}" class="btn btn-info">Tambah Pekerjaan</a>
									</div>
									<input type="text" class="form-control wide-width" placeholder="Search & type" />							
								</div>
								
								<div class="card-body">
									<ul class="list">
									@foreach($vacancies as $vacancy)
										<li class="manage-list-row clearfix">
											<div class="job-info @if($vacancy->partner=='1')premium-job @else @endif">
												<div class="job-img">
													@if(empty($vacancy->logo))
														<img src="{{asset('front/img/default/150x150.png')}}" class="attachment-thumbnail" alt="" />
													@else
														<img src="{{ asset('storage/uploads/company/logo/'.$vacancy->logo) }}" class="attachment-thumbnail" alt="{{$vacancy->company}}"/>								
													@endif														
												</div>
												<div class="job-details">
													<h3 class="job-name">{{ str_limit(strip_tags(ucwords($vacancy->title)), 25) }} @if($vacancy->reviewed=='1')<i class="fa fa-check-circle fa-lg kyt-check-green"></i>@endif</h3>
													<small class="job-company"><i class="ti-home"></i>{{ str_limit(strip_tags(ucwords($vacancy->company)), 25) }}</small>
													<small class="job-sallery"><i class="fa fa-money"></i>{{$vacancy->currency}} {{ number_format($vacancy->min_salary, 0, ',', '.') }} - {{$vacancy->currency}} {{ number_format($vacancy->max_salary, 0, ',', '.') }}</small>
													<small class="job-update"><i class="ti-time"></i>Expired: {{date($vacancy->date_format, strtotime($vacancy->closing_date))}}</small>
													<span class="j-type @if($vacancy->type_id=='1')full-time @elseif($vacancy->type_id=='2') part-time @elseif($vacancy->type_id=='3') internship @elseif($vacancy->type_id=='4') freelancer @else part-time @endif">{{$vacancy->type_name}}</span>
													
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
									{{$vacancies->render()}}
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