@extends('layouts.app2')
@section('title', 'Dashboard')
@section('content')


    <div class=" row d-flex justify-content-center align-items-center h-100">
        <div class=" col col-lg-9 w-100 col-xl-7">
            <div class="shadow-lg card">
                <div class="rounded-top text-white d-flex flex-row"
                    style="background-image: url('https://thumb.photo-ac.com/eb/eb4d9c8c85e462a4d8115eb9d50d2cd3_t.jpeg'); height:200px;">
                    <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                        <img src="{{ asset('img/logos/' . $logo) }}" alt="Generic placeholder image"
                            class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1">
                    </div>
                    <div class="ms-3" style="margin-top: 130px;">
                        <h3 style="color: #f8f9fa">{{ $entrepriseName }}</h3>
                        <p>{{ $entrepriseReprsenatant }}</p>
                    </div>
                </div>
                <div class="p-4 text-black" style="background-color: #f8f9fa;">
                    <div class="d-flex justify-content-end text-center py-1">
                        <form action="{{ route('logout.action') }}" method="POST">
                            @csrf
                            <button class="btn btn-danger">
                                Deconnexion
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body w-100 m-auto p-4 text-black">

                    <table class="table table-hover m-b-0">
                        <thead>
                            <tr>
                                <th><span>Nom Complet</span></th>
                                <th><span>Téléphone</span></th>
                                <th><span>Filiére</span></th>
                                <th><span>Date de Naissance</span></th>
                                <th><span>Etablissement</span></th>
                                <th><span>Cv</span></th>


                            </tr>
                        </thead>
                        <tbody>
                            <h1>les Candidats qui ont postulé:</h1>
                            @foreach ($appliedCandidates as $application)
                                <tr>
                                    <td> {{ $application->stagiaire->prenom }} {{ $application->stagiaire->nom }} </td>
                                    <td> {{ $application->stagiaire->telephone }} </td>
                                    <td> {{ $application->stagiaire->filiere }} </td>
                                    <td> {{ $application->stagiaire->dateNaissance }} </td>
                                    <td> {{ $application->stagiaire->etablissement->nom }}</td>
                                    <td>
                                        <form action="{{ route('viewCV') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="cv" value="{{ $application->stagiaire->cv }}">
                                            <button class="view-cv btn btn-info"><i class="fas fa-eye"></i> View CV</button>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
