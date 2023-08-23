<x-app-layout>
    @section('contenue')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Modal Data Datatables</h5>
                </div>
                <div class="card-body">
                    <table id="model-datatables" class="table table-bordered nowrap table-striped align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nom & Prénom</th>
                                <th>Période</th>
                                <th>Vues Rechercher</th>
                                <th>Type de fichier</th>
                                <th>Centres</th>
                                <th>Zones</th>
                                <th>N° Tâche</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($taches as $tache)
                                <tr>
                                    <td>{{$tache->nom}} {{$tache->prenom}}</td>
                                    <td>{{ strftime('%A %e %B %Y', strtotime($tache->debut)) }} à
                                        {{ strftime('%A %e %B %Y', strtotime($tache->fin)) }}
                                    </td>
                                    <td>{{$tache->vueRecherche}}</td>
                                    <td>{{$tache->tache_libelle}}</td>
                                    <td>
                                        {{$tache->centre}}
                                    </td>
                                    <td>{{$tache->pays}}
                                        {{$tache->villes}}
                                        {{$tache->departements}}
                                    </td>
                                    <td>T{{$tache->nbr}}</td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="{{route('attribuer.tache', ['id' => $tache->nbr,
                                                        'vues' =>$tache->vueRecherche, 'centre' =>$tache->idcentre,
                                                        'pay' => !empty($tache->idpays) ?  $tache->idpays: 0,
                                                        'dep' => !empty($tache->iddepartements) ? $tache->iddepartements : 0,
                                                        'vil' => !empty($tache->idvilles) ?  $tache->idvilles: 0])}}" class="btn btn-success">
                                                        <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>Valider
                                                    </a>
                                                <li>
                                                    <a class="dropdown-item edit-item-btn" href="{{route('showtache.client', ['id' => $tache->nbr])}}" class="btn btn-warning">
                                                        <i class="ri-eye-fill align-bottom me-2 text-muted"></i>Voir Plus
                                                    </a>
                                                </li>
                                                {{-- <li>
                                                    <a class="dropdown-item remove-item-btn">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                                    </a>
                                                </li> --}}
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!--end row-->
    @endsection
</x-app-layout>
