@extends('layouts.app')	
@section('content')
			<!-- End Navigation -->
			<div class="clearfix"></div>
			<!-- Title Header Start -->
			<section class="inner-header-title">
				<div class="container">
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- Title Header End -->
			
			<!-- Job Detail Start -->
			<section class="detail-desc advance-detail-pr gray-bg">
				<div class="container white-shadow">
					<div class="row bottom-mrg mrg-0">
						<div class="col-md-12 col-sm-12">
							<div class="advance-detail detail-desc-caption">
								<ul>
									<li><strong class="j-view">742</strong>View Job</li>
									<li><strong class="j-applied">570</strong>Job Applied</li>
									<li><strong class="j-shared">210</strong>Job Shared</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- Job Detail End -->
			
			<!-- Job full detail Start -->
			<section class="full-detail-description full-detail gray-bg">
				<div class="container">
					<!-- Job Description -->
					<div class="col-md-9 col-sm-12">
						<div class="full-card">
							<div class="row row-bottom mrg-0">
								<form role="form" enctype="multipart/form-data" method="POST" action="{{ url('article/my_article') }}" role="search">
								@csrf
								<div class="filter-form">
									<div class="input-group">									
										<input type="text" name="keyword" class="form-control" placeholder="@lang('global.Keyword')" value="{{old('keyword')}}">
										<span class="input-group-btn">
											<input type="submit" class="btn btn-primary" value="Go">
										</span>
										
									</div>
								</div>
								</form>
								<h2 class="detail-title">Job Responsibilities</h2>
								
								<article>							
									<div class="mng-resume">
										<div class="col-md-2 col-sm-2">
											<div class="mng-resume-pic">
											<a href="#" target="_blank">
												<img src="#" class="img-responsive" alt="#" /></a>
											</div>
										</div>
										<div class="col-md-8 col-sm-8">
											<div class="mng-resume-name">
												<h4><a href="#" target="_blank">#</a> <span class="cand-designation">(#x dilihat)</span></h4>
												<span class="cand-status">#</span> <span style="color:#11b719;">#</span>
											</div>
										</div>
										<div class="col-md-2 col-sm-2">
											<div class="mng-resume-action">
												<a href="#" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
												<a href="#" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></a>
											</div>
										</div>
									</div>
								</article>								
								
								
								
							</div>
						</div>
						<div class="row">
						Panging
						</div>							
					</div>
					<!-- End Job Description -->
					
					<!-- Start Sidebar -->
					<div class="col-md-3 col-sm-12">
						<div class="sidebar right-sidebar">
							<div class="side-widget">
								<h2 class="side-widget-title">Compensation</h2>
								<div class="widget-text padd-0">
									<ul>
										<li>
											<a href="{{route('my_article')}}">xxxxx</a>
											<span class="pull-right">xx</span>
										</li>
									</ul>
								</div>
							</div>
							
							<div class="side-widget">
								<h2 class="side-widget-title">Advertisment</h2>
								<div class="widget-text padd-0">
									<div class="ad-banner">
										<img src="http://via.placeholder.com/320x285" class="img-responsive" alt="">
									</div>
								</div>
							</div>
							
						</div>
					</div>
					<!-- End Sidebar -->
				</div>
			</section>
			<!-- Job full detail End -->
@endsection
@push('styles')

@endpush
@push('scripts')

@endpush			
	
