<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{asset('velson/images/logo-sm.png')}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('velson/images/logo-dark.png')}}" alt="" height="17">
                        </span>
                    </a>

                    <a href="index.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{asset('velson/images/logo-sm.png')}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('velson/images/logo-light.png')}}" alt="" height="17">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                    id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- App Search-->
            </div>

            <div class="d-flex align-items-center">
                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            @if ( Auth::user()->photpProfil )
                                <img class="rounded-circle header-profile-user" src="{{asset('storage'.Auth::user()->photpProfil)}}" alt="Header Avatar">
                            @else
                                <img class="rounded-circle header-profile-user" src="{{asset('velson/images/users/user-dummy-img.jpg')}}" alt="Header Avatar">
                            @endif
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</span>
                                <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">{{ Auth::user()->profil->profilLibelle }}</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header" >Bienvenue {{ Auth::user()->nom }}!</h6>
                        <a class="dropdown-item" href="" onclick="event.preventDefault();
                        this.closest('form').submit();">
                            <span class="align-middle" data-key="t-logout">
                                <form method="get" action="{{route('logout')}}">
                                    <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                    {{ __('Se Déconnecter') }}</a>
                                </form>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
