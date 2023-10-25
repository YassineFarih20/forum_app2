@extends('layouts.master', ['menu' => '31'])
@section('title', 'Inscription')
@section('content')

    <!-- Debut inscription  -->
    <div class="container-xxl py-5 bg-dark page-header mb-2">
        <div class="container my-5 pt-2 pb-2">
            <h2 class="display-3 text-white mt-3 animated slideInDown">Inscription</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-uppercase">
                    <li class="breadcrumb-item"><a href="{{ route('acceuil') }}">Acceuil</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('acceuil') }}">Inscription</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">S'inscrire</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Debut recherche by cin et date naissance -->
    @if (Session::has('currentStagiaire'))
        @php
            $stagiaire = Session('currentStagiaire');
        @endphp
    @endif

    <div class="container-fluid bg-primary mb-2 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
        <div class="container">
            <form method="post" action="/getstagiairebycindatenaissanceinscription">
                @csrf

                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <input type="text" class="form-control border-0" name="cin" placeholder="CIN ?"
                                    value="{{ isset($stagiaire) ? $stagiaire->cin : '' }}" />
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control border-0" name="datenaissance"
                                    placeholder="Date naissance ?"
                                    value="{{ isset($stagiaire) ? $stagiaire->datenaissance : '' }}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success border-0 w-100">Rechercher</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Fin recherche by cin et date naissance -->

    <!-- debut affichage du stagiaire et envoi de l'inscription -->
    @isset($stagiaire)


        <div class="container-xxl ">
            <h4 class="text-center mb-2 wow fadeInUp" data-wow-delay="0.1s">Informations personnelles</h4>
            <div class="row mt-1 g-4">
                <div class="wow fadeInUp" data-wow-delay="0.5s">
                    <form action="/enregistrerinscription" method="post" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf

                        <div class="row g-3">
                            <div class="row">
                                {{ session::has('success') ? session::get('success') : '' }}
                            </div>
                            <div class="row">
                                <div class="col-md-6 ps-md-5">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="nom" readonly
                                            value="{{ $stagiaire->nom }}">
                                        <label for="nom">Nom</label>
                                    </div>
                                </div>
                                <div class="col-md-6 pe-md-5">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="prenom" readonly
                                            value="{{ $stagiaire->prenom }}">
                                        <label for="prenom">Pr&eacute;nom</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 ps-md-5">
                                    <div class="form-floating">
                                        <input class="form-control" name="cin" placeholder="Votre CIN ?" readonly
                                            value="{{ $stagiaire->cin }}">
                                        <label for="email">cin</label>
                                    </div>
                                </div>
                                <div class="col-md-6 pe-md-5">
                                    <div class="form-floating">
                                        <input class="form-control" name="datenaissance" readonly
                                            value="{{ $stagiaire->datenaissance }}">
                                        <label for="datenaissance">Date de naissance</label>
                                    </div>
                                </div>
                            </div>
                            @if ($stagiaire->status === 0)
                                <div class="row">
                                    <div class="col-md-6 ps-md-5 ">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" name="email" readonly
                                                placeholder="Vote Email ?" value="{{ $stagiaire->email }}">
                                            <label for="email">Email (&acirc; changer si n&eacute;cessaire)</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4  ">
                                        <div class="form-floating">
                                            <input class="form-control" type="file" name="cv"
                                                accept=".pdf, .doc, .docx">
                                            @error('cv')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 pe-md-5 ">
                                        <div class="form-floating">
                                            <button class="btn btn-primary w-100 py-3" type="submit">S'inscrire</button>

                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row mt-3">
                                    <div class="col-4 offset"></div>
                                    <div class="bg-primary text-center col-5 pt-2 pb-2 ps-5 pe-5">
                                        <span> <b>Vous &egrave;tes d&eacute;ja inscrit(e) </b> </span>
                                        <A class="btn btn-success" href="/annulerinscription/{{ $stagiaire->cin }}">Annuler
                                            inscription</A>

                                    </div>
                                    <div class="col-3 offset"> </div>

                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="row mt-3">
            <div class="col-3 offset"></div>
            <div class="bg-primary text-center col-6 ps-5 pe-5">
                <H6> {{ __('Veuillez commencer/recommencer la recherche SVP') }} </H6>
            </div>
            <div class="col-3 offset"> </div>
        </div>

    @endisset

    <!-- fin affichage du stagiaire et envoi de l'inscription -->

    <!-- Fin inscription  -->

@endsection

<!-- Aller en haut -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
