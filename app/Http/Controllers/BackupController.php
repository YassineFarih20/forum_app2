<?php

namespace App\Http\Controllers;

use App\Exports\StagiairesDidNotConfirmExport;
use App\Exports\StagiairesParticipantsExport;
use Illuminate\Database\QueryException;
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
        $this->middleware('validateImport')->only(["importStagiaires", "importEtablissements", "importEntreprises"]);
    }
    public function index()
    {
        return view('admin.backup');
    }

    public function importStagiaires(Request $request)
    {
        $file = $request->file('file');
        try {
            Excel::import(new StagiairesImport, $file);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) return back()->withErrors(['backupAlert' => $e->errorInfo[2], 'style' => 'alert-danger']);
            return back()->withErrors(['backupAlert' => 'Database error: ' . $e->getMessage(), 'style' => 'alert-danger']);
        }
        return back()->withErrors(['backupAlert' => "Stagiaires imported successfully", 'style' => 'alert-primary']);
    }

    public function exportStagiaires()
    {
        return Excel::download(new StagiairesExport, 'stagiaires.csv');
    }
    public function importEtablissements(Request $request)
    {
        $file = $request->file('file');
        try {
            Excel::import(new EtablissementsImport, $file);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) return back()->withErrors(['backupAlert' => $e->errorInfo[2], 'style' => 'alert-danger']);
            return back()->withErrors(['backupAlert' => 'Database error: ' . $e->getMessage(), 'style' => 'alert-danger']);
        }
        return back()->withErrors(['backupAlert' => "Etablissements imported successfully", 'style' => 'alert-primary']);
    }

    public function exportEtablissements()
    {
        return Excel::download(new EtablissementsExport, 'etablissements.csv');
    }

    public function importEntreprises(Request $request)
    {
        $file = $request->file('file');
        try {
            Excel::import(new EntreprisesImport, $file);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) return back()->withErrors(['backupAlert' => $e->errorInfo[2], 'style' => 'alert-danger']);
            return back()->withErrors(['backupAlert' => 'Database error: ' . $e->getMessage(), 'style' => 'alert-danger']);
        }
        return back()->withErrors(['backupAlert' => "Etablissements imported successfully", 'style' => 'alert-primary']);
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
