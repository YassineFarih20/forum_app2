@extends('layouts.app2')
@section('title', 'Formulaire')
@section('content')

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <h2 class="text-center">Remarques et Notation pour {{ $stagiaire->prenom }} {{ $stagiaire->nom }}</h2>

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('remarques.enregistrer') }}" method="POST">
                    @csrf
                    <input type="hidden" name="entretien_id" value="{{ $entretien->id }}">


                    <div class="form-group">
                        <label for="note_posture">Notation de la posture</label>
                        <div class="rating-stars">
                            <ul id="stars">
                                <li class="star" title="Poor" data-value="1">
                                    <i class="fa fa-star fa-fw"></i>
                                </li>
                                <li class="star" title="Fair" data-value="2">
                                    <i class="fa fa-star fa-fw"></i>
                                </li>
                                <li class="star" title="Good" data-value="3">
                                    <i class="fa fa-star fa-fw"></i>
                                </li>
                                <li class="star" title="Very Good" data-value="4">
                                    <i class="fa fa-star fa-fw"></i>
                                </li>
                                <li class="star" title="Excellent" data-value="5">
                                    <i class="fa fa-star fa-fw"></i>
                                </li>
                            </ul>
                        </div>
                        <input type="hidden" name="note_posture" id="note_posture_input">
                    </div>
                    {{-- <div class='success-box'>
                        <div class='clearfix'></div>
                        <img alt='tick image' width='32'
                            src='data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA0MjYuNjY3IDQyNi42NjciIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQyNi42NjcgNDI2LjY2NzsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxwYXRoIHN0eWxlPSJmaWxsOiM2QUMyNTk7IiBkPSJNMjEzLjMzMywwQzk1LjUxOCwwLDAsOTUuNTE0LDAsMjEzLjMzM3M5NS41MTgsMjEzLjMzMywyMTMuMzMzLDIxMy4zMzMgIGMxMTcuODI4LDAsMjEzLjMzMy05NS41MTQsMjEzLjMzMy0yMTMuMzMzUzMzMS4xNTcsMCwyMTMuMzMzLDB6IE0xNzQuMTk5LDMyMi45MThsLTkzLjkzNS05My45MzFsMzEuMzA5LTMxLjMwOWw2Mi42MjYsNjIuNjIyICBsMTQwLjg5NC0xNDAuODk4bDMxLjMwOSwzMS4zMDlMMTc0LjE5OSwzMjIuOTE4eiIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K' />
                        <div class='text-message'></div>
                        <div class='clearfix'></div>
                    </div> --}}

                    <div class="form-group">
                        <label for="contenu">Contenu</label>
                        <textarea name="contenu" class="form-control" rows="4" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-success btn-block mx-5 mt-3 ml-5">Enregistrer Remarque et Notation</button>

                </form>


            </div>
        </div>
    </div>


@endsection
