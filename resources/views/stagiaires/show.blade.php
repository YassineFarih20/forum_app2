@extends('layouts.app2')
@section('title', 'Stagiaire list')
@section('content')

    <style>
        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8
        }

        .profile-button {
            background: rgb(99, 39, 120);
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: #682773
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none
        }

        .back:hover {
            color: #682773;
            cursor: pointer
        }

        .labels {
            font-size: 11px
        }

        .add-experience:hover {
            background: #BA68C8;
            color: #fff;
            cursor: pointer;
            border: solid 1px #BA68C8
        }
    </style>
    <div class="container">
        {{-- <a href="{{ route('stagiaires.index') }}">back</a> --}}
        @if ($stagiaire)
            <div class="container rounded bg-white mt-5 mb-5">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img
                                class="rounded-circle mt-5" width="150px" src="{{ asset('img/user.png') }}"><span
                                class="font-weight-bold">{{ $stagiaire->prenom . ' ' . $stagiaire->nom }}</span><span
                                class="text-black-50">{{ $stagiaire->matricule }}</span><span> </span></div>
                    </div>
                    <div class="col-md-5 border-right">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Profile</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6"><label class="labels">nom</label><input type="text"
                                        class="form-control" readonly value="{{ $stagiaire->nom }}"></div>
                                <div class="col-md-6"><label class="labels">Prenom</label><input type="text"
                                        class="form-control" value="{{ $stagiaire->prenom }}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mt-3 col-md-12"><label class="labels">CIN</label><input type="text"
                                        class="form-control" readonly value="{{ $stagiaire->cin }}">
                                </div>
                                <div class="mt-3 col-md-12"><label class="labels">Email</label><input type="text"
                                        class="form-control" readonly value="{{ $stagiaire->email }}"></div>
                                <div class="mt-3 col-md-12"><label class="labels">Date de naissance</label><input
                                        type="date" readonly class="form-control"
                                        value="{{ $stagiaire->dateNaissance }}"></div>
                                <div class="mt-3 col-md-12"><label class="labels">Telephone</label><input type="text"
                                        readonly class="form-control" value="{{ $stagiaire->telephone }}"></div>
                                <div class="mt-3 col-md-12"><label class="labels">Etablissement</label><input type="text"
                                        readonly class="form-control" value="{{ $stagiaire->efp }}"></div>
                                <div class="mt-3 col-md-12"><label class="labels">Filiere</label><input type="text"
                                        readonly class="form-control" value="{{ $stagiaire->filiere }}"></div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 pt-5 pb-0">
                            {{-- @auth('entreprise') --}}
                            @if (auth()->user()->hasRole(1))
                                @isset($stagiaire->cv)
                                    <form action="{{ route('viewCV') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="fileName" value={{ $stagiaire->cv }}>
                                        <button class="btn btn-info text-white">View CV</button>
                                    </form>
                                @else
                                    <p class="fw-bold">Ce stagiaire n'a pas de cv</p>
                                @endisset
                            @endif
                            {{-- @endauth --}}
                        </div>
                        <div class="p-3 d-flex gap-2">
                            @if ($stagiaire->status > 1)
                                <form action="{{ route('marquerPresent', ['cin' => $stagiaire->cin]) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-success">Passer un entretiens</button>
                                </form>
                            @else
                                <form action="{{ route('marquerPresent', ['cin' => $stagiaire->cin]) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-success">marquer la presence</button>
                                </form>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
    </div>
    </div>

    <br>
    @endif
    </div>
@endsection
