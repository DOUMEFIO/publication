<x-app-layout>
    @section('name')
        Les centres d'interets
    @endsection
    @section('title')
        Les centres d'interets
    @endsection
    @section('contenue')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" action="{{route('centre.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Nom du centre d'interet</strong></label>
                                    <input style="font-size: 15px" type="text" name="libelle" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group " >
                            <div class="row">
                                <div class="col md-5" style="text-align: right">
                                    <button class="btn btn-primary btn-sm" type="submit">Soumettre</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" action="{{route('editcentre')}}" >
                       @csrf
                       <input type="hidden" id="tacheIdInput" name="id">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Modifier</strong></label>
                                    <input style="font-size: 15px" type="text" id="libelle" name="libelle" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group " >
                            <div class="row">
                                <div class="col md-5" style="text-align: right">
                                    <button class="btn btn-primary btn-sm" type="submit">Soumettre</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <div class="card shadow col-xl mx-auto">
            @if (session('info'))
                <div class="alert alert-success">
                    {{ session('info') }}
                </div>
            @endif
            <div class="row card-body" style="float: right;">
                <span class="odd px-1">
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">AJOUTER</button>
                </span>
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
                        <div class="text-md-end dataTables_filter" id="dataTable_filter">
                            <label class="form-label">
                                <input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Recherche">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0" id="dataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Centre Interet</th>
                                <th>Date de creation</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody >
                            @php
                                $compteur = 1;
                            @endphp
                            @foreach ($centreInterets as $centreInteret )
                                <tr>
                                    <td>{{ $compteur++ }}</td>
                                    <td>{{$centreInteret->libelle}}</td>
                                    <td><span class="badge text-bg-success">{{ \Carbon\Carbon::parse($centreInteret->created_at)->locale('fr')->isoFormat('dddd D MMMM YYYY') }}</span></td>
                                    <td><button class="btn btn-secondary" type="button" onclick="showModal('{{$centreInteret->id}}','{{$centreInteret->libelle}}')">MODIFIER</button></td>
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
        <button style="display: none" id="triggerModal" class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2"></button>
    @endsection
    @push('scripts')
        <script>
            function showModal(id, ids){
                $('#tacheIdInput',).val(id);
                $('#triggerModal').trigger('click')
                $('#libelle').val(ids);
                $('#triggerModal').trigger('click')
            }
        </script>
    @endpush
</x-app-layout>
