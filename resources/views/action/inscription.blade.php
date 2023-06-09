<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/register.css') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset("template/assets/bootstrap/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{asset("template/assets/fonts/fontawesome-all.min.css")}}">
    <link rel="stylesheet" href="{{asset("template/assets/fonts/font-awesome.min.css")}}">
    <link rel="stylesheet" href="{{asset("template/assets/fonts/fontawesome5-overrides.min.css")}}">
    <title>Inscription</title>
</head>
<body>
    <section class="py-5" style="background-color: gainsboro;">
        <div class="container justify-content-center w-50">
            <div class="card shadow-lg o-hidden border-0 my-5">
                <div class="card-body p-0">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Inscription Client</h4>
                            </div>
                            <form class="user" method="POST" action="{{ route('tache.store') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="2" name="idprofil">
                                <div class="row mb-3">
                                        <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user required" type="text" id="exampleFirstName" placeholder="Nom" name="name"></div>
                                        <div class="col-sm-6"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Prénoms" name="prenom"></div>
                                    </div>
                                <div class="mb-3"><input class="form-control form-control-user" type="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Adresse Email" name="email"></div>
                                <div class="row mb-3">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <div class="input-group mb-3">
                                                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Mot de passe">
                                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                    <i class="fa fa-eye" id="eyeIcon"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input-group mb-3">
                                                <input type="password" class="form-control form-control-user" id="passwordConfirm" name="password_confirmation" placeholder="Confirmer mot de passe">
                                                <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm">
                                                    <i class="fa fa-eye" id="eyeIconConfirm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                @if(session()->has('error'))
                                        <div class="alert alert-danger"> {!! session('error') !!}</div>
                                    @endif

                                    @if($typetache == 1)
                                        <input type="hidden" value="{{$pay}}" name="pays">
                                        <input type="hidden" value="{{$centre}}" name="centre">
                                        <input type="hidden" value="{{$dep}}" name="departements">
                                        <input type="hidden" value="{{$vueRecherche}}" name="vueRecherche">
                                        <input type="hidden" value="{{$debut}}" name="debut">
                                        <input type="hidden" value="{{$fin}}" name="fin">
                                        <input type="hidden" value="{{$description}}" name="description">
                                        <input type="hidden" value="{{$typetache}}" name="typetache">
                                    @else
                                        <input type="hidden" value="{{$pay}}" name="pays">
                                        <input type="hidden" value="{{$centre}}" name="centre">
                                        <input type="hidden" value="{{$dep}}" name="departement">
                                        <input type="hidden" value="{{$vueRecherche}}" name="vueRecherche">
                                        <input type="hidden" value="{{$debut}}" name="debut">
                                        <input type="hidden" value="{{$fin}}" name="fin">
                                        <input type="hidden" value="{{$url}}" name="url">
                                        <input type="hidden" value="{{$description}}" name="description">
                                        <input type="hidden" value="{{$typetache}}" name="typetache">
                                    @endif
                                <button class="btn btn-primary d-block btn-user w-100" type="submit">Enregistrer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{asset("template/assets/js/chart.min.js") }}"></script>
    <script src="{{asset("template/assets/js/bs-init.js")}}"></script>
    <script src="{{asset("template/assets/js/theme.js")}}"></script>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const eyeIcon = document.querySelector('#eyeIcon');
        togglePassword.addEventListener('click', function (e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            eyeIcon.classList.toggle('fa-eye-slash');
            eyeIcon.classList.toggle('fa-eye');
        });

        const togglePasswordConfirm = document.querySelector('#togglePasswordConfirm');
        const passwordConfirm = document.querySelector('#passwordConfirm');
        const eyeIconConfirm = document.querySelector('#eyeIconConfirm');
        togglePasswordConfirm.addEventListener('click', function (e) {
            const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirm.setAttribute('type', type);
            eyeIconConfirm.classList.toggle('fa-eye-slash');
            eyeIconConfirm.classList.toggle('fa-eye');
        });
    </script>
@include('layouts.body')
