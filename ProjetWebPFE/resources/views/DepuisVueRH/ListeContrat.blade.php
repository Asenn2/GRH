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
            <li><a class="dropdown-item " href="{{route('ListeEmploye')}}">Liste</a></li>
            <li><a class="dropdown-item disabled" href="{{route('ListeContrat')}}">Contrat</a></li>
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

<div class="row justify-content-center mt-1 ">
  @foreach($typecontrats as $typecontrat)
    <div class="col-2 mx-1 p-0" >
      <button type="button" class="btn  btn-primary w-100 p-0  " data-bs-toggle="modal" data-bs-target="#modalform{{$typecontrat->NomTypeContrat}}" style="height: 50px">
        <img src="/bootstrap-icons/icons/plus.svg" style="height: 80%"> 
          Un Contrat {{$typecontrat->NomTypeContrat}}
      </button>
    </div>
  @endforeach
      <!--Catch d'erreur -->
  
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
  
      <!--Catch de succes -->
      <div>
        @if(session()->has('success'))
          <div class="alert alert-success">
            {{session('success')}}
          </div>
        @endif    
      </div>      
  
    </div>


<div class="pt-4 d-flex justify-content-center "><a  class="text-center text-decoration-none border-bottom border-dark pb-1 font-italic text-muted" data-bs-toggle="modal" data-bs-target="#modalformType">Ajouter un type...&rarr;</a>  
</div>
<!--Modal qui s'ouvre a l'appui de ajouter un contrat pour ajouter un contrat a la table dans la base de donnée  -->

<div class="modal fade" id="modalformCDD" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%" style="max-width: 2000px">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ajout d'un Contrat</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{route('createContrat')}}">
            @csrf
            <p class="lead">Informations Contrat CDD:</p> 
            <div class="row">
              <div class="col border-end">
                <select name="employe_id" class="form-select">
                  <option value="">Sélectionner un employé</option>
                  @foreach($employes as $employe)
                      <option value="{{ $employe->idEmploye }}">Id:{{ $employe->idEmploye }} Nom:{{ $employe->nom }}</option>
                  @endforeach
              </select>
              
              
                <label for="NomEmployeur" class="form-label">Nom Employeur:</label>
                <input type="text" class="form-control" id="NomEmployeur" name="NomEmployeur">
              
              
              
                <label for="DebutContrat" class="form-label">Date DateDebutContrat(Y-m-d):</label>
                <input type="date" class="form-control" id="DebutContrat" name="DebutContrat">
                <label for="DateFinContrat" class="form-label">Date DateFinContrat(Y-m-d):</label>
                <input type="date" class="form-control" id="DateFinContrat" name="DateFinContrat">
              </div>

            </div>
              
            <div class="row">
                <p class="lead">Informations Poste :</p>
                
                  <label for="Fonction" class="form-label">Fonction:</label>
                  <input type="text" class="form-control" id="Fonction" name="Fonction">
                  <label for="AdresseLieuTravail" class="form-label">Adresse du Lieu de Travail:</label>
                  <input type="text" class="form-control" id="AdresseLieuTravail" name="AdresseLieuTravail">
                  <label for="Salaire" class="form-label">Salaire:</label>
                  <input type="text" class="form-control" id="Salaire" name="Salaire">

                  
            </div>
            <div class="row">
              <b class="mb-3">Condition de Travail:</b>
              
                <label for="NombreHeuresTravail" class="form-label">Nombre d'heure de travail par semaine:</label>
                <input type="text" class="form-control" id="NombreHeuresTravail" name="NombreHeuresTravail">

                Du                   <select class="form-select" aria-label="Default select example" name="JourDebutSemaine">
                  <option selected>Jour de semaine</option>
                  <option value="Lundi">Lundi</option>
                  <option value="Mardi">Mardi</option>
                  <option value="Mercredi">Mercredi</option>
                  <option value="Jeudi">Jeudi</option>
                  <option value="Vendredi">Vendredi</option>
                  <option value="Samedi">Samedi</option>  
                  <option value="Dimanche">Dimanche</option>


                </select>
                Au
                                   <select class="form-select" aria-label="Default select example" name="JourFinSemaine">
                                    <option selected>Jour de semaine</option>
                                    <option value="Lundi">Lundi</option>
                                    <option value="Mardi">Mardi</option>
                                    <option value="Mercredi">Mercredi</option>
                                    <option value="Jeudi">Jeudi</option>
                                    <option value="Vendredi">Vendredi</option>
                                    <option value="Samedi">Samedi</option>  
                                    <option value="Dimanche">Dimanche</option>
                  
                </select>
                De  
                <label for="HeureDebutJourneeTravail">Heure :</label>
              <input type="time" id="HeureDebutJourneeTravail" name="HeureDebutJourneeTravail">
                à
                <label for="HeureFinJourneeTravail">Heure :</label>
                <input type="time" id="HeureFinJourneeTravail" name="HeureFinJourneeTravail">
                
              
            </div>
              <div class="row">
                <b class="mb-3">Congé:</b>
                
                  <label for="NombrejourCongeRemunere" class="form-label">Nombre de jours de congé payé par an:</label>
                  <input type="text" class="form-control" id="NombrejourCongeRemunere" name="NombrejourCongeRemunere">
                  
                
              </div>
              <div class="row">
                <b class="mb-3">Résiliation:</b>
                <label for="JourResiliation" class="form-label">Date Resiliation:</label>
                <input type="date" class="form-control" id="JourResiliation" name="JourResiliation">

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary">
                    Ajouter
                </button>
              </div>
          </form>
        </div>
      </div>
     </div>
