@extends('layouts.app')
@section('meta')<meta name="keywords" content="{{ config('app.keyword') }}" />
	<meta name="description" content="{{ config('app.description') }}">
	<meta name="author" content="gelarin.com">	
	<title>{{ config('app.name', 'Gelarin') }} {{ config('app.title') }}</title>	
@endsection
@section('content')
			<!-- Title Header Start -->
			<section class="inner-header-title" style="background-image:url({{asset('front/img/blog/banner-10.jpg')}});">
				<div class="container">
					<h1>{{__('header.Extra Page')}}</h1>
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- Title Header End -->
			
			<!-- Accordion Design Start -->
			<section class="accordion">
				<div class="container">
					<div class="col-md-6 col-sm-6">
						<div class="simple-tab">
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="work-process">
										<h4 class="panel-title">
											<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
											{{__('extra.Download Responsive HTML Templates')}}
											</a>
										</h4>
									</div>
									<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="work-process">
										<div class="panel-body">
											<p>1.<b>Medinova</b> (<a href="https://docs.google.com/uc?export=download&id=1GXZNMiY5pSLUyereOAH08TZ_i9K1gekw" class="kyt-font-green">{{__('extra.Download')}}</a>) (<a href="http://html.kodesolution.live/html/health-beauty/medical/medinova-html/v3.2/demo/" class="kyt-font-green"target="_blank">{{__('extra.Template Type')}}</a>) (<a href="http://html.kodesolution.live/html/health-beauty/medical/medinova-html/v3.2/demo/index-mp-layout1.html" class="kyt-font-green"target="_blank">Demo</a>) ({{__('extra.Recommendations for company profile')}})</p>
											<p>2.<b>Seos</b> (<a href="https://docs.google.com/uc?export=download&id=1oV03pvSa9SavejaIJaYfjHb3jBSrt82c" class="kyt-font-green">{{__('extra.Download')}}</a>) (<a href="https://colorlib.com/preview/theme/seos/" class="kyt-font-green"target="_blank">Demo</a>) ({{__('extra.Recommendations for landing pages')}})</p>
											<p>3.<b>Appco</b> (<a href="https://docs.google.com/uc?export=download&id=1HinwVjzupO08jGAbpT1p__pXqviq8I1S" class="kyt-font-green">{{__('extra.Download')}}</a>) (<a href="https://colorlib.com/preview/theme/appco/" class="kyt-font-green"target="_blank">Demo</a>) ({{__('extra.Recommendations for landing pages')}})</p>											
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="what-we-do">
										<h4 class="panel-title">
											<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
											{{__('header.Download Software')}}
											</a>
										</h4>
									</div>
									<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="what-we-do">
										<div class="panel-body">
											<p>1.<b>Axure RP 9</b> (<a href="https://www.axure.com/download" class="kyt-font-green">{{__('extra.Download')}}</a>) (<a href="https://docs.google.com/uc?export=download&id=1YFIB0nsjZWn-RGvfQEeo-lAal7DIeLCQ" class="kyt-font-green"target="_blank">{{__('extra.Activation Code')}}</a>) ({{__('extra.Recommendations for Application UI Design')}})</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="simple-tab">
							<div class="panel-group" id="accordionRigh" role="tablist" aria-multiselectable="false">
								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="excel">
										<h4 class="panel-title">
											<a role="button" data-toggle="collapse" data-parent="#accordionRigh" href="#collapseExcel" aria-expanded="true" aria-controls="collapseExcel">
											{{__('header.Download Excel Formulas')}}
											</a>
										</h4>
									</div>
									<div id="collapseExcel" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="excel">
										<div class="panel-body">
											<p>{{__('extra.Not available, please try again later')}}...</p>
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="site">
										<h4 class="panel-title">
											<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionRigh" href="#collapseSite" aria-expanded="false" aria-controls="collapseSite">
											{{__('header.List of Important Websites')}}
											</a>
										</h4>
									</div>
									<div id="collapseSite" class="panel-collapse collapse" role="tabpanel" aria-labelledby="site">
										<div class="panel-body">
											<p>{{__('extra.Not available, please try again later')}}...</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- Accordion Design End -->
@endsection	