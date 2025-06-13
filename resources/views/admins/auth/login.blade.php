<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ asset('assets/img/images/favicon_yako.png')}}" type="image/png" />
	<!--plugins-->
	<link href="{{ asset('cust_assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="cust_assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="{{ asset('cust_assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
	{{-- <!-- loader-->
	<link href="cust_assets/css/pace.min.css" rel="stylesheet" />
	<script src="cust_assets/js/pace.min.js"></script> --}}
	<!-- Bootstrap CSS -->
	<link href="{{ asset('cust_assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{ asset('cust_assets/css/bootstrap-extended.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ asset('cust_assets/css/app.css')}}" rel="stylesheet">
	<link href="{{ asset('cust_assets/css/icons.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
	<title>Login || Yako Africa Assurances Vie</title>
    <style>

    </style>
</head>

<body class="">
    <div id="preloader">
        <div id="loader" class="loader">
            <div class="loader-container">
                <div class="loader-icon"><img src="{{ asset('assets/img/logo/Logo_yako.png')}}" alt="Preloader"></div>
            </div>
        </div>
    </div>
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-cover">
			<div class="">
				<div class="row g-0">

					<div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">

                        <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
							<div class="card-body">
                                 <img src="{{ asset('cust_assets/images/login-images/login-cover.svg')}}" class="img-fluid auth-img-cover-login" width="650" alt=""/>
							</div>
						</div>
						
					</div>

					<div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
						<div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
							<div class="card-body p-sm-5">
								<div class="">
									<div class="mb-3 text-center">
										<img src="{{ asset('cust_assets/images/logo-icon.png')}}" width="150" alt="">
									</div>
									<div class="text-center mb-4">
										<h5 class="">Espace Admin</h5>
										<p class="mb-0">Veuillez vous connecter à votre compte</p>
									</div>
									<div class="form-body">
										<form action="{{ route('Admin.Login')}}" method="POST">
											@if (Session::get('fail'))
											    <div class="alert alert-danger alert-dismissible fade show" role="alert">
													{{ Session::get('fail') }}
												</div>
											@endif
											@if (Session::get('success'))
											    <div class="alert alert-success alert-dismissible fade show" role="alert">
													{{ Session::get('success') }}
												</div>
											@endif
                                            @csrf
                                            <div class="row g-3"> 
                                                <div class="col-12">
                                                    <label for="login" class="form-label">Nom d'utilisateur</label>
                                                    <input type="text" class="form-control" id="login" name="email">
                                                    @error('email')
                                                        <span class="text-danger">Veuillez entrer votre nom d'utilisateur</span> 
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputChoosePassword" class="form-label">Mot de passe</label>
                                                    <div class="input-group" id="show_hide_password">
                                                        <input type="password" class="form-control border-end-0" id="inputChoosePassword" name="password"> 
                                                        <a href="javascript:;" class="input-group-text bg-transparent"><i class="bx bx-hide"></i></a>
                                                    </div>
                                                    @error('password')
                                                        <span class="text-danger">Veuillez entrer votre mot de passe</span>
                                                    @enderror
                                                </div> 
                                                <div class="col-md-12 mb-3 text-end">    
                                                    <a href="authentication-forgot-password.html" class="">Mot de passe oublié ?</a>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12  text-center">
													<button class="btn-prime btn-prime-two d-block w-100">Se connecter</button>
                                                </div>
                                            </div> 
											<div class="col-md-12 text-center">
												<a href="{{ route('index')}}" class="btn-prime d-block">Retour au site</a>
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
	<script src="{{ asset('cust_assets/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	<script src="{{ asset('cust_assets/js/jquery.min.js')}}"></script>
	<script src="cust_assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="{{ asset('cust_assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{ asset('cust_assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
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
	<script src="{{ asset('cust_assets/js/app.js')}}"></script>
    <script src="{{ asset('assets/js/main.js')}}"></script>
</body>

</html>