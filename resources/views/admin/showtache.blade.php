<x-app-layout>
    @section('contenue')
    <div class="container-fluid col-md-6">
        <div class="card shadow">
            <div class="card-body">
                <ul>
                    <li>N° Tâche: {{$tache[0]->nbr}}</li>
                    <li>Nom & Prénom: {{$tache[0]->nom}} {{$tache[0]->prenom}}</li>
                    <li>Période: {{ strftime('%A %e %B %Y', strtotime($tache[0]->debut)) }} à
                        {{ strftime('%A %e %B %Y', strtotime($tache[0]->fin)) }}</li>
                    <li>Vues Rechercher: {{$tache[0]->vueRecherche}}</li>
                    <li>Type de fichier: </li>
                    <li>Description: {{$tache[0]->description}}</li>
                    <li>Centre: {{$tache[0]->centre}}</li>
                    <li>Zone:
                        <ul>
                            <li>Pays: {{$tache[0]->pays}}</li>
                            <li>Departements: {{$tache[0]->departements}}</li>
                            <li>Villes: {{$tache[0]->villes}}</li>
                        </ul>
                    </li>
                    @if ($tache[0]->fichier)
                        <li>Media: <img src="{{asset('storage'.$tache[0]->fichier)}}" alt="" width="200px"></li>
                    @endif

                </ul>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
