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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
    <title>Passer une commande</title>
</head>
<body>
<div class="container justify-content-center w-75">
    <div class="card shadow-lg o-hidden border-0 my-5">
        <div class="card-body p-0">
            <div class="col-lg-12">
                <div class="p-5">
                    <div class="text-center">
                        <h4 class="text-black mb-4">Passer une commande</h4>
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
                    <form class="user" method="POST" action="{{ route('form.submit') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-sm-6 mb-3 mb-sm-0"><label for="exampleFirstName" class="fw-bold text-black">Nombre de vues recherchées:</label>
                                <input class="form-control required" type="number" id="exampleFirstName" placeholder="Nombre de vues recherchées" name="vueRecherche">
                            </div>
                            <div class="col-sm-6">
                                <label for="centre" class="fw-bolder text-black">Vos centres d'intérêts</label>
                                <select class="selectpicker form-control" id="centre" multiple name='centre[]' required style="border: 2px solid black;">
                                    @foreach ($centres as $centre)
                                        <option value="{{$centre->id}}">{{$centre->libelle}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label class="fw-bold text-black" for="date">Date de début</label>
                                    <input type="date" class="form-control" id="date" name="debut"  placeholder="234" required>
                            </div>
                            <div class="col-sm-6">
                                <label class="fw-bolder text-black" for="date">Date de fin</label>
                                <input type="date" class="form-control" name="fin"  id="date" placeholder="234" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bolder text-black" for="selection">Type de fichier</label>
                            <select class="form-control" name="typetache" id="typetache" required>
                                <option value="-1">Choisissez</option>
                                @foreach ($fichiers as $fichier)
                                    <option value="{{$fichier->id}}">{{$fichier->libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" id="descriptionGroup" style="display:none;">
                            <label class="fw-bolder text-black" for="date">Description</label>
                            <input type="text" class="form-control"  name="description" id="date" placeholder="Description">
                        </div>
                        <div class="mb-3" id="fileGroup" style="display:none;">
                            <label class="fw-bolder text-black" for="avatar">Choisir un fichier</label>
                            <input type="file" class="form-control" id="avatar" name="avatar" >
                        </div>
                        <div class="mb-3">
                            <label class="fw-bolder text-black">Pays</label>
                            <select class="selectpicker form-control" id="countrylist" multiple name="pays[]" required>
                                <option value="-1" disabled>Choisissez</option>
                                @foreach ($pays as $pay)
                                    <option value="{{$pay->id}}">{{$pay->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" id="listdep" style="display:none;">
                            <label class="fw-bolder text-black">Département:</label>
                            <select id="stateliste" class="form-control" multiple name="departements[]" >
                            </select>
                        </div>
                        <div class="mb-3"  id="listvil" style="display:none;">
                            <label class="fw-bolder text-black">Ville:</label>
                            <select class="form-control" multiple name="villes[]" id="citielist" >
                            </select>
                        </div>
                        <div class="form-group ">
                            <div class="row my-3">
                                <button class="btn btn-primary d-block btn-user w-100" type="submit">Enregistrer</button>
                            </div>
                            <div class="row">
                                <span style="color: rgb(55, 53, 53);text-align:center">Avez-vous un compte? <a href="{{ route('login') }}" type="submit" value="connection">Se connecter</a></span>
                            </div>
                            <hr>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        <!--<div class="container py-2 col-7" style="font-size:20px;">
            <div class="card card-body ">
                  @if(session()->has('error'))
			       <div class="alert alert-succes"> {!! session('error') !!}</div>
		          @endif
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold" style="text-align: center; font-size:20px"><strong>Passer une commande</strong></p>
                        <div id="total" style="display:none;">
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('form.submit')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="city"><strong>Nombres de vues recherchées</strong></label>
                                        <input class="form-control" type="number" id="nom" name="vueRecherche" placeholder="234" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3 ">
                                        <label class="form-label"  for="exampleSelect2" for="selection"><strong>Vos centres d’intérêts</strong> </label>
                                        <select class="selectpicker form-control"  id="centre" multiple name='centre[]' required>
                                            @foreach ($centres as $centre)
                                                <option value="{{$centre->id}}">{{$centre->libelle}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="date"><strong>Date de début</strong></label>
                                         <input type="date" class="form-control" id="date" name="debut"  placeholder="234" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="date"><strong>Date de fin</strong></label>
                                         <input type="date" class="form-control" name="fin"  id="date" placeholder="234" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="selection" ><strong>Type de fichier</strong></label>
                                <select class="form-control" name="typetache" id="typetache" required>
                                        <option value="-1">Choisissez</option>
                                        @foreach ($fichiers as $fichier)
                                            <option value="{{$fichier->id}}">{{$fichier->libelle}}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="mb-3" id="descriptionGroup" style="display:none;">
                                <label class="form-label" for="date"><strong>Description</strong></label>
                                 <input type="text" class="form-control"  name="description" id="date" placeholder="Description">
                            </div>

                            <div class="mb-3" id="fileGroup" style="display:none;">
                                <label class="form-label" for="avatar"><strong>Choisir un fichier</strong></label>
                                 <input type="file" class="form-control" id="avatar" name="avatar" >
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><strong>Pays</strong></label>
                                <select class="selectpicker form-control" id="countrylist" multiple name="pays[]" required>
                                    <option value="-1">Choisissez</option>
                                    @foreach ($pays as $pay)
                                        <option value="{{$pay->id}}">{{$pay->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3" id="listdep" style="display:none;">
                                <label class="form-label"><strong>Département</strong></label>
                                <select id="stateliste" class="form-control" multiple name="departements[]" >
                                </select>
                            </div>
                            <div class="mb-3"  id="listvil" style="display:none;">
                                <label class="form-label"><strong>Ville</strong></label>
                                <select class="form-control" multiple name="villes[]" id="citielist" >
                                </select>
                            </div>
                            <div class="form-group " >
                                <hr>
                                <div class="row my-3">
                                    <button class="btn btn-primary btn-sm" type="submit" name="submit" value="inscription">S'inscrire</button>
                                </div>
                                <div class="row"><span style="color: rgb(55, 53, 53); font-size:22px; text-align:center">Avez-vous un compte?</span></div>
                                <div class="row">
                                    <div class="col md-5" style="text-align: center">
                                        <button class="btn btn-primary btn-sm" type="submit" name="submit" value="connection">Se Connecter</button>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>-->
</body>
@include('layouts.body')
@include('layouts.js')
</html>
