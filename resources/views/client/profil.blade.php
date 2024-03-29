<x-app-layout>
    @section('name')
        Profil
    @endsection
    @section('contenue')
        <div class="container-fluid">
            <div class="row mb-3">
                @if (session('info'))
                <div class="alert alert-success">
                    {{ session('info') }}
                </div>
            @endif
                <div class="col-lg-4">
                    <div class="card mb-3">
                        <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="{{asset('storage'.$clients[0]->travailleur->photpProfil)}}" width="160" height="160">
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
                                    <form class="user" method="POST" action="{{route('info.clientupdate')}}">
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
                                        <div class="mb-3"><button class="btn btn-primary btn-sm" id="saved" type="submit" disabled>Enregistrer</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
