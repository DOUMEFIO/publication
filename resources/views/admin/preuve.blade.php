<x-app-layout>
    @section("contenue")

    <div class="container py-2 col-6" style="font-size:20px;">
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold" style="text-align: center; font-size:20px"><strong>Trouvez la preuve de</strong></p>
                </div>
                <div class="card-body">
                    <form class="user" method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label"><strong>Nom</strong></label>
                            <input type="number" value="" name="nbr_vue_moyen" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Prenom</strong></label>
                            <input type="number" value="" name="nbr_vue_moyen" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Tache conserner</strong></label>
                            <input type="integer" class="form-control" id="avatar" name="avatar" value="">
                        </div>
                        <button type="submit" id="submitModal" class="btn btn-primary">Soumettre</button>
                    </form>
                </div>
            </div>
    </div>
    @include('layouts.js')
    @endsection
</x-app-layout>
