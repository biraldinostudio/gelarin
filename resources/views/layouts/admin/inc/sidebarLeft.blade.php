				<!-- Sidebar Navigation -->
				<div class="navbar-default sidebar" role="navigation">
					<div class="sidebar-nav navbar-collapse">
						<ul class="nav" id="side-menu">
						
						   <li class="active"><a href="{{route('admin.home')}}"><i class="fa fa-bullseye"></i>Dashboard</a></li>
						  

													  
							<li><a href="#"><i class="ti ti-email"></i>Kotak Pesan <b class="badge bg-purple pull-right">3</b></a></li>
							
							<li>
								<a href="javascript:void(0)"><i class="ti ti-ruler-pencil"></i>Halaman <span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li><a href="{{route('admin.page.active')}}"><i class="ti ti-file"></i>Halaman Aktif</a></li>
									<li><a href="{{route('admin.page.inactive')}}"><i class="ti ti-file"></i>Halaman NonAktif</a></li>
								</ul>
							</li>							
							
							<li>
								<a href="javascript:void(0)"><i class="ti ti-ruler-pencil"></i>FAQ <span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li><a href="{{route('admin.faq.active')}}"><i class="ti ti-file"></i>FAQ Aktif</a></li>
									<li><a href="{{route('admin.faq.inactive')}}"><i class="ti ti-file"></i>FAQ NonAktif</a></li>
								</ul>
							</li>							
							<li>
								<a href="javascript:void(0)"><i class="ti ti-ruler-pencil"></i>Pekerjaan <span class="fa arrow"></span>@if(!Route::is('admin.vacancies.index') and !Route::is('admin.vacancies.reviewed')and !Route::is('admin.vacancies.inactived')and !Route::is('admin.vacancies.expired')and !Route::is('admin.vacancies.trash')) @if($vacancyNewCounts>0)<b class="badge bg-success pull-right">{{$vacancyNewCounts}}</b>@endif @endif</a>
								<ul class="nav nav-second-level">
									<li>
										<a href="{{route('admin.vacancies.index')}}">Belum Review @if($vacancyNewCounts>0)<b class="badge bg-success pull-right">{{$vacancyNewCounts}}</b>@endif</a>
									</li>
									<li>
										<a href="{{route('admin.vacancies.reviewed')}}">Sudah Review <b class="badge bg-success pull-right">{{$countVacancy}}</b></a>
									</li>
									<li>
										<a href="{{route('admin.vacancies.expired')}}">Sudah Expire</a>
									</li>
									<li>
										<a href="{{route('admin.vacancies.inactived')}}">Sudah Nonaktif</a>
									</li>									
									<li>
										<a href="{{route('admin.vacancies.trash')}}">Sudah Dihapus</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="javascript:void(0)"><i class="ti ti-ruler-pencil"></i>Master Pekerjaan <span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">									
									<li>
										<a href="#">Tipe Kategori</a>
									</li>
									<li>
										<a href="#">Kategori</a>
									</li>
								   <li>
										<a href="#">Sub Kategori</a>
									</li>
									<li>
										<a href="#">Jenis Pekerjaan</a>
									</li>
									<li>
										<a href="#">Tingkatan Pekerjaan</a>
									</li>
								</ul>
							</li>							
							
							<li>
								<a href="javascript:void(0)"><i class="fa fa-graduation-cap"></i>Pendidikan <span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="#">Pendidikan</a>
									</li>
									<li>
										<a href="#">Jurusan</a>
									</li>
								</ul>
							</li>							

							<li>
								<a href="javascript:void(0)"><i class="fa fa-newspaper-o"></i>Artikel <span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="#">Kategori</a>
									</li>
									<li>
										<a href="#">Jenis Artikel</a>
									</li>
								   <li>
										<a href="#">Artikel</a>
									</li>
								</ul>
							</li>
							
							
							<li>
								<a href="javascript:void(0)"><i class="fa fa-map-marker"></i>Lokasi <span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="#">Benua</a>
									</li>
									<li>
										<a href="#">Negara</a>
									</li>
								   <li>
										<a href="#">Propinsi</a>
									</li>
									<li>
										<a href="#">Kabupaten</a>
									</li>
									<li>
										<a href="#">Kota</a>
									</li>
								</ul>
							</li>

							<li>
								<a href="javascript:void(0)"><i class="ti ti-user"></i>User <span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="{{route('admin.user.index')}}">Member <b class="badge bg-success pull-right">{{$countUser}}</b></a>
									</li>
									<li>
										<a href="{{route('admin.company.index')}}">Perusahaan <b class="badge bg-success pull-right">{{$countCompany}}</b></a>
									</li>
								</ul>
							</li>
							
							<li>
								<a href="javascript:void(0)"><i class="fa fa-user-secret"></i>Administrator <span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="#">Jenis Administrator</a>
									</li>
									<li>
										<a href="#">Administrator <b class="badge bg-success pull-right">3</b></a>
									</li>
								</ul>
							</li>							
							
							
							<li><a href="#"><i class="ti ti-settings"></i>Pengaturan</a></li>
							
							
							<li><a href="#"><i class="ti ti-folder"></i>Profile Saya</a></li>
							
							
							<li><a href="{{url('backstart/logout')}}"><i class="ti ti-shift-right"></i>Log Out</a></li>
						</ul>
					</div>
					<!-- /.sidebar-collapse -->
				</div>