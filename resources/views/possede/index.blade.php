<x-app-layout>
    @section('name')
     Tout les paiements
    @endsection
    @section('title')
        Paiement
    @endsection

    @section('contenue')
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 text-nowrap">
                        <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label">Voir<select class="d-inline-block form-select form-select-sm">
                                    <option value="10" selected="">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>&nbsp;</label></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Recherche"></label></div>
                    </div>
                </div>
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0" id="dataTable">
                        <thead>
                            <tr>
                                <th>Tâche</th>
                                <th>Nom & Prénom</th>
                                <th>Email</th>
                                <th>Date de Paiement</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($paiements as $paiement )
                                <tr>
                                    <td><span class="badge text-bg-info">T{{$paiement->idTache}}
                                    </span></td>
                                    <td>{{$paiement->client->nom}} {{$paiement->client->prenom}}</td>
                                    <td><span class="badge text-bg-success">{{$paiement->client->email}}
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
                <div class="row">
                    <div class="col-md-6 align-self-center">
                        <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                    </div>
                    <div class="col-md-6">
                        <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                            <ul class="pagination">
                                <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
