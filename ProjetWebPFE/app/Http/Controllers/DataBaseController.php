<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
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
use App\Models\Tache;
use App\Models\TypeConge;
use App\Models\TypeContrat;
use App\Models\TypeStage;
use App\Models\User;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Shared\ZipArchive;
use DateTime;
use Dompdf\Dompdf;

class DataBaseController extends Controller
{

    //ResponsableRH Vue    
    // Collecte les lignes dans la table Employé et la table Département et les retourne a la vue ResponsableRH

    public function CollecteEmployeetDepartement()
    {
        $employe = Employe::all();
        $departement = Departement::all();
        $postes = Poste::all();
        $typecontrats = TypeContrat::all();
        return view('VueResponsableRH', ['employés' => $employe, 'departements' => $departement, 'postes' => $postes, 'typecontrats' => $typecontrats]);
    }

    // Recherche un employé et le retourne a la vue ResponsableRH

    public function RechercheEmployé(Request $request)
    {
        $request->validate([
            'rechercheemp' => 'required'
        ]);
        $rechercheemp = $request->rechercheemp;

        $employé = Employe::where('nom', $rechercheemp)->get();
        $departements = Departement::all();
        return view('VueResponsableRH', ['employés' => $employé, 'departements' => $departements]);
    }

    // Recherche un département et le retourne a la vue ResponsableRH

    public function Recherchedépartement(Request $request)
    {
        $request->validate([
            'recherchedepart' => 'required'
        ]);
        $recherchedepart = $request->recherchedepart;

        $departements = Departement::where('nom', $recherchedepart)->get();
        $employé = Employe::all();
        return view('VueResponsableRH', ['employés' => $employé, 'departements' => $departements]);
    }
    //

    //Employe Vue
    public function EmployeHome($id)
    {
        $employe = Employe::where('idEmploye', $id)->first();
        $conges = Conge::where('idEmploye', $id)
            ->orWhere('status', 'Approuvé')
            ->orWhere('TypeConge', 1)
            ->get();
        $taches = Tache::where('idEmploye', $id)->get();
        $annonces = Annonce::all();
        return view('VueEmployeHome', ['employe' => $employe, 'annonces' => $annonces, 'conges' => $conges, 'taches' => $taches]);
    }

    public function InfosPers($id)
    {
        $employe = Employe::where('idEmploye', $id)->first();
        return view('DepuisVueEmp.InfosPers', ['employe' => $employe]);
    }

