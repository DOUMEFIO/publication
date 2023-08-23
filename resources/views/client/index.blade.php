<x-app-layout>
    @section('contenue')

    <div class="container-fluid">
        <div class="card shadow">
            <div class="row card-body">
                <div class="col md-9">
                    <p class="text-primary m-0 fw-bold">LES TACHES SOUMISES</p>
                </div>
                <div class="col md-3" style="padding-left: 600px">
                    <span class="odd px-0"><a href="client.tache" class="btn btn-primary">AJOUTER UNE TACHE</a></span>
                </div>
            </div>
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
                        <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="Recherche..." class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                    </div>
                </div>
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0" id="dataTable">
                        <thead>
                            <tr>
                                <th>Période</th>
                                <th>Vues Rechercher</th>
                                <th>Type de fichier</th>
                                <th>Déscription</th>
                                <th>Centres</th>
                                <th>Zones</th>
                                <th>Médias</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($taches as $tache)
                                <tr>
                                    <td>{{ strftime('%A %e %B %Y', strtotime($tache->debut)) }} à
                                        {{ strftime('%A %e %B %Y', strtotime($tache->fin)) }}
                                    </td>
                                    <td>{{$tache->vueRecherche}}</td>
                                    <td>{{$tache->tache_libelle}}</td>
                                    <td>{{$tache->description}}</td>
                                    <td>{{$tache->centre}}</td>
                                    <td>{{$tache->pays}},
                                        {{$tache->departements}},
                                        {{$tache->villes}}
                                        </td>
                                    <td>Voir</td>
                                    <td>{{$tache->status_libelle}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><strong>Période</strong></td>
                                <td><strong>Vues Recherchées</strong></td>
                                <td><strong>Type de fichier</strong></td>
                                <td><strong>Déscription</strong></td>
                                <td><strong>Centres</strong></td>
                                <td><strong>Zones</strong></td>
                                <td><strong>Médias</strong></td>
                                <td><strong>Actions</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-6 align-self-center">
                        <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Trouver 1 to 10 of 27</p>
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
