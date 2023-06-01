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
                                    <h4 class="text-dark mb-4">Inscription Influenceur</h4>
                                </div>
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form class="user" method="POST" action="{{ route('register') }}">
                                    @csrf
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
                                    <button class="btn btn-primary d-block btn-user w-100" type="submit">Enregistrer</button>
                                </form>
                                <div class="text-center"><a class="small" href="{{ route('login') }}">Already have an account? Login!</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-7">
                    <div class="card card-registration my-4">
                        <div class="row g-0">
                            <div class="col-xl-12">
                                <div class="card-body p-md-3 text-black">
                                    <h3 class="mb-3 text-uppercase" style="color: blue; text-align:center">Inscription Influenceur</h3>
                                    <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <input type="hidden" value="2" name="idprofil">
                                            <div class="row">
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-outline">
                                                        <x-input-label for="Nom" :value="__('Nom')" />
                                                        <x-text-input id="Nom" style="text-transform: uppercase;" class="form-control form-control-lg" type="text" name="name" :value="old('nom')" required autofocus autocomplete="nom" />
                                                        <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-outline">
                                                        <x-input-label for="Prénom" :value="__('Prenom')" />
                                                        <x-text-input id="Prenom" style="text-transform: capitalize;" class="form-control form-control-lg" type="text" name="prenom" :value="old('prenom')" required autofocus autocomplete="prenom" />
                                                        <x-input-error :messages="$errors->get('Prenom')" class="mt-2" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-outline mb-4">
                                                <x-input-label for="email" :value="__('Adress mail')" />
                                                <x-text-input id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-outline">
                                                        <x-input-label for="password" :value="__('Mot de passe')" />
                                                        <x-text-input id="password" class="form-control form-control-lg"
                                                                        type="password"
                                                                        name="password"
                                                                        required autocomplete="new-password" onclick="checkPassword()"/>
                                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-outline">
                                                        <x-input-label for="password_confirmation" :value="__('Confirmer mot de passe')" />

                                                        <x-text-input id="password_confirmation" class="form-control form-control-lg"
                                                                        type="password"
                                                                        name="password_confirmation" required autocomplete="new-password" />

                                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                                    </div>
                                                </div>
                                            </div>
                                            @if(session()->has('error'))
                                                <div class="alert alert-danger"> {!! session('error') !!}</div>
                                            @endif

                                            <div class="d-flex justify-content-end py-3 px-3">
                                                <a class="btn btn-light btn-lg" href="{{ route('login') }}">
                                                    {{ __('Déjà un compte?') }}
                                                </a>

                                                <x-primary-button class="btn btn-warning btn-lg ms-2">
                                                    {{ __('Enregistrer') }}
                                                </x-primary-button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
    </section>
    <script src="{{asset("template/assets/js/chart.min.js")}}"></script>
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
