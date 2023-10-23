<x-app-layout>
    @section('name')
        Tableau de bord
    @endsection
    @section('contenue')
        <div class="row mb-3 pb-1">
            <div class="col-12">
                <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-16 mb-1">Tâches</h4>
                    </div>
                </div><!-- end card header -->
            </div>
            <!--end col-->
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Tâches Total</p>
                            </div>
                            <div class="flex-shrink-0">
                                <h5 class="text-success fs-14 mb-0">
                                    <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                </h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{count($tacheall)}}">0</span> </h4>
                                <a href="{{route('infl.tacheall')}}" class="text-decoration-underline">Voir Plus</a>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-success rounded fs-3">
                                    <i class="bx bx-dollar-circle text-success"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Tâches En Cours</p>
                            </div>
                            <div class="flex-shrink-0">
                                <h5 class="text-danger fs-14 mb-0">
                                    <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                </h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{count($taches)}}">0</span></h4>
                                <a href="{{route('infl.tachencour')}}" class="text-decoration-underline">Voir Plus</a>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-info rounded fs-3">
                                    <i class="bx bx-shopping-bag text-info"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Tâches Exécuter</p>
                            </div>
                            <div class="flex-shrink-0">
                                <h5 class="text-success fs-14 mb-0">
                                    <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                </h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{count($tacheexecute)}}">0</span> </h4>
                                <a href="{{route('tachedo')}}" class="text-decoration-underline">Voir Plus</a>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-warning rounded fs-3">
                                    <i class="bx bx-user-circle text-warning"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
    @endsection
</x-app-layout>
