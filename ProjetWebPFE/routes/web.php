<?php

use App\Http\Controllers\DataBaseController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\WordToPdfController;
use App\Http\Middleware\RoleEmploye;
use App\Http\Middleware\RoleRH;
use App\Models\Departement;
use Illuminate\Support\Facades\Route;

// LOGIN + REGISTRATION

// Login Vue

Route::get('/', function () {
    return view('index');
})->name('login');

// Login Formulaire Authentification

Route::post('/', [LogController::class, "Log"])->name('loginPost');

// Registration Vue

Route::get('/registration', function () {
    return view('registration');
})->name('registration');

// Registration Formulaire 

Route::post('/registration', [LogController::class, "registrationpost"])->name('registration.post');

//

Route::delete('/logout', [LogController::class, "logout"])->name('logout');

Route::get('/Stage', [DataBaseController::class, "ListStage"])->name('ListStage');

Route::get('/Stage/{id}', [DataBaseController::class, "StageForm"])->name('StageForm');

Route::post('/Stage/{id}/Send', [DataBaseController::class, 'ajouterDemandeStage'])->name('ajouterDemandeStage');

Route::get('/admin', [DataBaseController::class, 'adminPannel'])->name('adminPannel');

Route::get('/admin/create', [DataBaseController::class, 'adminCreate'])->name('adminCreate');

Route::get('/admin/{id}/edit', [DataBaseController::class, 'adminEditForm'])->name('adminEditForm');

Route::get('/admin/{id}/update', [DataBaseController::class, 'adminUpdate'])->name('adminUpdate');

Route::delete('/admin/{id}', [DataBaseController::class, 'adminDelete'])->name('adminDelete');

//ListeOffreEmploi Vue

Route::get('/OffreEmploi', [DataBaseController::class, "CollecteOffreEmploi1"])->name('ListeOffreEmploi1');
Route::get('/Postuler/{id}', function ($id) {
    return view('DepuisVueIndex.DepuisVueListeOffreEmploi.PostulerForm', ['id' => $id]);
})->name('PostulerForm');
Route::post('/Postuler/{id}', [DataBaseController::class, "ajouterCandidature"])->name('ajouterCandidature');
//
Route::middleware([RoleEmploye::class])->group(function () {

    //EmployeHome Vue
    Route::get('/Employe/{id}', [DataBaseController::class, "EmployeHome"])->name("EmployeHome");

    Route::get('/Employe/{id}/Info', [DataBaseController::class, "InfosPers"])->name("InfosPers");

    Route::get('/Employe/{id}/Demande', [DataBaseController::class, "DemandeConge"])->name('DemandeConge');

    Route::post('/Employe/{id}/createDemande', [DataBaseController::class, "createDemandeConge"])->name('createDemandeConge');

    Route::get('/Employe/{id}/Formation', [DataBaseController::class, 'FormationEmploye'])->name('FormationEmploye');

    Route::get('/Employe/{id}/Promotion', [DataBaseController::class, 'PromotionEmploye'])->name('PromotionEmploye');

    Route::get('/Employe/{id}/demandeFormation/{idF}', [DataBaseController::class, 'DemandeFormation'])->name('DemandeFormation');

    Route::get('/Employe/{id}/demandePromotion/{idP}', [DataBaseController::class, 'DemandePromotion'])->name('DemandePromotion');

    //
});

