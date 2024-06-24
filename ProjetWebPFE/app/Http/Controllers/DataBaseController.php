<?php

namespace App\Http\Controllers;

use App\Mail\RDVMail;
use App\Models\Annonce;
use App\Models\Avantage;
use App\Models\Candidat;
use App\Models\Candidature;
use App\Models\Conge;
use App\Models\Contrat;
use App\Models\DemandeFormation;
use App\Models\DemandePromotion;
use App\Models\DemandeStage;
use App\Models\Departement;
use App\Models\Employe;
use App\Models\Formation;
use App\Models\login_table;
use App\Models\OffreEmploi;
use App\Models\Poste;
use App\Models\Promotion;
use App\Models\Stage;
use App\Models\StageCandidat;
use App\Models\Stagiaire;
use App\Models\Tache;
use App\Models\TacheStage;
use App\Models\TypeConge;
use App\Models\TypeContrat;
use App\Models\TypeStage;
use App\Models\User;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Shared\ZipArchive;
use DateTime;
use Dompdf\Dompdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class DataBaseController extends Controller
{

    //ResponsableRH Vue    
    // Collecte les lignes dans la table Employé et la table Département et les retourne a la vue ResponsableRH

    public function CollecteEmployeetDepartement()
    {
        $employe = Employe::all();
        $nbremploye = Employe::all()->count();
        $nbrpostes = Poste::all()->count();
        $postes = Poste::all();
        $nbrOffreEmploi = OffreEmploi::all()->count();
        $typecontrats = TypeContrat::all();
        $departements = Departement::all();
        $employesParDepartement = [];

        foreach ($departements as $departement) {
            $employes = Employe::where('idDepartement', $departement->idDepartement)->count();
            $employesParDepartement[$departement->nom] = $employes;
        }

        $nbrDemandeF = DemandeFormation::all()->count();
        $nbrDemandeP = DemandePromotion::all()->count();
        $nbrDemandeS = DemandeStage::all()->count();

        $demandespartype = [
            'Formation' => $nbrDemandeF,
            'Promotion' => $nbrDemandeP,
            'Stage' => $nbrDemandeS,
        ];

        return view('VueResponsableRH', [
            'employés' => $employe, 'departements' => $departements, 'postes' => $postes, 'typecontrats' => $typecontrats,
            'nombreEmployes' => $nbremploye,
            'nombreOffresEmploi' => $nbrOffreEmploi,
            'nombrePostes' => $nbrpostes,
            'employesParDepartement' => $employesParDepartement,
            'demandespartype' => $demandespartype
        ]);
    }

    public function creerTache(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'Description' => 'required',
            'employe' => 'required',
            'DateEcheance' => 'required|date|after:today',

        ]);
        $tache = new Tache();
        $tache->titre = $request->titre;
        $tache->Description = $request->Description;
        $tache->idEmploye = $request->input('employe');
        $tache->dateecheance = $request->DateEcheance;
        $tache->save();

        return redirect()->route('ResponsableRH')->with('success', 'Tache Comfirmé');
    }

    public function creerAnnonce(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'texte' => 'required',
        ]);
        $annonce = new Annonce();
        $annonce->titre = $request->titre;
        $annonce->texte = $request->texte;
        $annonce->save();

        return redirect()->route('ResponsableRH')->with('success', 'Annonce Comfirmé');
    }



    //

    //Employe Vue
    public function EmployeHome($id)
    {
        $employe = Employe::where('idEmploye', $id)->first();
        $conges = Conge::where('idEmploye', $id)
            ->orWhere('status', 'Accepté')
            ->orWhere('TypeConge', 1)
            ->get();
        $taches = Tache::where('idEmploye', $id)->get();
        $annonces = Annonce::all();
        return view('VueEmployeHome', ['employe' => $employe, 'annonces' => $annonces, 'conges' => $conges, 'taches' => $taches]);
    }

    public function PresenceEmploye($id, $action)
    {
        $employe = Employe::where('idEmploye', $id)->first();
        if ($action == "devientPlusPresent") {
            $employe->Etat = "Inactif";
        } elseif ($action == "devientPresent") {
            $employe->Etat = "Actif";
        }
        $employe->update();
        return  redirect()->route('EmployeHome', ['id' => $id]);
    }

    public function InfosPers($id)
    {
        $employe = Employe::where('idEmploye', $id)->first();
        return view('DepuisVueEmp.InfosPers', ['employe' => $employe]);
    }

    public function DemandeConge($id)
    {
        $typeConges = TypeConge::where('idTypeConge', '!=', 1)->get();
        $employe = Employe::where('idEmploye', $id)->first();
        $conges = Conge::where('idEmploye', $id)->get();
        return view("DepuisVueEmp.DemandeConge", ['typeConges' => $typeConges, 'employe' => $employe, 'conges' => $conges]);
    }

    public function createDemandeConge($id, Request $request)
    {
        $employe = Employe::where('idEmploye', $id)->first();
        $request->validate([
            'TypeConge',
            'DateDebut',
            'DateFin',
            'Description',
        ]);
        $conge = new Conge();
        $conge->TypeConge = $request->input("typeConge_id");
        $conge->DateDebut = $request->DateDebut;
        $conge->DateFin = $request->input("DateFin");
        $conge->Description = $request->input("Description");
        $conge->idEmploye = $id;
        $conge->status = "En cours";
        $conge->save();
        return redirect(route('DemandeConge', ['id' => $id]))->with('success', 'Nouvelle Demande Envoyé');
    }

    public function FormationEmploye($id)
    {
        $employe = Employe::where('idEmploye', $id)->first();
        $formations = Formation::all();
        $demandesenvoye = DemandeFormation::where('Employe', $id)->pluck('Formation')->toArray();
        $demandesformation = DemandeFormation::where('Employe', $id)->get();
        return view('DepuisVueEmp.FormationEmploye', ['employe' => $employe, 'formations' => $formations, 'demandesenvoye' => $demandesenvoye, 'demandesformations' => $demandesformation]);
    }

    public function DemandeFormation($id, $idF)
    {
        $formation = Formation::where('idFormation', $idF)->first();
        $demandeformation = new DemandeFormation();
        $demandeformation->Employe = $id;
        $demandeformation->Formation = $idF;
        $demandeformation->status = "En cours";
        $demandeformation->save();
        return redirect()->route('FormationEmploye', ['id' => $id])->with('success', 'Demande de Formation Envoyée');
    }

    public function PromotionEmploye($id)
    {
        $employe = Employe::where('idEmploye', $id)->first();
        $promotions = Promotion::all();
        $demandesenvoye = DemandePromotion::where('Employe', $id)->pluck('Promotion')->toArray();
        $demandespromotion = DemandePromotion::where('Employe', $id)->get();
        return view('DepuisVueEmp.PromotionEmploye', ['employe' => $employe, 'promotions' => $promotions, 'demandesenvoye' => $demandesenvoye, 'demandesPromotion' => $demandespromotion]);
    }

    public function DemandePromotion($id, $idP)
    {
        $employe = Employe::where('idEmploye', $id)->first();
        $promotion = Promotion::where('idPromotion', $idP)->first();
        $demandepromotion = new DemandePromotion();
        $demandepromotion->Employe = $id;
        $demandepromotion->Promotion = $idP;
        $demandepromotion->status = "En cours";
        $demandepromotion->save();
        return redirect()->route('PromotionEmploye', ['id' => $id])->with('success', 'Demande de Promotion Envoyée');
    }
    //

    //StageVue

    public function ListStage()
    {
        $stages = Stage::all();
        return view('DepuisVueIndex.ListeStage', ['stages' => $stages]);
    }

    public function StageForm($id)
    {
        return view('DepuisVueIndex.DepuisVueListeStage.DemandeStage', ['id' => $id]);
    }

    public function ajouterDemandeStage(Request $request, $id)
    {

        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'mail' => 'email',
            'Cv' => 'required|mimes:pdf|max:2048'
        ]);
        $candidat = new StageCandidat();
        $candidat->nom = $request->nom;
        $candidat->prenom = $request->prenom;
        $candidat->Mail = $request->Mail;

        $file_name = uniqid() . $request->file('Cv')->getClientOriginalName();
        $path = $request->file('Cv')->storeAs('DemandeStage/Cv', $file_name, 'public');
        //        dd(url('public/' . $path));
        $candidat->Cv = $path;
        $candidat->save();

        $candidature = new DemandeStage();
        $candidature->idStage = $id;
        $candidature->idStageCandidat = $candidat->idStageCandidat;
        $candidature->Motivation = $request->Motivation;
        $candidature->save();
        return redirect(route('ListStage'))->with("success", "Demande envoyée");
    }

    public function modifierStageDemande($id, $action, Request $request)
    {
        // Trouver la demande de promotion
        $demandee = DemandeStage::findOrFail($id);

        // Vérifier l'action et mettre à jour le statut en conséquence
        if ($action == 'Refuser') {
            $demandee->update(['status' => 'Refusé']);
        } elseif ($action == 'Accepter') {
            $demandee->update(['status' => 'Accepté']);
            $request->validate([
                'DateDebutStage' => 'required',
                'DateFinStage' => 'required'
            ]);
            $data = [
                'DebutStage' => $request->DateDebutStage,
                'FinStage' => $request->DateFinStage,
                'NomStagiaire' => $demandee->stagecandidat->nom,
                'PrenomStagiaire' => $demandee->stagecandidat->prenom,
                'Mail' => $demandee->stagecandidat->Mail,
                'idStage' => $demandee->idStage
            ];
            Stagiaire::create($data);
            login_table::create([
                'email' => $demandee->stagecandidat->Mail,
                'password' => $demandee->stagecandidat->nom . '123',
                'role' => 'Stagiaire'
            ]);
        } else {
            return redirect(route('ListeDemandeStage'))->with('error', 'Action invalide.');
        }

        // Rediriger avec un message de succès
        return redirect(route('ListeDemandeStage'))->with('success', 'Stagiaire ajouté avec succès.');
    }

    public function proposerRendezVous($mail, $id)
    {
        try {
            // Envoi de l'e-mail
            Mail::to($mail)->send(new RDVMail());

            // Mise à jour de la candidature
            $candidature = Candidature::findOrFail($id);
            $candidature->status = "Accepte";
            $candidature->update();

            return redirect()->route('ListeCandidature')->with('success', 'Rendez-vous envoyé');
        } catch (\Exception $e) {
            // Retourne un message d'erreur pour débogage
            return redirect()->route('ListeCandidature')->with('error', 'Erreur: ' . $e->getMessage());
        }
    }

    public function ListeElligible()
    {
        $formations = Formation::all();
        $promotions = Promotion::all();
        return view('DepuisVueRH.ListeElligible', ['formations' => $formations, 'promotions' => $promotions]);
    }

    public function adminPannel()
    {
        $users = login_table::all();
        return view('DepuisVueAdmin.ListeUser', ['users' => $users]);
    }

    public function adminCreate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required'
        ]);
        $user = new login_table();
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = $request->role;
        $user->save();
        return redirect(route('adminPannel'));
    }

    public function adminEditForm($id)
    {
        $user = login_table::findOrfail($id);
        return view('DepuisVueAdmin.EditForm', ['user' => $user]);
    }

    public function adminUpdate($id, Request $request)
    {
        $user = login_table::where('idEmploye', $id);
        $data = [
            'email' => $request->email,
            'role' => $request->role,
            'idEmploye' => $request->idEmploye,
        ];
        $employe = Employe::where('idEmploye', $id)->first();
        $employe->update(['mail' => $request->email]);
        if ($request->password) {
            $data['password'] = $request->password;
        }
        $user->update($data);
        return redirect()->route('adminPannel')->with('success', 'Utilisateur Modifié');
    }
    public function adminDelete($id)
    {
        $user = login_table::where('idlogin_table', $id);
        $user->delete();
        return redirect()->route('adminPannel')->with('success', 'Utilisateur Supprimé');
    }
    //

    //Departement Vue

    //Collecte les département et les renvoie a la vue
    public function CollecteDepartement()
    {
        $departement = Departement::all();
        return view('DepuisVueRH.ListeDepartement', ['departements' => $departement]);
    }

    //Rajoute le département dans ma base de données
    public function storeDepartement(Request $request)
    {
        $request->validate([
            'photo' => 'image|max:2048',
            'nom' => 'required|string|max:255',
            'Desc' => 'nullable|string',
        ]);
        $data = [
            'nom' => $request->nom,
            'Desc' => $request->Description,
            'photo' => null
        ];
        if ($request->hasFile('photo')) {

            $file_name = time() . $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('photos', $file_name, 'public');
            $data['photo'] = '/storage/' . $path;
        }

        Departement::create($data);
        return  redirect(route('ListeDepartement'));
    }

    //Supprime le département
    public function deleteDepartement($idd)
    {
        $dep = Departement::findOrFail($idd);
        $dep->delete();
        return redirect(route('ListeDepartement'));
    }

    //Modifie le département
    public function modifierDepartement(Departement $dep, Request $request)
    {
        $request->validate([
            'photo' => 'image|max:2048',
            'nom' => 'required|string|max:255',
            'Desc' => 'nullable|string',
        ]);
        $data = [
            'nom' => $request->nom,
            'Desc' => $request->Description,

        ];
        if ($request->hasFile('photo')) {
            $file_name = time() . $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('photos', $file_name, 'public');
            $data['photo'] = '/storage/' . $path;
        }
        $dep->update($data);
        return redirect(route('ListeDepartement'));
    }
    public function InfoDepartement($id)
    {
        $departement = Departement::findOrFail($id);
        $departements = Departement::all();
        $employesParDepartement = [];

        $nbremployes = Employe::where('idDepartement', $id)->count();
        $nbremployesActifs = Employe::where('Etat', 'Actif')->count();
        $nbrStageActifs = Stage::where('idDepartement', $id)->count();

        $nbrF = Formation::where('Departement', $id)->count();
        $nbrP = Promotion::where('Departement', $id)->count();
        $nbrS = Stage::where('idDepartement', $id)->count();

        $nbrtype = [
            'Formation' => $nbrF,
            'Promotion' => $nbrP,
            'Stage' => $nbrS,
        ];
        return view('DepuisVueRH.DepuisVueListeDepartement.Info', ['departement' => $departement, 'nbremployesActifs' => $nbremployesActifs, 'nbrStageActifs' => $nbrStageActifs, 'nbremployes' => $nbremployes, 'employesParDepartement' => $employesParDepartement, 'nbrtype' => $nbrtype]);
    }
    public function searchInDepartement(Request $request)
    {
        $query = $request->input('query');
        $employe = Employe::where('nom', "$query")->get();

        return response()->json($employe);
    }

    //

    //Employé Vue    

    // Collecte les lignes dans la table Employé

    public function Collecte_Employe_Poste_Departement_Contrat()
    {
        $employes = Employe::with(['departement', 'poste'])->get();
        $postes = Poste::all();
        $departements = Departement::all();
        $contrats = Contrat::all();
        return view('DepuisVueRH.ListeEmployé', [
            'employes' => $employes,
            'postes' => $postes,
            'Departements' => $departements,
            'contrats' => $contrats
        ]);
    }

    //Méthode pour ajouter un employé et un contrat a la table

    public function storeEmp(Request $request)
    {
        $request->validate([
            'mail' => 'required|email',
            'nom' => 'required',
            'prenom' => 'required',
            'sexe' => 'required',
            'LieuNaiss' => 'required',
            'DateNaiss' => 'date_format:Y-m-d',
            'Num' => 'required',
            'Adresse' => 'required',
            'poste_id' => 'required',
            'departement_id' => 'required',
        ]);

        $employe = new Employe;
        $employe->mail = $request->input('mail');
        $employe->nom = $request->input('nom');
        $employe->prenom = $request->input('prenom');
        $employe->sexe = $request->input('sexe');
        $employe->LieuNaiss = $request->input('LieuNaiss');
        $employe->DateNaiss = $request->input('DateNaiss');
        $employe->Num = $request->input('Num');
        $employe->Adresse = $request->input('Adresse');
        $employe->idDepartement = $request->input('departement_id');
        $employe->idPoste = $request->input('poste_id');
        $employe->dateEmb = Carbon::now()->toDateString();
        $employe->Etat = 'Inactif';


        $employe->save();


        return redirect(route('ListeEmploye'))->with("success", "Employé ajouté avec succès");
    }
    // Recupére les données d'un employé a partir de l'id pour l'afficher dans le formulaire
    public function show($id)
    {
        $employe = Employe::findOrFail($id);

        return response()->json($employe);
    }

    //Modifie les données de la table Employé
    public function updateemp(Request $request, $id)
    {
        $employe = Employe::findOrFail($id);


        $data = [
            'mail' => $request->maill,
            'nom' => $request->nomm,
            'prenom' => $request->prenomm,
            'sexe' => $request->sexee,
            'LieuNaiss' => $request->LieuNaisss,
            'DateNaiss' => $request->DateNaisss,
            'Num' => $request->Numm,
            'Adresse' => $request->Adressee,
            'idDepartement' => $request->input('departementedit'),
            'idPoste' => $request->input('posteedit'),
        ];



        $employe->update($data);

        return redirect(route('ListeEmploye'))->with("success", "Employé modifié avec succès");
    }

    //Supprime l'employé
    public function delete(Employe $employe)
    {
        $employe->delete();
        return redirect(route('ListeEmploye'))->with('success', 'Employé supprimé.');
    }

    public function FicheEmploye($id)
    {
        $employe = Employe::findOrFail($id);
        return view('DepuisVueRH.DepuisVueListeEmploye.FicheEmploye', ['employe' => $employe]);
    }
    public function AttestationTravail($id)
    {
        $employe = Employe::where('idEmploye', $id)->first();
        $templatePath = public_path('Attestation/modele.docx');

        // Initialisez le modèle avec le chemin correct
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);

        $templateProcessor->setValue('{NomEmploye}', $employe->nom);
        $templateProcessor->setValue('{PrenomEmploye}', $employe->prenom);
        $templateProcessor->setValue('{DateNaiss}', $employe->DateNaiss);
        $templateProcessor->setValue('{LieuNaiss}', $employe->LieuNaiss);
        $templateProcessor->setValue('{Poste}', $employe->poste->Fonction);
        $templateProcessor->setValue('{DateEmb}', $employe->dateEmb);

        $docPath = public_path('Attestation/AttestationEmploye/attestation_' . uniqid() . '.docx');
        $templateProcessor->saveAs($docPath);

        $domPdfPath = base_path('vendor/dompdf/dompdf');

        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
        $Content = \PhpOffice\PhpWord\IOFactory::load($docPath);
        $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content, 'PDF');

        $pdfFileName = time() . '.pdf';
        $pdfpath = public_path('Attestation/AttestationEmploye/' . $pdfFileName);
        $PDFWriter->save($pdfpath);

        return redirect()->route('FicheEmploye', ['id' => $id, 'file' => $pdfpath]);
    }

    //

    //OffreEmploi depuis le login

    // Collecte les lignes dans la table OffreEmploi 

    public function CollecteOffreEmploi1()
    {
        $offre = OffreEmploi::all();
        return view('DepuisVueIndex.ListeOffreEmploi', ['offres' => $offre]);
    }
    //Ajouter  une candidature
    public function ajouterCandidature(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'mail' => 'email',
            'Cv' => 'required|mimes:pdf|max:2048'
        ]);
        $candidat = new Candidat();
        $candidat->nom = $request->nom;
        $candidat->prenom = $request->prenom;
        $candidat->Mail = $request->Mail;

        $fileName = 'cv_' . time() . '_' . uniqid() . '.' . $request->file('Cv')->getClientOriginalExtension();

        $path = $request->file('Cv')->storeAs('Candidature/Cv', $fileName, 'public');
        //dd(url($path));
        $candidat->Cv = $path;
        $candidat->save();




        $candidature = new Candidature();
        $candidature->idOffreEmploi = $id;
        $candidature->idCandidat = $candidat->idCandidat;
        $candidature->Motivation = $request->Motivation;
        $candidature->status = 'En cours';
        $candidature->save();
        return redirect(route('ListeOffreEmploi1'))->with("success", "Candidature envoyée");
    }
    //

    //Promotion Vue    

    //Collecte les promotions et les renvoie à la vue
    public function CollectePromotion()
    {
        $promotions = Promotion::all();
        $postes = Poste::all();
        $formations = Formation::all();
        $DemandePromotions = DemandePromotion::all();
        $Departements = Departement::all();
        return view('DepuisVueRH.ListePromotion', ['promotions' => $promotions, 'Departements' => $Departements, 'postes' => $postes, 'formations' => $formations, 'DemandePromotions' => $DemandePromotions]);
    }

    //Crée une promotion
    public function CreatePromotion(Request $request)
    {
        $request->validate([
            'poste_id' => 'required',
            'Commentaire' => 'required',
            'Departement' => 'required'
        ]);

        $promotion = new Promotion();
        $promotion->NouveauPoste = $request->input('poste_id');
        if ($request->formation_id) {
            $promotion->Formation = $request->input('formation_id');
        }
        $promotion->Commentaire = $request->Commentaire;
        $promotion->Departement = $request->input('Departement');
        $promotion->save();
        return redirect(route('ListePromotion'))->with('success', 'Nouveau Promotion Ajouté');
    }

    public function modifierDPromotion($DemandePromotion, $action)
    {
        // Trouver la demande de promotion
        $demandee = DemandePromotion::findOrFail($DemandePromotion);

        // Vérifier l'action et mettre à jour le statut en conséquence
        if ($action == 'Refuser') {
            $demandee->update(['status' => 'Refusé']);
        } elseif ($action == 'Approuver') {
            $demandee->update(['status' => 'Accepté']);
        } else {
            return redirect(route('ListePromotion'))->with('error', 'Action invalide.');
        }

        // Rediriger avec un message de succès
        return redirect(route('ListePromotion'))->with('success', 'Demande modifiée avec succès.');
    }

    //

    //Formation Vue

    //Retourne Formation
    public function ListeFormation()
    {
        $formations = Formation::all();
        $demandeFormations = DemandeFormation::all();
        $Departements = Departement::all();
        return view('DepuisVueRH.ListeFormation', ['formations' => $formations, 'DemandeFormations' => $demandeFormations, 'Departements' => $Departements]);
    }

    //Retourne Formation
    public function CreateFormation(Request $request)
    {
        $request->validate([
            'NomFormation' => 'required',
            'DateFormation' => 'required',
            'DureeHeure' => 'required',
            'Format' => 'required',
            'Objectif' => 'required',
            'Departement' => 'required'

        ]);
        Formation::create($request->all());
        return redirect(route('ListeFormation'))->with('success', 'Nouveau Promotion Ajouté');
    }

    //Supprimer un Formation
    public function DeleteFormation($id)
    {
        $Formation = Formation::findOrFail($id);
        if ($Formation) {
            $Formation->delete();
            return redirect(route('ListeFormation'))->with('success', 'Formation Supprimé');
        } else {
            return redirect(route('ListeFormation'))->with('error', 'Erreur lors de l\'ajout du Formation ');
        }
    }
    //Modifier un Formation
    public function modifierFormation($id, Request $request)
    {
        $data = $request->validate([
            'NomFormation' => 'required',
            'DateFormation' => 'required',
            'DureeHeure' => 'numeric',
            'Format' => 'required',
            'Objectif' => 'required'
        ]);
        $formation = Formation::findOrFail($id);
        $formation->update($data);
        return redirect(route('ListeFormation'))->with('success', 'Formation Modifié');
    }

    public function modifierDemandeFormation($DemandeFormation, $action)
    {
        // Trouver la demande de promotion
        $demandee = DemandeFormation::findOrFail($DemandeFormation);

        // Vérifier l'action et mettre à jour le statut en conséquence
        if ($action == 'Refuser') {
            $demandee->update(['status' => 'Refusé']);
        } elseif ($action == 'Approuver') {
            $demandee->update(['status' => 'Accepté']);
        } else {
            return redirect(route('ListeFormation'))->with('error', 'Action invalide.');
        }

        // Rediriger avec un message de succès
        return redirect(route('ListeFormation'))->with('success', 'Demande de Formation modifiée avec succès.');
    }
    //

    //Poste Vue

    //Collecte les postes et les renvoie a la vue
    public function CollectePoste()
    {
        $postes = Poste::all();
        return view('DepuisVueRH.ListePoste', ['postes' => $postes]);
    }

    //Créer un poste
    public function createPoste(Request $request)
    {
        $request->validate([
            'Fonction' => 'required',
            'AdresseLieuTravail' => 'required',
            'Salaire' => 'numeric',
            'Desc' => 'nullable'
        ]);
        $poste = new Poste();
        $poste->Fonction = $request->Fonction;
        $poste->AdresseLieuTravail = $request->AdresseLieuTravail;
        $poste->Salaire = $request->Salaire;
        $poste->Desc = $request->Desc;
        $poste->save();
        return redirect(route('ListePoste'))->with('success', 'Nouveau Poste Ajouté');
    }

    //Supprimer un Poste
    public function deletePoste($id)
    {
        $poste = Poste::findOrFail($id);
        if ($poste) {
            $poste->delete();
            return redirect(route('ListePoste'))->with('success', 'Poste Supprimé');
        } else {
            return redirect(route('ListePoste'))->with('error', 'Erreur lors de l\'ajout du Poste ');
        }
    }

    //Modifier un poste
    public function modifierPoste($id, Request $request)
    {
        $data = $request->validate([
            'Fonctionedit' => 'required',
            'AdresseLieuTravailedit' => 'required',
            'Salaireedit' => 'numeric',
            'Descedit' => 'nullable'
        ]);
        $poste = Poste::findOrFail($id);
        $poste->Fonction = $request->Fonctionedit;
        $poste->AdresseLieuTravail = $request->AdresseLieuTravailedit;
        $poste->Salaire = $request->Salaireedit;
        $poste->Desc = $request->Descedit;
        $poste->update();
        return redirect(route('ListePoste'))->with('success', 'Poste Modifier');
    }
    //    

    //Candidature Vue

    // Collecte les lignes dans la table OffreEmploi et les renvoie en candidatures vers la vue

    public function Collectecandidature()
    {
        $candidatures = Candidature::all();

        return view('DepuisVueRH.ListeCandidature', ['candidatures' => $candidatures]); //return view('DepuisVueIndex.ListeCandidature',compact($candidatures));
    }

    public function deleteCandidature($id)
    {
        $candidature = Candidature::findOrFail($id);
        $candidature->delete();

        return redirect(route('ListeCandidature'))->with('success', 'Candidature Refusé.');
    }
    //

    //Méthode pour ajouter l'offre d'emploi
    public function storeoffreemploi(Request $request)
    {
        $offreEmploi = new OffreEmploi();

        $offreEmploi->IdTypeContrat = $request->input('typecontrat');
        $offreEmploi->IdPoste = $request->input('poste');
        $offreEmploi->Iddepartement = $request->input('departement');
        $offreEmploi->CompetenceRequise = $request->input('CompetenceRequise');
        $offreEmploi->Commentaire = $request->input('Commentaire');

        $offreEmploi->save();
        $id = $offreEmploi->idOffreEmploi;
        return redirect(route('ResponsableRH'))->with('success', 'Offre Ajouté avec Succès');
    }
    //

    //Contrat Vue


    // Collecte les lignes dans la table Contrat et les retourne a la vue ListeContrat

    public function CollecteContrat()
    {
        $contrat = Contrat::all();
        $employes = Employe::all();
        $departements = Departement::all();
        $typecontrat = TypeContrat::all();
        $postes = Poste::all();
        $avantages = Avantage::all();
        return view('DepuisVueRH.ListeContrat', ['contrats' => $contrat, 'employes' => $employes, 'departements' => $departements, 'typecontrats' => $typecontrat, 'postes' => $postes, 'avantages' => $avantages]);
    }
    //Méthode pour créer un contrat et son fichier word et l'ajouter à la table

    public function createContrat(Request $request)
    {
        $request->validate([
            'employe_id' => 'required',
            'DebutContrat' => 'required',
            'DateFinContrat' => 'required',
            'soldeCG' => 'required',
            'dateResiliation' => 'required',
        ]);
        $dateRes = new DateTime($request->JourResiliation);


        $idEmploye = $request->input('employe_id');
        $employe = Employe::findOrFail($idEmploye);





        $templatePath = public_path('Contrats/Template/templateCDD.docx');

        // Initialisez le modèle avec le chemin correct
        $templateProcessor = new
            TemplateProcessor($templatePath);

        $dateDebut = new DateTime($request->DebutContrat);
        $dateFin = new DateTime($request->DateFinContrat);
        $dureeContrat = $dateDebut->diff($dateFin);
        $totalDays = $dureeContrat->y * 12 + $dureeContrat->m + $dureeContrat->days;




        // Remplacer les balises de fusion dans le modèle par les données du formulaire
        $templateProcessor->setValue('{NomEmployeur}', $request->NomEmployeur);
        $templateProcessor->setValue('{NomEmploye}', $employe->nom);
        $templateProcessor->setValue('{DateNaissEmploye}', $employe->DateNaiss);
        $templateProcessor->setValue('{AdresseEmploye}', $employe->Adresse);
        $templateProcessor->setValue('{FonctionPoste}', $request->Fonction);
        $templateProcessor->setValue('{DateContrat}', $dateDebut->format('Y-m-d'));
        $templateProcessor->setValue('{DateFinContrat}', $dateFin->format('Y-m-d'));
        $templateProcessor->setValue('{DureeContrat}', $totalDays);
        $templateProcessor->setValue('{AdresseLieuTravail}', $request->AdresseLieuTravail);
        $templateProcessor->setValue('{Salaire}', $request->Salaire);
        $templateProcessor->setValue('{NombrejourCongeRemunere}', $request->soldeCG);
        $templateProcessor->setValue('{JourResiliation}', $request->JourResiliation);

        // Chemin de stockage pour le contrat généré
        $docPath = public_path('Contrats/Contrat/contract_' . uniqid() . '.docx');
        $templateProcessor->saveAs($docPath);

        $cont = [
            'status' => 'En cours',
            'Employe' => $idEmploye,
            'Avantage' => 1,
            'Type' => 1,
            'poste' => $request->input('poste_id'),
            'Debut' => $request->DebutContrat,
            'Fin' => $request->DateFinContrat,
            'soldeCG' => $request->soldeCG,
            'DateResiliation' =>  $dateRes->format('Y-m-d'),
            'contratFile' => $docPath,

        ];
        $contrat = Contrat::create($cont);

        // Ajouter les avantages au contrat
        if ($request->has('avantages')) {

            $avantages = $request->avantages;
            $contrat->avantages()->attach($avantages);
        }



        // Retourner le chemin du contrat généré ou une redirection vers le contrat généré
        return redirect(route('ListeContrat'))->with('success', 'Contrat ajouté');
    }
    public function createTypeContrat(Request $request)
    {
        $typecontrat = new TypeContrat();
        $typecontrat->NomTypeContrat = $request->NomTypeContrat;
        $typecontrat->Desc = $request->Desc;
        $typecontrat->save();

        return redirect(route('ListeContrat'));
    }


    public function deleteTypeContrat(TypeContrat $typecontrat)
    {
        $contrats = Contrat::where('Type', $typecontrat->idTypeContrat)->exists();
        if ($contrats) {
            return redirect(route('ListeContrat'))->with('error', 'Ce Type est utilisé par un contrat.');
        }

        $typecontrat->delete();
        return redirect(route('ListeContrat'))->with('success', 'Type de Contrat supprimé.');
    }

    public function deleteContrat($id)
    {
        $contrat = Contrat::findOrFail($id);
        $contrat->delete();

        return redirect(route('ListeContrat'))->with('success', 'Contrat supprimé.');
    }

    //

    //Stage Vue

    //Retourne vue
    public function ListeStage()
    {
        $typestages = TypeStage::all();
        $departements = Departement::all();
        $stages = Stage::all();
        return view('DepuisVueRH.ListeStage', ['typestages' => $typestages, 'departements' => $departements, 'stages' => $stages]);
    }

    //Créer un Type  
    public function createTypeStage(Request $request)
    {
        $request->validate([
            'NomType' => 'Required',
            'Desc' => 'nullable'

        ]);
        $typeStage = new TypeStage();
        $typeStage->NomTypeStage = $request->NomType;
        $typeStage->Desc = $request->Desc;
        $typeStage->save();
        return redirect(route('ListeStage'))->with('success', 'Type Ajouté avec Succès');
    }
    //Supprime un Type
    public function deleteTypeStage(TypeStage $typestage)
    {
        $typestage->delete();
        return redirect(route('ListeStage'))->with('success', 'Type Ajouté avec Succès');
    }

    //Crée un Stage
    public function createStage(Request $request)
    {
        $request->validate([
            'typestage_id' => 'required',
            'Objectif' => 'required',
            'departement_id' => 'required'
        ]);
        $Stage = new Stage();
        $Stage->Type = $request->input('typestage_id');
        $Stage->Objectif = $request->Objectif;
        $Stage->idDepartement = $request->input('departement_id');
        $Stage->Desc = $request->Desc;
        $Stage->save();
        return redirect(route('ListeStage'))->with('success', 'Stage Ajouté avec Succès');
    }

    //Supprime un Stage
    public function deleteStage(Stage $stage)
    {
        $stage->delete();
        return redirect(route('ListeStage'))->with('success', 'Stage supprimé avec Succès');
    }

    // Recupére les données d'un employé a partir de l'id pour l'afficher dans le formulaire
    public function showStage($id)
    {
        $stage = Stage::findOrFail($id);

        return response()->json($stage);
    }

    //Modifie le Stage
    public function editStage($id, Request $request)
    {
        $stage = Stage::findOrFail($id);
        $stage->update($request->all());
        return redirect(route('ListeStage'))->with('success', 'Stage modifié avec Succès');
    }

    //Demande Stage
    public function DemandeStage()
    {
        $DemandeStages = DemandeStage::all();
        return view('DepuisVueRH.ListeDemandeStage', ['DemandeStages' => $DemandeStages]);
    }
    //
    //

    //Congé
    public function ListeConge()
    {
        $typeconges = TypeConge::all();
        $conges = Conge::where('TypeConge', 1)->get();
        $demandes = Conge::where('TypeConge', '!=', 1)->get();
        return view('DepuisVueRH.ListeConge', ['typeconges' => $typeconges, 'conges' => $conges, 'demandes' => $demandes]);
    }

    public function eventsConge()
    {
        $conges = Conge::where('TypeConge', 1)->get();
        return response()->json($conges);
    }

    public function createTypeConge(Request $request)
    {

        $request->validate([
            'NomType' => 'Required',
            'Desc' => 'nullable'

        ]);
        $typeConge = new TypeConge();
        $typeConge->NomTypeConge = $request->NomType;
        $typeConge->Desc = $request->Desc;
        $typeConge->save();
        return redirect(route('ListeConge'))->with('success', 'Type Ajouté avec Succès');
    }

    //Supprime un Type
    public function deleteTypeConge(TypeConge $typeconge)
    {
        $typeconge->delete();
        return redirect(route('ListeConge'))->with('success', 'Type supprimé avec Succès');
    }

    //Crée un Congé
    public function createCongeAnnuel(Request $request)
    {
        $request->validate([
            'NomConge' => 'required',
            'DateDebut' => 'required',
            'DateFin' => 'required',
        ]);
        $Conge = new Conge();
        $Conge->TypeConge = '1';
        $Conge->NomConge = $request->NomConge;
        $Conge->DateDebut = $request->DateDebut;
        $Conge->DateFin = $request->DateFin;
        $Conge->Description = $request->Desc;
        $Conge->save();
        return redirect(route('ListeConge'))->with('success', 'Conge Ajouté avec Succès');
    }

    public function modifierDemande($demande, $action)
    {
        if ($action == 'Refuser') {
            $demandee = Conge::where('idConge', $demande)->first();
            $data = [
                'status' => 'Refusé'
            ];
            $demandee->update($data);
        } elseif ($action == 'Approuver') {
            $demandee = Conge::where('idConge', $demande)->first();
            $data = [
                'status' => 'Accepte'
            ];
            $demandee->update($data);
        }
        return redirect(route('ListeConge'))->with('success', 'Demande Modifié avec Succès');
    }
    //   

    //HomeStagiaire
    public function homeStagiaire($id)
    {
        $stagiaire = Stagiaire::where('Manager', $id)->first();
        $tacheStage = TacheStage::where('idStagiaire', $stagiaire->idStagiaire)->get();
        $nbrTache = TacheStage::where('idStagiaire', $stagiaire->idStagiaire)->count();
        $nbrTacheTermine = TacheStage::where('idStagiaire', $stagiaire->idStagiaire)
            ->where('status', 'Termine')
            ->count();
        $nbrTachePasEncore = TacheStage::where('idStagiaire', $stagiaire->idStagiaire)
            ->where('status', 'Pas Encore')
            ->count();
        if ($nbrTache > 0) {
            $progression = ($nbrTacheTermine / $nbrTache) * 100;
        } else {
            $progression = 0; // To avoid division by zero if no tasks are assigned
        }

        // Assign the calculated progression to the stagiaire object
        $stagiaire->progression = $progression;
        $stagiaire->save();
        return view('HomeStagiaire', ['stagiaire' => $stagiaire, 'tacheStage' => $tacheStage]);
    }

    public function StagiaireProgress($id)
    {
        $stagiaire = Stagiaire::where('Manager', $id)->first();
        $employe = Employe::where('idEmploye', $id)->first();
        $tacheStage = TacheStage::where('idStagiaire', $stagiaire->idStagiaire)->get();
        $nbrTache = TacheStage::where('idStagiaire', $stagiaire->idStagiaire)->count();
        $nbrTacheTermine = TacheStage::where('idStagiaire', $stagiaire->idStagiaire)
            ->where('status', 'Termine')
            ->count();
        if ($nbrTache > 0) {
            $progression = ($nbrTacheTermine / $nbrTache) * 100;
        } else {
            $progression = 0; // To avoid division by zero if no tasks are assigned
        }

        // Assign the calculated progression to the stagiaire object
        $stagiaire->progression = $progression;
        return view('DepuisVueEmp.StagiaireProgress', ['stagiaire' => $stagiaire, 'employe' => $employe, 'tacheStage' => $tacheStage]);
    }

    public function attribuerTache($id, $idS, Request $request)
    {
        $stagiaire = Stagiaire::where('Manager', $id)->first();
        $employe = Employe::where('idEmploye', $id)->first();
        $tacheStage = new TacheStage();
        $tacheStage->contenu = $request->contenu;
        $tacheStage->idStagiaire = $idS;
        $tacheStage->status = 'Pas Encore';
        $tacheStage->save();
        return redirect()->route('StagiaireProgress', ['id' => $employe->idEmploye]);
    }
    public function TacheStagiaireGestion($id, $action, $idEmp)
    {
        $tache = TacheStage::where('id', $id)->first();
        if ($action == 'Termine') {
            $data = [
                'status' => 'Termine'
            ];
            $tache->update($data);
        } elseif ($action == 'Pas Encore') {
            $data = [
                'status' => 'Pas Encore'
            ];
            $tache->update($data);
        }
        return redirect()->route('StagiaireProgress', ['id' => $idEmp]);
    }

    public function InfosStage($id)
    {
        $stagiaire = Stagiaire::where('idStagiaire', $id)->first();
        return view('DepuisVueEmp.InfosStagiaire', ['stagiaire' => $stagiaire]);
    }
}
