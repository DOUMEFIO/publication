<x-app-layout>
    @section('name')
        Les Preuves
    @endsection
    @section('contenue')
    {{-- {{$totalVues}} --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row gallery-wrapper">
                                @foreach ($preuves as $preuve)
                                    <div class="element-item col-xxl-3 col-xl-4 col-sm-6 project designing development" data-category="designing development">
                                        <div class="gallery-box card">
                                            <div class="gallery-container">
                                                <a class="image-popup" href="{{asset('storage'.$preuve->capture)}}" title="">
                                                    <img class="gallery-img img-fluid mx-auto" src="{{asset('storage'.$preuve->capture)}}" alt="" />
                                                    <div class="gallery-overlay">
                                                        <h5 class="overlay-caption">{{$user[0]->nom}} {{$user[0]->prenom}}</h5>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="box-content">
                                                <div class="d-flex align-items-center mt-1">
                                                    <div class="flex-grow-1 text-muted">T <a href="#" class="text-body text-truncate">{{$id}}</a></div>
                                                    <div class="flex-shrink-0">
                                                        <div class="d-flex gap-3">
                                                            <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0">
                                                                <i class="ri-calendar-check-line text-muted align-bottom me-1"></i>
                                                                {{ \Carbon\Carbon::parse($preuve->created_at)->locale('fr')->isoFormat('dddd D MMMM YYYY') }}
                                                            </button>
                                                            <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0">
                                                                <i class="ri-question-answer-fill text-muted align-bottom me-1"></i>{{$preuve->totalVues}} vues
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- end row -->
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- ene card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    @endsection
</x-app-layout>
