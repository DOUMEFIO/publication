<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .divider:after,
        .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
}
    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/register.css') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset("template/assets/bootstrap/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{asset("template/assets/fonts/fontawesome-all.min.css")}}">
    <link rel="stylesheet" href="{{asset("template/assets/fonts/font-awesome.min.css")}}">
    <link rel="stylesheet" href="{{asset("template/assets/fonts/fontawesome5-overrides.min.css")}}">
    <title>Document</title>
</head>
<body style="background-color: #e8e8ec">
    <section>
        <div class="container w-50 justify-content-center" >
            <div class="card shadow-lg o-hidden border-0 my-5">
                <div class="card-body p-0">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Connexion</h4>
                            </div>
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form class="user" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3"><input class="form-control form-control-user" type="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Entrez votre adresse e-mail" name="email"></div>
                                <div class="mb-3">
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Mot de passe">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fa fa-eye" id="eyeIcon"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="custom-control custom-checkbox small">
                                        <div class="form-check"><input class="form-check-input custom-control-input" type="checkbox" id="formCheck-1"><label class="form-check-label custom-control-label" for="formCheck-1">Se souvenir de moi</label></div>
                                    </div>
                                </div><button class="btn btn-primary d-block btn-user w-100" type="submit">Se connecter</button>
                                <hr><a class="btn btn-primary d-block btn-google btn-user w-100 mb-2" role="button"><i class="fab fa-google"></i>&nbsp; Se connecter avec Google</a><a class="btn btn-primary d-block btn-facebook btn-user w-100" role="button"><i class="fab fa-facebook-f"></i>&nbsp; Se connecter avec Facebook</a>
                                <hr>
                            </form>
                            @if (Route::has('password.request'))
                            <div class="text-center"><a class="small" href="forgot-password.html">Mot de passe oublié?</a></div>
                            @endif
                            <div class="text-center"><a class="small" href="{{ route('register') }}">Inscrivez-vous!</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="container py-5 col-10" >
        <div class="row">
          <div class=" row d-flex align-items-center justify-content-center h-100">
            <div class="card col-md-12 col-lg-5 col-xl-5 offset-xl-1 py-3">
                <h3 style="text-align: center; color:blue">CONNECTEZ-VOUS</h3>
                <form method="POST" action="{{route('login') }}">-->
                    @csrf
                <!-- Email input -->
                <!--<div class="form-outline mb-4">
                  <x-input-label for="email" :value="__('Email')" />
                  <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                  <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>-->

                <!-- Password input -->
                <!--<div class="form-outline mb-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>-->

                <!--<div class="d-flex justify-content-around align-items-center mb-4">-->
                  <!-- Checkbox -->
                  <!--<div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                    <label class="form-check-label" for="form1Example3">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Se Souvenir de moi') }}</span>
                    </label>
                  </div>
                  @if (Route::has('password.request'))
                   <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                   {{ __('Mot de passe oublier?') }}
                   </a>
    @endif
                </div>-->

                <!-- Submit button -->
                <!--<x-primary-button class="btn btn-primary btn-lg btn-block">
                    {{ __('Connecter') }}
                </x-primary-button>-->

                <!--<div class="divider d-flex align-items-center my-4">
                    <p class="text-center fw-bold mx-3 mb-0 text-muted">Connectez-vous avec</p>
                </div>
                <div class="row py-2" style="font-size: 12px">
                    <div class="col-8">
                        <a class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998" href="#!"
                          role="button">
                          <i class="fab fa-facebook-f me-2" ></i> Facebook
                        </a>
                    </div>
                    <div class="col-4">
                        <a class="btn btn-primary btn-lg btn-block" style="background-color: #55acee" href="#!"
                        role="button">
                        <i class="fab fa-twitter me-2"></i> Ggoogle</a>
                    </div>
                </div>
              </form>
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
    </script>
</body>
</html>
