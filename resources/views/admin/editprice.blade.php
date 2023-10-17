<x-app-layout>
    @section('name')
        Paramètre
    @endsection
    @section('title')
        Paramètre
    @endsection
    @section('contenue')
    <div class="col-xxl-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Form Grid</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <p class="text-muted">Permet de Modifier le prix d'une tâche.</p>
                <div class="live-pre
                view">
                    <form method="post" action="{{route('updateprice')}}" >
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="firstNameinput" class="form-label">Prix Unitaire de tâche</label>
                                    <input type="float" class="form-control" id="firstNameinput"
                                           name="prixclient" value="{{ old('prixtache') }}">
                                    <input type="hidden" value="{{$id}}" name="id">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="lastNameinput" class="form-label">Prix Unitaire par vues</label>
                                    <input type="float" class="form-control" id="lastNameinput"
                                           name="prixinfluenceur" value="{{ old('prixinfluenceur') }}">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="compnayNameinput" class="form-label">Tâches</label>
                                    <select class="form-control" data-trigger="" name="idtache" id="productname-field">
                                        @foreach ($taches as $tache)
                                            <option value="{{$tache->id}}">T{{$tache->id}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
