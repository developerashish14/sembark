<!doctype html>
<html lang="en">
<head>
    @include('includes.head')
	<!-- @yield('scripts') -->
</head>

<body class="bg-theme bg-theme1">
	<!--wrapper-->
	<div class="wrapper">

		<!--start page wrapper -->
            @yield('content')
		<!--end page wrapper -->
	</div>
	<!--end wrapper-->
	
	<!-- Bootstrap JS -->
	<script src="{{ asset('admin_assets/js/bootstrap.bundle.min.js') }}"></script>
	<!--plugins-->
	<script src="{{ asset('admin_assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('admin_assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
	<script src="{{ asset('admin_assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
	<script src="{{ asset('admin_assets/js/index.js') }}"></script>
	<!--app JS-->
	<script src="{{ asset('admin_assets/js/app.js') }}"></script>
	@yield('js')
</body>

</html>