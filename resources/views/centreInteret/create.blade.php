<x-app-layout>
    @section('contenue')
    <section class="textarea-select">
        <!-- Textarea start -->
        <div class="row">
            <div class="col-12 mt-3 mb-1">
                <h4 class="text-uppercase">Textarea &amp; Select</h4>
                <p>Textual form controls—like <code>&lt;select&gt;</code>s, and <code>&lt;textarea&gt;</code>s—are styled with the <code>.form-control</code> class. Included are styles for general appearance, focus state, sizing, and more.</p>
            </div>
        </div>
        <div class="row match-height">
            <div class="px-5 col-lg-8 col-md-12">
                <div class="card">
                    <div class="card-body">
                    <div class="card-header">
                        <h4 class="card-title">Textarea</h4>
                    </div>
                    <form method="post" action="{{route('centreInteret.store')}}">
                        @csrf
                        <div class="card-block">
                            <div class="card-body">
                                <h5 class="mt-2">Enregitrer une centre Interet</h5>
                                <x-input-label for="libelle" :value="__('Nom')" />
                                <x-text-input id="libelle" class="form-control form-control-lg" type="text" name="libelle" :value="old('libelle')" required autocomplete="libelle" />
                            </div>
                        </div>
                        <div class="row px-5 py-2">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div></div>
            </div>
        </div>
        <!-- Textarea end -->
      </section>
    @endsection
</x-app-layout>
