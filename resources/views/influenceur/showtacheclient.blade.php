<x-app-layout>
    @section('name')
        Influenceur
    @endsection

    @section('contenue')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-n4 mx-n4">
                    <div class="bg-soft-warning">
                        <div class="card-body pb-0 px-4">
                            <div class="row mb-3">
                                <div class="col-md">
                                    <div class="row align-items-center g-3">
                                        <div class="col-md-auto">
                                            <div class="avatar-md">
                                                @if ($influenceurs[0]->type->photpProfil)
                                                        <div class="avatar-title bg-white rounded-circle">
                                                            <img src="{{asset('storage'.$influenceurs[0]->type->photpProfil)}}" alt="" class="avatar-xs">
                                                        </div>
                                                    @else
                                                        <div class="avatar-title bg-white rounded-circle">
                                                            <img src="{{asset('velson/images/users/user-dummy-img.jpg')}}" alt="" class="avatar-xs">
                                                        </div>
                                                    @endif
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div>
                                                <h4 class="fw-bold">{{$influenceurs[0]->type->nom}} {{$influenceurs[0]->type->prenom}}</h4>
                                                <div class="hstack gap-3 flex-wrap">
                                                    <div>Créer le : <span class="fw-medium">{{ \Carbon\Carbon::parse($influenceurs[0]->type->created_at)->locale('fr')->isoFormat('dddd D MMMM YYYY') }}
                                                    </span></div>
                                                    <div class="vr"></div>
                                                    <div>Pays : <span class="fw-medium">{{$influenceurs[0]->residencepay->name}}
                                                    </span></div>
                                                    <div class="vr"></div>
                                                    <div>Departement : <span class="fw-medium">{{$influenceurs[0]->residencedep->name}}
                                                    </span></div>
                                                    <div class="vr"></div>
                                                    <div>Ville : <span class="fw-medium">{{$influenceurs[0]->residencevil->name}}
                                                    </span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link fw-semibold active" data-bs-toggle="tab" href="#project-overview" role="tab" aria-selected="true">
                                        Profil
                                    </a>
                                </li>
                                @if (Auth::user()->idProfil == 1)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#project-documents" role="tab" aria-selected="false" tabindex="-1">
                                            Tâches
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="tab-content text-muted">
                    <div class="tab-pane fade active show" id="project-overview" role="tabpanel">
                        <div class="row">
                            <div class="col-xl-12 col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-muted">
                                            <h5 class="card-title mb-3">Profil</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-borderless mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Client :</th>
                                                                <td class="text-muted">{{$influenceurs[0]->type->nom}} {{$influenceurs[0]->type->prenom}}</td>
                                                            </tr>

                                                            <tr>
                                                                <th class="ps-0" scope="row">Email :</th>
                                                                <td class="text-muted">{{$influenceurs[0]->type->email}}</td>
                                                            </tr>

                                                            <tr>
                                                                <th class="ps-0" scope="row">Pays :</th>
                                                                <td class="text-muted">{{$influenceurs[0]->residencepay->name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Departement :</th>
                                                                <td class="text-muted">{{$influenceurs[0]->residencedep->name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Ville :</th>
                                                                <td class="text-muted">{{$influenceurs[0]->residencevil->name}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Centres D'Interets</h5>
                                        <div class="d-flex flex-wrap gap-2 fs-15">
                                            @foreach ($centres as $centre)
                                                <span class="badge badge-soft-primary">{{$centre->centre->libelle}}</span>
                                            @endforeach
                                        </div>
                                    </div><!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end tab pane -->
                    <div class="tab-pane fade" id="project-documents" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <h5 class="card-title flex-grow-1">Tâches</h5>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-responsive table-card">
                                            <table class="table table-borderless align-middle mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col">N° Tâche</th>
                                                        <th scope="col">Nom & Prénom</th>
                                                        <th scope="col">Période</th>
                                                        <th scope="col">Vues Rechercher</th>
                                                        <th scope="col">Vues Réaliser</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Réalisation</th>
                                                        <th scope="col" style="width: 120px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($taches as $tache)
                                                        <tr>
                                                            <td>T{{$tache->idTache}}</td>
                                                            <td>{{$tache->infotache->travailleur->nom}} {{$tache->infotache->travailleur->prenom}}</td>
                                                            <td><span class="badge text-bg-success">{{ \Carbon\Carbon::parse($tache->infotache->debut)->locale('fr')->isoFormat('dddd D MMMM YYYY') }} au <br>
                                                                {{ \Carbon\Carbon::parse($tache->infotache->fin)->locale('fr')->isoFormat('dddd D MMMM YYYY') }} </span></td>
                                                                <td><span class="badge text-bg-primary">{{$tache->totalVues}}</span></td>
                                                            <td><span class="badge text-bg-primary">{{$tache->infotache->vueRecherche}}</span></td>
                                                            <td><span class="badge text-bg-info">{{$tache->infotache->status->libelle}}</span></td>
                                                            <td><span class="badge text-bg-info">{{$tache->infotache->realisation}}</span></td>
                                                            <td>
                                                                <div class="dropdown d-inline-block">
                                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" >
                                                                        @if (Auth::user()->idProfil == 1)
                                                                            <a class="dropdown-item edit-item-btn" href="{{route('showtache.client', ['id' => $tache->idTache])}}" class="btn btn-warning">
                                                                                <i class="ri-eye-fill align-bottom me-2 text-muted"></i>Voir Plus
                                                                            </a>
                                                                        @else
                                                                            <a class="dropdown-item edit-item-btn" href="{{route('showtache.influenceur', ['id' => $tache->idTache])}}" class="btn btn-warning">
                                                                                <i class="ri-eye-fill align-bottom me-2 text-muted"></i>Voir Plus
                                                                            </a>
                                                                        @endif
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end tab pane -->
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    @endsection
</x-app-layout>
