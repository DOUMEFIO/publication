<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">


<!-- Mirrored from themesbrand.com/velzon/html/default/auth-signup-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Nov 2022 16:41:56 GMT -->
@include("layouts.header")

<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="#" class="d-inline-block auth-logo">
                                    <img src="{{asset("dashbord/images/images/logo.png")}}" alt="" height="50">
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">S'inscrire</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Créer un compte Client</h5>
                                    @if(session()->has('error'))
                                        <div class="alert alert-danger"> {!! session('error') !!}</div>
                                    @endif
                                </div>
                                <div class="p-2 mt-4">
                                    <form class="needs-validation" novalidate method="POST" action="{{ route('tache.store') }}">
                                        @csrf
                                        <input type="hidden" value="2" name="idprofil">
                                        <div class="live-preview">
                                            <div class="row align-items-center g-3">
                                                <div class="col-lg-6">
                                                    <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                                    <input name="name" type="text" class="form-control" id="name" placeholder="Enter username" required>
                                                    <div class="invalid-feedback">
                                                        Entrer votre nom
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <label for="prenom" class="form-label">Prenom <span class="text-danger">*</span></label>
                                                    <input name="prenom" type="text" class="form-control" id="prenom" placeholder="Enter username" required>
                                                    <div class="invalid-feedback">
                                                        Entrer votre prenom
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Email <span class="text-danger">*</span></label>
                                            <input name="email" type="email" class="form-control" id="username" placeholder="Enter username" required>
                                            <div class="invalid-feedback">
                                                Entrer votre mail
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Mot de Passe <span class="text-danger">*</span></label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input name="password" type="password" class="form-control pe-5 password-input" onpaste="return false" placeholder="Enter password" id="password-input" aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                <div class="invalid-feedback">
                                                    Entrer mot de passe
                                                </div>
                                            </div>
                                        </div>

                                         <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                            <h5 class="fs-13">Password must contain:</h5>
                                            <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 characters</b></p>
                                            <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b> letter (a-z)</p>
                                            <p id="pass-upper" class="invalid fs-12 mb-2">At least <b>uppercase</b> letter (A-Z)</p>
                                            <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b> (0-9)</p>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Enregister</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">Vous avez déjà un compte ? <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-underline"> Connexion </a> </p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>document.write(new Date().getFullYear())</script> WasPay. Pulication <i class="mdi mdi-heart text-danger"></i> by Themesbrand
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    @include("layouts.jss")
</body>


<!-- Mirrored from themesbrand.com/velzon/html/default/auth-signup-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Nov 2022 16:41:58 GMT -->
</html>
