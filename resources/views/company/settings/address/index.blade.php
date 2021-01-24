@extends('layouts.company.app')
@section('meta')<meta name="keywords" content="{{ config('app.keyword') }}" />
	<meta name="description" content="{{ config('app.description') }}">
	<meta name="author" content="gelarin.com">	
	<title>{{ config('app.name', 'Gelarin') }} {{ config('app.title') }}</title>	
@endsection
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
											@if(Route::is('settings.address.index'))
											<li><a href="#createModal" data-toggle="modal" data-target="#createModal" class="kyt-font-green" title="@lang('global.Add New')"><i class="fa fa-plus"></i></a></li>
											<li>@lang('auth.Address')</li>
											<li>
												<a href="{{route('settings.legal.index')}}" class="kyt-font-green">@lang('auth.Legal')</a>																						
											</li>											
											<li><a href="{{route('settings.address.trash')}}" class="kyt-font-green"><i class="fa fa-trash"></i> {{$countAddressTrash}}</a></li>
											<li><a href="{{route('settings.index')}}" class="kyt-font-green" title="@lang('global.Back')"><i class="fa fa-arrow-left"></i></a></li>												
											@endif
											@if(Route::is('settings.address.trash'))
											<li><i class="fa fa-trash"></i> {{$countAddressTrash}}</li>												
											<li><a href="{{route('settings.address.index')}}" class="kyt-font-green" title="@lang('global.Back')"><i class="fa fa-arrow-left"></i></a></li>
											@endif						
										</ol>
									</div>
								</div>
							</div>
							
							<div class="card-body">
							@foreach($addresses as $address)
							@if(count($addresses)>0)
								<article>
									<div class="mng-company">
										<div class="col-md-7 col-sm-7">
											<div class="item-fl-box">
												<div class="mng-company-pic">
													@if($address->active==null or $address->active=='0')
														@if(Route::is('settings.address.index'))
															<a href="{{route('settings.address.updateActive',$address->id)}}"><i class="fa fa-circle fa-3x"></i></a>
														@endif
														@if(Route::is('settings.address.trash'))
															<i class="fa fa-circle fa-3x"></i>
														@endif														
													@else
														<i class="fa fa-check-circle fa-3x" style="color:red;"></i>
													@endif
												</div>
												<div class="mng-company-name">
												@if($address->active==null or $address->active=='0')
													<a href="{{route('settings.address.updateActive',$address->id)}}">
														<h5>{{ str_limit(strip_tags(ucwords($address->address)), 40) }}</h5>
														<span class="cmp-time">{{$address->postal_code}}</span>
													</a>
												@else
													<h5>{{ str_limit(strip_tags(ucwords($address->address)), 40) }}</h5>
													<span class="cmp-time">{{$address->postal_code}}</span>													
												@endif				
												</div>
											</div>
										</div>
									
										<div class="col-md-4 col-sm-4">
											<div class="advance-search-job-locat">
												<p>
													@if($address->active==null or $address->active=='0')
														<a href="{{route('settings.address.updateActive',$address->id)}}"><i class="fa fa-map-marker"></i>{{$address->city->name}}, {{$address->city->subadmin1->name}}</a>
													@else
														<i class="fa fa-map-marker"></i>{{$address->city->name}}, {{$address->city->subadmin1->name}}							
													@endif	
												</p>
											</div>
										</div>
										
										<div class="col-md-2 col-sm-2">
										<div class="mng-company-action">
											@if(Route::is('settings.address.index'))
											<a href="{{route('settings.address.edit',$address->id)}}" data-toggle="tooltip" title="@lang('global.Edit')"><i class="fa fa-edit"></i></a>
											<a href="{{route('settings.address.delete',$address->id)}}" onclick="return confirm('@lang('global.Do you want to delete it?')')" data-toggle="tooltip" title="@lang('global.Delete')"><i class="fa fa-remove"></i></a>
											@endif
											@if(Route::is('settings.address.trash'))
											<a href="{{route('settings.address.restore',$address->id)}}" onclick="return confirm('@lang('global.Do you want to restore it?')')" data-toggle="tooltip" title="@lang('global.Restore')"><i class="fa fa-undo"></i></a>
											<a href="{{route('settings.address.destroy',$address->id)}}" onclick="return confirm('@lang('global.Do you want to delete it?')')" data-toggle="tooltip" title="@lang('global.Delete')"><i class="fa fa-trash-o"></i></a>
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
						{{$addresses->render()}}
						</div>					
					</div>
		<!-- Sidebar Start -->
		@section('sidebar')
			@include('layouts.company.inc.sidebar')
		@show
	<!-- Sidebar End -->	
	</div>
</section>
					@includeWhen(auth()->check(), 'company.settings.address.modal.create')
@endsection