@extends('layouts.app2')
@section('title', 'Formulaire')
@section('content')

    <div class="container mt-5 gap-5">
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <h2 class="text-center">{{ $stagiaire->prenom }} {{ $stagiaire->nom }}</h2>

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('remarques.enregistrer') }}" method="POST">
                    @csrf
                    <input type="hidden" name="entretien_id" value="{{ $entretien->id }}">

                    <div class="form-group text-center my-5">
                        <label for="note_posture" style="font-size: 1.5em; " class="mb-3">Notation de la posture:</label>
                        <div class="rating-stars">
                            <ul id="stars">
                                <li class="star" title="Poor" data-value="1">
                                    <i class="fa fa-star fa-fw" style="font-size: 4em;"></i>
                                </li>
                                <li class="star" title="Fair" data-value="2">
                                    <i class="fa fa-star fa-fw" style="font-size: 4em;"></i>
                                </li>
                                <li class="star" title="Good" data-value="3">
                                    <i class="fa fa-star fa-fw"style="font-size: 4em;"></i>
                                </li>
                                <li class="star" title="Very Good" data-value="4">
                                    <i class="fa fa-star fa-fw" style="font-size: 4em;"></i>
                                </li>
                                <li class="star" title="Excellent" data-value="5">
                                    <i class="fa fa-star fa-fw" style="font-size: 4em;"></i>
                                </li>
                            </ul>
                        </div>
                        <input type="hidden" name="note_posture" id="note_posture_input">
                    </div>

                    <div class="form-group text-center my-5">
                        <label for="note_communication" style="font-size: 1.5em;" class="mb-3">Notation de la
                            communication:</label>
                        <div class="rating-stars">
                            <ul id="communication-stars">
                                <li class="star" title="Poor" data-value="1">
                                    <i class="fa fa-star fa-fw" style="font-size: 4em;"></i>
                                </li>
                                <li class="star" title="Fair" data-value="2">
                                    <i class="fa fa-star fa-fw" style="font-size: 4em;"></i>
                                </li>
                                <li class="star" title="Good" data-value="3">
                                    <i class="fa fa-star fa-fw" style="font-size: 4em;"></i>
                                </li>
                                <li class="star" title="Very Good" data-value="4">
                                    <i class="fa fa-star fa-fw" style="font-size: 4em;"></i>
                                </li>
                                <li class="star" title="Excellent" data-value="5">
                                    <i class="fa fa-star fa-fw" style="font-size: 4em;"></i>
                                </li>
                            </ul>
                        </div>
                        <input type="hidden" name="note_communication" id="note_communication_input">
                    </div>

                    <div class="form-group text-center my-5">
                        <label for="contenu" style="font-size: 1.5em;">Contenu:</label>
                        <textarea name="contenu" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="form-group text-center my-5">
                        <button style="font-size: 1.5em;" type="submit"
                            class="btn btn-success btn-block mx-5 mt-3">Enregistrer Votre Remarque</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
