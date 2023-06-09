<x-app-layout>
    @section('contenue')

    <div class="container-fluid">
        <div class="card shadow">
            <div class="row card-header">
                <div class="col md-9">
                    <p class="text-primary m-0 fw-bold">LES TACHES ATTRIBUES</p>
                </div>
                <div class="col md-3" style="padding-left: 600px">
                </div>
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
                                <th>#</th>
                                <th>Nom & Prénom</th>
                                <th>Début & Fin</th>
                                <th>Les Taches attribuer</th>
                                <th>Nombre de vues realisée</th>
                                <th>Capture</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($taches as $tache)
                                <tr>
                                    <td>{{$tache->id}}</td>
                                    <td>{{$tache->travailleur->nom}}
                                        {{$tache->travailleur->prenom}}
                                    </td>
                                    <td>
                                        {{ strftime('%A %e %B %Y', strtotime($tache->tacheall->debut)) }} à
                                        {{ strftime('%A %e %B %Y', strtotime($tache->tacheall->fin)) }}
                                    </td>
                                    <td>T{{$tache->idTache}}</td>
                                    <td>0</td>
                                    <td>Pas encore</td>
                                    <td>Modifier</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><strong>#</strong></td></th>
                                <td><strong>Nom & Prénom</strong></td></th>
                                <td><strong>Début & Fin</strong></td></th>
                                <td><strong>Les Taches attribuer</strong></td></th>
                                <td><strong>Nombre de vues realisée</strong></td></th>
                                <td><strong>Capture</strong></td></th>
                                <td><strong>Action</strong></td></th>
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
