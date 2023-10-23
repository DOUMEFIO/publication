<x-app-layout>
    @section('name')
        Paiements
    @endsection
    @section('title')
        Influenceurs Paiements
    @endsection

    @section('contenue')
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-nowrap">
                        <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                            <input type="search" class="form-control form-control-sm" aria-controls="dataTable"
                                id="myInput" onkeyup="myFunction()" placeholder="Rechercher Paiement...">
                        </div>
                    </div>
                </div>
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table table-nowrap align-middle dataTable" id="table_id">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tâche</th>
                                <th>Nom & Prénom</th>
                                <th>Email</th>
                                <th>Vues Optenir</th>
                                <th>Montant Payer</th>
                                <th>Date de Paiement</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody >
                            @php
                                $compteur = 1;
                            @endphp
                            @foreach ($paiements as $paiement )
                                <tr>
                                    <td>{{ $compteur++ }}</td>
                                    <td><span class="badge text-bg-info">T{{$paiement->idTache}}
                                    </span></td>
                                    <td>{{$paiement->client->nom}} {{$paiement->client->prenom}}</td>
                                    <td><span class="badge text-bg-success">{{$paiement->client->email}}
                                    </span></td>
                                    <td><span class="badge text-bg-info">{{$paiement->totalVues}}
                                    </span></td>
                                    <td><span class="badge text-bg-primary">{{$paiement->montant}}
                                    </span></td>
                                    <td><span class="badge text-bg-success">
                                        {{ \Carbon\Carbon::parse($paiement->created_at)->locale('fr')->isoFormat('dddd D MMMM YYYY') }}
                                    </span></td>
                                    <td><button class="btn btn-soft-secondary btn-sm dropdown" type="button" >
                                        <a class="dropdown-item edit-item-btn" href="{{route('showtache.all', ['id' => $paiement->id])}}" class="btn btn-warning">
                                            <i class="ri-eye-fill align-bottom me-2 text-muted"></i>Voir Plus
                                        </a>
                                    </button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    {{ $paiements->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
