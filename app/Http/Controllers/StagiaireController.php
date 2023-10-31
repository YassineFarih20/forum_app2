<?php

namespace App\Http\Controllers;

use App\Models\Stagiaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StagiaireController extends Controller
{
    public function __construct()
    {
        // dd(auth('entreprise')->user());

        // dd(Session::get('authEntreprise'));

        // session('authEntreprise') ? $this->middleware("auth:entreprise") : $this->middleware("auth");
    }
    public function index()
    {
        return view("stagiaires.index", ["stagiaires" => stagiaire::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($cin)
    {
        $stg = Stagiaire::join('etablissements', 'etablissements.id', '=', 'stagiaires.etablissement_id')
            ->select('stagiaires.*', 'etablissements.nom as efp')
            ->where('cin', $cin)
            ->firstOrFail();
        return view("stagiaires.show", ["stagiaire" => $stg]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stagiaire $stagiaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stagiaire $stagiaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stagiaire $stagiaire)
    {
        //
    }
    public function marquerPresent($cin)
    {
        try {
            $stg = Stagiaire::where('cin', $cin)->firstOrFail();
            $stg->status = 2;
            $stg->save();
            return back();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Stagiaire non trouvé.'], 404);
        }
    }
}
