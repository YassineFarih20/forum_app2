<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\inscriptionController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\StagiaireController;
use App\Http\Controllers\ApplicationController;

Route::get('/', fn () => view('index'))->name('acceuil');
Route::get('/about', fn () => view('about'))->name('about');
Route::get('/inscription', fn () => view('inscription'))->name('inscription');
Route::get('/reservationrdv', fn () => view('reservationrdv'))->name('reservationrdv');
Route::get('/invitation', fn () => view('invitation'))->name('invitation');
Route::get('/contact', fn () => view('contact'))->name('contact');


Auth::routes();


Route::post('/getStagiaire', [inscriptionController::class, 'getStagiaire'])->name('getStagiaire');
Route::patch('/enregistrerinscription', [inscriptionController::class, 'enregistrerInscription'])->name('enregistrerInscription');
// Route::get('/annulerinscription/{cin}', [App\Http\Controllers\inscriptionController::class, 'annulerInscription'])->name('annulerinscription');




// Admin Routes
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/student/delete/{id}', [AdminController::class, 'deleteStudent'])->name('student.delete');
    Route::get('/', [AdminController::class, "index"])->name('index');
    Route::get('/dashboard', [AdminController::class, "dashboard"])->name('dashboard');
    Route::get('/analytics', [AdminController::class, "analytics"])->name('analytics');
    Route::post('/auth', [AdminController::class, "handleLogin"])->name('handleLogin');
    Route::get('/message', [AdminController::class, "message"])->name('message');
    Route::post('/logout', [AdminController::class, "logout"])->name('logout');
    Route::group(['prefix' => 'backup', 'as' => 'backup.'], function () {
        Route::get('/', [BackupController::class, "index"])->name('index');
        Route::post('/importStagiaires', [BackupController::class, "importStagiaires"])->name('importStagiaires');
        Route::get('/exportStagiaires', [BackupController::class, "exportStagiaires"])->name('exportStagiaires');
        Route::post('/importEntreprises', [BackupController::class, "importEntreprises"])->name('importEntreprises');
        Route::get('/exportEntreprises', [BackupController::class, "exportEntreprises"])->name('exportEntreprises');
        Route::post('/importEtablissements', [BackupController::class, "importEtablissements"])->name('importEtablissements');
        Route::get('/exportEtablissements', [BackupController::class, "exportEtablissements"])->name('exportEtablissements');
        Route::get('/exportEFP', [BackupController::class, "exportEFP"])->name('exportEFP');
        Route::get('/exportStgPostule', [BackupController::class, "exportStgPostule"])->name('exportStgPostule');
        Route::get('/exportStgParticipants', [BackupController::class, "exportStgParticipants"])->name('exportStgParticipants');
        Route::get('/exportStgNonConfirme', [BackupController::class, "exportStgNonConfirme"])->name('exportStgNonConfirme');
    });
    Route::group(['prefix' => 'ajouter', 'as' => 'ajouter.'], function () {
        Route::get('/stagiaire', [AdminController::class, "ajouterStagiaire"])->name('ajouter_S');
        Route::get('/entreprise', [AdminController::class, "ajouterEntreprise"])->name('ajouter_E');
        Route::get('/admin', [AdminController::class, "ajouterAdmin"])->name('ajouter_A');
        Route::get('/etablissement', [AdminController::class, "ajouterEtab"])->name('ajouter_etab');
        Route::post('/addAdmin', [AdminController::class, "add_a"])->name('add_A');
        Route::post('/addEntreprises', [AdminController::class, "add_e"])->name('add_E');
        Route::post('/addStagiaire', [AdminController::class, "add_s"])->name('add_S');
        Route::post('/addEtab', [AdminController::class, "add_etab"])->name('add_Etab');
    });
});

Route::post('/sendMessage', [MessageController::class, "sendMessage"])->name('sendMessage');

Route::post('/apply-for-interview', [ApplicationController::class, "applyForInterview"])->name('apply-for-interview');

Route::get('/login', [EntrepriseController::class, 'loginIndex'])->name('login');
Route::post('/login', [EntrepriseController::class, 'login'])->name('login.action');
Route::post('/logout', [EntrepriseController::class, 'logout'])->name('logout.action');
Route::get('/entreprise/dashboard', [EntrepriseController::class, 'dashboard'])->name('entreprise.dashboard');
Route::get('/entreprise/logout', [EntrepriseController::class, 'logout'])->name('entreprise.logout');




Route::post('/presence/{cin}', [StagiaireController::class, 'marquerPresent'])->name('marquerPresent');
Route::post('/viewCv', [StagiaireController::class, 'viewCv'])->name('viewCV');
// Route::post('/cv/download', [AdminController::class, 'downloadCv'])->name('downloadCV');


Route::resources([
    'stagiaires' => stagiaireController::class,
    'entreprises' => entrepriseController::class,
]);


// // Route qui permet de connaître la langue active
// Route::get('local', [LocalizationController::class, 'getLang'])->name('getlang');

// // Route qui permet de modifier la langue
// Route::get('local/{lang}', [LocalizationController::class, 'setLang'])->name('setlang');
