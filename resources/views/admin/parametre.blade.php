<x-app-layout>
    @section('name')
        Paramètre
    @endsection
    @section('title')
        Paramètre
    @endsection
    @section('contenue')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-body">
                            <form class="user" method="POST" action="{{route('updateprice')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="email"><strong>Prix Unitaire</strong></label>
                                            <input class="form-control" type="number" id="" name="prixtache" value="{{$prices->prixtache}}" disabled></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="email"><strong>Prix Influenceur</strong></label>
                                            <input class="form-control" type="float" id="" name="prixinfluenceur" value="{{$prices->prixinfluenceur}}" disabled></div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-sm btn-light px-2"><a id="modify">Modifier</a></button>
                                    <button id="saved" type="submit" disabled class="px-2 btn btn-sm btn-success">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
