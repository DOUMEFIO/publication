<x-app-layout>
    @section('name')
        Tâches
    @endsection
    @section('name')
        Tâches
    @endsection
    @section('contenue')

    <div class="container-fluid">
        <div class="profile-foreground position-relative mx-n4 mt-n4">
            <div class="profile-wid-bg">
                <img src="{{asset('velson/images/profile-bg.jpg')}}" alt="" class="profile-wid-img">
            </div>
        </div>
        <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
            <div class="row g-4">
                <div class="col-auto">
                    <div class="avatar-lg" style="width: 100px;height: 100px;background-color: #3498db;
                    border-radius: 50%;display: flex;justify-content: center;align-items: center;
                    font-size: 80px;color: white;font-weight: bold;">
                        <span>T</span>
                    </div>
                </div>
                <!--end col-->
                <div class="col">
                    <div class="p-2">
                        <h3 class="text-white mb-1">{{$clients[0]["idTache"]}}</h3>
                        <span class="badge text-bg-success">{{$clients[0]["status"]}}</span>
                        <div class="hstack text-white-50 gap-1">
                            <div class="me-2"><i class="ri-calendar-check-line me-1 text-white-75 fs-16 align-middle"></i>Débute le
                                {{ \Carbon\Carbon::parse($clients[0]["debuts"])->locale('fr')->isoFormat('dddd D MMMM YYYY') }}
                            </div>
                            <div>
                                <i class="ri-calendar-check-line me-1 text-white-75 fs-16 align-middle"></i> Prends fin le
                                {{ \Carbon\Carbon::parse($clients[0]["fin"])->locale('fr')->isoFormat('dddd D MMMM YYYY') }}
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
                <div class="col-12 col-lg-auto order-last order-lg-0">
                    <div class="row text text-white-50 text-center">
                        <div class="col-lg-6 col-4">
                            <div class="p-2">
                                <h4 class="text-white mb-1">{{$clients[0]["totalinflu"]}}</h4>
                                <p class="fs-14 mb-0">Influenceurs</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-4">
                            <div class="p-2">
                                <h4 class="text-white mb-1">{{$clients[0]["totalvues"]}}/{{$clients[0]["vueRecherche"]}}</h4>
                                <p class="fs-14 mb-0">Vues</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->

            </div>
            <!--end row-->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div>
                    <div class="d-flex">
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab" aria-selected="true" tabindex="-1">
                                    <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Détails</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link fs-14" data-bs-toggle="tab" href="#activities" role="tab" aria-selected="false" tabindex="-1">
                                    <i class="ri-list-unordered d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Influenceurs</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link fs-14" data-bs-toggle="tab" href="#projects" role="tab" aria-selected="false" tabindex="-1">
                                    <i class="ri-price-tag-line d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Réalisation/Preuves</span>
                                </a>
                            </li>
                        </ul>
                        @if ($clients[0]["profil"] == 1)
                            <div class="flex-shrink-0">
                                @if ($clients[0]["status"] != "Valide")
                                    <a href="{{route('attribuer.tache', ['id' => $clients[0]["idTache"],
                                        'vues' =>$clients[0]["vueRecherche"], 'centre' =>$idcentre,
                                        'pay' => !empty($idpays) ?  $idpays: 0,
                                        'dep' => !empty($iddepartements) ? $iddepartements : 0,
                                        'vil' => !empty($idvilles) ?  $idvilles: 0])}}" class="btn btn-success"><i class="ri-edit-box-line align-bottom"></i> Valider </a>
                                @endif
                            </div>
                        @endif
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content pt-4 text-muted">
                        <div class="tab-pane fade active show" id="overview-tab" role="tabpanel">
                            <div class="row">
                                <div class="col-xxl">
                                    <div class="card">
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">Les détails de la tâche T{{$clients[0]["idTache"]}}</h5>
                                            <div class="table-responsive">
                                                <table class="table table-borderless mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <th class="ps-0" scope="row"><a href="{{route('showtache.all', ['id'=>$clients[0]['idClient']])}}"><span class="badge text-bg-primary">Client :</span></a></th>
                                                            <td class="text-muted"><a href="{{route('showtache.all', ['id'=>$clients[0]['idClient']])}}">{{$clients[0]["nomClient"]}}
                                                                {{$clients[0]["prenomClient"]}}. {{$clients[0]["mailClient"]}}</a></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Vues Rechercher :</th>
                                                            <td class="text-muted">{{$clients[0]["vueRecherche"]}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row"> Type de fichier :</th>
                                                            <td class="text-muted">{{$clients[0]["libelle"]}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Description :</th>
                                                            <td class="text-muted">{{$clients[0]["description"]}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Centre :</th>
                                                            <td class="text-muted">{{$centre}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">
                                                                <span>Zone</span>
                                                                <ul>
                                                                    <li>Pays: </li>
                                                                    <li>Departements: </li>
                                                                    <li>Villes: </li>
                                                                </ul>
                                                            </th>
                                                            <td class="text-muted">
                                                                <ul>
                                                                   <span style="display: none"> <li></li> </span>
                                                                    <li>{{$pays}}</li>
                                                                    <li>{{$departements}}</li>
                                                                    <li>{{$villes}}</li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        @if ($clients[0]["fichier"])
                                                            <tr>
                                                                <th class="ps-0" scope="row">Media :</th>
                                                                @if (in_array(substr($clients[0]["fichier"], -4), ['.jpg', 'jpeg', '.png', '.gif']))
                                                                    <td class="text-muted">
                                                                        <img src="{{asset('storage'.$clients[0]["fichier"])}}" alt="" width="200px">
                                                                    </td>
                                                                @elseif (in_array(substr($clients[0]["fichier"], -4),['.mp3','.wav','aiff','.wma','.aac','.flac','.ogg','.m4a']))
                                                                    <td class="text-muted">
                                                                        <audio controls>
                                                                            <source src="{{asset('storage'.$clients[0]["fichier"])}}" type="audio/mpeg">
                                                                        </audio>
                                                                    </td>
                                                                @else
                                                                    <td class="text-muted">
                                                                        <video controls width="200px" height="250px">
                                                                            <source src="{{asset('storage'.$clients[0]["fichier"])}}" type="video/mp4">
                                                                        </video>
                                                                    </td>
                                                                @endif
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <div class="tab-pane fade" id="activities" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Les Influenceurs</h5>
                                    <div class="acitivity-timeline">
                                        @foreach ($clients[0]["travailleurs"] as $influenceur)
                                            <div class="acitivity-item d-flex px-3">
                                                @if (!blank($influenceur['image']))
                                                    <div class="flex-shrink-0">
                                                        <img src="{{asset('storage'.$influenceur['image'])}}" alt="" class="avatar-xs rounded-circle acitivity-avatar">
                                                    </div>
                                                @else
                                                <div class="flex-shrink-0">
                                                    <img src="{{asset('velson/images/users/user-dummy-img.jpg')}}" alt="" class="avatar-xs rounded-circle acitivity-avatar">
                                                </div>
                                                @endif

                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1">{{$influenceur['nom']}} {{$influenceur['prenom']}} <span class="badge bg-soft-primary text-primary align-middle">{{$influenceur['vues']}}/J</span></h6>
                                                    <p class="text-muted mb-2"> {{$influenceur['email']}}. {{$influenceur['tel']}}</p>
                                                    <small class="mb-0 text-muted">{{$influenceur['sexe']}}</small>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!--end card-body-->
                            </div>
                            <!--end card-->
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane fade" id="projects" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($clients[0]["travailleurstaches"] as $execute)
                                            <div class="col-xxl-3 col-sm-6">
                                                <div class="card profile-project-card shadow-none profile-project-warning">
                                                    <div class="card-body p-4">
                                                        <div class="d-flex">
                                                            <div class="flex-grow-1 text-muted overflow-hidden">
                                                                <h5 class="fs-14 text-truncate"><a href="#" class="text-dark">{{$execute['nom']}} {{$execute['prenom']}}</a></h5>
                                                                <p class="text-muted text-truncate mb-0">Total Vues obtenues : {{$execute['totalVues']}}</p>
                                                            </div>
                                                            <div class="flex-shrink-0 ms-2">
                                                                <a href="{{route('showtacheallinfluenceur', ['id' => $clients[0]["idTache"],
                                                                    'idinfluenceur' =>$execute['id']])}}"><div class="badge badge-soft-warning fs-10">Voir Plus</div></a>
                                                            </div>
                                                        </div>

                                                        <div class="d-flex mt-4">
                                                            <div class="flex-grow-1">
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <div>
                                                                        <a href="{{route('showPreuve', ['id' => $clients[0]["idTache"],
                                                                            'idinfluenceur' =>$execute['id']])}}" class="btn btn-success"><i class="ri-edit-box-line align-bottom"></i>Preuve</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end card body -->
                                                </div>
                                                <!-- end card -->
                                            </div>
                                        @endforeach
                                        <!--end col-->
                                        <div class="col-lg-12">
                                            <div class="mt-4">
                                                <ul class="pagination pagination-separated justify-content-center mb-0">
                                                    <li class="page-item disabled">
                                                        <a href="javascript:void(0);" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                                                    </li>
                                                    <li class="page-item active">
                                                        <a href="javascript:void(0);" class="page-link">1</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="javascript:void(0);" class="page-link">2</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="javascript:void(0);" class="page-link">3</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="javascript:void(0);" class="page-link">4</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="javascript:void(0);" class="page-link">5</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="javascript:void(0);" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end card-body-->
                            </div>
                            <!--end card-->
                        </div>
                    </div>
                    <!--end tab-content-->
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

    </div>
    @endsection
</x-app-layout>
