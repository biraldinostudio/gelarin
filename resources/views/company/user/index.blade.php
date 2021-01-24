@extends('layouts.company.app')	
@section('meta')<meta name="keywords" content="{{ config('app.keyword') }}" />
	<meta name="description" content="{{ config('app.description') }}">
	<meta name="author" content="gelarin.com">	
	<title>{{ config('app.name', 'Gelarin') }} {{ config('app.title') }}</title>	
@endsection
@section('content')
			<!-- Title Header Start -->
			<section class="inner-header-page" style="background-image:url({{asset('front/img/content/banner-10.jpg')}});">
				<div class="container">
					
					<h2>{{__('global.Hire The Expert Candidate')}}</h2>
					<p>{{__('global.Work with the world’s best talent on '.config('app.name').' — the top freelancing website trusted by over 5 million businesses.')}}</p>
					
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- Title Header End -->
			
			<!-- Accordion Design Start -->
			<section class="accordion">
				<div class="container">
					
					<!-- search filter -->
					<div class="row extra-mrg">
						<div class="wrap-search-filter">
							<form>
								<div class="col-md-6 col-sm-6">
									<input type="text" class="form-control" placeholder="@lang('global.Keyword. Developer, Designer')...">
								</div>
								{{--<div class="col-md-3 col-sm-3">
									<select class="form-control category">
										<option value="">&nbsp;</option>
										<option value="1">Information Technology</option>
										<option value="2">Mechanical</option>
										<option value="3">Hardware</option>
										<option value="4">Hospitality & Tourism</option>
										<option value="5">Education & Training</option>
										<option value="6">Government & Public</option>
										<option value="7">Architecture</option>
									</select>

								</div>--}}
								<div class="col-md-3 col-sm-3">
											<select name="location" id="choose-city" class="form-control">
												<option value="" data-type=""
													@if (request('location')=='' or request('location')==0)
														selected="selected"
													@endif
													> @lang('global.All Locations') 
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
								<div class="col-md-3 col-sm-3">
									<button type="submit" class="btn btn-primary full-width">@lang('global.Search')</button>
								</div>
							</form>
						</div>
					</div>
					<!-- search filter End -->
					
					<!-- Paid Candidate Start -->
					<div class="row">
						
						@foreach($users as $user)
						<!-- Single paid-candidater -->
						<div class="col-md-4 col-sm-6">
							<div class="paid-candidate-container">
								<div class="paid-candidate-box">
									<div class="dropdown">
										<div class="btn-group fl-right">
											<button type="button" class="btn-trans" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="fa fa-gear"></i>
											</button>
											<div class="dropdown-menu pull-right animated flipInX">
												<a href="#">@lang('global.Make a Reference')</a>
												<a href="#">@lang('global.Send Message')</a>
											</div>
										</div>
									</div>
									<div class="paid-candidate-inner--box">
										<div class="paid-candidate-box-thumb">
										<a href="{{route('talents.pages.profiles',[$crypto->encodeHex($user->id),str_slug($user->name)])}}" target="_blank">
										@if(!empty($user->userdescription->photo))
											<img src="{{ asset('storage/uploads/member/photo/'.$user->userdescription->photo) }}" class="img-responsive img-circle" title="{{ str_limit(strip_tags(ucwords($user->name)), 21) }}" />
										@else
											<img src="{{asset('front/img/default/photo.jpg')}}" class="img-responsive img-circle" title="{{ str_limit(strip_tags(ucwords($user->name)), 21) }}" />											
										@endif
										</a>
										</div>
										<div class="paid-candidate-box-detail">

											<h4><a href="{{route('talents.pages.profiles',[$crypto->encodeHex($user->id),str_slug($user->name)])}}" target="_blank">{{ str_limit(strip_tags(ucwords($user->name)), 25) }}</a></h4>
											@if(!empty($user->userdescription->profession))
											<span class="desination">{{ str_limit(strip_tags(ucwords($user->userdescription->profession)), 30) }}</span>
										    @else
											<span class="desination">@lang('auth.Profession')...</span>												
											@endif	
										</div>
									</div>
									<div class="paid-candidate-box-extra">
										
										@if(!empty($user->userdescription->city_id))
											<p>{{str_limit(strip_tags(ucwords($user->userdescription->city->name)),21) }},{{str_limit(strip_tags(ucwords($user->userdescription->city->subadmin1->name)),21) }},{{str_limit(strip_tags(ucwords($user->userdescription->country->name)),21) }}</p>
										@else
											<p>@lang('global.Location')</p>											
										@endif	
									</div>
								</div>

								<a href="{{route('talents.pages.profiles',[$crypto->encodeHex($user->id),str_slug($user->name)])}}" class="btn btn-paid-candidate bt-1" target="_blank">@lang('global.View Detail')</a>
							</div>
						</div>
						@endforeach
						

						<!-- Single Freelancer -->
						<div class="col-md-12 col-sm-12">
							<div class="text-center">
							{{--<a href="#" class="btn btn-primary">Load More</a>--}}
								{{$users->render()}}
							</div>
						</div>
						
					</div>
						
				</div>
			</section>
			<!-- Accordion Design End -->
@endsection
@push('styles')
	<link href="{{asset('front/custom/autocomplete/chosen.css')}}" rel="stylesheet">
@endpush
@push('scripts')
	<script type="text/javascript" src="{{asset('front/custom/autocomplete/chosen.jquery.js')}}"></script>
	<script type="text/javascript">
		 var $ = jQuery.noConflict();
		$(".category").select2({
			placeholder: "{{trans('global.Choose Experience')}}"
		});
		$(".location").select2({
			placeholder: "{{trans('global.Choose Location')}}"
		});		
	</script>	
@endpush			
	
