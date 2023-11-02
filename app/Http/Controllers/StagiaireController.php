<?php

namespace App\Http\Controllers;

use App\Models\Stagiaire;
use Illuminate\Http\Request;
use App\Models\Entretien;
use Illuminate\Support\Facades\Storage;

class StagiaireController extends Controller
{
    public function __construct()
    {
        $this->middleware(["auth:entreprise,web"]);
    }


    public function getCookieValue(Request $request)
    {
        $cookieName = 'user_preference';
        $defaultValue = 'default_value';

        $cookieValue = $request->cookie($cookieName, $defaultValue);

        // Use $cookieValue in your code
        return $cookieValue;
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
    public function passerEntretien($cin)
    {
        try {
            $stg = Stagiaire::where('cin', $cin)->firstOrFail();
            $stg->entretiens()->update(['status' => 2]);
            return redirect()->route('remarques.create', ['cin' => $stg->cin]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Stagiaire non trouvé.'], 404);
        }
    }
    
    

    public function viewCV(Request $request)
    {
        $fileName = $request->cv;
        if ($fileName) {
            $pdf = Storage::disk('resumes')->get($fileName);
            return response($pdf, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $fileName . '"',
            ]);
        }
        return redirect()->back()->with(["error" => "Pas de CV trouvé."]);
    }
}
