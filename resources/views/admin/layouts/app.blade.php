<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ env('APP_SITE_TITLE') }} {{ isset($page_title) ? ' | '.$page_title : '' }}</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="{{ asset('theme/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('theme/admin/bower_components/font-awesome/css/font-awesome.min.css') }}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="{{ asset('theme/admin/bower_components/Ionicons/css/ionicons.min.css') }}">
	<!-- DataTables -->
	<link rel="stylesheet" href="{{ asset('theme/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
	<!-- jvectormap -->
	<link rel="stylesheet" href="{{ asset('theme/admin/bower_components/jvectormap/jquery-jvectormap.css') }}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('theme/admin/dist/css/AdminLTE.min.css') }}">
	<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="{{ asset('theme/admin/dist/css/skins/_all-skins.min.css') }}">
	<!-- jquery confirm -->
	<link rel="stylesheet" href="{{ asset('theme/admin/dist/css/jquery-confirm.min.css') }}">
	<!-- Select2 -->
	<link rel="stylesheet" href="{{ asset('theme/admin/bower_components/select2/dist/css/select2.min.css') }}">
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="{{ asset('theme/admin/plugins/iCheck/all.css') }}">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

	@yield('styles')
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		@include('admin.includes.header')
		@include('admin.includes.loader')
		<!-- Left side column. contains the logo and sidebar -->
		@include('admin.includes.sidebar')
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			@include('admin.includes.breadcrumbs')
			<!-- Main content -->
			@yield('content')
		</div>
		<!-- /.content-wrapper -->
		@include('admin.includes.footer')
		<!-- Control Sidebar -->
		<div class="control-sidebar-bg"></div>
	</div>
	<!-- ./wrapper -->
	<!-- jQuery 3 -->
	<script src="{{ asset('theme/admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="{{ asset('theme/admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<!-- DataTables -->
	<script src="{{ asset('theme/admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('theme/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
	<!-- FastClick -->
	<script src="{{ asset('theme/admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('theme/admin/dist/js/adminlte.min.js') }}"></script>
	<!-- Sparkline -->
	<script src="{{ asset('theme/admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
	<!-- jvectormap  -->
	<script src="{{ asset('theme/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
	<script src="{{ asset('theme/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
	<!-- SlimScroll -->
	<script src="{{ asset('theme/admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
	<!-- ChartJS -->
	<script src="{{ asset('theme/admin/bower_components/chart.js/Chart.js') }}"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="{{ asset('theme/admin/dist/js/pages/dashboard2.js') }}"></script>
	<!-- jquery confirm -->
	<script src="{{ asset('theme/admin/dist/js/jquery-confirm.min.js') }}"></script>
	<!-- Select2 -->
	<script src="{{ asset('theme/admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
	<!-- iCheck 1.0.1 -->
	<script src="{{ asset('theme/admin/plugins/iCheck/icheck.min.js') }}"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="{{ asset('theme/admin/dist/js/demo.js') }}"></script>
	@yield('scripts')
	<script type="text/javascript">
		setTimeout(function() { $('#alert-message').fadeOut('fast'); }, 3000); // Hide message
	</script>
</body>
</html>