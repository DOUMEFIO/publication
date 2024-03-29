<x-app-layout>
    @section('name')
        Profil
    @endsection
    @section('title')
        Profil
    @endsection
    @section('contenue')
        <div class="container-fluid">
            <div class="row mb-3">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-lg-4">
                    <div class="card mb-3">
                        <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="{{asset('storage'.$profil[0]->photpProfil)}}" width="160" height="160">
                            <div class="mb-3">
                                <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Modifier la photo</button>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modifier la photo de profil</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form class="user" method="POST" action="{{route('infopictureUpdate')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mb-3">
                                                <input type="file" class="form-control" id="avatar" name="avatar">
                                            </div>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary" style="float:right">Enregistrer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form class="user" method="get" action="{{route('verified.tel', [ 'tel' => $users[0]->tel])}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="">
                                                <h5 class="modal-title" id="exampleModalLabel">Vérification</h5>
                                            </div>
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="exampleModalLabel"> Veuillez confimer votre numéro en
                                                    cliquant sur ce lien <a href="{{route('whatsapcofirm', [ 'id' => Auth::user()->id])}}" target="_blank" onclick="compteRebours()">https://wa.me/{{$users[0]->tel}}</a>
                                                </h6>
                                            </div>
                                            <div class="modal-header">
                                                <button type="button" class="btn btn-danger" id="annuler" data-bs-dismiss="modal">Annuler</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="py-3 px-5">
                            <label class="form-label" for="last_name"><strong>Votre solde actuel est:
                                <span class="badge badge-soft-success text-2xl">{{$sommesoldeprincipale}} Fcfa</span></strong></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col">
                            <div class="card shadow mb-3">
                                <div class="card-header py-3">
                                    <span class="text-primary m-0 fw-bold fs-5 text-center">Informations d'Utilisateur</span><a class="btn btn-primary float-end text-light" id="modify">Modifier</a>
                                </div>
                                <div class="card-body">
                                    <form class="user" method="POST" action="{{route('info.influupdate')}}">
                                        @csrf
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label class="form-label" for="email"><strong>Adresse e-mail</strong></label>
                                                    <input class="form-control" type="email" id="email" placeholder="user@example.com" name="email" value="{{Auth::user()->email}}" disabled></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label class="form-label" for="first_name"><strong>Nom</strong></label>
                                                    <input class="form-control" type="text" id="first_name" placeholder="John" name="first_name" value="{{Auth::user()->nom}}" ></div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label class="form-label" for="last_name"><strong>Prénom</strong></label>
                                                    <input class="form-control" type="text" id="last_name" placeholder="Doe" name="last_name" value="{{Auth::user()->prenom}}"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label class="form-label" for="email">
                                                        <strong>Sexe </strong>
                                                    </label>
                                                    <select name="sexe" class="form-control">
                                                        @if($users[0]->sexe == 'Masculin')
                                                            <option value="Masculin" selected>Masculin</option>
                                                            <option value="Féminin">Féminin</option>
                                                        @elseif($users[0]->sexe == 'Féminin')
                                                            <option value="Féminin" selected>Féminin</option>
                                                            <option value="Masculin">Masculin</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label class="form-label" for="last_name"><strong>Paiement</strong></label>
                                                    <select name="paiement" class="form-control">
                                                        @if($users[0]->paiement == 'Hebdomendaire')
                                                            <option value="Hebdomendaire" selected>Hebdomendaire</option>
                                                            <option value="Mensuel">Mensuel</option>
                                                        @elseif($users[0]->paiement == 'Mensuel')
                                                            <option value="Mensuel" selected>Mensuel</option>
                                                            <option value="Hebdomendaire">Hebdomendaire</option>
                                                        @endif
                                                    </select>
                                                 </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label class="form-label" for="first_name"><strong>Téléphone</strong></label>
                                                    <input class="form-control" type="text" id="telephone" placeholder="John" name="tel" value="{{$users[0]->tel}}">
                                                    <div class="py-1">
                                                        @if ($users[0]->validation == 0)
                                                            <button class="btn btn-primary btn-sm" type="button" id="button" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal1" onclick="appelRoute()">Confirmer votre numéro</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label class="form-label" for="last_name"><strong>Nombre moyen de vues</strong></label>
                                                    <input class="form-control" type="number" id="tel" placeholder="Doe" name="vuesmoyen" value="{{$users[0]->nbr_vue_moyen}}"></div>
                                            </div>
                                        </div>
                                        <div class="row" id="noninput">
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="last_name"><strong>Résidence</strong></label>
                                                    <ul>
                                                        <li><strong>Pays: </strong>{{$users[0]->residencepay->name}}</li>
                                                        <li><strong>Département: </strong>{{$users[0]->residencedep->name}}</li>
                                                        <li><strong>Ville: </strong>{{$users[0]->residencevil->name}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" value="{{$idlibelles}}" name="idlibelles">
                                        <div class="row" id="noninputs">
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="last_name"><strong>Centre d'intérets:</strong></label>
                                                    <ul>
                                                        @foreach ($libelles as $libelle)
                                                            <li><strong>{{$libelle}}</strong></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" id="input" style="display:none;">
                                            <div class="col">
                                                <div class="mb-3 ">
                                                    <label class="form-label" ><strong>Vos centres d’intérêts</strong> </label>
                                                    <select class="selectpicker form-control" data-none-results-text="No results matched {0}" title="Selctionner les centres d’intérêts"
                                                    multiple name='id_centre[]' >
                                                    <option disabled selected value="{{$idlibelles}}">{{ $libelles->implode(' ,', ', ') }}</option>
                                                        @foreach ($centres as $centre)
                                                            <option value="{{$centre->id}}">{{$centre->libelle}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label class="form-label"><strong>Pays</strong></label>
                                                    <select class="form-control" id="country" name="pay" required>
                                                        <option value="{{$users[0]->residencepay->id}}">{{$users[0]->residencepay->name}}</option>
                                                        @foreach ($pays as $pay)
                                                            <option value="{{$pay->id}}">{{$pay->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3" id="dep" style="display:none">
                                                    <label class="form-label"><strong>Département</strong></label>
                                                    <select id="state" class="form-control" name="departement">

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3"  id="vil" style="display:none">
                                                    <label class="form-label"><strong>Ville</strong></label>
                                                    <select class="form-control" name="ville" id="citie">

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3"><button id="saved" class="btn btn-primary btn-sm" type="submit" disabled>Enregistrer</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            let intervalId;
            function appelRoute() {
                let telephone = document.getElementById("telephone");
                var button = document.getElementById("button");
                telephone = telephone.value;
                console.log(telephone);
                var url = '{{ config("app.url") }}/verified/'+telephone;
                /*console.log(appUrl);
                 const url = 'http://127.0.0.1:8000/verified/'+telephone; en local utilise ceci */
                $.get(url, (res, data) => {
                    console.log(res);
                    if(res?.success == true){
                        button.style.display = 'none';
                        annulerModal();
                        clearInterval(intervalId);
                    }
                    else{
                        setTimeout(function () {
                            location.reload();
                        }, 120000);
                    }
                });
            }

            function annulerModal() {
                let boutonAnnuler = document.getElementById("annuler"); // Sélectionnez le bouton "Annuler" du modal par son ID
                if (boutonAnnuler) {
                    boutonAnnuler.click(); // Déclenchez un clic sur le bouton "Annuler"
                }
            }

            document.getElementById("button").addEventListener("click", () => {
                appelRoute();
                intervalId = setInterval(appelRoute, 15000);
            });
        </script>
        @include('layouts.jss')
        @include('layouts.js')
    @endsection
</x-app-layout>
<script>
    // Désactive tous les éléments input
    var saveButton = document.getElementById('saved');
    saveButton.disabled = true;
    var inputs = document.getElementsByTagName('input');
    for (var i = 6; i < inputs.length; i++) {
        inputs[i].disabled = true;
    }

    // Désactive tous les éléments option
    var options = document.getElementsByTagName('option');
    for (var i = 0; i < options.length; i++) {
        options[i].disabled = true;
    }

    // Désactive tous les éléments option
    function disableAllOptions() {
        var options = document.getElementsByTagName('option');
        for (var i = 0; i < options.length; i++) {
            options[i].disabled = true;
        }
    }

    // Réactive tous les éléments input
    function enableAllInputs() {

        var inputs = document.getElementsByTagName('input');
        for (var i = 1; i < inputs.length; i++) {
            inputs[i].disabled = false;
        }
    }

    // Réactive tous les éléments option
    function enableAllOptions() {
        var options = document.getElementsByTagName('option');
        for (var i = 0; i < options.length; i++) {
            options[i].disabled = false;
        }
    }

    // Crée un bouton pour réactiver tous les éléments
    var enableButton = document.getElementById('modify');
    enableButton.addEventListener('click', function() {
        enableAllInputs();
        enableAllOptions();
        saveButton.disabled = false;
        $('#input').attr('style','')
        $('#noninput').attr('style','display:none')
        $('#noninputs').attr('style','display:none')
    });
</script>
