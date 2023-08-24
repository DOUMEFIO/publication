<x-app-layout>
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
                    <form method="" action="" >
{{--                         @csrf
 --}}                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Modifier</strong></label>
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

        <div class="card shadow col-xl-6 mx-auto">
            <div class="row card-body">
                <div class="col md-6">
                    <p class="text-primary m-0 fw-bold">Centre Interet</p>
                </div>
                <div class="col md-6" style="padding-left: 100px">
                    <span class="odd px-5"><button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">AJOUTER</button>
                    </span>
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
                                <th>Nom du centre Interet</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($centreInterets as $centreInteret )
                                <tr>
                                    <td>{{$centreInteret->libelle}}</td>
                                    <td><button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2">MODIFIER</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><strong>Nom du centre Interet</strong></td>
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
    @endsection
</x-app-layout>
