@extends('admin.layouts.aunthentication')
@section('content')
<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
	<div class="container">
		<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
			<div class="col mx-auto">
				<div class="card my-5 my-lg-0 shadow-none border">
					<div class="card-body">
						<div class="p-4">
							<div class="mb-3 text-center">
								<img src="images/logo-icon.png" width="60" alt="" />
							</div>
							<div class="text-center mb-4">
								@if ($message = Session::get('success'))
									<div class="alert alert-primary">
										{{ $message }}
									</div>    
								@endif
								<h5 class="">Shakaboom Admin</h5>
								<p class="mb-0">Please log in to your account</p>
							</div>
							<div class="form-body ">
								<form class="row g-3" action="{{ route('signIn') }}" method="post">
								@csrf
									<div class="col-12">
										<label for="inputEmailAddress" class="form-label">Email</label>
										<input type="email" name="email" class="form-control" id="inputEmailAddress" placeholder="jhon@example.com">
										@if ($errors->has('email'))
											<span class="text-danger">{{ $errors->first('email') }}</span>
										@endif
									</div>
									<div class="col-12">
										<label for="inputChoosePassword" class="form-label">Password</label>
										<div class="input-group" id="show_hide_password">
											<input type="password" name="password" class="form-control border-end-0" id="inputChoosePassword" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
										</div>
										@if ($errors->has('password'))
												<span class="text-danger">{{ $errors->first('password') }}</span>
										@endif
									</div>
									<!-- <div class="col-md-6">
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
											<label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
										</div>
									</div> -->
									<!-- <div class="col-md-6 text-end">	<a href="">Forgot Password ?</a>
									</div> -->
									<div class="col-12">
										<div class="d-grid">
											<button type="submit" class="btn btn-light">Sign in</button>
										</div>
									</div>
									<!-- <div class="col-12">
										<div class="text-center ">
											<p class="mb-0">Don't have an account yet? <a href="">Sign up here</a>
											</p>
										</div>
									</div> -->
								</form>
							</div>
							<!--
							<div class="login-separater text-center mb-5"> <span>SIGN IN </span>
								<hr/>
							</div>
							
							<div class="list-inline contacts-social text-center">
								<a href="javascript:;" class="list-inline-item bg-light text-white border-0 rounded-3"><i class="bx bxl-facebook"></i></a>
								<a href="javascript:;" class="list-inline-item bg-light text-white border-0 rounded-3"><i class="bx bxl-twitter"></i></a>
								<a href="javascript:;" class="list-inline-item bg-light text-white border-0 rounded-3"><i class="bx bxl-google"></i></a>
								<a href="javascript:;" class="list-inline-item bg-light text-white border-0 rounded-3"><i class="bx bxl-linkedin"></i></a>
							</div>
							-->

						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end row-->
	</div>
</div>
@stop



@section('js')
<script>
	$(document).ready(function () {
		$("#show_hide_password a").on('click', function (event) {
			event.preventDefault();
			if ($('#show_hide_password input').attr("type") == "text") {
				$('#show_hide_password input').attr('type', 'password');
				$('#show_hide_password i').addClass("bx-hide");
				$('#show_hide_password i').removeClass("bx-show");
			} else if ($('#show_hide_password input').attr("type") == "password") {
				$('#show_hide_password input').attr('type', 'text');
				$('#show_hide_password i').removeClass("bx-hide");
				$('#show_hide_password i').addClass("bx-show");
			}
		});
	});
</script>
@stop