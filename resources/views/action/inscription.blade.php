<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/register.css') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <section class="h-100 bg-dark">
        <div class="container py-5 h-100">

          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-7">
                <div class="card card-registration my-4">
                    <div class="row g-0">
                        <div class="col-xl-12">
                            <div class="card-body p-md-3 text-black">
                                <h3 class="mb-3 text-uppercase" style="color: blue; text-align:center">Inscription Client</h3>
                                <form method="POST" action="{{ route('tache.store') }}" enctype="multipart/form-data">
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
                                                                required autocomplete="new-password" />

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

                                    <div class="d-flex justify-content-end py-3 px-3">
                                        <button type="submit" class="btn btn-primary" >Enregistrer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@include('layouts.body')
