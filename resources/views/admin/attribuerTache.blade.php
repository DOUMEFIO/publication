<x-app-layout>
    @section("contenue")
     
    <div class="row">
        <div class="col-xl-6 mx-auto">
            <div class="card ">
                <div class="card-body">
                    <h6 class="mb-0 text-uppercase">Selectionner vos</h6>
                    <hr>
                    <form method="" action="#" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 ">
                            <label class="form-label"  for="exampleSelect2" for="selection">Influenceur</label>
                            <select class="selectpicker form-control" multiple name='id_centre[]' required>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->type->nom}} {{$user->type->prenom}} 
                                        {{$user->sexe}}, {{$user->residence}}, {{$user->nbr_vue_moyen}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-8"></div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-secondary">Soumettre</button>
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
