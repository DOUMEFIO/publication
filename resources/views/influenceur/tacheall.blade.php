<x-app-layout>
    @section('name')
        Tâches 
    @endsection
    @section('title')
        Toutes Tâche
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
                                            <th data-sort="id">Client</th>
                                            <th data-sort="customer_name">Période</th>
                                            <th data-sort="product_name">Vues Rechercher</th>
                                            <th data-sort="status">Status</th>
                                            <th data-sort="city">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($taches as $tache)
                                            <tr>
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
                                <div class="noresult" style="display: none">
                                    <div class="text-center">
                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                                        <h5 class="mt-2">Sorry! No Result Found</h5>
                                        <p class="text-muted">We've searched more than 150+ Orders We did not find any orders for you search.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <div class="pagination-wrap hstack gap-2">
                                    <a class="page-item pagination-prev disabled" href="#">
                                        Previous
                                    </a>
                                    <ul class="pagination listjs-pagination mb-0"></ul>
                                    <a class="page-item pagination-next" href="#">
                                        Next
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--end col-->
        </div>
    @endsection
</x-app-layout>
