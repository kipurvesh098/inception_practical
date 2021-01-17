<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ env('APP_SITE_TITLE') }} {{ isset($page_title) ? ' | '.$page_title : '' }}</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}">
	<link rel="stylesheet" href="{{ asset('theme/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('theme/admin/bower_components/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('theme/admin/bower_components/Ionicons/css/ionicons.min.css') }}">
	<link rel="stylesheet" href="{{ asset('theme/admin/dist/css/AdminLTE.min.css') }}">
	<link rel="stylesheet" href="{{ asset('theme/admin/plugins/iCheck/square/blue.css') }}">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<style type="text/css" media="screen">
		.login-page{
			background-color: #4980b9;
		}
	</style>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	@yield('styles')
</head>
<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href="{{ url('/') }}">{{ HTML::image('images/logo.svg', 'Inception', array('class' => 'img-100')) }}</a>
		</div>
		@include('admin.includes.loader')
		@yield('content')
	</div>
	<script src="{{ asset('theme/admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ asset('theme/admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('theme/admin/plugins/iCheck/icheck.min.js') }}"></script>
	<script src="{{ asset('js/jquery.bootstrap-growl.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/parsley.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/pages/submitForm.js?000001') }}"></script>
	<script>
		$(function () {
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%' /* optional */
			});
		});
	</script>
	@yield('scripts')
</body>
</html>