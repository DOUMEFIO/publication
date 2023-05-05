@include("layouts.head")

    <div id="wrapper">

        @include("layouts.sidebar")

        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">

                @include("layouts.navbar")

                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    </div>
                    @yield("contenue")
                </div>
            </div>
            @include("layouts.footer")
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    @include("layouts.body")
