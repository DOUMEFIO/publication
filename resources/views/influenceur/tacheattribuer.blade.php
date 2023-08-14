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
                        <form class="user" method="POST" action="{{route('updatevues')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="text" value="" name="id" id="tacheIdInput">
                            <div class="mb-3">
                                <label class="form-label"><strong>Nombres vues Realisée</strong></label>
                                <input type="number" value="" name="nbr_vue_moyen" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><strong>Capture</strong></label>
                                <input type="file" class="form-control" id="avatar" name="avatar" value="">
                            </div>
                            <button type="submit" id="submitModal" class="btn btn-primary">Enregistrer</button>
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
                @if (session('info'))
                        <div class="alert alert-success">
                            {{ session('info') }}
                        </div>
                    @endif
                <div class="col md-9">
                    <p class="text-primary m-0 fw-bold">LES TÂCHES ATTRIBUÉES</p>
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
                                <th>Période</th>
                                <th>Fichier</th>
                                <th>Déscription</th>
                                <th>Médias</th>
                                <th>Vues Réalisées</th>
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
                                    <td></td>
{{--                                <td><button onclick="showModal({{$tache->idTache}})" class="btn btn-primary btn-sm" type="button" >Nbrs Vues Réalisée</button></td>
 --}}                               <td><a class="btn btn-primary btn-sm" href="{{ route('vuesrealise', ['id' => $tache->idTache]) }}">Nbrs Vues Réalisées</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><strong>Tâches</strong></td>
                                <td><strong>Période</strong></td>
                                <td><strong>Fichier</strong></td>
                                <td><strong>Déscription</strong></td>
                                <td><strong>Médias</strong></td>
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
    <button id="triggerModal" class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"></button>
    @endsection
</x-app-layout>
@push('scripts')
    <script>
        function showModal(id){
            $('#tacheIdInput').val(id);
            $('#triggerModal').trigger('click')
        }
    </script>
@endpush