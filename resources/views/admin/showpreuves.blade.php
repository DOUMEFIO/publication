<x-app-layout>
    @section('contenue')
        <div class="card shadow">
            <div class="row card-header">
                <div class="col md-9">
                    <p class="text-primary m-0 fw-bold">Les Preuves</p>
                    <p class="text-primary m-0 fw-bold">Vues Total: {{$totalVues}}</p>
                </div>
            </div>
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0" id="dataTable">
                        <thead>
                            <tr>
                                <th>Capture</th>
                                <th>Vues Obtenues</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($preuves as $preuve)
                                <tr>
                                    <td><img src="{{asset('storage'.$preuve->capture)}}" width="200px"></td>
                                    <td>{{$preuve->totalVues}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><strong>Capture</strong></td>
                                <td><strong>Vues Obtenues</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
