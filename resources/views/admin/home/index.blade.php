@extends('layouts.admin.app')
@section('content')
			<div id="page-wrapper">
				<div class="row page-titles">
					<div class="col-md-5 align-self-center">
						<h3 class="text-themecolor">Home</h3>
					</div>
					<div class="col-md-7 align-self-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item active">Dashboard</li>
						</ol>
					</div>
				</div>
				<div class="container-fluid">
				
					<!-- /row -->
					<div class="row">
						<div class="col-md-3 col-sm-6">
							<div class="widget standard-widget">
								<div class="row">
									<div class="widget-caption info">
										<div class="col-xs-4 no-pad">
											<i class="icon icon-briefcase"></i>
										</div>
										<div class="col-xs-8 no-pad">
											<div class="widget-detail">
											<a href="{{route('admin.vacancies.index')}}">
												<h3>{{$vacUnReviewed}}</h3>
												<span>Belum Direview</span></a>
											</div>
										</div>
										<div class="col-xs-12">
											<div class="widget-line bg-info">
												<span style="width:72%;" class="bg-info widget-horigental-line"></span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-3 col-sm-6">
							<div class="widget standard-widget">
								<div class="row">
									<div class="widget-caption danger">
										<div class="col-xs-4 no-pad">
											<i class="icon icon-happy"></i>
										</div>
										<div class="col-xs-8 no-pad">
											<div class="widget-detail">
											<a href="{{route('admin.vacancies.reviewed')}}">
												<h3>{{$vacReviewed}}</h3>
												<span>Lowongan Aktif</span></a>
											</div>
										</div>
										<div class="col-xs-12">
											<div class="widget-line bg-danger">
												<span style="width:65%;" class="bg-danger widget-horigental-line"></span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-3 col-sm-6">
							<div class="widget standard-widget">
								<div class="row">
									<div class="widget-caption success">
										<div class="col-xs-4 no-pad">
											<i class="icon icon-tools"></i>
										</div>
										<div class="col-xs-8 no-pad">
											<div class="widget-detail">
												<a href="{{route('admin.company.index')}}">
													<h3>{{$companies}}</h3>
													<span>Perusahaan</span>
												</a>
											</div>
										</div>
										<div class="col-xs-12">
											<div class="widget-line bg-sucess">
												<span style="width:55%;" class="bg-success widget-horigental-line"></span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-3 col-sm-6">
							<div class="widget standard-widget">
								<div class="row">
									<div class="widget-caption warning">
										<div class="col-xs-4 no-pad">
											<i class="icon icon-trophy"></i>
										</div>
										<div class="col-xs-8 no-pad">
											<div class="widget-detail">
												<a href="{{route('admin.user.index')}}">											
												<h3>{{$users}}</h3>
												<span>Member</span>
												</a>
											</div>
										</div>
										<div class="col-xs-12">
											<div class="widget-line bg-warning">
												<span style="width:70%;" class="bg-warning widget-horigental-line"></span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<!-- row -->
					<div class="row">
					
						<!-- Area Chart -->
						<div class="col-md-8 col-sm-12">
							<div class="card">
								<div class="card-header">
									<div class="pull-right">
										<div class="btn-group">
											<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
												<i class="ti-more"></i>
											</button>
											<ul class="dropdown-menu pull-right animated flipInX">
												<li><a href="#">This Month</a></li>
												<li><a href="#">Last Month</a></li>
												<li><a href="#">From 6 Month</a></li>
											</ul>
										</div>
									</div>
									<h4 class="mb-0">Your Profile Views</h4>
								</div>
								<div class="card-body">
									<ul class="list-inline text-center m-t-40">
										<li>
											<h5><i class="fa fa-circle m-r-5 cl-purple"></i> Lamaran Kerja</h5>
										</li>
										<li>
											<h5><i class="fa fa-circle m-r-5 cl-inverse"></i> Pekerjaan</h5>
										</li>
										<li>
											<h5><i class="fa fa-circle m-r-5 cl-success"></i> Member</h5>
										</li>
									</ul>
									<div class="chart" id="profile-view" style="height: 300px;"></div>
								</div>
							</div>
						</div>
						
						<!-- Donut Chart -->
						<div class="col-md-4 col-sm-12">
							<div class="card">
								<div class="card-header">
									<h4 class="mb-0">View</h4>
								</div>
								<div class="card-body">
									<ul class="list-inline text-center m-t-40">
										<li>
											<h5><i class="fa fa-circle m-r-5 cl-inverse"></i> {{$vacReviewed}} lowongan</h5>
										</li>
										<li>
											<h5><i class="fa fa-circle m-r-5 cl-purple"></i> {{$companies}} perusahaan</h5>
										</li>
										<li>
											<h5><i class="fa fa-circle m-r-5 cl-success"></i> {{$users}} orang</h5>
										</li>
									</ul>
									<div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
								</div>
							</div>	
						</div>
						
					</div>
					<!-- /.row -->
					
					<!-- Row -->
					<div class="row">
						<div class="col-md-3 col-sm-6">
							<div class="social social-box">
								<div class="social-slick-4 facebook-box">
									<i class="fa fa-facebook"></i>
									<h3>1240</h3>
									<span>Facebook Shares</span>
								</div>
							</div>
						</div>
						
						<div class="col-md-3 col-sm-6">
							<div class="social social-box">
								<div class="social-slick-4 google-plus-box">
									<i class="fa fa-google-plus"></i>
									<h3>1872</h3>
									<span>G Plus Shares</span>
								</div>
							</div>
						</div>
						
						<div class="col-md-3 col-sm-6">
							<div class="social social-box">
								<div class="social-slick-4 twitter-box">
									<i class="fa fa-twitter"></i>
									<h3>1750</h3>
									<span>Twitter Shares</span>
								</div>
							</div>
						</div>
						
						<div class="col-md-3 col-sm-6">
							<div class="social social-box">
								<div class="social-slick-4 instagram-box">
									<i class="fa fa-instagram"></i>
									<h3>2187</h3>
									<span>Instagra Followers</span>
								</div>
							</div>
						</div>
					</div>
					
					<!-- Row -->
					<div class="row">
						<!-- col-md-6 -->
						<div class="col-md-6">
							<div class="card">
							
								<div class="card-header">
									<h4>Popular Freelancer</h4>
								</div>
								
								<div class="card-body">
									<div class="todo-list todo-list-hover todo-list-divided">
										<div class="todo todo-default">
											<div class="sm-avater list-avater">
												<img src="{{asset('admin/img/user-1.jpg')}}" class="img-responsive img-circle" alt="" />
												<span class="user-status bage-warning"></span>
											</div>
											<h5 class="ct-title">Michel Chark<span class="ct-designation">UI/UX Designer</span></h5>
											<div class="badge badge-action">
												<a href="#" class="btn btn-user btn-default btn-round btn-outline">Hire</a>
											</div>
										</div>
										<div class="todo todo-default">
											<div class="sm-avater list-avater">
												<img src="{{asset('admin/img/user-2.jpg')}}" class="img-responsive img-circle" alt="" />
												<span class="user-status bage-status"></span>
											</div>
											<h5 class="ct-title">Michel Chark<span class="ct-designation">SEO Expert</span></h5>
											<div class="badge badge-action">
												<a href="#" class="btn btn-user btn-round btn-success">Hired</a>
											</div>
										</div>
										<div class="todo todo-default">
											<div class="sm-avater list-avater">
												<img src="{{asset('admin/img/user-3.jpg')}}" class="img-responsive img-circle" alt="" />
												<span class="user-status bage-danger"></span>
											</div>
											<h5 class="ct-title">Michel Chark<span class="ct-designation">PHP Expert</span></h5>
											<div class="badge badge-action">
												<a href="#" class="btn btn-user btn-round btn-success">Hired</a>
											</div>
										</div>
										<div class="todo todo-default">
											<div class="sm-avater list-avater">
												<img src="{{asset('admin/img/user-4.jpg')}}" class="img-responsive img-circle" alt="" />
												<span class="user-status bage-success"></span>
											</div>
											<h5 class="ct-title">Michel Chark<span class="ct-designation">App Designer</span></h5>
											<div class="badge badge-action">
												<a href="#" class="btn btn-user btn-default btn-round btn-outline">Hire</a>
											</div>
										</div>
										<div class="todo todo-default">
											<div class="sm-avater list-avater">
												<img src="{{asset('admin/img/user-5.jpg')}}" class="img-responsive img-circle" alt="" />
												<span class="user-status bage-warning"></span>
											</div>
											<h5 class="ct-title">Michel Chark<span class="ct-designation">Web Developer</span></h5>
											<div class="badge badge-action">
												<a href="#" class="btn btn-user btn-round btn-success">Hired</a>
											</div>
										</div>
									</div>	
								</div>
							</div>
						</div>
						<!-- /col-md-6 -->
						
						<!-- col-md-6 -->
						<div class="col-md-6">
							<div class="card">
							
								<div class="card-header">
									<h4>New Notification</h4>
								</div>
								
								<div class="card-body">
									<ul class="task">
										<li>
											<a href="#">
												<div class="task-overview">
													<div class="alpha-box alpha-a">
														<span>A</span>
													</div>
													<div class="task-detail">
														<p>Hello, I am Maryam.</p>
														<span class="task-time">2 Min Ago</span>
													</div>
												</div>
											</a>
										</li>
										<li>
											<a href="#">
												<div class="task-overview">
													<div class="alpha-box alpha-h">
														<span>H</span>
													</div>
													<div class="task-detail">
														<p>Hello, I am Maryam.</p>
														<span class="task-time">2 Min Ago</span>
													</div>
												</div>
											</a>
										</li>
										<li>
											<a href="#">
												<div class="task-overview">
													<div class="alpha-box alpha-d">
														<span>D</span>
													</div>
													<div class="task-detail">
														<p>Hello, I am Maryam.</p>
														<span class="task-time">2 Min Ago</span>
													</div>
												</div>	
											</a>
										</li>
										<li>
											<a href="#">
												<div class="task-overview">
													<div class="alpha-box alpha-g">
														<span>G</span>
													</div>
													<div class="task-detail">
														<p>Hello, I am Maryam.</p>
														<span class="task-time">2 Min Ago</span>
													</div>
												</div>
											</a>
										</li>
										<li>
											<a href="#">
												<div class="task-overview">
													<div class="alpha-box alpha-h">
														<span>H</span>
													</div>
													<div class="task-detail">
														<p>Hello, I am Maryam.</p>
														<span class="task-time">2 Min Ago</span>
													</div>
												</div>
											</a>
										</li>
									</ul>	
								</div>
							
							</div>
						</div>
						<!-- /col-md-6 -->
					</div>
					
				</div>	
			</div>
			<!-- /#page-wrapper -->
