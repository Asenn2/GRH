@extends('layout')
@section('title','Login')
@section('content')

<!--La Navbar  -->

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">GRH</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('ResponsableRH')}}">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Employés
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item disabled" href="{{route('ListeEmploye')}}">Liste</a></li>
            <li><a class="dropdown-item " href="{{route('ListeContrat')}}">Contrat</a></li>
            <li><a class="dropdown-item" href="{{route('ListeCandidature')}}">Candidature</a></li>
            <li><a class="dropdown-item " href="{{route('ListePoste')}}">Postes</a></li>
            <li><a class="dropdown-item " href="{{route('ListeConge')}}">Congé</a></li>

          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Carrières
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item  " href="{{route('ListePromotion')}}">Promotion</a></li>
            <li><a class="dropdown-item " href="{{route('ListeFormation')}}">Formation</a></li>

          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('ListeDepartement')}}">Départements</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Stages
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item " href="/ResponsableRH/Stage">Gestion de Stages</a></li>
            <li><a class="dropdown-item" href="#">Demande de Stage</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

  <!--Partie situé en bas de la navbar  -->

<div class="row justify-content-center">
  <div class="col-3" >
    <button type="button" class="btn  btn-primary w-100  " data-bs-toggle="modal" data-bs-target="#modalform" style="height: 50px">
      <img src="/bootstrap-icons/icons/person-add.svg" style="height: 80%"> 
        Ajouter un employé
    </button>

    <!--Catch d'erreur -->



    <!--Catch de succes -->
    <div>
      @if(session()->has('success'))
        <div class="alert alert-success">
          {{session('success')}}
        </div>
      @endif    
    </div>      

  </div>
</div>

  <!--Modal qui s'ouvre a l'appui de ajouter un employé pour ajouter un employé a la table dans la base de donnée  -->

  <div class="modal fade" id="modalform" tabindex="-1" aria-labelledby="modalform" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ajout d'un employé</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{route('storeemploye')}}" >
            @csrf 
            <p class="lead">Informations personnelles:</p>
            <div class="row">
              <div class="col mb-1">
                <label for="mail" class="form-label">mail</label>
                <input type="mail" class="form-control" id="mail" name="mail" value="">
              </div>
              <div class="col mb-1">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="">
              </div>
              <div class="col mb-1">
                <label for="prenom" class="form-label">Prénom:</label>
                <input type="text" class="form-control" id="prenom" name="prenom">
              </div>
            </div>
            <div class="row">
              <div class="col mb-1">
                <label for="sexe" class="form-label">Sexe:</label>
                <input type="text" class="form-control" id="sexe" name="sexe">
              </div>
              <div class="col mb-1">
                <label for="LieuNaiss" class="form-label">Lieu Naissance:</label>
                <input type="text" class="form-control" id="LieuNaiss" name="LieuNaiss">
              </div>
            </div>
            <div class="row">
              <div class="col mb-1">
                <label for="DateNaiss" class="form-label">Date Naissance(Y-m-d):</label>
                <input type="text" class="form-control" id="DateNaiss" name="DateNaiss">
              </div>
              <div class="col mb-1">
                <label for="Num" class="form-label">Num:</label>
                <input type="text" class="form-control" id="Num" name="Num">
              </div>
              <div class="col mb-1">
                <label for="Adresse" class="form-label">Adresse:</label>
                <input type="text" class="form-control" id="Adresse" name="Adresse">
              </div>
            </div>
                                    <hr>
            <p class="lead">Informations professionnelles:</p>

              <div class="row">
                <b class="mb-3">Poste:</b>
                <select name="poste_id" class="form-select">
                  <option value="">Sélectionner un Poste</option>
                  @foreach($postes as $poste)
                      <option value="{{ $poste->idPoste }}">Id:{{ $poste->idPoste }} Fonction:{{ $poste->Fonction }}</option>
                  @endforeach
              </select>
              </div>
              <div class="row">
                <b class="mb-3">Departement:</b>
                <select name="departement_id" class="form-select">
                  <option value="">Sélectionner un Departement</option>
                  @foreach($Departements as $Departement)
                      <option value="{{ $Departement->idDepartement }}">Id:{{ $Departement->idDepartement }} Nom:{{ $Departement->nom }}</option>
                  @endforeach
              </select>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary" id="ajouterEmployeBtn">Ajouter</button> <!-- Utilisation d'un bouton ordinaire pour empêcher la soumission du formulaire -->
            </div>
          </form>
            </div>
          
        </div>
        

    
        
      </div>
  </div>
 
  
