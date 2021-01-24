@extends('layouts.app')
@section('meta')<meta name="keywords" content="informasi covid19 indonesia terbaru, informasi covid19 indonesia, informasi covid19, informasi, covid19" />
	<meta name="description" content="Informasi Covid19 Indonesia">
	<meta name="author" content="gelarin.com">	
	<title>{{ config('app.name', 'Gelarin') }} Informasi Covid19 Indonesia</title>	
@endsection
@section('content')
	<section class="kyt-header-content">
		<div class="container">
		</div>
	</section>
	<div class="clearfix"></div>
		<section class="tab-sec gray">
			<div class="container">
				<div class="col-lg-8 col-md-8 col-sm-12 col-lg-offset-2 col-md-offset-2">
					<div class="kyt-page-static">
						<ul class="nav modern-tabs" id="simple-design-tab">
							<li class="active"><img src="{{asset('front/img/social/stop-covid.png')}}"></li>
						</ul>
						<div class="tab-content">
						
							<table class="table">
							  <caption><b>{{__('extra.Covid19 Indonesia Information')}}</b></caption>
							  <thead>
								<tr>
								  <th scope="col">{{__('extra.Country')}}</th>
								  <th scope="col">{{__('extra.Positive')}}</th>
								  <th scope="col">{{__('extra.Get Well')}}</th>
								  <th scope="col">{{__('extra.Died')}}</th>	  
								</tr>
							  </thead>
							  <tbody>
							 @foreach($datCov19Alls as $datCov19All => $dCov19All)
								<tr>
								  <td>{{$dCov19All->name}}</td>
								  <td>{{$dCov19All->positif}}</td>
								  <td>{{$dCov19All->sembuh}}</td>
								  <td>{{$dCov19All->meninggal}}</td>								  
								</tr>
							@endforeach
							</table>						
						
						
							<table class="table">
							  <caption><b>{{__('extra.Covid19 Information by Province')}}</b></caption>							
							  <thead>
								<tr>
								  <th scope="col">No</th>								
								  <th scope="col">{{__('extra.Province')}}</th>
								  <th scope="col">{{__('extra.Positive')}}</th>
								  <th scope="col">{{__('extra.Get Well')}}</th>
								  <th scope="col">{{__('extra.Died')}}</th>	  
								</tr>
							  </thead>
							  <tbody>
							 @foreach($datCov19ByProvs as $infoCovid19x => $infoCovid19)
								<tr>
								  <th scope="row">{{$infoCovid19x+1}}.</th>
								  <td>{{$infoCovid19->attributes->Provinsi}}</td>
								  <td>{{$infoCovid19->attributes->Kasus_Posi}}</td>
								  <td>{{$infoCovid19->attributes->Kasus_Semb}}</td>
								  <td>{{$infoCovid19->attributes->Kasus_Meni}}</td>	  
								</tr>
							@endforeach
							</table>
						</div>
					</div>
				</div>
			</div>			
		</section>
@endsection		
	
