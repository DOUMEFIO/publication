<x-app-layout>
    @section('name')
        Plus d'Info
    @endsection
    @section("contenue")
    <div class="container py-2 col-12" style="font-size:20px;">
            <div class="card shadow">
                <div class="card-header py-3">
                    @if ($errors->has('tel'))
                        <div class="alert alert-danger">
                            {{ $errors->first('tel') }}OPP
                        </div>
                    @endif
                    <p class="text-primary m-0 fw-bold" style="text-align: center; font-size:20px"><strong>Completez vos informations</strong></p>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('store.influenceur')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Numéro WhatsApp</strong></label>
                                    <input type="tel" name="tel" class="form-control rounded-end flag-input" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Vues moyennes</strong></label>
                                    <input type="number" name="nbr_vue_moyen" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 ">
                            <label class="form-label" ><strong>Vos centres d’intérêts</strong> </label>
                            <select data-none-results-text="No results matched {0}" title="Selctionner les centres d’intérêts"
                            class="selectpicker form-control" multiple name='id_centre[]' required>
                                @foreach ($centres as $centre)
                                    <option value="{{$centre->id}}">{{$centre->libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" style="text-align: center">

                            <div class="row">
                                <div class="col-3">
                                    <h3 class="form-check-label">Sexe: </h3>
                                </div>
                                <div class="col-4">
                                    <input class="form-check-input" type="radio" name="sexe" id="flexRadioDefault1" value="Féminin">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Féminin
                                    </label>
                                </div>
                                <div class="col-4">
                                    <input class="form-check-input" type="radio" name="sexe" id="flexRadioDefault2" value="Masculin">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Masculin
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Pays</strong></label>
                            <select class="form-control" id="country" name="pay" required>

                                @foreach ($pays as $pay)
                                    <option value="{{$pay->id}}">{{$pay->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" id="dep" style="display:none">
                            <label class="form-label"><strong>Département</strong></label>
                            <select id="state" class="form-control" name="departement" required>

                            </select>
                        </div>
                        <div class="mb-3"  id="vil" style="display:none">
                            <label class="form-label"><strong>Ville</strong></label>
                            <select class="form-control" name="ville" id="citie" required>

                            </select>
                        </div>
                        <div class="form-group " >
                            <div class="row">
                                <div class="col md-5" style="text-align: right">
                                    <button class="btn btn-primary btn-sm" type="submit">Soumettre</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    @include('layouts.js')
    @endsection
</x-app-layout>
