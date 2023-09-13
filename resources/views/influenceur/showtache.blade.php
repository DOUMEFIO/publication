<x-app-layout>
    @section('contenue')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modifier la photo de profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form class="user" method="POST" action="{{route('updatevues')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="tacheIdInput">
                        <div class="mb-3">
                            <label class="form-label"><strong>Nombres vues Realisée</strong></label>
                            <input type="number" value="" name="nbr_vue_moyen" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Capture</strong></label>
                            <input type="file" class="form-control" id="avatar" name="avatar" value="">
                        </div>
                        <button type="submit" id="submitModal" class="btn btn-primary" style="float: right">Enregistrer</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                                <a class="nav-link fs-14" data-bs-toggle="tab" onclick="showModal({{$clients[0]['idTache']}})" role="tab" aria-selected="false" tabindex="-1">
                                    <i class="ri-list-unordered d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Ajouter Preuve</span>
                                </a>
                            </li>
                        </ul>
                        @if (session('info'))
                            <div class="alert alert-success">
                                {{ session('info') }}
                            </div>
                        @endif
                        <div class="flex-shrink-0">
                            <a href="{{route('showPreuve', ['id' => $clients[0]['idTache'],
                                'idinfluenceur' =>$user])}}" class="btn btn-success"><i class="ri-edit-box-line align-bottom"></i>Preuve
                            </a>
                        </div>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content pt-4 text-muted">
                        <div class="tab-pane fade active show" id="overview-tab" role="tabpanel">
                            <div class="row">
                                <div class="col-xxl-3">
                                    <div class="card">
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">Les détails de la tâche T{{$clients[0]["idTache"]}}</h5>
                                            <div class="table-responsive">
                                                <table class="table table-borderless mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Client :</th>
                                                            <td class="text-muted">{{$clients[0]["nomClient"]}}
                                                                {{$clients[0]["prenomClient"]}}. {{$clients[0]["mailClient"]}}</td>
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
                        <!--end tab-pane-->
                    </div>
                    <!--end tab-content-->
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

    </div>
    <button style="display: none" id="triggerModal" class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"></button>
    @endsection
    @push('scripts')
        <script>
            function showModal(id){
                $('#tacheIdInput').val(id);
                $('#triggerModal').trigger('click')
            }
        </script>
    @endpush
</x-app-layout>
