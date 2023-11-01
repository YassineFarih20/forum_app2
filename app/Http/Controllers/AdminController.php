<?php

namespace App\Http\Controllers;

use App\Models\Etablissement;
use App\Models\Stagiaire;
use App\Models\Admin;
use App\Models\Entreprise;
use App\Models\Entretien;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;


class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth")->except(['index', 'handleLogin']);
    }
    public function index()
    {

        return view('admin.login');
    }

    public function dashboard()
    {
        $stg = Stagiaire::join('etablissements', 'etablissements.id', '=', 'stagiaires.etablissement_id')
            ->select('stagiaires.*', 'etablissements.nom as efp')->get();

        $entreprises = Entreprise::all();

        $loginaction = Stagiaire::where('status', 1)
            ->orWhere('status', 2)
            ->get();

        $entretien = Stagiaire::where('status', 2)->get();

        return view('admin.index', ['temp' => 1, 'stg' => $stg, 'entreprises' => $entreprises, 'loginaction' => $loginaction, 'Entretien' => $entretien]);
    }

    public function handleLogin(Request $request)
    {
        return Auth::attempt($request->only('login', 'password')) ? redirect()->route('admin.dashboard') : back()->withErrors(['login' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function deleteStudent($id)
    {
        $student = Stagiaire::find($id);

        if (!$student) {
            return redirect()->back();
        }

        $student->delete();

        return redirect()->back();
    }

    public function ajouterAdmin()
    {
        return view('admin.index', ['temp' => 2]);
    }

    public function analytics()
    {
        $stagiaires = count(Stagiaire::all());
        $entreprises = count(Entreprise::all());
        $entretiens = count(Entretien::all());
        $notConfirmed = count(Stagiaire::where('status', 0)->get());
        $confirmed = count(Stagiaire::where('status', 1)->get());
        $attended = count(Stagiaire::where('status', 2)->get());
        $stgNotConfirmed = Stagiaire::join('etablissements', 'etablissements.id', '=', 'stagiaires.etablissement_id')
            ->select('stagiaires.*', 'etablissements.nom as efp')
            ->where('status', 0)
            ->get();
        $stgConfirmed = Stagiaire::join('etablissements', 'etablissements.id', '=', 'stagiaires.etablissement_id')
            ->select('stagiaires.*', 'etablissements.nom as efp')
            ->where('status', '>', 0)
            ->get();
        $dataByEFP  = DB::table('stagiaires as s')
            ->join('etablissements as e', 's.etablissement_id', '=', 'e.id')
            ->select(
                'e.nom',
                DB::raw('count(*) AS total'),
                DB::raw('SUM(CASE WHEN s.status in (1,2) THEN 1 ELSE 0 END) AS status_1_count'),
                DB::raw('SUM(CASE WHEN s.status = 2 THEN 1 ELSE 0 END) AS status_2_count'),
                DB::raw('SUM(CASE WHEN s.status = 0 THEN 1 ELSE 0 END) AS status_0_count')
            )
            ->groupBy('e.id', 'e.nom')
            ->get();
        $interviewData = DB::table('entretiens as ent')
            ->join('entreprises as e', 'ent.entreprise_id', '=', 'e.id')
            ->join('stagiaires as s', 'ent.stagiaire_id', '=', 's.id')
            ->join('etablissements as efp', 'efp.id', '=', 's.etablissement_id')
            ->select(
                's.matricule',
                's.nom',
                's.prenom',
                'e.raisonabregee as entreprise',
                'efp.nom as etablissement',
                'ent.status',
            )->orderBy('s.nom')
            ->get();

        return view('admin.index', [
            'temp' => 7,
            'stagiaires' => $stagiaires,
            'entreprises' => $entreprises,
            'notConfirmed' => $notConfirmed,
            'confirmed' => $confirmed,
            'attended' => $attended,
            'dataByEFP' => $dataByEFP,
            'entretiens' => $entretiens,
            'stgNotConfirmed' => $stgNotConfirmed,
            'stgConfirmed' => $stgConfirmed,
            'interviewData' => $interviewData,
        ]);
    }

    public function ajouterEntreprise()
    {
        return view('admin.index', ['temp' => 3]);
    }

    public function add_a(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'password' => 'required|min:6',
        ]);
        $admin = new admin();
        $admin->login = strip_tags($request->input('name'));
        $admin->password = Hash::make(strip_tags($request->input('password')));
        $admin->role = 1;
        try {
            $admin->save();
        } catch (QueryException $e) {
            // MySQL error code for duplicate entry violation
            if ($e->errorInfo[1] == 1062) return redirect()->back()->withInput()->withErrors(['alert' => $e->errorInfo[2], 'style' => 'alert-danger']);
            return redirect()->back()->withInput()->withErrors(['alert' => 'Database error: ' . $e->getMessage(), 'style' => 'alert-danger']);
        }

        return redirect()->back()->withErrors(['alert' => "Etablissement inserted successfully", 'style' => 'alert-success']);
    }

    public function add_e(Request $request)
    {

        $request->validate([
            'raisonabregee' => 'required|string|max:20',
            'raisonsociale' => 'required|string|max:40',
            'representant' => 'required|string|max:50',
            'logo' => 'required|url',
            'web' => 'required|url',
            'email' => 'required|email|max:150',
            'stand' => 'required|integer',
        ]);

        $entreprise = new Entreprise();
        $entreprise->raisonabregee = strip_tags($request->input('raisonabregee'));
        $entreprise->raisonsociale = strip_tags($request->input('raisonsociale'));
        $entreprise->representant = strip_tags($request->input('representant'));
        $entreprise->logo = strip_tags($request->input('logo'));
        $entreprise->web = strip_tags($request->input('web'));
        $entreprise->email = strip_tags($request->input('email'));
        $entreprise->stand = strip_tags($request->input('stand'));

        try {
            $entreprise->save();
        } catch (QueryException $e) {
            // MySQL error code for duplicate entry violation
            if ($e->errorInfo[1] == 1062) return redirect()->back()->withInput()->withErrors(['alert' => $e->errorInfo[2], 'style' => 'alert-danger']);
            return redirect()->back()->withInput()->withErrors(['alert' => 'Database error: ' . $e->getMessage(), 'style' => 'alert-danger']);
        }

        return redirect()->back()->withErrors(['alert' => "Entreprise inserted successfully", 'style' => 'alert-success']);
    }

    public function add_s(Request $request)
    {

        $request->validate([
            'matricule' => 'required|string|max:255',
            'cin' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'dateNaissance' => 'required|date_format:Y-m-d',
            'email' => 'required|email|max:255',
            'telephone' => 'required|numeric|min:10',
            'filiere' => 'required|string|max:255',
            'sexe' => 'required|in:F,H',
        ]);

        $stg = new Stagiaire();
        $stg->matricule = strip_tags($request->matricule);
        $stg->cin = strip_tags($request->cin);
        $stg->nom = strip_tags($request->nom);
        $stg->prenom = strip_tags($request->prenom);
        $stg->dateNaissance = strip_tags($request->dateNaissance);
        $stg->email = strip_tags($request->email);
        $stg->telephone = strip_tags($request->telephone);
        $stg->filiere = strip_tags($request->filiere);
        $stg->sexe = strip_tags($request->sexe);
        $stg->etablissement_id = 1;

        try {
            $stg->save();
        } catch (QueryException $e) {
            // MySQL error code for duplicate entry violation
            if ($e->errorInfo[1] == 1062) return redirect()->back()->withInput()->withErrors(['alert' => $e->errorInfo[2], 'style' => 'alert-danger']);
            return redirect()->back()->withInput()->withErrors(['alert' => 'Database error: ' . $e->getMessage(), 'style' => 'alert-danger']);
        }

        return redirect()->back()->withErrors(['alert' => "Stagiaire inserted successfully", 'style' => 'alert-success']);
    }

    public function add_etab(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $etablissement = new Etablissement();
        $etablissement->nom = strip_tags($request->nom);

        try {
            $etablissement->save();
        } catch (QueryException $e) {
            // MySQL error code for duplicate entry violation
            if ($e->errorInfo[1] == 1062) return redirect()->back()->withInput()->withErrors(['alert' => $e->errorInfo[2], 'style' => 'alert-danger']);
            return redirect()->back()->withInput()->withErrors(['alert' => 'Database error: ' . $e->getMessage(), 'style' => 'alert-danger']);
        }

        return redirect()->back()->withErrors(['alert' => "Etablissement inserted successfully", 'style' => 'alert-success']);
    }

    public function ajouterEtab()
    {
        return view('admin.index', ['temp' => 6]);
    }

    public function ajouterStagiaire()
    {
        return view('admin.index', ['temp' => 5, 'etabs' => Etablissement::all()]);
    }

    public function message()
    {
        return view('admin.index', ['temp' => 8, 'msgs' => Message::all()]);
    }
}
