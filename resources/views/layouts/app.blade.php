<!doctype html>
<html lang="en">
<head>
    @include('includes.head')
</head>

<body class="bg-theme bg-theme1">
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
            @include('includes.sidebar')
		<!--end sidebar wrapper -->

		<!--start header -->
            @include('includes.header')
		<!--end header -->

		<!--start page wrapper -->
            @yield('content')
		<!--end page wrapper -->

		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->

		<!--Start Back To Top Button--> 
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->

        <!--start footer -->
		    @include('includes.footer')
		<!--end footer -->
	</div>
	<!--end wrapper-->
	
	<!-- Bootstrap JS -->
	<script src="{{ asset('admin_assets/js/bootstrap.bundle.min.js') }}"></script>
	<!--plugins-->
	<script src="{{ asset('admin_assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('admin_assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
	<script src="{{ asset('admin_assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
	<script src="{{ asset('admin_assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
	<script src="{{ asset('admin_assets/plugins/validation/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('admin_assets/plugins/validation/validation-script.js') }}"></script>
	<script src="{{ asset('admin_assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('admin_assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
	<script src="{{ asset('admin_assets/js/index.js') }}"></script>
	<!--app JS-->
	<script src="{{ asset('admin_assets/js/app.js') }}"></script>
	@yield('scripts')
</body>

</html>