Route::middleware([RoleRH::class])->group(function () {

    // ResponsableRH Vue

    // Retourne Vue avec Employé et Departement

    Route::get('/ResponsableRH', [DataBaseController::class, "CollecteEmployeetDepartement"])->name('ResponsableRH')->middleware(RoleRH::class);

    //

    //ListeEmployé Vue

    // Retourne Vue avec Employé et Departement et Poste et TypeContrat

    Route::get('/ResponsableRH/Employé', [DataBaseController::class, "Collecte_Employe_Poste_Departement_Contrat"])->name('ListeEmploye');

    // Ajoute un employé rempli dans le formulaire

    Route::post('/ResponsableRH/Employé', [DataBaseController::class, "storeEmp"])->name('storeemploye');

    // Modifie un employé rempli dans le formulaire
    Route::put('/ResponsableRH/Employé/{id}/update', [DataBaseController::class, 'updateemp'])->name('employe.update');


    // Rempli le formulaire avec les données de l'employé a modifier

    Route::get('/ResponsableRH/Employé/{id}', [DataBaseController::class, "show"])->name('employe.show');

    //Renvoie les données de l'employé a supprimer

    Route::delete('/ResponsableRH/Employé/{employe}/delete', [DatabaseController::class, 'delete'])->name('employé.delete');


    //    


    //ListeContrat Vue

    //Retourne la Vue avec les contrats 
    Route::get('/ResponsableRH/Contrat', [DataBaseController::class, "CollecteContrat"])->name('ListeContrat');

    //Crée le contrat et le stock en format word dans Public
    Route::post('/ResponsableRH/Contrat', [DataBaseController::class, "createContratCDD"])->name('createContrat');

    //Crée le type de contrat 
    Route::post('/ResponsableRH/typeContrat', [DataBaseController::class, "createTypeContrat"])->name('createTypeContrat');

    //Converti le word lié au contrat dans la table en pdf et le stock dans Public
    Route::get('/convert-word-to-pdf/{id}', [WordToPdfController::class, 'convertWordToPdf'])->name('wordtopdf');

    //Crée une url ayant le contrat en pdf puis le renvoie a la vue
    Route::get('/contrats/{pdfFileName}', [WordToPdfController::class, 'afficherPdf'])->name('afficher_pdf');

    Route::post('/contrat/search', [DataBaseController::class, 'search'])->name('employees.search');

    Route::delete('ResponsableRH/Contrat/TypeContrat/{typecontrat}', [DataBaseController::class, 'deleteTypeContrat'])->name('deleteTypeContrat');

    //

    //Responsable RH crée Offre d'Emploi

    //Retourne vue avec la liste d'Offre d'Emploi 
    Route::get('/ResponsableRH/OffreEmploi', [DataBaseController::class, "CollecteOffreEmploi2"])->name('ListeOffreEmploi2');

    //Ajoute l'Offre d'Emploi depuis le formulaire
    Route::post('/ResponsableRH/OffreEmploi', [DataBaseController::class, "storeoffreemploi"])->name('storeoffreemploi');

    //

    //Candidature Vue


    //Retourne vue avec les candidatures
    Route::get('/ResponsableRH/Candidature', [DataBaseController::class, "Collectecandidature"])->name('ListeCandidature');
    //Crée une url ayant le contrat en pdf puis le renvoie a la vue
    Route::get('/Candidat/{id}', [WordToPdfController::class, 'afficherCv'])->name('afficher_cv');

    Route::delete('/Candidature/{idcandidature}', [DataBaseController::class, "deleteCandidature"])->name('DeleteCandidature');
    //  

    //Promotion Vue

    //Retourne vue avec les promotions
    Route::get('/ResponsableRH/Promotion', [DataBaseController::class, "CollectePromotion"])->name('ListePromotion');

    //Crée une promotion
    Route::post('/ResponsableRH/Promotion', [DataBaseController::class, "CreatePromotion"])->name('CreatePromotion');
    //

    //Poste Vue

    //Retourne vue avec les postes
    Route::get('/ResponsableRH/Poste', [DataBaseController::class, "CollectePoste"])->name('ListePoste');

    //Créer un poste
    Route::post('/ResponsableRH/Poste/create', [DataBaseController::class, 'createPoste'])->name('createPoste');

    //Supprimer un poste
    Route::delete('/ResponsableRH/Poste/{id}/delete', [DataBaseController::class, 'deletePoste']);
    //

    //Departement Vue

    //Retourne vue avec les départements
    Route::get('/ResponsableRH/Departement', [DataBaseController::class, "CollecteDepartement"])->name('ListeDepartement');

    //Retourne vue pour créer un département
    Route::get('/ResponsableRH/Departement/create', function () {
        return view('DepuisVueRh.DepuisVueListeDepartement.createDepartement');
    })->name('createDepartement');

    //Ajoute le département 
    Route::post('/ResponsableRH/Departement', [DataBaseController::class, "storeDepartement"])->name('storeDepartement');

    //Suprrime le département 
    Route::delete('/ResponsableRH/Departement/{idd}', [DataBaseController::class, "deleteDepartement"])->name('deleteDepartement');

    //Renvoie vers la page createDepartement pour modifier avec les valeurs dans le formulaire  
    Route::get('/ResponsableRH/Departement/{departement}/edit', function (Departement $departement) {
        return view('DepuisVueRH.DepuisVueListeDepartement.createDepartement', ['departement' => $departement]);
    })->name('Departement.edit');

    //Modifie le département
    Route::put('/ResponsableRH/Departement/{dep}/modifier', [DataBaseController::class, "modifierDepartement"])->name('modifierDepartement');

    Route::get('/Departement/info/{id}', [DataBaseController::class, "InfoDepartement"])->name('InfoDepartement');

    Route::post('/Departement/Employe/search', [DataBaseController::class, 'searchInDepartement'])->name('employes.searchInDepartement');


    //


    //Stage Vue

    //Retourne la vue
    Route::get('/ResponsableRH/Stage', [DataBaseController::class, 'ListeStage'])->name('ListeStage');

    //Crée un type de Stage
    Route::post('/ResponsableRH/Stage/TypeStage', [DataBaseController::class, 'createTypeStage'])->name('createTypeStage');

    //Supprime un type de Stage
    Route::delete('/ResponsableRH/Stage/TypeStage/delete/{typestage}', [DataBaseController::class, 'deleteTypeStage'])->name('deleteTypeStage');

    //Crée un Stage
    Route::post('/ResponsableRH/Stage/create', [DataBaseController::class, 'createStage'])->name('createStage');

    //Supprime un stage
    Route::delete('/ResponsableRH/Stage/{stage}/delete', [DataBaseController::class, 'deleteStage'])->name('deleteStage');

    //Modifie un stage
    Route::put('/ResponsableRH/Stage/{id}', [DataBaseController::class, 'editStage'])->name('editStage');

    // Rempli le formulaire avec les données du Stage a modifier

    Route::get('/ResponsableRH/Stage/{id}', [DataBaseController::class, "showStage"])->name('Stage.show');


    //

    //Congé Vue

    //retourne vue
    Route::get('/ResponsableRH/Conge', [DataBaseController::class, "ListeConge"])->name('ListeConge');

    //Crée un type de Conge
    Route::post('/ResponsableRH/Conge/TypeConge', [DataBaseController::class, 'createTypeConge'])->name('createTypeConge');

    //Supprime un type de Congé
    Route::delete('/ResponsableRH/Conge/TypeConge/delete/{typeconge}', [DataBaseController::class, 'deleteTypeConge'])->name('deleteTypeConge');

    //Crée un Congé
    Route::post('/ResponsableRH/Conge/create', [DataBaseController::class, 'createCongeAnnuel'])->name('createCongeAnnuel');

    Route::get('/events', [DataBaseController::class, 'eventsConge'])->name('eventsConge');
    //

    //Formation Vue

    //Retourne Formation
    Route::get('/ResponsableRH/Formation', [DataBaseController::class, 'ListeFormation'])->name('ListeFormation');

    //Crée une Formation
    Route::post('/ResponsableRH/Formation', [DataBaseController::class, 'CreateFormation'])->name('CreateFormation');

    //Supprime une Formation
    Route::delete('/ResponsableRH/Formation/{id}/delete', [DataBaseController::class, 'DeleteFormation'])->name('DeleteFormation');

    Route::delete('/ResponsableRH/Formatioeeen/', [DataBaseController::class, 'DeleteFormation'])->name('test');

    //
});
