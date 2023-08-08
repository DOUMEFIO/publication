<x-app-layout>
    @section("contenue")

    <div class="container py-2 col-6" style="font-size:20px;">
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold" style="text-align: center; font-size:20px"><strong>Completez vos informations</strong></p>
                </div>
                <div class="card-body">
                    <form class="user" method="POST" action="{{route('updatevues')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="text" value="{{$id}}" name="id" id="tacheIdInput">
                        <div class="mb-3">
                            <label class="form-label"><strong>Nombres vues Realisée</strong></label>
                            <input type="number" value="" name="nbr_vue_moyen" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Capture</strong></label>
                            <input type="file" class="form-control" id="avatar" name="avatar" value="">
                        </div>
                        <button type="submit" id="submitModal" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
    </div>
    @include('layouts.js')
    @endsection
</x-app-layout>
