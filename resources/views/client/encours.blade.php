<x-app-layout>
    @section('name')
        Les Tâches Attribuées
    @endsection
    @section('contenue')
        <div class="row">
            <div class="col-lg-12">
                <div class="card" id="orderList">
                    <div class="card-body pt-0">
                        <div>
                            <div class="table-responsive table-card mb-1">
                                <table class="table table-nowrap align-middle" id="orderTable">
                                    <thead class="text-muted table-light">
                                        <tr class="text-uppercase">
                                            <th data-sort="status">N° Tâche</th>
                                            <th data-sort="customer_name">Période</th>
                                            <th data-sort="product_name">Vues Rechercher</th>
                                            <th data-sort="status">Status</th>
                                            <th data-sort="status">Réalisation</th>
                                            <th data-sort="city">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($clients as $client)
                                            <tr>
                                                <td class="status"><span class="badge badge-soft-success text-uppercase">T{{$client['idTache']}}</span>
                                                <td><span class="badge badge-soft-primary text-uppercase">{{ \Carbon\Carbon::parse($client['debut'])->locale('fr')->isoFormat('dddd D MMMM YYYY') }} au <br>
                                                    {{ \Carbon\Carbon::parse($client['fin'])->locale('fr')->isoFormat('dddd D MMMM YYYY') }}</span></td>
                                                <td><span class="badge text-bg-info">{{$client['vues']}}</span></td>
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
                            {{ $clients->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                        <!--end modal -->
                    </div>
                </div>

            </div>
            <!--end col-->
        </div>
    @endsection
</x-app-layout>
