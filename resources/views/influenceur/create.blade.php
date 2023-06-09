<x-app-layout>
    @section("contenue")

    <div class="container py-2 col-6" style="font-size:20px;">
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold" style="text-align: center; font-size:20px"><strong>Completez vos informations</strong></p>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('store.influenceur')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Numéro WhatsApp</strong></label>
                                    <input type="tel" name="tel" id="phone" class="form-control" required>
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
                            <select class="selectpicker form-control" multiple name='id_centre[]' required>
                                
                                @foreach ($centres as $centre)
                                    <option value="{{$centre->id}}">{{$centre->libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" style="text-align: center">
                            <div class="row">
                                <div class="col-3">
                                    <h6 class="">Sexe: </h6>
                                </div>
                                <div class="col-4">
                                    <input class="form-check-input" type="radio" name="sexe" id="femaleGender"
                                      value="Féminin" required/>
                                    <label class="form-check-label" for="femaleGender">Féminin</label>
                                </div>
                                <div class="col-4">
                                    <input class="form-check-input" type="radio" name="sexe" id="maleGender"
                                      value="Masculin" required/>
                                    <label class="form-check-label" for="maleGender">Masculin</label>
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
