<div class="container-fluid">
    <div class="card table-card">
        <div class="card-header">

            <div class="d-flex justify-content-between">
                <h3>Candidats qui ont postulé </h3>
                <a href="{{ route('admin.backup.exportStgPostule') }}" class=" btn btn-primary">
                    <i class="feather icon-download"></i>
                    Export</a>
            </div>

        </div>

        <div class="card-body px-0 py-0">
            <div class="table-responsive">
                <div class="session-scroll" style="height:478px;position:relative;">
                    <table class="table table-hover m-b-0">
                        <thead>
                            <tr>
                                <th><span>Matricule</span></th>
                                <th><span>Nom complet</span></th>
                                <th><span>Entreprise</span></th>
                                <th><span>Etablissement</span></th>
                                <th><span>Status</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($interviewData as $data)
                                <tr>
                                    <td>{{ $data->matricule }}</td>
                                    <td>{{ $data->nom . ' ' . $data->prenom }}</td>
                                    <td>{{ $data->entreprise }}</td>
                                    <td>{{ $data->etablissement }}</td>
                                    <td>{{ $data->status === 1 ? 'postulé' : '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
