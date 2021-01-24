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
								<div class="row mrg-0">
									<div class="col-md-4 col-sm-4">
										@if(session()->has('success'))
											<ol class="breadcrumb pull-left">
												<li class="active">
													<i class="fa fa-check"></i> {{ session()->get('success') }}
												</li>
											</ol>	
										@endif
										@if(session()->has('warning'))
											<ol class="breadcrumb pull-left">
												<li>
													<i class="fa fa-exclamation-triangle"></i> {{ session()->get('warning') }}
												</li>
											</ol>	
										@endif
									</div>
									<div class="col-md-2 col-sm-2 small-padd">

									</div>
									<div class="col-md-6 col-sm-6">	
										<ol class="breadcrumb pull-right">
											<li><a href="{{route('company.dashboard')}}" class="kyt-font-green"><i class="fa fa-home"></i></a></li>										
											@if(Route::is('settings.legal.index'))
											<li><a href="#createModal" data-toggle="modal" data-target="#createModal" class="kyt-font-green" title="@lang('global.Add New')"><i class="fa fa-plus"></i></a></li>
											<li>@lang('auth.Legal')</li>
											<li><a href="{{route('settings.address.index')}}" class="kyt-font-green">@lang('auth.Address')</a></li>											
											<li><a href="{{route('settings.legal.trash')}}" class="kyt-font-green"><i class="fa fa-trash"></i> ({{$countlegalTrash}})</a></li>
											<li><a href="{{route('settings.index')}}" class="kyt-font-green" title="@lang('global.Back')"><i class="fa fa-arrow-left"></i></a></li>												
											@endif
											@if(Route::is('settings.legal.trash'))
											<li><i class="fa fa-trash"></i> ({{$countlegalTrash}})</li>												
											<li><a href="{{ route('settings.legal.index') }}" class="kyt-font-green" title="@lang('global.Back')"><i class="fa fa-arrow-left"></i></a></li>
											@endif						
										</ol>
									</div>
								</div>
							</div>
							
							<div class="card-body">
							@foreach($legals as $legal)
							@if(count($legals)>0)
								<article>
									<div class="mng-company">
										<div class="col-md-7 col-sm-7">
											<div class="item-fl-box">
												<div class="mng-company-name">
													<h5>{{ str_limit(strip_tags(ucwords($legal->name)), 40) }}</h5>
													<span class="cmp-time">{{ str_limit(strip_tags(ucwords($legal->number)), 40) }}</span></br>
													@if(!empty($legal->file) and !empty(file_exists(public_path('storage/uploads/company/legal/'.$legal->file))))
														<span class="cmp-time"><a href="{{route('settings.legal.download_file',$legal->id)}}" style="color:#2867b2;"><i class="fa fa-file-pdf-o"></i> {{substr($legal->file,13)}}</a></span>					
													@endif	
												</div>
											</div>
										</div>
									
										<div class="col-md-4 col-sm-4">
											<div class="advance-search-job-locat">
												<p><i class="fa fa-hourglass-end"></i>{{date($myCountries->date_format, strtotime($legal->expire))}}</p>
											</div>
										</div>
										
										<div class="col-md-2 col-sm-2">
										<div class="mng-company-action">
											@if(Route::is('settings.legal.index'))
											<a href="{{route('settings.legal.edit',$legal->id)}}" data-toggle="tooltip" title="@lang('global.Edit')"><i class="fa fa-edit"></i></a>
											<a href="{{route('settings.legal.delete',$legal->id)}}" onclick="return confirm('@lang('global.Do you want to delete it?')')" data-toggle="tooltip" title="@lang('global.Delete')"><i class="fa fa-remove"></i></a>
											@endif
											@if(Route::is('settings.legal.trash'))
											<a href="{{route('settings.legal.restore',$legal->id)}}" onclick="return confirm('@lang('global.Do you want to restore it?')')" data-toggle="tooltip" title="@lang('global.Restore')"><i class="fa fa-undo"></i></a>
											<a href="{{route('settings.legal.destroy',$legal->id)}}" onclick="return confirm('@lang('global.Do you want to delete it?')')" data-toggle="tooltip" title="@lang('global.Delete')"><i class="fa fa-trash-o"></i></a>
											@endif												
										</div>
										</div>									
									</div>
								</article>
								@else
									<article>
										<div class="mng-company">
											Data kosong
										</div>
									</article>
								@endif	
								@endforeach
							</div>
						</div>
						
						<div class="row">
						{{$legals->render()}}
						</div>					
					</div>
		<!-- Sidebar Start -->
		@section('sidebar')
			@include('layouts.company.inc.sidebar')
		@show
	<!-- Sidebar End -->	
	</div>
</section>
@includeWhen(auth()->check(), 'company.settings.legal.modal.create')
@endsection