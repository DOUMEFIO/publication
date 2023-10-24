
<x-app-layout>
    @section('name')
        Les Tâches Validées
    @endsection
    @section('title')
        Tâches
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
                                        <th data-sort="id"> N° Tâche</th>
                                        <th data-sort="customer_name"> Nom & Prénom</th>
                                        <th data-sort="product_name">Période </th>
                                        <th data-sort="status">Vues Rechercher</th>
                                        <th data-sort="status">Status</th>
                                        <th data-sort="status">Réalisation</th>
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
                                            <td class="status"><span class="badge badge-soft-primary text-uppercase">T{{$tache->tacheid}}</span>
                                            </td>
                                            <td class="id"><a href="apps-ecommerce-order-details.html" class="fw-medium link-primary">{{$tache->nom}} {{$tache->prenom}}</td>
                                            <td class="customer_name">{{ strftime('%A %e %B %Y', strtotime($tache->debut)) }} à </br>
                                                {{ strftime('%A %e %B %Y', strtotime($tache->fin)) }}</td>
                                            <td class="product_name"><span class="badge badge-soft-primary text-uppercase">{{$tache->vueRecherche}}</span></td>
                                            @if ($tache->status_libelle == "Valide")
                                                <td class="status"><span class="badge badge-soft-success text-uppercase">Validée</span>
                                                </td>
                                            @else
                                                <td class="status"><span class="badge badge-soft-warning text-uppercase">Non Validée</span>
                                                </td>
                                            @endif
                                            @if ($tache->realisation ==  "Non Exécuter")
                                                <td class="status"><span class="badge badge-soft-danger text-uppercase">{{$tache->realisation}}</span>
                                                </td>
                                            @elseif ($tache->realisation ==  "Vues Non Atteint")
                                                <td class="status"><span class="badge badge-soft-warning text-uppercase">{{$tache->realisation}}</span>
                                                </td>
                                            @else
                                                <td class="status"><span class="badge badge-soft-success text-uppercase">{{$tache->realisation}}</span>
                                                </td>
                                            @endif
                                            <td>
                                                <div class="dropdown d-inline-block">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" >
                                                        <a class="dropdown-item edit-item-btn" href="{{route('showtache.client', ['id' => $tache->tacheid])}}" class="btn btn-warning">
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
                    <!--end modal -->
                </div>
            </div>

        </div>
        <!--end col-->
    </div>

    @endsection
</x-app-layout>
