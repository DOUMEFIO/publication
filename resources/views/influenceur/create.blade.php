<x-app-layout>
    @section("contenue")
    <div class="container justify-content-center w-50" style="font-size:20px;">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h4 class="text-black mb-4">Complétez vos informations</h4>
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
                    <form method="post" action="{{route('store.influenceur')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="tel" name="tel" id="phone" class="form-control form-control-user" placeholder="Numéro WhatsApp" required>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="fw-bolder text-black">Vues moyennes</label>
                                    <input type="number" name="nbr_vue_moyen" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bolder text-black" >Vos centres d’intérêts</label>
                            <select class="selectpicker form-control" multiple name='id_centre[]' required>
                                <option value="-1">Selectionner</option>
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
                                           value="Feminin" required/>
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
                            <label class="fw-bolder text-black">Pays</label>
                            <select class="form-control" id="country" name="pay" required>
                                <option value="-1">Selectionner</option>
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
    </div>
    @include('layouts.js')
    @endsection
</x-app-layout>
