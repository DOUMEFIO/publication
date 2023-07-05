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
    <title>Document</title>
</head>
<body>
    <section >
        <div class="container py-5 col-10" >
            <div class="row">
              <div class=" row d-flex align-items-center justify-content-center h-100">
                <div class="card col-md-12 col-lg-5 col-xl-5 offset-xl-1 py-3">
                    @if (session('info'))
                        <div class="alert alert-success">
                            {{ session('info') }}
                        </div>
                    @endif
                    <h3 style="text-align: center; color:blue">CONNECTEZ-VOUS</h3>
                <form method="POST" action="{{route('connecte')}}">
                    @csrf
                <!-- Email input -->
                <div class="form-outline mb-4">
                  <x-input-label for="email" :value="__('Email')" />
                  <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                  <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="d-flex justify-content-around align-items-center mb-4">
                  <!-- Checkbox -->
                  <div class="form-check">
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
                </div>

                <!-- Submit button -->
                <x-primary-button class="btn btn-primary btn-lg btn-block">
                    {{ __('Connecter') }}
                </x-primary-button>

                <div class="divider d-flex align-items-center my-4">
                    <p class="text-center fw-bold mx-3 mb-0 text-muted">Connectez-vous avec</p>
                </div>
                <div class="row" style="font-size: 12px">
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

              </form>
            </div>
          </div>
        </div>
      </section>
</body>
</html>
