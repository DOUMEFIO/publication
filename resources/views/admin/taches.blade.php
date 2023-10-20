<x-app-layout>
    @section('name')
        Toutes les Tâches
    @endsection
    @section('title')
        Tâches
    @endsection
    @section('contenue')
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-body pt-0">
                    <div>
                        <div class="table-responsive table-card mb-1">
                            @if(session()->has('info'))
                                <div class="alert alert-danger"> {!! session('info') !!}</div>
                            @endif
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
                            <table class="table table-nowrap align-middle dataTable" id="table_id">
                                <thead class="text-muted table-light">
                                    <tr class="text-uppercase">
                                        <th>#</th>
                                        <th data-sort="customer_name"> N° Tâche</th>
                                        <th > Client</th>
                                        <th >Période </th>
                                        <th >Vues Rechercher</th>
                                        <th >Status</th>
                                        <th >Réalisation</th>
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @php
                                        $compteur = 1;
                                    @endphp
                                    @foreach ($taches as $tache)
                                        <tr>
                                            <td>{{ $compteur++ }}</td>
                                            <td class="customer_name"><span class="badge badge-soft-primary text-uppercase">T{{$tache->id}}</span>
                                            </td>
                                            <td class="">{{$tache->travailleur->nom}} {{$tache->travailleur->prenom}}</td>
                                            <td class="">{{ \Carbon\Carbon::parse($tache->debut)->locale('fr')->isoFormat('dddd D MMMM YYYY') }} au <br>
                                                                      {{ \Carbon\Carbon::parse($tache->fin)->locale('fr')->isoFormat('dddd D MMMM YYYY') }}</td>
                                            <td class="product_name"><span class="badge badge-soft-primary text-uppercase">{{$tache->vueRecherche}}</span></td>
                                            @if ($tache->status->libelle == "Valide")
                                                <td class="status"><span class="badge badge-soft-success text-uppercase">Validée</span>
                                                </td>
                                            @else
                                                <td class="status"><span class="badge badge-soft-warning text-uppercase">Non Validée</span>
                                                </td>
                                            @endif
                                            @if ($tache->realisation ==  "Non Exécuter")
                                                <td class="status"><span class="badge badge-soft-danger text-uppercase">{{$tache->realisation}}</span>
                                                </td>
                                            @elseif ($tache->realisation ==  "Vues Non Atteint")
                                                <td class="status"><span class="badge badge-soft-warning text-uppercase">{{$tache->realisation}}</span>
                                                </td>
                                            @else
                                                <td class="status"><span class="badge badge-soft-success text-uppercase">{{$tache->realisation}}</span>
                                                </td>
                                            @endif
                                            <td>
                                                <div class="dropdown d-inline-block">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" >
                                                        <a class="dropdown-item edit-item-btn" href="{{route('showtache.client', ['id' => $tache->id])}}" class="btn btn-warning">
                                                            <i class="ri-eye-fill align-bottom me-2 text-muted"></i>Voir Plus
                                                        </a>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            {{ $taches->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>

    @endsection
</x-app-layout>
