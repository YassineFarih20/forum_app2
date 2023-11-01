<?php

namespace App\Http\Controllers;

use App\Models\Stagiaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class inscriptionController extends Controller
{

    function __construct()
    {
        $this->middleware("validateCv")->only("enregistrerInscription");
    }

    public function getStagiaire(Request $request)
    {
        $request->validate([
            'cin' => 'required',
            'datenaissance' => 'required',
        ]);
        $this->setSession($request->cin, $request->datenaissance);
        return redirect()->back();
    }

    public function setSession($cin, $dateNaissance)
    {
        $stagiaire = Stagiaire::join('etablissements', 'etablissements.id', '=', 'stagiaires.etablissement_id')
            ->select('stagiaires.*', 'etablissements.nom as efp')
            ->where('cin', $cin)
            ->where('dateNaissance', $dateNaissance)->first();

        $entretien = Stagiaire::join('entretiens as e', 'stagiaires.id', '=', 'e.stagiaire_id')
            ->select('e.entreprise_id')
            ->where('stagiaires.id', $stagiaire->id)
            ->get();

        $stagiaire ? Session::put('currentStagiaire', $stagiaire) : Session::forget('currentStagiaire');
        $stagiaire ? Session::put('currentEntretien', $entretien) : Session::forget('currentEntretien');
    }

    public function enregistrerInscription(Request $request)
    {
        $stagiaire = Session::get('currentStagiaire');
        $stagiaire->status = 1;

        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            if ($stagiaire->cv) $path = Storage::disk('resumes')->delete($stagiaire->cv);
            $path = Storage::disk('resumes')->putFileAs('/', $file, $stagiaire->cin . str()->uuid() . '.' . $file->extension());
            $stagiaire->cv = $path;
            $stagiaire->save();
            // refreshing session
            $this->setSession($stagiaire->cin, $stagiaire->datenaissance);

            return redirect(route('inscription'))->with('success', 'Inscription enregistrée!');
        } else return redirect(route('inscription'))->with('success', 'CV est obligatoire pour s\'inscrire!');
    }

    public function annulerInscription(string $cin)
    {
        $stagiaire = Session::get('currentStagiaire');
        $stagiaire->status = 0;

        if ($stagiaire->cv) Storage::disk('resumes')->delete($stagiaire->cv);

        $stagiaire->cv = null;
        $stagiaire->save();

        // refreshing session
        $this->setSession($stagiaire->cin, $stagiaire->datenaissance);


        return redirect(route('inscription'))->with('success', 'Inscription annulé!');
    }
}
