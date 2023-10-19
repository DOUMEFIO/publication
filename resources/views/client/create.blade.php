<x-app-layout>
    @section('contenue')
        <div class="container py-2 col-12" style="font-size:20px;">
            <div class="card-body ">
                  @if(session()->has('error'))
			        <div class="alert alert-succes"> {!! session('error') !!}</div>
		          @endif
                <div class="card shadow">
                    <div class="py-3">
                        <p class="text-primary m-0 fw-bold" style="text-align: center; font-size:20px"><strong>Créer Tâche</strong></p>
                        <div id="total" style="display:none;">
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('store.client')}}" enctype="multipart/form-data">
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
                                        <select class="selectpicker form-control" id="centre" multiple name='centre[]' required>
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
                                <label class="form-label" for="selection" ><strong>Type de tâche</strong></label>
                                <select class="form-control" name="typetache" id="typetache" required>
                                       <option value="" disabled selected>Choisissez un type de tâche</option>
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
                            <div class="col md-5" style="text-align: center">
                                <button class="btn btn-primary btn-sm" type="submit">Soumettre</button>
                                <button class="btn btn-primary btn-sm" type="submit">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @include('layouts.js')
    @endsection
</x-app-layout>
