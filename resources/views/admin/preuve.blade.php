<x-app-layout>
    @section("contenue")

    <div class="container py-2 col-6" style="font-size:20px;">
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold" style="text-align: center; font-size:20px"><strong>Trouver les preuves.</strong></p>
                </div>
                <div class="card-body">
                    <form class="user" method="POST" action="{{route('showPreuve')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label"><strong>Tâche</strong></label>
                            <select class="form-control" name="idTache">
                                @foreach ($taches as $tache)
                                    <option value="{{$tache->id}}">T{{$tache->id}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Travailleur</strong></label>
                            <select class="form-control" name="idTravailleur">
                                @foreach ($travailleurs as $travailleur)
                                    <option value="{{$travailleur->id}}">{{$travailleur->nom}} {{$travailleur->prenom}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" id="submitModal" class="btn btn-primary">Soumettre</button>
                    </form>
                </div>
            </div>
    </div>
    @include('layouts.js')
    @endsection
</x-app-layout>
