<x-app-layout>
    @section('contenue')

    <div class="container-fluid">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modifier la photo de profil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="user" method="POST" action="{{route('vuesrealise')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="tacheIdInput" readonly name="id">
                            <div class="mb-3">
                                <label class="form-label"><strong>Nombres vues Realisée</strong></label>
                                <input type="number" name="nbr_vue_moyen" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><strong>Capture</strong></label>
                                <input type="file" class="form-control" id="avatar" name="avatar">
                            </div>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow">
            <div class="row card-header">
                <div class="col md-9">
                    <p class="text-primary m-0 fw-bold">LES TACHES ATTRIBUEE</p>
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
                                <th>Tâches</th>
                                <th>Début & Fin</th>
                                <th>Fichier</th>
                                <th>Déscription</th>
                                <th>Média</th>
                                <th>Tâche Réaliser</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($taches as $tache)
                                <tr>
                                    <td>T{{$tache->idTache}}</td>
                                    <td>{{ strftime('%A %e %B %Y', strtotime($tache->tacheall->debut)) }} <br> à
                                        {{ strftime('%A %e %B %Y', strtotime($tache->tacheall->fin)) }}
                                    </td>
                                    <td>{{$tache->tacheall->type->libelle}}</td>
                                    <td>{{$tache->tacheall->description}}</td>
                                    <td>url</td>
                                    <td><button data-tacheid="{{$tache->id}}" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary btn-sm">Nbrs Vues Réalisée</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><strong>Tâches</strong></td>
                                <td><strong>Début & Fin</strong></td>
                                <td><strong>Fichier</strong></td>
                                <td><strong>Déscription</strong></td>
                                <td><strong>Média</strong></td>
                                <td><strong>Tâche Réaliser</strong></td>
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

<script>
    $(document).on('click', '.btn', function () {
            var tacheId = $(this).data('tacheid');
            document.getElementById('tacheIdInput').value = tacheId;
        });
</script>
