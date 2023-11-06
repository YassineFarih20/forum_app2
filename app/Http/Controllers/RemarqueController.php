<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stagiaire;
use App\Models\Entretien;
use App\Models\Remarque;

class RemarqueController extends Controller
{
    
    public function afficherFormulaireRemarque($cin)
    {
        $stagiaire = Stagiaire::where('cin', $cin)->firstOrFail();
        $entretien = $stagiaire->entretiens->first(); 
    
        return view('remarques.formulaire', compact('stagiaire', 'entretien'));
    }
    
    public function enregistrerRemarque(Request $request)
    {
        try {
            $entretien = Entretien::find($request->input('entretien_id'));
            if (!$entretien) {
                return back()->with('error', 'Entretien non trouvé.');
            }
    
            $remarque = Remarque::where('entretien_id', $entretien->id)
                ->where('entreprise_id', auth('entreprise')->user()->id)
                ->first();
    
            if ($remarque) {
              
                $remarque->contenu = $request->input('contenu');
                $notePosture = $request->input('note_posture');
                $remarque->posture = $notePosture;
                $noteCommunication = $request->input('note_communication');
                $remarque->communication = $noteCommunication;
                $remarque->save();
            } else {
                $remarque = new Remarque();
                $remarque->contenu = $request->input('contenu');
                $notePosture = $request->input('note_posture');
                $remarque->posture = $notePosture;
                $noteCommunication = $request->input('note_communication');
                $remarque->communication = $noteCommunication;
                $remarque->entretien_id = $entretien->id;
                $remarque->entreprise_id = auth('entreprise')->user()->id;
                $remarque->save();
            }
    
            return redirect()->route('remarques.create', ['cin' => $entretien->stagiaire->cin])
                ->with('success', 'Remarque enregistrée avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur s\'est produite lors de l\'enregistrement des remarques.');
        }
    }
    
    

    
}
