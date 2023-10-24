<x-app-layout>
    @section('name')
        Les Tâches En cours
    @endsection
    @section('title')
        Tâche
    @endsection
    @section('contenue')
        <div class="row">
            <div class="col-md-3 text-nowrap py-3">
                <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                    <input type="search" class="form-control form-control-sm" aria-controls="dataTable"
                        id="myInput" onkeyup="myFunction()" placeholder="Rechercher Paiement...">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card" id="orderList">
                    <div class="card-body pt-0">
                        <div>
                            <div class="table-responsive table-card mb-1">
                                <table class="table table-nowrap align-middle" id="table_id">
                                    <thead class="text-muted table-light">
                                        <tr class="text-uppercase">
                                            <th>#</th>
                                            <th data-sort="status">N° Tâche</th>
                                            <th data-sort="id">Client</th>
                                            <th data-sort="customer_name">Période</th>
                                            <th data-sort="product_name">Vues Rechercher</th>
                                            <th data-sort="status">Status</th>
                                            <th data-sort="city">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @php
                                            $compteur = 1;
                                        @endphp
                                        @foreach ($taches as $tache)
                                            <tr>
                                                <td>{{ $compteur++ }}</td>
                                                <td class="status"><span class="badge badge-soft-primary text-uppercase">T{{$tache->idTache}}</span>
                                                </td>
                                                <td class="id"><a href="apps-ecommerce-order-details.html" class="fw-medium link-primary">{{$tache->tacheall->travailleur->nom}} {{$tache->tacheall->travailleur->prenom}}</td>
                                                <td class="customer_name">{{ \Carbon\Carbon::parse($tache->tacheall->debut)->locale('fr')->isoFormat('dddd D MMMM YYYY') }}
                                                    au <br> {{ \Carbon\Carbon::parse($tache->tacheall->fin)->locale('fr')->isoFormat('dddd D MMMM YYYY') }}</td>
                                                <td class="product_name"><span class="badge text-bg-success">{{$tache->tacheall->vueRecherche}}</span>
                                                </td>
                                                <td class="status"><span class="badge badge-soft-success text-uppercase">En cours</span>
                                                </td>
                                                <td>
                                                    <div class="dropdown d-inline-block">
                                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" >
                                                            <a class="dropdown-item edit-item-btn" href="{{route('showtache.influenceur', ['id' => $tache->idTache])}}" class="btn btn-warning">
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
                        </div>
                    </div>
                </div>

            </div>
            <!--end col-->
        </div>
    @endsection
</x-app-layout>
