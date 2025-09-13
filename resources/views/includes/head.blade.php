<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf_token" content="{{ csrf_token() }}" />
	<!--favicon-->
	<link rel="icon" href="{{ asset('admin_assets/images/favicon-32x32.png') }}" type="image/png"/>
	<!--plugins-->
	<link href="{{ asset('admin_assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin_assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin_assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin_assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
	
	<!-- Bootstrap CSS -->
	<link href="{{ asset('admin_assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('admin_assets/css/bootstrap-extended.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="{{ asset('admin_assets/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('admin_assets/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('admin_assets/css/icons.css') }}" rel="stylesheet">


	<style>
		.alert-success{
			--bs-alert-color: #afe1d2;
		}

		.sidebarActiveLink
		{
			color: #ffffff;
			text-decoration: none;
			background: rgb(255 255 255 / 15%);
		}
	</style>