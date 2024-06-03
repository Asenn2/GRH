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
          <a class="nav-link disabled" aria-current="page" href="{{route('ResponsableRH')}}">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Employés
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item " href="{{route('ListeEmploye')}}">Liste</a></li>
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
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <form action="{{route('logout')}}" method="post">
            @csrf
            @method('delete')
            <button><img src="/bootstrap-icons/icons/door-closed-fill.svg" style="height: 80%"></button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>

    <!--Partie situé en bas de la navbar  -->
<h6 class="text-center text-body-secondary" style="text-decoration: underline">Services:</h6>
<div class="row justify-content-center">
  <div class="col-3" >
    <button type="button" id="Départbtn" class="btn-lg  btn-primary w-100  " style="height: 50px">
        <img src="/bootstrap-icons/icons/house.svg" style="height: 80%"> 
        Départements
      </button>
    </div>
  <div class="col-3">
    <button type="button" id="Empbtn" class="btn-lg btn-primary w-100" style="height: 50px">
      <img src="/bootstrap-icons/icons/file-person.svg" style="height: 30px">  
      Employés
    </button>
  </div>
  <div class="col-3">
        <button type="button" class="btn-lg  btn-primary w-100  " data-bs-toggle="modal" data-bs-target="#modalform" style="height: 50px">
          <img src="/bootstrap-icons/icons/plus.svg" style="height: 80%"> 
            Ajouter une offre d'emploi
        </button>
  </div>
</div>
<hr>

<!--Modal pour ajouter une offre d'emploi -->

<div class="modal fade" id="modalform" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%" style="max-width: 2000px">
  <div class="modal-dialog modal-dialog-scrollable">

    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Ajout d'une offre d'emploi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form method="POST" action="{{ route('storeoffreemploi') }}" >
          @csrf
              <!--Poste-->
          <div class="row">
              <div class="col">
                  <select name="poste" class="form-select mb-3">
                      <option value="">Sélectionner un poste</option>
                      @foreach($postes as $poste)
                          <option value="{{ $poste->idPoste }}">{{ $poste->Fonction }} </option>
                      @endforeach
                  </select>
              </div>
          </div>
              <!--Departement-->
          <div class="row">
              <div class="col">
                  <select name="departement" class="form-select mb-3">
                      <option value="">Sélectionner un département</option>
                      @foreach($departements as $departement)
                          <option value="{{ $departement->idDepartement}}">{{ $departement->nom }} </option>
                      @endforeach
                  </select>
              </div>
          </div>
              <!--TypeContrat-->
           <div class="row">
              <div class="col">
                  <select name="typecontrat" class="form-select mb-3">
                      <option value="">Sélectionner un type de contrat</option>
                      @foreach($typecontrats as $typecontrat)
                          <option value="{{ $typecontrat->idTypeContrat}}">{{ $typecontrat->NomTypeContrat }} </option>
                      @endforeach
                  </select>
              </div>
           </div>
              <!--Informations Supplémentaire-->
          <div class="row">
              <p class="lead">Informations supplémentaire:</p>
              <div class=" mb-1">
                <label for="CompetenceRequise" class="form-label">Compétence Requise:</label>
                <input type="text" class="form-control" id="CompetenceRequise" name="CompetenceRequise">
              </div>
              <label for="Commentaire" class="form-label">Commentaire :</label>
              <textarea class="form-control" id="Commentaire" name="Commentaire" rows="4" placeholder="Saisissez votre commentaire ici"></textarea>
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



<script>
  var BtnEmp= document.getElementById('Empbtn');
  BtnEmp.addEventListener('click',function(){
    var TableEmp= document.getElementById('tableEmployé');
    var tableDepart=document.getElementById('tableDepart');
    if(TableEmp.style.display==='none'){
      TableEmp.style.display='block';
      tableDepart.style.display='none';
    }else {
      TableEmp.style.display='none';
    }
  })
  var Départbtn= document.getElementById('Départbtn');
  Départbtn.addEventListener('click',function(){
    var TableEmp= document.getElementById('tableEmployé');
    var tableDepart=document.getElementById('tableDepart');
    if(tableDepart.style.display==='none'){
      TableEmp.style.display='none';
      tableDepart.style.display='block';
    }else {
      tableDepart.style.display='none';
    }
  }) 
  var rechdepbtn= document.getElementById('rechdep');
  rechdepbtn.addEventListener('click',function(){
    var TableEmp= document.getElementById('tableEmployé');
    var tableDepart=document.getElementById('tableDepart');
    if(tableDepart.style.display==='none'){
    tableDepart.style.display='block';}
    }
  )



</script>

