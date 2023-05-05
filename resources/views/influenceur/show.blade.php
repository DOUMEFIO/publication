<x-app-layout>
    @section('contenue')
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 fw-bold">Les Influenceurs</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 text-nowrap">
                        <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label">Show&nbsp;<select class="d-inline-block form-select form-select-sm">
                                    <option value="10" selected="">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>&nbsp;</label></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                    </div>
                </div>
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0" id="dataTable">
                        <thead>
                            <tr>
                                <th>Nom & Prénom</th>
                                <th>Téléphone</th>
                                <th>Résidence</th>
                                <th>Centre D'Interet</th>
                                <th>Vues moyens</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($users as $user )
                                <tr>
                                    <td>
                                        <img class="rounded-circle me-2" src="{{asset('template/assets/img/avatars/avatar1.jpeg')}}" width="30" height="30">{{$user->nom}} {{$user->prenom}}
                                    </td>
                                    <td style="text-align:center">{{$user->tel}}</td>
                                    <td>{{$user->pays}},{{$user->departement}}, {{$user->ville}}</td>
                                    <td style="text-align:center">{{$user->interests}}</td>
                                    <td style="text-align:center">{{$user->nbr_vue_moyen}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><strong>Nom & Prénom</strong></td>
                                <td><strong>Téléphone</strong></td>
                                <td><strong>Résidence</strong></td>
                                <td><strong>Centre D'Interet</strong></td>
                                <td><strong>Vues moyens</strong></td>
                            </tr>
                        </tfoot>
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
