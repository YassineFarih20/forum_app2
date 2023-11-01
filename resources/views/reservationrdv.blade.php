@extends('layouts.master', ['menu' => '32'])
@section('title', 'R&eacute;servation RDV')
@section('content')
    <link rel="stylesheet" href="{{ asset('/css/reservation.css') }}">

    <!-- Debut resevation  -->
    <div class="container-xxl py-5 bg-dark page-header mb-5">
        <div class="container my-5 pt-5 pb-4">
            <h2 class="display-3 text-white mb-3 animated slideInDown">R&eacute;servation RDV</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-uppercase">
                    <li class="breadcrumb-item"><a href="{{ route('acceuil') }}">Acceuil</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('acceuil') }}">Inscription</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">R&eacute;servation RDV</li>
                </ol>
            </nav>
        </div>
    </div>


    <!-- Debut recherche by cin et date naissance -->
    @if (Session::has('currentStagiaire'))
        @php
            $stagiaire = Session('currentStagiaire');
            $entretien = Session('currentEntretien');
        @endphp
    @endif

    <div class="container-fluid bg-primary mb-2 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
        <div class="container">
            <form method="post" action="{{ route('getStagiaire') }}">
                @csrf
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <input type="text" class="form-control border-0" name="cin" placeholder="CIN"
                                    value="{{ isset($stagiaire) ? $stagiaire->cin : '' }}" />
                            </div>
                            <div class="col-md-6">
                                <input type="date" class="form-control border-0" name="datenaissance"
                                    placeholder="Date naissance"
                                    value="{{ isset($stagiaire) ? $stagiaire->dateNaissance : '' }}" />
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


    @isset($stagiaire)
        <?php
        $entreprises = App\Models\Entreprise::all();
        ?>

        <div class="container-xxl py-5 ">
            <div class="container">
                @if ($entreprises->count() > 0)
                    <div class="row">
                        <div class="col-lg-10 mx-auto mb-4">
                            <div class="section-title text-center ">
                                <h3 class="top-c-sep mb-5">Réservation des Rendez-vous</h3>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-10 mx-auto">
                            <div class="career-search mb-60">
                                <div class="filter-result">
                                    @foreach ($entreprises as $entreprise)
                                        <?php
                                        $temp = false;
                                        ?>
                                        <div class="job-box d-md-flex align-items-center justify-content-between mb-30">
                                            <div class="job-left my-4 d-md-flex align-items-center flex-wrap">
                                                <div class="mr-md-4 mb-md-0 mb-4 mx-auto mx-md-0 d-md-none d-lg-flex">
                                                    <img style="width:5rem" src="{{ asset('img/logos/' . $entreprise->logo) }}">
                                                </div>
                                                <div class="job-content">
                                                    <h5 style="margin-left: 2rem" class="text-md-left">
                                                        {{ $entreprise->raisonabregee }}</h5>
                                                    <ul class="d-md-flex flex-column flex-wrap text-capitalize ff-open-sans">
                                                        <li class="mr-md-4">
                                                            {{ Str::upper($entreprise->raisonsociale) }}
                                                        </li>
                                                        <li class="mr-md-4 underline">
                                                            {{ Str::upper($entreprise->web) }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            @if (count($entretien) > 0)
                                                @foreach ($entretien as $i)
                                                    @if ($i->entreprise_id === $entreprise->id)
                                                        @php
                                                            $temp = true;
                                                        @endphp
                                                        <div class="job-right my-4 flex-shrink-0">
                                                            <span class="d-block w-100 d-sm-inline-block" style="color:green">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                                    height="1em" viewBox="0 0 448 512">
                                                                    <path
                                                                        d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
                                                                </svg>
                                                                Postulé</span>
                                                        </div>
                                                    @endif
                                                @endforeach
                                                @if (!$temp)
                                                    <div class="job-right my-4 flex-shrink-0">
                                                        <form method="POST"
                                                            action="{{ route('apply-for-interview', ['stagiaire' => $stagiaire->id]) }}">
                                                            @csrf
                                                            <input type="hidden" name="entreprise"
                                                                value="{{ $entreprise->id }}">
                                                            <button id="postuleBTN"
                                                                class="btn d-block w-100 d-sm-inline-block btn-success">Postulé
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="job-right my-4 flex-shrink-0">
                                                    <form method="POST"
                                                        action="{{ route('apply-for-interview', ['stagiaire' => $stagiaire->id]) }}">
                                                        @csrf
                                                        <input type="hidden" name="entreprise" value="{{ $entreprise->id }}">
                                                        <button id="postuleBTN"
                                                            class="btn d-block w-100 d-sm-inline-block btn-success">Postulé
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <p class="mb-30 ff-montserrat">Total Entreprises : {{ count($entreprises) }}</p>
                            @if ($temp)
                                <a class="btn btn-success d-block m-auto col-3" href="{{ route('invitation') }}">Imprimer mon
                                    invitation</a>
                            @else
                                <p class="text-center fw-bolder">Veuillez postuler pour une entreprise</p>
                            @endif


                            {{-- <!-- START Pagination -->
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-reset justify-content-center">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                            <i class="zmdi zmdi-long-arrow-left"></i>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item d-none d-md-inline-block"><a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item d-none d-md-inline-block"><a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                                    <li class="page-item"><a class="page-link" href="#">8</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">
                                            <i class="zmdi zmdi-long-arrow-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <!-- END Pagination --> --}}
                        </div>
                    </div>

            </div>
            @endif
        @else
            <div class="row mt-3">
                <div class="col-3 offset"></div>
                <div class="bg-primary text-center col-6 ps-5 pe-5">
                    <H6> {{ __('Les informations entrees incorrectes ou (re)commencez la recherche ') }} </H6>
                </div>
                <div class="col-3 offset"> </div>
            </div>

        @endisset

        <!-- fin affichage du stagiaire et envoi de la resevation -->



        <!-- Fin resevation  -->

    @endsection

    <!-- Aller en haut -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
