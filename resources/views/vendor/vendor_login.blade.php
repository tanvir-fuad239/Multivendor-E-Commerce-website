<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ asset('backend') }}/assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="{{ asset('backend') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="{{ asset('backend') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="{{ asset('backend') }}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
	<!-- loader-->
	{{-- <link href="{{ asset('backend') }}/assets/css/pace.min.css" rel="stylesheet" />
	<script src="{{ asset('backend') }}/assets/js/pace.min.js"></script> --}}

	 {{-- fontawesome cdn --}}
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- Bootstrap CSS -->
	<link href="{{ asset('backend') }}/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{ asset('backend') }}/assets/css/app.css" rel="stylesheet">
	<link href="{{ asset('backend') }}/assets/css/icons.css" rel="stylesheet">

	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/dark-theme.css" />
	<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/semi-dark.css" />
	<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/header-colors.css" />

	 {{-- toastr js  --}}  
	 <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0- 
	 alpha/css/bootstrap.css" rel="stylesheet">
	
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 
	 <link rel="stylesheet" type="text/css" 
		 href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	 
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

	<title>Vendor | Sign In</title>
</head>

<body class="bg-login">
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="text-center">
										<h3 class="">Vendor Sign in</h3>
									</div>
									<div class="form-body">
										<form method="POST" action="{{ route('login') }}" class="row g-3">
                                            @csrf

                                            <!-- Username -->
											<div class="col-12">
												<label for="login" class="form-label">Username</label>
												<input type="text" class="form-control" id="login" name="login" placeholder="Enter username">
											</div>

                                            <!-- Password -->
											<div class="col-12">
												<label for="password" class="form-label">Password</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" class="form-control border-end-0" id="password" name="password" placeholder="Enter password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
											</div>

                                            <!-- Remember Me -->
											<div class="col-md-6">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" id="remember_me" name="remember">
													<label class="form-check-label" for="remember_me">Remember Me</label>
												</div>
											</div>

											<div class="col-md-6 text-end">	<a href="authentication-forgot-password.html">Forgot Password ?</a>
											</div>

											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign in</button>
												</div>
											</div>

										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="{{ asset('backend') }}/assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>
	<script src="{{ asset('backend') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="{{ asset('backend') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>

	{{-- jquery cdn  --}}
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

	<!--Password show & hide js -->
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
	<!--app JS-->
	<script src="{{ asset('backend') }}/assets/js/app.js"></script>

	 {{-- toastr js --}}
	 <script>

        @if(Session::has('message'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true,
        }
                toastr.success("{{ session('message') }}");
        @endif

    </script> 
	
</body>

</html>