<x-app-layout>
    @section('contenue')
    <div class="row mb-3">
        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-body text-center shadow">
                    <img class="rounded-circle mb-3 mt-4" src="{{asset('template/assets/img/dogs/image2.jpeg')}}" width="160" height="160">
                    <div class="mb-3">
                        <span><strong>{{Auth::user()->nom}} {{Auth::user()->prenom}}</strong></span>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary btn-sm" type="button">Change Photo</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Vos Informations</p>
                        </div>
                        <div class="card-body">
                            <table style="border:1">
                                <tr >
                                    <td class="sorting_1"><strong>Résidence</strong></td>
                                    <td class="sorting_1">: {{$users[0]->residencepay->name}},
                                                            {{$users[0]->residencedep->name}},
                                                            {{$users[0]->residencevil->name}}
                                    </td>
                                </tr>
                                <tr >
                                    <td class="sorting_1"><strong>Sexe</strong></td>
                                    <td class="sorting_1">: {{$users[0]->sexe}}</td>
                                </tr>
                                <tr >
                                    <td class="sorting_1"><strong>Téléphone</strong></td>
                                    <td class="sorting_1">: {{$users[0]->tel}}</td>
                                </tr>
                                <tr >
                                    <td class="sorting_1"><strong>Nombres de vues moyens</strong></td>
                                    <td class="sorting_1">: {{$users[0]->nbr_vue_moyen}}</td>
                                </tr>
                                <tr >
                                    <td class="sorting_1"><strong>Vos centres d'interet sont</strong></td>
                                    <td class="sorting_1">: {{$libelles}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