<!--Modal qui s'ouvre a l'appui de edit pour modifier les données d'une ligne de la table  -->

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modifier un employé</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="#" id="EditEmployeForm">
          @csrf 
          <p class="lead">Informations personnelles:</p>
          <div class="row">
            <div class="col mb-1">
              <label for="maill" class="form-label">mail</label>
              <input type="mail" class="form-control" id="mailedit" name="maill" value="">
            </div>
            <div class="col mb-1">
              <label for="nomm" class="form-label">Nom</label>
              <input type="text" class="form-control" id="nomedit" name="nomm" value="">
            </div>
            <div class="col mb-1">
              <label for="prenomm" class="form-label">Prénom:</label>
              <input type="text" class="form-control" id="prenomedit" name="prenomm">
            </div>
          </div>
          <div class="row">
            <div class="col mb-1">
              <label for="sexee" class="form-label">Sexe:</label>
              <input type="text" class="form-control" id="sexeedit" name="sexee">
            </div>
            <div class="col mb-1">
              <label for="LieuNaisss" class="form-label">Lieu Naissance:</label>
              <input type="text" class="form-control" id="LieuNaissedit" name="LieuNaisss">
            </div>
          </div>
          <div class="row">
            <div class="col mb-1">
              <label for="DateNaisss" class="form-label">Date Naissance(Y-m-d):</label>
              <input type="text" class="form-control" id="DateNaissedit" name="DateNaisss">
            </div>
            <div class="col mb-1">
              <label for="Numm" class="form-label">Num:</label>
              <input type="text" class="form-control" id="Numedit" name="Numm">
            </div>
            <div class="col mb-1">
              <label for="Adressee" class="form-label">Adresse:</label>
              <input type="text" class="form-control" id="Adresseedit" name="Adressee">
            </div>
          </div>
                                  <hr>

            <div class="row">
              <b class="mb-3">Poste:</b>
              <select id="posteedit" name="posteedit" class="form-select">
                <option value="">Sélectionner un Poste</option>
                @foreach($postes as $poste)
                    <option value="{{ $poste->idPoste }}">Id:{{ $poste->idPoste }} Fonction:{{ $poste->Fonction }}</option>
                @endforeach
            </select>
            </div>
            <div class="row">
              <b class="mb-3">Departement:</b>
              <select id="departementedit" name="departemenedit" class="form-select">
                <option value="">Sélectionner un Departement</option>
                @foreach($Departements as $Departement)
                    <option value="{{ $Departement->idDepartement }}">Id:{{ $Departement->idDepartement }} Nom:{{ $Departement->nom }}</option>
                @endforeach
            </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-primary" id="modifierEmployeBtn">Modifier</button> <!-- Utilisation d'un bouton ordinaire pour empêcher la soumission du formulaire -->
          </div>
        </form>
          </div>
       
      </div>
      

      
      
    </div>
</div>


  <!-- Table pour afficher les employés -->

<table class="table caption-top" >
  <caption class="text-body-secondary" >Liste d'employé :</caption>
  <thead>
    <tr class="table-primary">
      <th scope="col">id</th>
      <th scope="col">mail</th>
      <th scope="col">Nom</th>
      <th scope="col">Prénom</th>
      <th scope="col">Sexe</th>
      <th scope="col">Lieu de Naissance</th>
      <th scope="col">Date de Naissance</th>
      <th scope="col">Adresse</th>
      <th scope="col">Num</th>
      <th scope="col">Departement</th>
      <th scope="col">Poste</th>
      <th colspan="2"> </th>
    </tr>
  </thead>
  <tbody>
    @foreach($employes as $employe)
    <tr class="employe-{{$employe->idEmploye}}">
      <td class="IdEmploye">{{$employe->idEmploye}}</td>
      <td class="mail">{{$employe->mail}}</td>
      <td class="nom">{{$employe->nom}}</td>
      <td class="prenom">{{$employe->prenom}}</td>
      <td class="sexe">{{$employe->sexe}}</td>
      <td class="LieuNaiss">{{$employe->LieuNaiss}}</td>
      <td class="DateNaiss">{{$employe->DateNaiss}}</td>
      <td class="Num">{{$employe->Num}}</td>
      <td class="Adresse">{{$employe->Adresse}}</td>
      <td class="idDepartement">{{$employe->idDepartement}}</td>
      <td class="idPoste">{{$employe->idPoste}}</td>
      <td>
        <a href="#" class="nav-link active edit-employe" data-bs-toggle="modal" data-bs-target="#editModal" data-employe="{{$employe->idEmploye}}">Edit</a>
      </td>
      <td>
        <form method="post" action="{{route('employé.delete',['employe'=>$employe])}}">
          @csrf 
          @method('delete')
          <input type="submit" class="btn btn-outline-danger" value="Delete"/>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
      var employeId,url;
      var employeData;
      var nom,prenom,sexe,LieuNaiss,DateNaiss,Num,idContrat,idDepartement,idPoste ;
 

    //Ouvre le modal et remplis les champs du formulaire
    $('.edit-employe').on('click', function() {
        employeId = $(this).data('employe');
        $.ajax({
            url: '/ResponsableRH/Employé/' + employeId,
            type: 'GET',
            success: function(response) {
                // Les données du formulaire se remplissent ici
                $('#mailedit').val(response.mail);
                $('#nomedit').val(response.nom);
                $('#prenomedit').val(response.prenom);
                $('#sexeedit').val(response.sexe);
                $('#LieuNaissedit').val(response.LieuNaiss);
                $('#DateNaissedit').val(response.DateNaiss);
                $('#Numedit').val(response.Num);
                $('#Adresseedit').val(response.Adresse);
                $('#departementedit').val(response.idDepartement);
                $('#posteedit').val(response.idPoste);

                // Sélectionnez le formulaire par son ID (remplacez "monFormulaire" par l'ID de votre formulaire)
                var formulaire = $('#modalform');

                // Désactiver tous les champs du formulaire
                formulaire.find(':input').prop('disabled', true);
               /* var f=$('#EditEmployeForm').serialize();
                console.log(f);*/
            },
            error: function(xhr, status, error) {
                console.log(employeId);
            }
        });
    });

    $('#modifierEmployeBtn').on('click', function() {
        // Effectuez la requête AJAX
        $.ajax({
            url: '/ResponsableRH/Employé/'+employeId+'/update',
            type: 'put', // Utilisation de la méthode PUT pour la modification
            data: $('#EditEmployeForm').serialize(), // Sérialisation des données du formulaire
            success: function(response) {
                // Affichez un message de succès à l'utilisateur
    
            },
            error: function(xhr, status, error) {
                // Gérer les erreurs ici
                console.error('Erreur lors de la modification des données de l\'employé :', error);
                console.log('XHR:', xhr);
                console.log('Status:', status);
                console.log('Error:', error);
            }
        });
    });


               
</script>
 