</div>

<div class="modal fade" id="modalformType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%" style="max-width: 2000px">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ajout d'un Contrat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('createTypeContrat')}}">
          @csrf
          <p class="lead">Informations Type de Contrat:</p> 
          <div class="row">

            
            
              <label for="NomTypeContrat" class="form-label">Nom Type de Contrat :</label>
              <input type="text" class="form-control" id="NomTypeContrat" name="NomTypeContrat">
            
            
            
              <label for="Desc" class="form-label">Description:</label>
              <textarea class="form-control" id="Desc" name="Desc"></textarea>



          </div>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
              <button type="button" class="btn btn-secondary"  data-bs-toggle="modal" data-bs-target="#modalformTypeListe" >Supprimer un Type</button>
              <button type="submit" class="btn btn-primary">
                  Ajouter
              </button>
            </div>
        </form>
      </div>
    </div>
</div>


<div class="modal fade" id="modalformTypeListe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%" style="max-width: 2000px">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ajout d'un Contrat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<table class="table">
  <thead>
    <tr class="table-primary">

      <th scope="col">idTypeContrat</th>
      <th scope="col">Nom du Type</th>
      <th scope="col">Description</th>
      <th colspan=""></th>
    </tr>
  </thead>
  <tbody>
    @foreach($typecontrats as $typecontrat)
    <tr class="typecontrat-{{$typecontrat->idTypeContrat}}">
      <td class="idTypeContrat">{{$typecontrat->idTypeContrat}}</td>
      <td class="NomTypeContrat">{{$typecontrat->NomTypeContrat}}</td>
      <td class="Desc">{{$typecontrat->Desc}}</td>

      <td>
        <form action="{{route('deleteTypeContrat',['typecontrat'=> $typecontrat])}}" class="pt-2" method="POST">
          @csrf
          @method('delete')
          <button type="submit" class="btn btn-link text-decoration-none border-bottom border-dark pb-1 font-italic text-danger">
              Delete &rarr;
          </button>
      </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>

            </div>
        
      </div>
    </div>
</div>



<!--Body-->

