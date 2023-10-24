<x-app-layout>
    @section('name')
        Les Tâches Exécutées
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
                                <th>Attribuer à</th>
                                <th>Vues obtenir</th>
                                <th>Période</th>
                                <th >Status</th>
                                <th >Réalisation</th>
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
                                    <td>T{{$client['idTache']}}</td>
                                    <td>
                                        <ul>
                                            @foreach ($client['travailleurs'] as $travailleur)
                                                <li>{{ $travailleur['nom'] }}
                                                    {{ $travailleur['prenom'] }}
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach ($client['travailleurs'] as $travailleur)
                                                <li>{{ $travailleur['totalVues'] }}
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($client['debut'])->locale('fr')->isoFormat('dddd D MMMM YYYY') }} au <br>
                                        {{ \Carbon\Carbon::parse($client['fin'])->locale('fr')->isoFormat('dddd D MMMM YYYY') }}</span></td>
                                    @if ($client['status']["libelle"] == "Valide")
                                        <td class="status"><span class="badge badge-soft-success text-uppercase">{{$client['status']["libelle"]}}</span>
                                        </td>
                                    @else
                                        <td class="status"><span class="badge badge-soft-warning text-uppercase">{{$client['status']["libelle"]}}</span>
                                        </td>
                                    @endif
                                    @if ($client['realisation'] ==  "Non Exécuter")
                                        <td class="status"><span class="badge badge-soft-danger text-uppercase">{{$client['realisation']}}</span>
                                        </td>
                                    @elseif ($client['realisation'] ==  "Vues Non Atteint")
                                        <td class="status"><span class="badge badge-soft-warning text-uppercase">{{$client['realisation']}}</span>
                                        </td>
                                    @else
                                        <td class="status"><span class="badge badge-soft-success text-uppercase">{{$client['realisation']}}</span>
                                        </td>
                                    @endif
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" >
                                                <a class="dropdown-item edit-item-btn" href="{{route('showtache.client', ['id' => $client['idTache']])}}" class="btn btn-warning">
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
