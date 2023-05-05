<x-app-layout>
    @section('contenue')

    <div class="container py-2 col-6" style="font-size:20px;">
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 fw-bold" style="text-align: center; font-size:20px"><strong>Centre d'Interet</strong></p>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('centre.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label"><strong>Nom du centre d'interet</strong></label>
                                <input style="font-size: 15px" type="text" name="libelle" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group " >
                        <div class="row">
                            <div class="col md-5" style="text-align: right">
                                <button class="btn btn-primary btn-sm" type="submit">Soumettre</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</div>
    @endsection
</x-app-layout>
