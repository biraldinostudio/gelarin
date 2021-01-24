@extends('layouts.admin.app')
@section('content')
			<!-- /#page-wrapper -->
			<div id="page-wrapper">
				<div class="row page-titles">
					<div class="col-md-5 align-self-center">
						<h3 class="text-themecolor">Manajemen Halaman</h3>
					</div>
					<div class="col-md-7 align-self-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="javascript:void(0)">Beranda</a></li>
							<li class="breadcrumb-item">
								<a href="{{route('admin.faq.active')}}">
									Menejemen Halaman
								</a>
							</li>
							<li class="breadcrumb-item active">
								@if(Route::is('admin.page.active'))Halaman Aktif @else Halaman Non Aktif @endif					
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
										<a href="{{route('admin.faq.create')}}" class="btn btn-info">Tambah FAQ</a>
									</div>
									<input type="text" class="form-control wide-width" placeholder="Search & type" />
								</div>
								
								<div class="card-body">
									<ul class="list">
									@foreach($faqs as $faq)
										<li class="manage-list-row clearfix">
											<div class="job-info">
												<div class="job-details">
													<h3 class="job-name">{{ str_limit(strip_tags(ucwords($faq->title)), 25) }}</h3>
													<small class="job-company">{{$faq->type}}</small>
													@if($faq->active=='1')
														<div class="shortlisted-can">Aktif</div>
													@endif
												</div>
											</div>
											<div class="job-buttons">
												<a href="{{route('admin.faq.edit',$faq->id)}}" class="btn btn-gary manage-btn" data-toggle="tooltip" data-placement="top" title="Edit"><i class="ti-pencil-alt"></i></a> 
											</div>
										</li>
									@endforeach	
									</ul>
									
									<div class="flexbox padd-10">
									{{$faqs->render()}}
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