<div class="container-fluid">
    <div class="card table-card">
        <div class="card-header">

            <div class=" d-flex justify-content-between">
                <h3>Participation par EFP</h3>
                {{-- </div>
                <div class="col-md-2"> --}}
                <a href="{{ route('admin.backup.exportEFP') }}" class="btn btn-primary">
                    <i class="feather icon-download"></i>Export</a>
            </div>

        </div>

        <div class="card-body px-0 py-0">
            <div class="table-responsive">
                <div class="session-scroll" style="height:478px;position:relative;">
                    <table class="table table-hover m-b-0">
                        <thead>
                            <tr>
                                <th><span>EFP</span></th>
                                <th><span>non confirmé</span></th>
                                <th><span>confirmé</span></th>
                                <th><span>attended</span></th>
                                <th><span>total</span></th>
                                <th><span>Taux de confirmation %</span></th>
                                <th><span>Taux de participation %</span></th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($dataByEFP as $data)
                            <tr>
                                <td>{{ $data->nom }}</td>
                                <td>{{ $data->status_0_count }}</td>
                                <td>{{ $data->status_1_count }}</td>
                                <td>{{ $data->status_2_count }}</td>
                                <td>{{ $data->total }}</td>
                                <td>{{ number_format(($data->status_1_count / $data->total) * 100, 2) }}%</td>
                                <td>{{ number_format(($data->status_2_count / $data->total) * 100, 2) }}%</td>
                            </tr>
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
