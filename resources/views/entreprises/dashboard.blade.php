@extends('layouts.master', ['menu' => '35'])
@section('title', 'Entreprise')
@vite([''])

@section('content')
<div class="container-xxl py-5 bg-dark page-header mb-2">
    <div class="container d-flex my-5 pt-2 pb-3">
        
        <img src="{{ asset('img/logos/' . $logo) }}" alt="Company Logo" class="img-fluid img-thumbnail mt-3 mb-2" style="width: 90px; z-index: 1">
        <h2 class="display-3 text-white mx-3 mt-5 mb-1 animated slideInDown">{{ $entrepriseName }}</h2>
    </div>
    <nav aria-label="breadcrumb">
        {{-- <ol class="breadcrumb text-uppercase">
            <li class="breadcrumb-item"><a href="{{ route('acceuil') }}">Acceuil</a></li>
            <li class="breadcrumb-item text-white active" aria-current="page">S'inscrire</li>
        </ol> --}}
    </nav>
</div>

<div class="col col-lg-9 w-100 col-xl-7">
    <div class="card-body w-100 m-auto p-4 text-black">
        <table class="table table-hover m-b-0">
            <thead>
                <tr>
                    <th><span>Nom Complet</span></th>
                    <th><span>Téléphone</span></th>
                    <th><span>Filière</span></th>
                    {{-- <th><span>Date de Naissance</span></th>
                    <th><span>Etablissement</span></th> --}}
                    <th class="text-center"><span>Cv</span></th>
                </tr>
            </thead>
            <tbody>
                <h1>les Candidats qui ont postulé:</h1>
                @foreach ($appliedCandidates as $application)
                    <tr>
                        <td> {{ $application->stagiaire->prenom }} {{ $application->stagiaire->nom }} </td>
                        <td> {{ $application->stagiaire->telephone }} </td>
                        <td> {{ $application->stagiaire->filiere }} </td>
                        {{-- <td> {{ $application->stagiaire->dateNaissance }} </td>
                        <td> {{ $application->stagiaire->etablissement->nom }}</td> --}}
                        <td class="text-center">
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
@endsection
