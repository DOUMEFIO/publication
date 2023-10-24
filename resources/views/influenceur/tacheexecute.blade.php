<x-app-layout>
    @section('name')
        Les Tâches EXécutées
    @endsection
    @section('title')
        Tâche
    @endsection
    @section('contenue')
    <div class="container-fluid">
        <div class="card shadow">
            <div class="row card-body">
                <div class="col md-3" style="padding-left: 600px">
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-nowrap py-3">
                        <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                            <input type="search" class="form-control form-control-sm" aria-controls="dataTable"
                                id="myInput" onkeyup="myFunction()" placeholder="Rechercher Paiement...">
                        </div>
                    </div>
                </div>
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0" id="table_id">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Taches</th>
                               {{--  <th>Attribuer à</th> --}}
                                <th>Vues obtenir</th>
                                <th>Créer par</th>
                                <th>Période</th>
                                <th>Type Tâche</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody >
                            @php
                                $compteur = 1;
                            @endphp
                            @foreach ($clientes as $client)
                                <tr>
                                    <td>{{ $compteur++ }}</td>
                                    <td><span class="badge badge-soft-primary">T{{$client['idTache']}}</span></td>
                                    {{-- <td>
                                            @foreach ($client['travailleurs'] as $travailleur)
                                                {{ $travailleur['nom'] }}
                                                    {{ $travailleur['prenom'] }}
                                            @endforeach
                                    </td> --}}
                                    <td>
                                            @foreach ($client['travailleurs'] as $travailleur)
                                            {{ $travailleur['totalVues'] }}
                                            @endforeach
                                    </td>
                                    <td>{{$client['clientnom'] }} {{$client['clientprenom']}}
                                    </td>
                                    <td>
                                        {{ strftime('%A %e %B %Y', strtotime($client['debut'])) }} à <br>
                                        {{ strftime('%A %e %B %Y', strtotime($client['fin'])) }}
                                    </td>
                                    <td>{{$client['libelle']}}</td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" >
                                                <a class="dropdown-item edit-item-btn" href="{{route('showtache.influenceur', ['id' => $client['idTache']])}}" class="btn btn-warning">
                                                    <i class="ri-eye-fill align-bottom me-2 text-muted"></i>Voir Plus
                                                </a>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    {{ $taches->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
