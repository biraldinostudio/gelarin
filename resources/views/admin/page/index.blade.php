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
								<a href="{{route('admin.page.active')}}">
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
										<select class="form-control">
											<option>Short By</option>
											<option>Premium Job</option>
											<option>Ascending</option>
											<option>Descending</option>
											<option>Most Popular</option>
										</select>
									</div>
									<input type="text" class="form-control wide-width" placeholder="Search & type" />							
								</div>
								
								<div class="card-body">
									<ul class="list">
									@foreach($pages as $vacancy)
										<li class="manage-list-row clearfix">
											<div class="job-info">
												<div class="job-details">
													<h3 class="job-name">Halaman {{ str_limit(strip_tags(ucwords($vacancy->title)), 25) }}</h3>
													<small class="job-company">{{ str_limit(strip_tags(ucwords($vacancy->description)), 50) }}</small>
													<small class="job-update"><i class="ti-file"></i>Posisi: @if($vacancy->position=='nav') Bagian Navigator @elseif($vacancy->position=='footer') Bagian Footer @elseif($vacancy->position=='lsidebar') Bagian Kiri @elseif($vacancy->position=='rsidebar') Bagian Kanan @endif</small>
												</div>
											</div>
											<div class="job-buttons">
												<a href="{{route('admin.page.edit',$vacancy->id)}}" class="btn btn-gary manage-btn" data-toggle="tooltip" data-placement="top" title="Edit"><i class="ti-pencil-alt"></i></a> 
											</div>
										</li>
									@endforeach	
									</ul>
									
									<div class="flexbox padd-10">
									{{$pages->render()}}
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