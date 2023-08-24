<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="#" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{asset('dashbord/images/images/logo.png')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{asset('dashbord/images/images/logo.png')}}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="#" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{asset('dashbord/images/images/logo.png')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{asset('dashbord/images/images/logo.png')}}" alt="" height="60">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Tableau de bord</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="dashboard-nft.html" class="nav-link" data-key="t-nft"> Statistiques</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                 <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-apps-2-line"></i> <span data-key="t-apps">Autres</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            @if (Auth::User()->idProfil == 1)
                                <li class="nav-item">
                                    <a href="{{route('admin.index')}}" class="nav-link" data-key="t-calendar"> Centres D'interets </a>
                                </li>
                            @endif
                            @if (Auth::User()->idProfil == 1 || Auth::User()->idProfil == 3)
                                <li class="nav-item">
                                    <a href="{{route('show.influenceur')}}" class="nav-link" data-key="t-chat"> Influenceurs </a>
                                </li>
                            @endif
                            @if (Auth::User()->idProfil == 2)
                                <li class="nav-item">
                                    <a href="{{route('influenceurconnect')}}" class="nav-link" data-key="t-select2">Profil</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
                <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarForms" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarForms">
                        <i class="ri-file-list-3-line"></i> <span data-key="t-forms">Tâches</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarForms">
                        <ul class="nav nav-sm flex-column">
                            @if (Auth::User()->idProfil == 1)
                                <li class="nav-item">
                                    <a href="{{route('admin.tache')}}" class="nav-link" data-key="t-select2">Toutes Tâches</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.tachevalide')}}" class="nav-link" data-key="t-select2">Tâches Validées</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('tache.partager')}}" class="nav-link" data-key="t-select2">Tâches Attribuées</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('tache.executez')}}" class="nav-link" data-key="t-select2">Tâches Exécutées</a>
                                </li>
                            @endif

                            @if (Auth::User()->idProfil == 2)
                                <li class="nav-item">
                                    <a href="{{route('infl.tachencour')}}" class="nav-link" data-key="t-select2">Tâche En cours</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('tachedo')}}" class="nav-link" data-key="t-select2">Tâches Exécutées</a>
                                </li>
                            @endif

                            @if (Auth::User()->idProfil == 3)
                                <li class="nav-item">
                                    <a href="{{route('/dashboard')}}" class="nav-link" data-key="t-select2">Tâche</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('clienttacheencours')}}" class="nav-link" data-key="t-select2">Tâche En cours</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('clienttacheexecutez')}}" class="nav-link" data-key="t-select2">Tâche Exécutées</a>
                                </li>
                            @endif

                            @if (Auth::User()->idProfil == 1 || Auth::User()->idProfil == 2 || Auth::User()->idProfil == 3)
                                <li class="nav-item">
                                    <a href="{{route('preuve')}}" class="nav-link" data-key="t-select2">Preuve</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
