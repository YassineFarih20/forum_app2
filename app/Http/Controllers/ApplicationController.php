<?php

namespace App\Http\Controllers;

use App\Models\Entretien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ApplicationController extends Controller
{
    public function applyForInterview(Request $request)
    {
        $stagiaire = Session::get('currentStagiaire');

        Entretien::create([
            'stagiaire_id' => $stagiaire->id,
            'entreprise_id' => $request->input('entreprise'),
            'status' => 1,
        ]);

        $session = new inscriptionController;
        $session->setSession($stagiaire->cin, $stagiaire->dateNaissance);

        return redirect()->back();
    }
}
