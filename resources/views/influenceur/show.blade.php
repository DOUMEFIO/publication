<x-app-layout>
    @section('name')
        Les Influenceurs
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
                    <table class="table my-0" id="dataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom & Prénom</th>
                                <th>Téléphone</th>
                                <th>Résidence</th>
                                <th>Centre D'Interet</th>
                                <th>Vues moyens</th>
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
                                    @if ($user->photpProfil)
                                    <td>
                                        <img class="rounded-circle me-2" src="{{asset('storage'.$user->type->photpProfil)}}" width="30" height="30">{{$user->type->nom}} {{$user->type->prenom}}
                                    </td>
                                    @else
                                    <td>
                                        <img class="rounded-circle me-2" src="{{asset('velson/images/users/user-dummy-img.jpg')}}" width="30" height="30">{{$user->type->nom}} {{$user->type->prenom}}
                                    </td>
                                    @endif
                                    <td style="text-align:center">{{$user->type->tel}}</td>
                                    <td>{{$user->residencepay->name}}, {{$user->residencedep->name}}, {{$user->residencevil->name}}</td>
                                    <td style="text-align:center">
                                        @foreach ($user->type->centres as $centre)
                                            {{$centre->libelle}},
                                        @endforeach
                                    </td>
                                    <td style="text-align:center">{{$user->nbr_vue_moyen}}</td>
                                    <td>
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" >
                                            <a class="dropdown-item edit-item-btn" href="{{route('showtacheallinfluenceur', ['id'=>$user->id_User])}}" class="btn btn-warning">
                                                <i class="ri-eye-fill align-bottom me-2 text-muted"></i>Voir Plus
                                            </a>
                                        </button>
                                    </td>
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
