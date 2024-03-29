<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<!-- Mirrored from themesbrand.com/velzon/html/default/apps-projects-create.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Nov 2022 16:41:06 GMT -->
@include("layouts.header")

<body>
    <div class="container justify-content-center w-85">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center mb-4">
                            <h4 class="text-black ">Passer une commande</h4>
                            <h5 id="total" style="display:none;"></h5>
                        </div>
                        @if (session('info'))
                            <div class="alert alert-success">
                                {{ session('info') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="user" method="POST" action="{{ route('form.submit') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-sm-6 mb-3 mb-sm-0"><label for="exampleFirstName" class="fw-bold text-black">Nombre de vues recherchées:</label>
                                    <input class="form-control required" type="number" id="exampleFirstName" placeholder="Nombre de vues recherchées" name="vueRecherche">
                                </div>
                                <div class="col-sm-6">
                                    <label for="centre" class="fw-bolder text-black">Vos centres d'intérêts</label>
                                    <select data-none-results-text="No results matched {0}" title="Selctionner vos centre"
                                     class="selectpicker form-control" id="centre" multiple name='centre[]' required style="border: 2px solid black;">
                                        @foreach ($centres as $centre)
                                            <option value="{{$centre->id}}">{{$centre->libelle}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label class="fw-bold text-black" for="date">Date de début</label>
                                        <input type="date" class="form-control" id="dateValidation" name="debut" min="YYYY-MM-DD" placeholder="234" required>
                                </div>
                                <div class="col-sm-6">
                                    <label class="fw-bolder text-black" for="date">Date de fin</label>
                                    <input type="date" class="form-control" name="fin"  id="dateValidationInputFin" min="YYYY-MM-DD" placeholder="234" required>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="fw-bolder text-black" for="selection">Type de tâche</label>
                                <select class="form-control" name="typetache" id="typetache" required>
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
                            <div class="form-group ">
                                <div class="row my-3">
                                    <button class="btn btn-primary d-block btn-user w-100" type="submit" name="submit" value="inscription">Enregistrer</button>
                                </div>
                                <div class="row">
                                    <span style="color: rgb(55, 53, 53);text-align:center">Avez-vous un compte? <button type="submit" name="submit" value="connection">Se connecter</a></span>
                                </div>
                                <hr>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JAVASCRIPT -->
    @include("layouts.js")
    @include("layouts.jss")
</body>
<!-- Mirrored from themesbrand.com/velzon/html/default/apps-projects-create.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Nov 2022 16:41:07 GMT -->
</html>


