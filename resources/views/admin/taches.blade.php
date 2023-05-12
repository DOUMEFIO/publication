<x-app-layout>
    @section('contenue')

    <div class="container-fluid">
        <div class="card shadow">
            <div class="row card-header">
                <div class="col md-9">
                    <p class="text-primary m-0 fw-bold">LES TACHES SOUMISES</p>
                </div>
                <div class="col md-3" style="padding-left: 600px">
                    <span class="odd px-0"><a href="#" class="btn btn-primary">AJOUTER UNE TACHE</a></span>
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
                                <th>Nom & Prénom</th>
                                <th>Début & Fin</th>
                                <th>Vues Rechercher</th>
                                <th>Type de fichier</th>
                                <th>Déscription</th>
                                <th>Centre</th>
                                <th>Zone</th>
                                <th>Média</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($taches as $tache)
                                <tr>
                                    <td>{{$tache->nom}} {{$tache->prenom}}</</td>
                                    <td>{{ strftime('%A %e %B %Y', strtotime($tache->debut)) }} à
                                        {{ strftime('%A %e %B %Y', strtotime($tache->fin)) }}
                                    </td>
                                    <td>{{$tache->vueRecherche}}</td>
                                    <td>{{$tache->tache_libelle}}</td>
                                    <td>{{$tache->description}}</td>
                                    <td>
                                        {{$tache->centre}}
                                    </td>
                                    <td>{{$tache->pays}}
                                        {{$tache->villes}}
                                        {{$tache->departements}}
                                    </td>
                                    <td>T{{$tache->nbr}}</td>
                                    <td>
                                        <a href="{{route('attribuer.tache', ['id' => $tache->nbr,
                                        'vues' =>$tache->vueRecherche, 'centre' =>$tache->idcentre,
                                        'pay' => !empty($tache->idpays) ?  $tache->idpays: 0,
                                        'dep' => !empty($tache->iddepartements) ? $tache->iddepartements : 0,
                                        'vil' => !empty($tache->idvilles) ?  $tache->idvilles: 0])}}" class="btn btn-success"><i class="fa fa-check"></i>Valider</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><strong>Nom & Prénom</strong></td>
                                <td><strong>Début & Fin</strong></td>
                                <td><strong>Vues Recherchées</strong></td>
                                <td><strong>Type de fichier</strong></td>
                                <td><strong>Déscription</strong></td>
                                <td><strong>Centre</strong></td>
                                <td><strong>Zone</strong></td>
                                <td><strong>Média</strong></td>
                                <td><strong>Action</strong></td>
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
