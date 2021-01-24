<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="{{ app()->getLocale() }}">
<head>
	<!-- Basic Page Needs
	================================================== -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="google-site-verification" content="google-site-verification=KKEmyIKy2PeHegcuDZBr_SknLDZz3W1TCDdWubURt14">
	@yield('meta')
	<!-- CSS
	================================================== -->
	<link rel="stylesheet" href="{{asset('front/plugins/css/plugins.css')}}">
    <link href="{{asset('front/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/colors/blue-style.css')}}" rel="stylesheet">	
    <link href="{{asset('front/css/all.css')}}" rel="stylesheet">	
	@stack('styles')
	<link rel="shortcut icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon">
	<link rel="icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon">	
</head>

	<body>	
	<div class="Loader"></div>
		<div class="wrapper">  
			@section('header')
				@include('layouts.inc.header')
			@show
			<div class="clearfix"></div>
			@yield('content')
			<div class="clearfix"></div>
			@section('footer')
				@include('layouts.inc.footer')
			@show			
			
			{{--@section('login')
					@include('auth.popup.login')
			@show--}}
				{{--@section('register')
					@include('auth.popup.register')
				@show--}} 
			
			<!-- Scripts
			================================================== -->
			<script type="text/javascript" src="{{asset('front/plugins/js/jquery.min.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/viewportchecker.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/bootstrap.min.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/bootsnav.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/select2.min.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/wysihtml5-0.3.0.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/bootstrap-wysihtml5.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/datedropper.min.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/dropzone.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/loader.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/owl.carousel.min.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/slick.min.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/gmap3.min.js')}}"></script>
			<script type="text/javascript" src="{{asset('front/plugins/js/jquery.easy-autocomplete.min.js')}}"></script>
			<!-- Custom Js -->
			<script src="{{asset('front/js/custom.js')}}"></script>
			
			<script type="text/javascript" src="{{asset('front/center/phone/js/bootstrap-formhelpers.min.js')}}"></script>	
			<script src="{{asset('front/center/select2/select2.js')}}" type="text/javascript"></script>
				<!-- untuk validasi form dialog atau modal -->
				<script type="text/javascript">
				  var $ = jQuery.noConflict();
						@if (isset($errors) and $errors->any())
							@if ($errors->any() and old('quickLoginForm')=='1')
								$('#quickLogin').modal();
							@endif
						@endif
						
						@if (isset($errors) and $errors->any())
							@if ($errors->any() and old('quickRegisterForm')=='1')
								$('#quickRegister').modal();
							@endif
						@endif						
						
						@if (isset($errors) and $errors->any())
							@if ($errors->any() and old('hdnInputCreate')=='1')
								$('#createModal').modal();
							@endif						
						@endif
				</script>
			   <script type="text/javascript">
					var $ = jQuery.noConflict();
					function reloadPage() {
						location.reload();
					}
					function hideLogin() {
						$("#quickLogin").modal('hide');
					}
					function hideRegister() {
						$("#quickRegister").modal('hide');
					}
					function hideApplyJob() {
						$("#quickApplyJob").modal('hide');
					}
				</script>
				<!-- batas untuk validasi form dialog atau modal -->

				<!-- Agar input angka saja -->
				<script language="javascript">
					var $ = jQuery.noConflict();
					function getkey(e)
					{
					if (window.event)
					   return window.event.keyCode;
					else if (e)
					   return e.which;
					else
					   return null;
					}
					function goodchars(e, goods, field)
					{
					var key, keychar;
					key = getkey(e);
					if (key == null) return true;
					 
					keychar = String.fromCharCode(key);
					keychar = keychar.toLowerCase();
					goods = goods.toLowerCase();
					 
					// check goodkeys
					if (goods.indexOf(keychar) != -1)
						return true;
					// control keys
					if ( key==null || key==0 || key==8 || key==9 || key==27 )
					   return true;
						
					if (key == 13) {
						var i;
						for (i = 0; i < field.form.elements.length; i++)
							if (field == field.form.elements[i])
								break;
						i = (i + 1) % field.form.elements.length;
						field.form.elements[i].focus();
						return false;
						};
					// else return false
					return false;
					} 
				</script> 		
				{{--<script>
					var $ = jQuery.noConflict();
					$('#country').change(function()
					{
						$.get('countries/' + this.value + '/sub_admin1s.json', function(sub_admin1s)
						{
							var $subadmin1 = $('#subadm');
				 
							$subadmin1.find('option').remove().end();
				 
							$.each(sub_admin1s, function(index, subadm) {
								$subadmin1.append($('<option/>').attr('value', subadm.code).text(subadm.name)); 
							});
						});
					});
				 
					$(document).ready(function() {
						$(".country option[value='0']").attr("disabled","disabled");
						$(".subadm option[value='0']").attr("disabled","disabled");
					});
				</script> --}}
			<script>
				var $ = jQuery.noConflict();
				$('#subadm').change(function()
				{
					$.get('subadms/' + this.value + '/cities.json', function(cities)
					{
						var $city = $('#cit');
			 
						$city.find('option').remove().end();
			 
						$.each(cities, function(index, cit) {
							$city.append($('<option/>').attr('value', cit.id).text(cit.name)); 
						});
					});
				});
			 
				$(document).ready(function() {
					$(".subadm option[value='0']").attr("disabled","disabled");
					$(".cit option[value='0']").attr("disabled","disabled");
				});
			</script>
@stack('scripts')			
		</div>
	</body>
</html>