    public function DemandeConge($id)
    {
        $typeConges = TypeConge::all();
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
        $employe = Employe::where('idEmploye', $id)->first();
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
            'Cv' => 'required|mimes:docx|max:2048'
        ]);
        $candidat = new StageCandidat();
        $candidat->nom = $request->nom;
        $candidat->prenom = $request->prenom;
        $candidat->Mail = $request->Mail;

        $file_name = time() . $request->file('Cv')->getClientOriginalName();
        $path = $request->file('Cv')->storeAs('Cv', $file_name, 'public');
        $candidat->Cv = $path;
        $candidat->save();

        $candidature = new DemandeStage();
        $candidature->idStage = $id;
        $candidature->idStageCandidat = $candidat->idStageCandidat;
        $candidature->Motivation = $request->Motivation;
        $candidature->save();
        return redirect(route('ListStage'))->with("success", "Demande envoyée");
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
            'password' => $request->password,
            'role' => $request->role,
            'idEmploye' => $request->idEmploye,
        ];
        $user->update($data);
        return redirect()->route('adminPannel')->with('success', 'Utilisateur Modifié');
    }
    public function adminDelete($id)
    {
        $user = login_table::where('idlogin_table', $id);
        $user->delete();
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
        $dep = Departement::findOrFail($id);
        $employes = Employe::where('idDepartement', $id)->get();
        $nbr = $employes->count();
        return view('DepuisVueRH.DepuisVueListeDepartement.Info', ['departement' => $dep, 'employes' => $employes, 'nbr' => $nbr]);
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
        $employes = Employe::all();
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
            'idDepartement' => $request->departementedit,
            'idPoste' => $request->posteedit,
        ];



        $employe->update($data);

        return response()->json();
    }

    //Supprime l'employé
    public function delete(Employe $employe)
    {
        $employe->delete();
        return redirect(route('ListeEmploye'))->with('success', 'Employé supprimé.');
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
            'Cv' => 'required|mimes:docx|max:2048'
        ]);
        $candidat = new Candidat();
        $candidat->nom = $request->nom;
        $candidat->prenom = $request->prenom;
        $candidat->Mail = $request->Mail;

        $file_name = time() . $request->file('Cv')->getClientOriginalName();
        $path = $request->file('Cv')->storeAs('Cv', $file_name, 'public');
        $candidat->Cv = $path;
        $candidat->save();



        $candidature = new Candidature();
        $candidature->idOffreEmploi = $id;
        $candidature->idCandidat = $candidat->idCandidat;
        $candidature->Motivation = $request->Motivation;
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
        return view('DepuisVueRH.ListePromotion', ['promotions' => $promotions, 'postes' => $postes, 'formations' => $formations, 'DemandePromotions' => $DemandePromotions]);
    }

    //Crée une promotion
    public function CreatePromotion(Request $request)
    {
        $request->validate([
            'poste_id' => 'required',
            'Commentaire' => 'required'
        ]);

        $promotion = new Promotion();
        $promotion->NouveauPoste = $request->input('poste_id');
        if ($request->formation_id) {
            $promotion->Formation = $request->input('formation_id');
        }
        $promotion->Commentaire = $request->Commentaire;
        $promotion->save();
        return redirect(route('ListePromotion'))->with('success', 'Nouveau Promotion Ajouté');
    }
    //

    //Formation Vue

    //Retourne Formation
    public function ListeFormation()
    {
        $formations = Formation::all();
        return view('DepuisVueRH.ListeFormation', ['formations' => $formations]);
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

        ]);
        Formation::create($request->all());
        return redirect(route('ListeFormation'))->with('success', 'Nouveau Promotion Ajouté');
    }

    //Supprimer un Poste
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
        return view('DepuisVueRH.ListeContrat', ['contrats' => $contrat, 'employes' => $employes, 'departements' => $departements, 'typecontrats' => $typecontrat]);
    }
    //Méthode pour créer un contrat et son fichier word et l'ajouter à la table

    public function createContratCDD(Request $request)
    {
        $request->validate([
            'employe_id' => 'required',
            'NomEmployeur' => 'required',
            'DebutContrat' => 'required',
            'DateFinContrat' => 'required',
            'Fonction' => 'required',
            'AdresseLieuTravail' => 'required',
            'Salaire' => 'required',
            'NombreHeuresTravail' => 'required',
            'JourDebutSemaine' => 'required',
            'JourFinSemaine' => 'required',
            'HeureDebutJourneeTravail' => 'required',
            'HeureFinJourneeTravail' => 'required',
            'NombrejourCongeRemunere' => 'required',
            'JourResiliation' => 'required',
        ]);
        $dateRes = new DateTime($request->JourResiliation);

        $poste = [
            'Fonction' => $request->Fonction,
            'AdresseLieuTravail' => $request->AdresseLieuTravail,
            'Salaire' => $request->Salaire,

        ];
        Poste::create($poste);
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
        $templateProcessor->setValue('{NombreHeuresTravail}', $request->NombreHeuresTravail);
        $templateProcessor->setValue('{JourDebutSemaine}', $request->JourDebutSemaine);
        $templateProcessor->setValue('{JourFinSemaine}', $request->JourFinSemaine);
        $templateProcessor->setValue('{HeureDebutJourneeTravail}', $request->HeureDebutJourneeTravail);
        $templateProcessor->setValue('{HeureFinJourneeTravail}', $request->HeureFinJourneeTravail);
        $templateProcessor->setValue('{NombrejourCongeRemunere}', $request->NombrejourCongeRemunere);
        $templateProcessor->setValue('{JourResiliation}', $request->JourResiliation);

        // Chemin de stockage pour le contrat généré
        $docPath = public_path('Contrats/Contrat/contract_' . uniqid() . '.docx');
        $templateProcessor->saveAs($docPath);

        $contrat = [
            'status' => 'En cours',
            'Employe' => $idEmploye,
            'Conditions' => 1,
            'Type' => 1,
            'Debut' => $request->DebutContrat,
            'Fin' => $request->DateFinContrat,
            'DateResiliation' =>  $dateRes->format('Y-m-d'),
            'contratFile' => $docPath,

        ];
        $cont = Contrat::create($contrat);




        // Retourner le chemin du contrat généré ou une redirection vers le contrat généré
        return redirect(route('ListeContrat'));
    }
    public function createTypeContrat(Request $request)
    {
        $typecontrat = new TypeContrat();
        $typecontrat->NomTypeContrat = $request->NomTypeContrat;
        $typecontrat->Desc = $request->Desc;
        $typecontrat->save();

        return redirect(route('ListeContrat'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $contrats = Contrat::where('Employe', 'like', "%$query%")->get();

        return response()->json($contrats);
    }

    public function deleteTypeContrat(TypeContrat $typecontrat)
    {

        $typecontrat->delete();
        return redirect(route('ListeContrat'))->with('success', 'Type de Contrat supprimé.');
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
    //

    //Congé
    public function ListeConge()
    {
        $typeconges = TypeConge::all();
        $conges = Conge::all();
        return view('DepuisVueRH.ListeConge', ['typeconges' => $typeconges, 'conges' => $conges]);
    }
    public function eventsConge()
    {
        $conges = Conge::all();
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
        return redirect(route('ListeConge'))->with('success', 'Type Ajouté avec Succès');
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
    //    
}
