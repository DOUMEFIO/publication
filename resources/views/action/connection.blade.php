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
    <title>Connexion </title>
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
                          <form method="POST" action="{{route('connecte')}}" class="user">
                            @csrf
                            <div class="mb-3">
                                <input class="form-control form-control-user" type="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Entrez votre adresse e-mail" name="email">
                            </div>
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
                            </div>
                            <button class="btn btn-primary d-block btn-user w-100" type="submit">Se connecter</button>
                            <hr><a class="btn btn-primary d-block btn-google btn-user w-100 mb-2" role="button"><i class="fab fa-google"></i>&nbsp; Se connecter avec Google</a><a class="btn btn-primary d-block btn-facebook btn-user w-100" role="button"><i class="fab fa-facebook-f"></i>&nbsp; Se connecter avec Facebook</a>
                            <hr>
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
          </div>
        </div>
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
