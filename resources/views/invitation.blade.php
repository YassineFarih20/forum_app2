@extends('layouts.master', ['menu' => '33'])
@section('title', 'Invitation')
<link rel="stylesheet" href="{{ asset('css/ticket.css') }}">
@vite([])
@section('content')

    <!-- Debut Invitation  -->
    <div class="container-xxl py-5 bg-dark page-header mb-5">
        <div class="container my-5 pt-5 pb-4">
            <h2 class="display-3 text-white mb-3 animated slideInDown">Invitation</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-uppercase">
                    <li class="breadcrumb-item"><a href="{{ route('acceuil') }}">Acceuil</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('acceuil') }}">Inscription</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Imprimer invitation</li>
                </ol>
            </nav>
        </div>
    </div>


    @if (Session::has('currentStagiaire'))
        @php
            $stagiaire = Session('currentStagiaire');
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


    <!-- Fin recherche by cin et date naissance -->

    <!-- debut affichage du stagiaire et envoi de la reservation -->
    @isset($stagiaire)
        <div class="container-xxl ">
            <h4 class="text-center mb-2 wow fadeInUp" data-wow-delay="0.1s">Invitation</h4>
            <div class="row mt-1 g-4">
                <div class="wow fadeInUp" data-wow-delay="0.5s">

                    <main id="elementToPrint" class="flex flex-col">
                        <section class="w-full flex-grow flex items-center justify-center p-4">
                            <div class="flex w-full max-w-3xl text-zinc-900 h-64">
                                <div class="h-full bg-slate-200	 flex items-center justify-center px-8 rounded-l-3xl">
                                    <div id="qrCode">
                                        {!! QrCode::size(180)->generate(route('stagiaires.show', ['stagiaire' => $stagiaire->cin])) !!}
                                    </div>
                                </div>
                                <div
                                    class="relative h-full flex flex-col items-center border-dashed justify-between border-2 bg-black border-white">
                                    <div class="absolute rounded-full w-8 h-8 bg-white -top-5"></div>
                                    <div class="absolute rounded-full w-8 h-8 bg-white -bottom-5"></div>
                                </div>
                                <div
                                    class="h-full px-10 bg-slate-200 flex-grow rounded-r-3xl flex justify-content-start flex-col">
                                    <div class="flex w-full mt-4 justify-between items-center">

                                        <h1 id="title">Salon Régional de recrutement</h1>

                                        <div class="flex flex-col items-start">
                                            <img id="logo" src="{{ asset('img/logos/logo.png') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column ">
                                        <h2 id="text" class="text-zinc-500">Location:</h2>
                                        <span id="Location" class="font-mono">ISTA CFPMS (OFPPT) - Hay Hassani
                                        </span>
                                        <span class="font-mono">30 Novembre 2023 </span>
                                    </div>
                                    <div class="flex w-full mt-4 justify-between">
                                        <div class="flex flex-col">
                                            <span class="text-xs text-zinc-400">Nom Complet</span>
                                            <span class="font-mono">{{ $stagiaire->prenom }}
                                                {{ $stagiaire->nom }} </span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-xs text-zinc-400">CIN</span>
                                            <span class="font-mono">{{ $stagiaire->cin }} </span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-xs text-zinc-400">Etablissement</span>
                                            <span class="font-mono">{{ $stagiaire->efp }} </span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-xs text-zinc-400">filiere</span>
                                            <span class="font-mono">{{ $stagiaire->filiere }} </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </main>
                    <div class="row">
                        <div class="col-5 offset"></div>
                        <a class="col-3 w-full btn btn-success" id="downloadBtn">Telecharger</a>
                    </div>



                </div>
            </div>
        @else
            <div class="row mt-3">
                <div class="col-3 offset"></div>
                <div class="bg-primary text-center col-6 ps-5 pe-5">
                    <h6> {{ __('Les informations entrees incorrectes ou (re)commencez la recherche ') }} </h6>
                </div>
                <div class="col-3 offset"> </div>
            </div>
        @endisset



        <!-- Fin Invitation  -->

    @endsection

    <!-- Aller en haut -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
