<x-app-layout>
    @section('name')
        Tâches
    @endsection
    @section('contenue')
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modifier Tâche</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="user" method="POST" action="{{route('updatevues')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="id" id="tacheIdInput">
                            <div class="mb-2">
                                <label for="centre" class="fw-bolder text-black">Vos centres d'intérêts</label>
                                <select data-none-results-text="No results matched {0}" title="Selctionner vos centre"
                                 class="selectpicker form-control" id="centre" multiple name='centre[]' required style="border: 2px solid black;">
                                    @foreach ($centres as $centre)
                                        <option value="{{$centre->id}}">{{$centre->libelle}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="fw-bolder text-black" for="selection">Type de tâche</label>
                                <select class="form-control" name="typetache" id="tacheIddInput" required>
                                    <option value="" disabled selected>Choisissez un type de tâche</option>
                                    @foreach ($fichiers as $fichier)
                                        <option value="{{$fichier->id}}">{{$fichier->libelle}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-2" id="descriptionGroup" style="display:none;">
                                <label class="fw-bolder text-black" for="date">Déscription</label>
                                <input type="text" class="form-control"  name="description" id="date" placeholder="Description">
                            </div>
                            <div class="mb-3" id="fileGroup" style="display:none;">
                                <label class="fw-bolder text-black" for="avatar">Choisir un fichier</label>
                                <input type="file" class="form-control" id="avatar" name="avatar" >
                            </div>

                            <div class="mb-2">
                                <label class="fw-bolder text-black">Pays</label>
                                <select data-none-results-text="No results matched {0}" title="Selctionner les pays"
                                class="selectpicker form-control" id="countrylist" multiple name="pays[]">
                                    @foreach ($pays as $pay)
                                        <option value="{{$pay->id}}">{{$pay->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-2" id="listdep" style="display:none;">
                                <label class="fw-bolder text-black">Département:</label>
                                <select id="stateliste" class="form-control" multiple name="departements[]" >

                                </select>
                            </div>
                            <div class="mb-2"  id="listvil" style="display:none;">
                                <label class="fw-bolder text-black">Ville:</label>
                                <select class="form-control" multiple name="villes[]" id="citielist" >

                                </select>
                            </div>

                            <button type="submit" id="submitModal" class="btn btn-primary" style="float: right">Enregistrer</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card" id="orderList">
                    <div class="card-header border-0 py-3">
                        @if (session('info'))
                            <div class="alert alert-success">
                                {{ session('info') }}
                            </div>
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
                            <div class="col-md-6">
                                <div class="d-flex align-items-center" style="float: right" >
                                    <a href="client.tache" class="btn btn-primary">AJOUTER UNE TACHE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div>
                            <div class="table-responsive table-card mb-1">
                                <table class="table table-nowrap align-middle dataTable" id="table_id">
                                    <thead class="text-muted table-light">
                                        <tr class="text-uppercase">
                                            <th>#</th>
                                            <th data-sort="status">N° Tâche</th>
                                            <th data-sort="customer_name">Période</th>
                                            <th data-sort="product_name">Vues Rechercher</th>
                                            <th data-sort="amount">Centres</th>
                                            <th data-sort="status">Status</th>
                                            <th data-sort="status">Réalisation</th>
                                            <th data-sort="city" style="float: center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @php
                                            $compteur = 1;
                                        @endphp
                                        @foreach ($taches as $tache)
                                            <tr>
                                                <td>{{ $compteur++ }}</td>
                                                <td class="status"><span class="badge badge-soft-primary text-uppercase">T{{$tache->id}}</span>
                                                <td class="customer_name">{{ \Carbon\Carbon::parse($tache->debut)->locale('fr')->isoFormat('dddd D MMMM YYYY') }}  <br>
                                                    {{ \Carbon\Carbon::parse($tache->fin)->locale('fr')->isoFormat('dddd D MMMM YYYY') }}</td>
                                                <td class="product_name">{{$tache->vueRecherche}}</td>
                                                <td class="amount">
                                                    @foreach ($tache->centres as $centre)
                                                        {{$centre->libelle}},
                                                    @endforeach
                                                </td>
                                                @if ($tache->status->libelle == "Valide")
                                                    <td class="status"><span class="badge badge-soft-success text-uppercase">{{$tache->status->libelle}}</span>
                                                    </td>
                                                @else
                                                    <td class="status"><span class="badge badge-soft-warning text-uppercase">{{$tache->status->libelle}}</span>
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
                                                        <button class="btn btn-soft-primary btn-sm dropdown" type="button" >
                                                            <a class="dropdown-item edit-item-btn" data-bs-toggle="tab" onclick="showModal({{$tache->id}})" role="tab" aria-selected="false" tabindex="-1">
                                                                <i class="ri-edit-box-line align-bottom me-2 text-muted"></i>Modifier
                                                            </a>
                                                        </button>
                                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" >
                                                            <a class="dropdown-item edit-item-btn" href="{{route('showtache.client', ['id' => $tache->id])}}" >
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
        <button style="display: none" id="triggerModal" class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"></button>
        @include("layouts.js")
        @include("layouts.jss")
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
