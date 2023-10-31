<?php

namespace App\Http\Controllers;

use App\Exports\StagiairesDidNotConfirmExport;
use App\Exports\StagiairesParticipantsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\imports\StagiairesImport;
use App\Exports\StagiairesExport;
use App\imports\EntreprisesImport;
use App\Exports\EntreprisesExport;
use App\Imports\EtablissementsImport;
use App\Exports\EtablissementsExport;
use App\Exports\EFPExport;
use App\Exports\StagiairesPostuleExport;

class BackupController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:1');
        $this->middleware('auth');
    }
    public function index()
    {
        return view('admin.backup');
    }

    public function importStagiaires(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new StagiairesImport, $file);
        return back()->with('success', 'Stagiaires imported successfully.');
    }

    public function exportStagiaires()
    {
        return Excel::download(new StagiairesExport, 'stagiaires.csv');
    }
    public function importEtablissements(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new EtablissementsImport, $file);
        return back()->with('success', 'etablissements imported successfully.');
    }

    public function exportEtablissements()
    {
        return Excel::download(new EtablissementsExport, 'etablissements.csv');
    }

    public function importEntreprises(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new EntreprisesImport, $file);
        return back()->with('success', 'Entreprises imported successfully.');
    }

    public function exportEntreprises()
    {
        return Excel::download(new EntreprisesExport, 'entreprises.csv');
    }
    public function exportEFP()
    {
        return Excel::download(new EFPExport, 'participation_efp.xlsx');
    }
    public function exportStgPostule()
    {
        return Excel::download(new StagiairesPostuleExport, 'stagiaires_postule.xlsx');
    }
    public function exportStgParticipants()
    {
        return Excel::download(new StagiairesParticipantsExport, 'stagiaires_participants.xlsx');
    }
    public function exportStgNonConfirme()
    {
        return Excel::download(new StagiairesDidNotConfirmExport, 'stagiaires_qui_n_ont_pas_confirme.xlsx');
    }
}
