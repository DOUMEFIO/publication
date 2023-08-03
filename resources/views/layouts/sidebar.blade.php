<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
    <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
            <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
            <div class="sidebar-brand-text mx-3"><span>Brand</span></div>
        </a>
        <hr class="sidebar-divider my-0">
        <ul class="navbar-nav text-light" id="accordionSidebar">
            @if (Auth::User()->idProfil == 1)
                <li class="nav-item"><a class="nav-link active" href="{{route("admin.index")}}"><i class="fas fa-tachometer-alt"></i><span>Centres D'interets</span></a></li>
            @endif
        </ul>
        <ul class="navbar-nav text-light" id="accordionSidebar">
            @if (Auth::User()->idProfil == 1)
                <li class="nav-item"><a class="nav-link active" href="{{route("show.influenceur")}}"><i class="fas fa-tachometer-alt"></i><span>Influenceurs</span></a></li>
            @endif
        </ul>
        <ul class="navbar-nav text-light" id="accordionSidebar">
            @if (Auth::User()->idProfil == 1)
                <li class="nav-item"><a class="nav-link active" href="{{route("admin.tache")}}"><i class="fas fa-tachometer-alt"></i><span>Tâches</span></a></li>
            @endif
        </ul>
        <ul class="navbar-nav text-light" id="accordionSidebar">
            @if (Auth::User()->idProfil == 1)
                <li class="nav-item"><a class="nav-link active" href="{{route("admin.tachevalide")}}"><i class="fas fa-tachometer-alt"></i><span>Tâches Validés</span></a></li>
            @endif
        </ul>
        <ul class="navbar-nav text-light" id="accordionSidebar">
            @if (Auth::User()->idProfil == 1)
                <li class="nav-item"><a class="nav-link active" href="{{route("tache.partager")}}"><i class="fas fa-tachometer-alt"></i><span>Tâches Attribuées</span></a></li>
            @endif
        </ul>

        <ul class="navbar-nav text-light" id="accordionSidebar">
            @if (Auth::User()->idProfil == 1)
                <li class="nav-item"><a class="nav-link active" href="{{route("tache.executez")}}"><i class="fas fa-tachometer-alt"></i><span>Tâches Exécutez</span></a></li>
            @endif
        </ul>

        <ul class="navbar-nav text-light" id="accordionSidebar">
            @if (Auth::User()->idProfil == 1)
                <li class="nav-item"><a class="nav-link active" href="{{route("tache.partager")}}"><i class="fas fa-tachometer-alt"></i><span>Preuve</span></a></li>
            @endif
        </ul>

        <ul class="navbar-nav text-light" id="accordionSidebar">
            @if (Auth::User()->idProfil == 2)
                <li class="nav-item"><a class="nav-link active" href="{{route("influenceurconnect")}}"><i class="fas fa-tachometer-alt"></i><span>Profil</span></a></li>
            @endif
        </ul>

        <ul class="navbar-nav text-light" id="accordionSidebar">
            @if (Auth::User()->idProfil == 2)
                <li class="nav-item"><a class="nav-link active" href="{{route("infl.tachencour")}}"><i class="fas fa-tachometer-alt"></i><span>Tache En cours</span></a></li>
            @endif
        </ul>

        <ul class="navbar-nav text-light" id="accordionSidebar">
            @if (Auth::User()->idProfil == 2)
                <li class="nav-item"><a class="nav-link active" href="{{route("tache.partager")}}"><i class="fas fa-tachometer-alt"></i><span>Tache Exécutez</span></a></li>
            @endif
        </ul>
        <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
    </div>
</nav>

