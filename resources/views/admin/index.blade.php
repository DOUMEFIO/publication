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
            <div class="card-body">
                <div class="row py-3">
                    <div class="col-md-6 text-nowrap">
                        <div class="col-md-6 text-nowrap">
                            <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                <input type="search" class="form-control form-control-sm" aria-controls="dataTable"
                                    id="myInput" onkeyup="myFunction()" placeholder="Rechercher Centre...">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center" style="float: right" >
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">AJOUTER</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0" id="table_id">
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
            </div>
            <div class="d-flex justify-content-end">
                {{ $centreInterets->onEachSide(1)->links('pagination::bootstrap-4') }}
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
