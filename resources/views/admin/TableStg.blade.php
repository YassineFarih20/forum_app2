<div class="container-fluid">
    <div class="card table-card">
        <div class="card-header">

            <div class="row">
                <div class="col-md-10">
                    <h3>{{ isset($title) ? $title : 'List stagiaires' }}</h3>
                </div>
                @isset($temp)
                    @if ($temp)
                        <div class="col-md-2">
                            <a href="{{ route('admin.backup.exportStgParticipants') }}" class=" btn btn-primary">
                                <i class="feather icon-download"></i>
                                Export</a>

                        </div>
                    @else
                        <div class="col-md-2">
                            <a href="{{ route('admin.backup.exportStgNonConfirme') }}" class=" btn btn-primary">
                                <i class="feather icon-download"></i>
                                Export</a>

                        </div>
                    @endif
                @endisset
            </div>

        </div>

        <div class="card-body px-0 py-0">
            <div class="table-responsive">
                <div class="session-scroll" style="height:478px;position:relative;">
                    <table class="table table-hover m-b-0">
                        <thead>
                            <tr>
                                <th><span>Matricule</span></th>
                                <th><span>cin</span></th>
                                <th><span>Nom complet</span></th>
                                <th><span>Sexe</span></th>
                                <th><span>Telephone</span></th>
                                <th><span>Efp</span></th>
                                <th><span>Filiere</span></th>
                                @isset($action)
                                    <th><span>Actions</span></th>
                                @endisset
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($stg as $student)
                            <tr>
                                <td>{{ $student->matricule }}</td>
                                <td>{{ $student->cin }}</td>
                                <td>{{ $student->prenom . ' ' . $student->nom }}</td>
                                <td>{{ $student->sexe }}</td>
                                <td>{{ $student->telephone }}</td>
                                <td>{{ $student->efp }}</td>
                                <td>{{ $student->filiere }}</td>
                                @isset($action)
                                    <td>
                                        <a class="text-primary" href="#"><span><i class="fas fa-edit"></i></span></a>
                                        &nbsp &nbsp &nbsp
                                        <a class="text-danger"
                                            href="{{ route('admin.student.delete', ['id' => $student['id']]) }}"><span><i
                                                    class="fas fa-trash-alt"></i></span></a>
                                    </td>
                                @endisset
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
