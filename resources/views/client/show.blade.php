<x-app-layout>
    @section('name')
        Les Clients
    @endsection
    @section('title')
        Utilisateurs
    @endsection

    @section('contenue')
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-body">
                <div class="row py-3">
                    <div class="col-md-6 text-nowrap">
                        <div class="col-md-6 text-nowrap">
                            <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                <input type="search" class="form-control form-control-sm" aria-controls="dataTable"
                                    id="myInput" onkeyup="myFunction()" placeholder="Rechercher Tâche...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table table-nowrap align-middle dataTable" id="table_id">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom & Prénom</th>
                                <th>Email</th>
                                <th>Date de creation</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody >
                            @php
                                $compteur = 1;
                            @endphp
                            @foreach ($users as $user )
                                <tr>
                                    <td>{{ $compteur++ }}</td>
                                    <td>{{$user->nom}} {{$user->prenom}}</td>
                                    <td>{{$user->email}}</td>
                                    <td><span class="badge text-bg-success">
                                        {{ \Carbon\Carbon::parse($user->created_at)->locale('fr')->isoFormat('dddd D MMMM YYYY') }}
                                    </span></td>
                                    <td><button class="btn btn-soft-secondary btn-sm dropdown" type="button" >
                                        <a class="dropdown-item edit-item-btn" href="{{route('showtache.all', ['id' => $user->id])}}" class="btn btn-warning">
                                            <i class="ri-eye-fill align-bottom me-2 text-muted"></i>Voir Plus
                                        </a>
                                    </button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    {{ $users->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