@endsection
@push('scripts')
<script>
   // Extra chart
	 Morris.Area({
		element: 'profile-view',
		data: [{
					period: '2010',
					iphone: 0,
					ipad: 0,
					itouch: 0
				}, {
					period: '2011',
					iphone: 50,
					ipad: 15,
					itouch: 5
				}, {
					period: '2012',
					iphone: 20,
					ipad: 50,
					itouch: 65
				}, {
					period: '2013',
					iphone: 60,
					ipad: 12,
					itouch: 7
				}, {
					period: '2014',
					iphone: 30,
					ipad: 20,
					itouch: 120
				}, {
					period: '2015',
					iphone: 25,
					ipad: 80,
					itouch: 40
				}, {
					period: '2016',
					iphone: 10,
					ipad: 10,
					itouch: 10
				}


				],
				lineColors: ['#1dc130', '#2f3d4a', '#009efb'],
				xkey: 'period',
				ykeys: ['iphone', 'ipad', 'itouch'],
				labels: ['Member', 'Pekerjaan', 'Lamar Kerja'],
				pointSize: 0,
				lineWidth: 0,
				resize:true,
				fillOpacity: 0.8,
				behaveLikeLine: true,
				gridLineColor: '#e0e0e0',
				hideHover: 'auto'
			
		});


    var donut = new Morris.Donut({
      element: 'sales-chart',
      resize: true,
      colors: ["#2f3d4a", "#1dc130", "#d180fb"],
      data: [
        {label: "Perusahaan", value: {{$companies}}},
        {label: "Member", value: {{$users}}},
        {label: "Pekerjaan", value: {{$vacReviewed}}}
      ],
      hideHover: 'auto'
    });
	</script>
@endpush	