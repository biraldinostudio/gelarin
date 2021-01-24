@extends('layouts.app')
@section('meta')<meta name="keywords" content="{{ config('app.keyword') }}" />
	<meta name="description" content="{{ config('app.description') }}">
	<meta name="author" content="gelarin.com">	
	<title>{{ config('app.name', 'Gelarin') }} {{ config('app.title') }}</title>	
@endsection
@section('content')

			<!-- Title Header Start -->
			<section class="kyt-header-content">
				<div class="container">
				</div>
			</section>
			<!-- End Navigation -->
			<div class="clearfix"></div>
			<!-- ========== Begin: Brows job Category ===============  -->
			<section class="brows-job-category">
				<div class="container">
					<!-- Company Searrch Filter Start -->
					<div class="row extra-mrg">
						<div class="wrap-search-filter">
							<form lass="bt-form" role="form" files="true"  enctype="multipart/form-data" method="GET" action="{{ route('vacancies') }}">
							@csrf
								<div class="col-md-4 col-sm-4">
									<input type="text" name="keyword" id="keyword" class="form-control" placeholder="@lang('vacancy.Keyword: title or employer')" value="{{request('keyword')}}" autofocus>
								</div>
								<div class="col-md-3 col-sm-3">
									<select name="type"  class="form-control" data-placeholder="@lang('vacancy.All Types')">
										<option value="" data-type=""@if (request('type')=='' or request('type')=='')selected="selected"@endif>@lang('vacancy.All Types') </option>
											@foreach($working_types as $type)
												<option value="{{ $type->translation_of}}"@if (request('type')==$type->translation_of)selected="selected"@endif> {{ $type->name }} </option>
											@endforeach	
									</select>
								</div>
								<div class="col-md-3 col-sm-3">
									<select name="location" id="choose-city" class="form-control" data-placeholder="@lang('vacancy.All Locations')">
										<option value="" data-type=""
											@if (request('location')=='' or request('location')==0)
												selected="selected"
											@endif
											> @lang('vacancy.All Locations')
										</option>
										@foreach ($locations as $prov)
											<option value="{{ $prov->code }}"
													@if (request('location')==$prov->code)
														selected="selected"
													@endif
													> {{ $prov->name }} 
											</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-2 col-sm-2">
									<button type="submit" class="btn btn-primary">@lang('vacancy.Search Job')</button>
								</div>
							</form>
						</div>
					</div>
					<!-- Company Searrch Filter End -->
		@if($vacancies->isEmpty())
			<div class="row">
				<div class="container">
					<div class="error-page">
						<p><span style="color:red;"><b>Oops...</b></span></span>@lang('vacancy.No results found')!</p> 
					</div>
				</div>
			</div>
		@else					

					<!--Browse Job In Grid-->
					<div class="row extra-mrg">

			@if(count($vacancies)>0)
				@foreach($vacancies as $vacancy)						
					<!-- Single New Job -->
                    <div class="col-md-3 col-sm-6">
                        <div class="job-instructor-layout">
							@if($vacancy->partner=='1')<span class="tg-themetag tg-featuretag">Premium</span>@endif
							<div class="brows-job-type">
								@if($vacancy->working_type_id==1)
									<span class="full-time">
								@endif
								@if($vacancy->working_type_id==2)
									<span class="part-time">
								@endif
								@if($vacancy->working_type_id==3)
									<span class="freelanc">
								@endif
								@if($vacancy->working_type_id==4)
									<span class="freelanc">
								@endif
								@if($vacancy->working_type_id==5)
									<span class="enternship">
								@endif
								@if($vacancy->working_type_id==6)
									<span class="enternship">
								@endif								
									
									{{$vacancy->type}}</span>							
							
							</div>
							<div class="job-instructor-thumb">
								@if(!empty($vacancy->logo))
									<img src="{{ asset('storage/uploads/company/logo/'.$vacancy->logo) }}" class="img-fluid" style="height:150px;" alt="{{$vacancy->company}}"/>
								@else
									<img src="{{asset('front/img/blank/150x150.png') }}" class="img-fluid" style="height:150px;" alt="{{$vacancy->company}}"/> 
								@endif
							</div>
							<div class="job-instructor-content">
								<h4 class="instructor-title"><a href="{{ route('vacancies.detail',[$vacancy->id,$vacancy->slug]) }}" target="_blank">{{ str_limit(strip_tags(ucwords($vacancy->title)), 23) }}</a></h4>
								<div class="instructor-skills">
									<a href="{{route('employers.pages.profiles',[$crypto->encodeHex($vacancy->company_id),$vacancy->company_slug])}}">{{ str_limit(strip_tags(ucwords($vacancy->company)), 25) }}</a>
									<br>
									<i class="fa fa-map-marker"></i> 
									{{ str_limit(strip_tags(ucwords($vacancy->city)), 12) }},
									{{ str_limit(strip_tags(ucwords($vacancy->province)), 16) }}
									<h5 class="instructor-scount kyt-font-kecil">{{CountDay($vacancy->created_at,date("Y-m-d"))}} @lang('home.Days Ago')</h5>
								</div>
							</div>
							<div class="job-instructor-footer">
								<div class="instructor-students">
									@if(auth()->check())
										@if($vacancy->user_id_save==auth()->user()->id  and $vacancy->vacancy_id_save==$vacancy->id or $vacancy->vacancy_id==$vacancy->id and $vacancy->user_id==auth()->user()->id)
										@else
											<a href="{{route('manage.vacancies.store',[$vacancy->idx,$vacancy->slug])}}"><i class="fa fa-save"></i></a>
										@endif
									@else
										<a href="{{route('manage.vacancies.store',[$vacancy->idx,$vacancy->slug])}}"><i class="fa fa-save"></i></a>
									@endif									
								</div>
								<div class="instructor-corses">
									<span class="c-counting">
									@if(auth()->check())
										@if($vacancy->vacancy_id==$vacancy->id and $vacancy->user_id==auth()->user()->id)
											{{__('home.Applied')}}
										@else
											<a href="{{route('application.apply',[$vacancy->id,$vacancy->slug])}}" title="@lang('home.Apply for this job application')" style="color:#2867b2;">@lang('home.Apply')</a>
										@endif
									@else
										<a href="{{route('application.apply',[$vacancy->id,$vacancy->slug])}}" title="@lang('home.Apply for this job application')" style="color:#2867b2;">@lang('home.Apply')</a>										
									@endif		
									
									</span>
								</div>
							</div>
						</div>
                    </div>
				@endforeach
				@endif



					</div>
		@endif			
					<!--/.Browse Job In Grid-->

					<div class="row">
						{{$vacancies->render()}}
					</div>
					
				</div>
			</section>
			<!-- ========== Begin: Brows job Category End ===============  -->
@endsection
@push('styles')
	<link href="{{asset('front/custom/autocomplete/chosen.css')}}" rel="stylesheet">
@endpush
@push('scripts')
	<script type="text/javascript" src="{{asset('front/custom/autocomplete/chosen.jquery.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/custom/autocomplete/init.js')}}"></script>
@endpush		
	
