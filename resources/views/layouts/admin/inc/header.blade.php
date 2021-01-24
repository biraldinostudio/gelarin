				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="{{route('admin.home')}}"><img src="{{asset('admin/img/logo/logo-white.png')}}" class="img-responsive" alt="Logo"></a>
				</div>
				<!-- /.navbar-header -->
				
				<ul class="nav navbar-top-links navbar-left header-search-form hidden-xs">
					<li><a class="menu-brand" id="menu-toggle"><span class="ti-view-grid"></span></a></li>

				</ul>
				<ul class="nav navbar-top-links navbar-right">
					<li class="dropdown">
						<a class="dropdown-toggle notification-show" data-toggle="dropdown" href="#">
							<i class="ti-email"></i>
							<span class="email-notify noti-count">4</span>
						</a>
						<ul class="dropdown-menu dropdown-messages right-swip">
							<li class="external">
								<h3><span class="bold">All Messages</span></h3>
								<span class="notification-label bg-success">New 6</span>
							</li>
							<li>
								<a href="messages.html">
									<div class="message-apt">
										<div class="user-img">
											<img src="{{asset('admin/img/user-1.jpg')}}" class="img-responsive img-circle" alt="">
											<span class="profile-status online"></span>
										</div>
										<div class="message-body">
											<strong>John Smith</strong>
											<span class="pull-right text-muted">
												Just Now
											</span>
											<p>I am John Smith Ckeck My...</p>
										</div>
									</div>
								</a>
							</li>
							<li>
								<a href="messages.html">
									<div class="message-apt">
										<div class="user-img">
											<img src="{{asset('admin/img/user-2.jpg')}}" class="img-responsive img-circle" alt="">
											<span class="profile-status warning"></span>
										</div>
										<div class="message-body">
											<strong>Daniel Luke</strong>
											<span class="pull-right text-muted">
												2 Min Ago
											</span>
											<p>Can You Send Me your Bugdet...</p>
										</div>
									</div>
								</a>
							</li>
							<li>
								<a href="messages.html">
									<div class="message-apt">
										<div class="user-img">
											<img src="{{asset('admin/img/user-3.jpg')}}" class="img-responsive img-circle" alt="">
											<span class="profile-status busy"></span>
										</div>
										<div class="message-body">
											<strong>Litha Lilly</strong>
											<span class="pull-right text-muted">
												7 Min Ago
											</span>
											<p>I have Check Your Design Like...</p>
										</div>
									</div>
								</a>
							</li>
							 <li>
								<a href="messages.html">
									<div class="message-apt">
										<div class="user-img">
											<img src="{{asset('admin/img/user-4.jpg')}}" class="img-responsive img-circle" alt="">
											<span class="profile-status offline"></span>
										</div>
										<div class="message-body">
											<strong>Adam Kruel</strong>
											<span class="pull-right text-muted">
												1 Hour Ago
											</span>
											<p>Heelo! I need best web design...</p>
										</div>
									</div>
								</a>
							</li>
							<li>
								<a class="text-center" href="#">
									<strong>Read All Messages</strong>
									<i class="fa fa-angle-right"></i>
								</a>
							</li>
						</ul>
						<!-- /.dropdown-messages -->
					</li>
					<!-- /.dropdown -->
					<li class="dropdown">
						<a class="dropdown-toggle notification-show" data-toggle="dropdown" href="#">
							<i class="ti-bell"></i>
							<span class="task-notify noti-count">7</span>
						</a>
						<ul class="task dropdown-menu dropdown-tasks right-swip">
							<li class="external">
								<h3><span class="bold">Show Notifications</span></h3>
								<span class="notification-label bg-success">New 4</span>
							</li>
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
							<li>
								<a class="text-center" href="#">
									<strong>See All Tasks</strong>
									<i class="fa fa-angle-right"></i>
								</a>
							</li>
						</ul>
						<!-- /.dropdown-tasks -->
					</li>
					<!-- /.dropdown -->
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="ti-announcement"></i>
						</a>
						<div class="dropdown-menu dropdown-grid animated flipInX">
							<a href="index.html" class="dropdown-item">
								<img src="{{asset('admin/img/dashboard.png')}}" class="img-responsive" alt="" />
								<span class="dropdown-title">Dashboard</span>
							</a>
							<a href="messages.html" class="dropdown-item">
								<img src="{{asset('admin/img/chat.png')}}" class="img-responsive" alt="" />
								<span class="dropdown-title">Chat</span>
							</a>
							<a href="settings.html" class="dropdown-item">
								<img src="{{asset('admin/img/settings.png')}}" class="img-responsive" alt="" />
								<span class="dropdown-title">Settings</span>
							</a>
							<a href="create-jobs.html" class="dropdown-item">
								<img src="{{asset('admin/img/add-job.png')}}" class="img-responsive" alt="" />
								<span class="dropdown-title">New Jobs</span>
							</a>
							<a href="freelancers.html" class="dropdown-item">
								<img src="{{asset('admin/img/freelancers.png')}}" class="img-responsive" alt="" />
								<span class="dropdown-title">Freelancers</span>
							</a>
							<a href="my-profile.html" class="dropdown-item">
								<img src="{{asset('admin/img/profile.png')}}" class="img-responsive" alt="" />
								<span class="dropdown-title">Profile</span>
							</a>
						</div>
						<!-- /.dropdown-alerts -->
					</li>
					<!-- /.dropdown -->
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<img src="{{asset('admin/img/user-1.jpg')}}" class="img-responsive img-circle" alt="user">
						</a>
						<ul class="dropdown-menu dropdown-user right-swip">
							<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
							</li>
							<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
							</li>
							<li><a href="{{url('backstart/logout')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
							</li>
							
						</ul>
						<!-- /.dropdown-user -->
					</li>
					<li><a id="right-sidebar-toggle" href="#" class="btn btn-lg toggle"><i class="spin ti-settings"></i></a></li>

					<!-- /.dropdown -->
				</ul>
				<!-- /.navbar-top-links -->