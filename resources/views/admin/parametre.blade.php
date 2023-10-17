<x-app-layout>
    @section('name')
        Paramètre
    @endsection
    @section('title')
        Paramètre
    @endsection
    @section('contenue')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Prix</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <button type="button" class="btn btn-sm btn-light"><a href="{{route('createparametre')}}">Ajouter un prix</a></button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <p class="text-muted mb-4">Les <code>Prix </code> des tâches spéciales.</p>

                    <div class="live-preview">
                        <div class="table-responsive table-card">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Tâche</th>
                                        <th scope="col">Prix Unitaire</th>
                                        <th scope="col">Prix Influenceur</th>
                                        <th scope="col" style="width: 150px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prices as $price)
                                        <tr>
                                            <td>T{{$price->idTache}}</td>
                                            <td>{{$price->prixtache}}</td>
                                            <td>{{$price->prixinfluenceur}}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-light"><a href="{{route('editprice',['id' => $price->id])}}">Modifier</a></button>
                                                <button type="button" class="btn btn-sm btn-danger">Supprimer</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div>
    @endsection
</x-app-layout>
