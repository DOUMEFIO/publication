<x-app-layout>
    @section('name')
        Client
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
                                                    @if ($taches[0]->travailleur->photpProfil)
                                                        <div class="avatar-title bg-white rounded-circle">
                                                            <img src="{{asset('storage'.$taches[0]->travailleur->photpProfil)}}" alt="" class="avatar-xs">
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
                                                    <h4 class="fw-bold">{{$taches[0]->travailleur->nom}} {{$taches[0]->travailleur->prenom}}</h4>
                                                    <div class="hstack gap-3 flex-wrap">
                                                        <div>Créer le : <span class="fw-medium">{{ \Carbon\Carbon::parse($taches[0]->travailleur->created_at)->locale('fr')->isoFormat('dddd D MMMM YYYY') }}
                                                        </span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="hstack gap-1 flex-wrap">
                                            <button type="button" class="btn py-0 fs-16 favourite-btn active">
                                                <i class="ri-star-fill"></i>
                                            </button>
                                            <button type="button" class="btn py-0 fs-16 text-body">
                                                <i class="ri-share-line"></i>
                                            </button>
                                            <button type="button" class="btn py-0 fs-16 text-body">
                                                <i class="ri-flag-line"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link fw-semibold active" data-bs-toggle="tab" href="#project-overview" role="tab" aria-selected="true">
                                            Profil
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#project-documents" role="tab" aria-selected="false" tabindex="-1">
                                            Tâches
                                        </a>
                                    </li>
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
                                                                <td class="text-muted">{{$taches[0]->travailleur->nom}} {{$taches[0]->travailleur->prenom}}</td>
                                                            </tr>

                                                            <tr>
                                                                <th class="ps-0" scope="row">Email :</th>
                                                                <td class="text-muted">{{$taches[0]->travailleur->email}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card body -->
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
                                                            <th scope="col">Période</th>
                                                            <th scope="col">Vues Rechercher</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col" style="width: 120px;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($taches as $tache)
                                                            <tr>
                                                                <td>T{{$tache->id}}</td>
                                                                <td><span class="badge text-bg-success">{{ \Carbon\Carbon::parse($tache->debut)->locale('fr')->isoFormat('dddd D MMMM YYYY') }} au <br>
                                                                    {{ \Carbon\Carbon::parse($tache->fin)->locale('fr')->isoFormat('dddd D MMMM YYYY') }} </span></td>
                                                                <td><span class="badge text-bg-primary">{{$tache->vueRecherche}}</span></td>
                                                                @if ($tache->status->libelle == "Valide")
                                                                    <td class="status"><span class="badge badge-soft-success text-uppercase">Validée</span>
                                                                    </td>
                                                                @else
                                                                    <td class="status"><span class="badge badge-soft-warning text-uppercase">Non Validée</span>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end tab pane -->
                        <div class="tab-pane fade" id="project-team" role="tabpanel">
                            <div class="row g-4 mb-3">
                                <div class="col-sm">
                                    <div class="d-flex">
                                        <div class="search-box me-2">
                                            <input type="text" class="form-control" placeholder="Search member...">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <div>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#inviteMembersModal"><i class="ri-share-line me-1 align-bottom"></i> Invite Member</button>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="team-list list-view-filter">
                                <div class="card team-box">
                                    <div class="card-body px-4">
                                        <div class="row align-items-center team-row">
                                            <div class="col team-settings">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <div class="flex-shrink-0 me-2">
                                                            <button type="button" class="btn fs-16 p-0 favourite-btn">
                                                                <i class="ri-star-fill"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="col text-end dropdown">

                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="team-profile-img">
                                                    <div class="avatar-lg img-thumbnail rounded-circle">
                                                        <img src="assets/images/users/avatar-2.jpg" alt="" class="img-fluid d-block rounded-circle">
                                                    </div>
                                                    <div class="team-content">
                                                        <a href="#" class="d-block">
                                                            <h5 class="fs-16 mb-1">Nancy Martino</h5>
                                                        </a>
                                                        <p class="text-muted mb-0">Team Leader &amp; HR</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="row text-muted text-center">
                                                    <div class="col-6 border-end border-end-dashed">
                                                        <h5 class="mb-1">225</h5>
                                                        <p class="text-muted mb-0">Projects</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="mb-1">197</h5>
                                                        <p class="text-muted mb-0">Tasks</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col">
                                                <div class="text-end">
                                                    <a href="pages-profile.html" class="btn btn-light view-btn">View Profile</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end card-->
                                <div class="card team-box">
                                    <div class="card-body px-4">
                                        <div class="row align-items-center team-row">
                                            <div class="col team-settings">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <div class="flex-shrink-0 me-2">
                                                            <button type="button" class="btn fs-16 p-0 favourite-btn active">
                                                                <i class="ri-star-fill"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="col text-end dropdown">
                                                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill fs-17"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="team-profile-img">
                                                    <div class="avatar-lg img-thumbnail rounded-circle">
                                                        <div class="avatar-title bg-soft-danger text-danger rounded-circle">
                                                            HB
                                                        </div>
                                                    </div>
                                                    <div class="team-content">
                                                        <a href="#" class="d-block">
                                                            <h5 class="fs-16 mb-1">Henry Baird</h5>
                                                        </a>
                                                        <p class="text-muted mb-0">Full Stack Developer</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="row text-muted text-center">
                                                    <div class="col-6 border-end border-end-dashed">
                                                        <h5 class="mb-1">352</h5>
                                                        <p class="text-muted mb-0">Projects</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="mb-1">376</h5>
                                                        <p class="text-muted mb-0">Tasks</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col">
                                                <div class="text-end">
                                                    <a href="pages-profile.html" class="btn btn-light view-btn">View Profile</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end card-->
                                <div class="card team-box">
                                    <div class="card-body px-4">
                                        <div class="row align-items-center team-row">
                                            <div class="col team-settings">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <div class="flex-shrink-0 me-2">
                                                            <button type="button" class="btn fs-16 p-0 favourite-btn active">
                                                                <i class="ri-star-fill"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="col text-end dropdown">
                                                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill fs-17"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="team-profile-img">
                                                    <div class="avatar-lg img-thumbnail rounded-circle">
                                                        <img src="assets/images/users/avatar-3.jpg" alt="" class="img-fluid d-block rounded-circle">
                                                    </div>
                                                    <div class="team-content">
                                                        <a href="#" class="d-block">
                                                            <h5 class="fs-16 mb-1">Frank Hook</h5>
                                                        </a>
                                                        <p class="text-muted mb-0">Project Manager</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="row text-muted text-center">
                                                    <div class="col-6 border-end border-end-dashed">
                                                        <h5 class="mb-1">164</h5>
                                                        <p class="text-muted mb-0">Projects</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="mb-1">182</h5>
                                                        <p class="text-muted mb-0">Tasks</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col">
                                                <div class="text-end">
                                                    <a href="pages-profile.html" class="btn btn-light view-btn">View Profile</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end card-->
                                <div class="card team-box">
                                    <div class="card-body px-4">
                                        <div class="row align-items-center team-row">
                                            <div class="col team-settings">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <div class="flex-shrink-0 me-2">
                                                            <button type="button" class="btn fs-16 p-0 favourite-btn">
                                                                <i class="ri-star-fill"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="col text-end dropdown">
                                                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill fs-17"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="team-profile-img">
                                                    <div class="avatar-lg img-thumbnail rounded-circle">
                                                        <img src="assets/images/users/avatar-8.jpg" alt="" class="img-fluid d-block rounded-circle">
                                                    </div>
                                                    <div class="team-content">
                                                        <a href="#" class="d-block">
                                                            <h5 class="fs-16 mb-1">Jennifer Carter</h5>
                                                        </a>
                                                        <p class="text-muted mb-0">UI/UX Designer</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="row text-muted text-center">
                                                    <div class="col-6 border-end border-end-dashed">
                                                        <h5 class="mb-1">225</h5>
                                                        <p class="text-muted mb-0">Projects</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="mb-1">197</h5>
                                                        <p class="text-muted mb-0">Tasks</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col">
                                                <div class="text-end">
                                                    <a href="pages-profile.html" class="btn btn-light view-btn">View Profile</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end card-->
                                <div class="card team-box">
                                    <div class="card-body px-4">
                                        <div class="row align-items-center team-row">
                                            <div class="col team-settings">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <div class="flex-shrink-0 me-2">
                                                            <button type="button" class="btn fs-16 p-0 favourite-btn">
                                                                <i class="ri-star-fill"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="col text-end dropdown">
                                                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill fs-17"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="team-profile-img">
                                                    <div class="avatar-lg img-thumbnail rounded-circle">
                                                        <div class="avatar-title bg-soft-success text-success rounded-circle">
                                                            ME
                                                        </div>
                                                    </div>
                                                    <div class="team-content">
                                                        <a href="#" class="d-block">
                                                            <h5 class="fs-16 mb-1">Megan Elmore</h5>
                                                        </a>
                                                        <p class="text-muted mb-0">Team Leader &amp; Web Developer</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="row text-muted text-center">
                                                    <div class="col-6 border-end border-end-dashed">
                                                        <h5 class="mb-1">201</h5>
                                                        <p class="text-muted mb-0">Projects</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="mb-1">263</h5>
                                                        <p class="text-muted mb-0">Tasks</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col">
                                                <div class="text-end">
                                                    <a href="pages-profile.html" class="btn btn-light view-btn">View Profile</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end card-->
                                <div class="card team-box">
                                    <div class="card-body px-4">
                                        <div class="row align-items-center team-row">
                                            <div class="col team-settings">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <div class="flex-shrink-0 me-2">
                                                            <button type="button" class="btn fs-16 p-0 favourite-btn">
                                                                <i class="ri-star-fill"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="col text-end dropdown">
                                                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill fs-17"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="team-profile-img">
                                                    <div class="avatar-lg img-thumbnail rounded-circle">
                                                        <img src="assets/images/users/avatar-4.jpg" alt="" class="img-fluid d-block rounded-circle">
                                                    </div>
                                                    <div class="team-content">
                                                        <a href="#" class="d-block">
                                                            <h5 class="fs-16 mb-1">Alexis Clarke</h5>
                                                        </a>
                                                        <p class="text-muted mb-0">Backend Developer</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="row text-muted text-center">
                                                    <div class="col-6 border-end border-end-dashed">
                                                        <h5 class="mb-1">132</h5>
                                                        <p class="text-muted mb-0">Projects</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="mb-1">147</h5>
                                                        <p class="text-muted mb-0">Tasks</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col">
                                                <div class="text-end">
                                                    <a href="pages-profile.html" class="btn btn-light view-btn">View Profile</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end card-->
                                <div class="card team-box">
                                    <div class="card-body px-4">
                                        <div class="row align-items-center team-row">
                                            <div class="col team-settings">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <div class="flex-shrink-0 me-2">
                                                            <button type="button" class="btn fs-16 p-0 favourite-btn">
                                                                <i class="ri-star-fill"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="col text-end dropdown">
                                                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill fs-17"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="team-profile-img">
                                                    <div class="avatar-lg img-thumbnail rounded-circle">
                                                        <div class="avatar-title bg-soft-info text-info rounded-circle">
                                                            NC
                                                        </div>
                                                    </div>
                                                    <div class="team-content">
                                                        <a href="#" class="d-block">
                                                            <h5 class="fs-16 mb-1">Nathan Cole</h5>
                                                        </a>
                                                        <p class="text-muted mb-0">Front-End Developer</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="row text-muted text-center">
                                                    <div class="col-6 border-end border-end-dashed">
                                                        <h5 class="mb-1">352</h5>
                                                        <p class="text-muted mb-0">Projects</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="mb-1">376</h5>
                                                        <p class="text-muted mb-0">Tasks</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col">
                                                <div class="text-end">
                                                    <a href="pages-profile.html" class="btn btn-light view-btn">View Profile</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end card-->
                                <div class="card team-box">
                                    <div class="card-body px-4">
                                        <div class="row align-items-center team-row">
                                            <div class="col team-settings">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <div class="flex-shrink-0 me-2">
                                                            <button type="button" class="btn fs-16 p-0 favourite-btn">
                                                                <i class="ri-star-fill"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="col text-end dropdown">
                                                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill fs-17"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="team-profile-img">
                                                    <div class="avatar-lg img-thumbnail rounded-circle">
                                                        <img src="assets/images/users/avatar-7.jpg" alt="" class="img-fluid d-block rounded-circle">
                                                    </div>
                                                    <div class="team-content">
                                                        <a href="#" class="d-block">
                                                            <h5 class="fs-16 mb-1">Joseph Parker</h5>
                                                        </a>
                                                        <p class="text-muted mb-0">Team Leader &amp; HR</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="row text-muted text-center">
                                                    <div class="col-6 border-end border-end-dashed">
                                                        <h5 class="mb-1">64</h5>
                                                        <p class="text-muted mb-0">Projects</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="mb-1">93</h5>
                                                        <p class="text-muted mb-0">Tasks</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col">
                                                <div class="text-end">
                                                    <a href="pages-profile.html" class="btn btn-light view-btn">View Profile</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end card-->
                                <div class="card team-box">
                                    <div class="card-body px-4">
                                        <div class="row align-items-center team-row">
                                            <div class="col team-settings">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <div class="flex-shrink-0 me-2">
                                                            <button type="button" class="btn fs-16 p-0 favourite-btn">
                                                                <i class="ri-star-fill"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="col text-end dropdown">
                                                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill fs-17"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="team-profile-img">
                                                    <div class="avatar-lg img-thumbnail rounded-circle">
                                                        <img src="assets/images/users/avatar-5.jpg" alt="" class="img-fluid d-block rounded-circle">
                                                    </div>
                                                    <div class="team-content">
                                                        <a href="#" class="d-block">
                                                            <h5 class="fs-16 mb-1">Erica Kernan</h5>
                                                        </a>
                                                        <p class="text-muted mb-0">Web Designer</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="row text-muted text-center">
                                                    <div class="col-6 border-end border-end-dashed">
                                                        <h5 class="mb-1">345</h5>
                                                        <p class="text-muted mb-0">Projects</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="mb-1">298</h5>
                                                        <p class="text-muted mb-0">Tasks</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col">
                                                <div class="text-end">
                                                    <a href="pages-profile.html" class="btn btn-light view-btn">View Profile</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end card-->
                                <div class="card team-box">
                                    <div class="card-body px-4">
                                        <div class="row align-items-center team-row">
                                            <div class="col team-settings">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <div class="flex-shrink-0 me-2">
                                                            <button type="button" class="btn fs-16 p-0 favourite-btn">
                                                                <i class="ri-star-fill"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="col text-end dropdown">
                                                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill fs-17"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="team-profile-img">
                                                    <div class="avatar-lg img-thumbnail rounded-circle">
                                                        <div class="avatar-title border bg-light text-primary rounded-circle">
                                                            DP
                                                        </div>
                                                    </div>
                                                    <div class="team-content">
                                                        <a href="#" class="d-block">
                                                            <h5 class="fs-16 mb-1">Donald Palmer</h5>
                                                        </a>
                                                        <p class="text-muted mb-0">Wed Developer</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="row text-muted text-center">
                                                    <div class="col-6 border-end border-end-dashed">
                                                        <h5 class="mb-1">97</h5>
                                                        <p class="text-muted mb-0">Projects</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="mb-1">135</h5>
                                                        <p class="text-muted mb-0">Tasks</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col">
                                                <div class="text-end">
                                                    <a href="pages-profile.html" class="btn btn-light view-btn">View Profile</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end card-->
                            </div>
                            <!-- end team list -->

                            <div class="row g-0 text-center text-sm-start align-items-center mb-3">
                                <div class="col-sm-6">
                                    <div>
                                        <p class="mb-sm-0">Showing 1 to 10 of 12 entries</p>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-sm-6">
                                    <ul class="pagination pagination-separated justify-content-center justify-content-sm-end mb-sm-0">
                                        <li class="page-item disabled"> <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a> </li>
                                        <li class="page-item"> <a href="#" class="page-link">1</a> </li>
                                        <li class="page-item active"> <a href="#" class="page-link">2</a> </li>
                                        <li class="page-item"> <a href="#" class="page-link">3</a> </li>
                                        <li class="page-item"> <a href="#" class="page-link">4</a> </li>
                                        <li class="page-item"> <a href="#" class="page-link">5</a> </li>
                                        <li class="page-item"> <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a> </li>
                                    </ul>
                                </div><!-- end col -->
                            </div><!-- end row -->
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