<div class="container-fluid">
  <div class="row mt-1">
    <!--PDF Contrat -->
    <div class="col-6">
      <iframe id="pdfViewer" src="" width="100%" height="600" frameborder="0"></iframe>
    </div>
    <!--Liste De Contrats -->
    <div class="col-6">
      <table class="table caption-top" id="ContratTable" >
        <caption class="text-body-secondary" >Liste des contrats :</caption>
        <input type="text" id="search" placeholder="Rechercher par l'iD de l'Employé">

        <thead>
          <tr class="table-primary">
            <th scope="col"></th>

            <th scope="col">idContrat</th>
            <th scope="col">statut</th>
            <th scope="col">Employé</th>
            <th scope="col">Condition</th>
            <th scope="col">Type de Contrat</th>
            <th scope="col">Debut Contrat</th>
            <th scope="col">Fin Contrat</th>
            <th scope="col">Délai Resiliation</th>
            <th colspan="2">Operations</th>
          </tr>
        </thead>
        <tbody>
          @foreach($contrats as $contrat)
          <tr class="contrat-{{$contrat->idContrat}}">
            <td>              <a class="text-decoration-dotted-line border-bottom border-dark pb-1 font-italic text-success afficherContrat" data-id-contrat="{{$contrat->idContrat}}" href="">
              Afficher &rarr;
          </a>
            </td>
            <td class="idContrat">{{$contrat->idContrat}}</td>
            <td class="statut">{{$contrat->statut}}</td>
            <td class="Employe">{{$contrat->Employe}}</td>
            <td class="Condition">{{$contrat->Condition}}</td>
            <td class="Type">{{$contrat->Type}}</td>
            <td class="Debut">{{$contrat->Debut}}</td>
            <td class="Fin">{{$contrat->Fin}}</td>
            <td class="DelaiResiliation">{{$contrat->DelaiResiliation}}</td>
            <td>
              <a class="text-decoration-dotted-line border-bottom border-dark pb-1 font-italic text-success" href="">
                Edit &rarr;
            </a>
            </td>
            <td>
              <form action="/ResponsableRH/Contrat/{{$contrat->idContrat}}" class="pt-2" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-link text-decoration-none border-bottom border-dark pb-1 font-italic text-danger">
                    Delete &rarr;
                </button>
            </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  //Renvoie à l'attribut src de iframe l'url du pdf contrat
  
$(document).ready(function() {
    $('.afficherContrat').on('click', function(event) {
        event.preventDefault();

        var contratId = $(this).data('id-contrat');
        $.ajax({
            url: '{{ route("wordtopdf", ":id") }}'.replace(':id', contratId),
            type: 'GET',
            success: function(response) {
                // La route du Pdf
                var pdfUrl = response.pdfpathurl;

                // console.log("URL du PDF :", pdfUrl); pour tester !

                $('#pdfViewer').attr('src', pdfUrl);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
   
    $('#search').on('keyup', function() {
        var query = $(this).val();
        $.ajax({
            url: '{{ route("employees.search") }}',
            type: 'POST',
            data: {_token: '{{ csrf_token() }}',query: query},
            success: function(response) {
                var tbody = $('#ContratTable tbody');
                tbody.empty();
                $.each(response, function(index, contrat) {
                    var row = '<tr class="contrat-' + contrat.idContrat + '">' +
                        '<td><a class="text-decoration-dotted-line border-bottom border-dark pb-1 font-italic text-success afficherContrat" data-id-contrat="' + contrat.idContrat + '" href="">Afficher &rarr;</a></td>' +
                        '<td class="idContrat">' + contrat.idContrat + '</td>' +
                        '<td class="statut">' + contrat.statut + '</td>' +
                        '<td class="Employe">' + contrat.Employe + '</td>' +
                          '<td class="Condition">' + contrat.Condition + '</td>' +
                           '<td class="Type">' + contrat.Type + '</td>' +
                      '<td class="Debut">' + contrat.Debut + '</td>' +
                     '<td class="Fin">' + contrat.Fin + '</td>' +
                             ' <td class="DelaiResiliation">' + contrat.DateResiliation + '</td>' +
                        '<td><a class="text-decoration-dotted-line border-bottom border-dark pb-1 font-italic text-success" href="">Edit &rarr;</a></td>' +
                '<td>' +
                   '<form action="/ResponsableRH/Contrat/' + contrat.idContrat + '" class="pt-2" method="POST">' +
                        '@csrf' +
                    '@method('delete')' +
                          '<button type="submit" class="btn btn-link text-decoration-none border-bottom border-dark pb-1 font-italic text-danger">Delete &rarr;</button>' +
                    '</form>' +
                            '</td>' +
                                  '</tr>';
                      tbody.append(row);
                });
            }
        });
    });


});


</script>