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
            <li><a class="dropdown-item " href="{{route('ListeContrat')}}">Contrat</a></li>
            <li><a class="dropdown-item" href="{{route('ListeCandidature')}}">Candidature</a></li>
            <li><a class="dropdown-item disabled " href="{{route('ListePoste')}}">Postes</a></li>
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
  <div class="col-1" >
    <button type="button" class="btn  btn-primary w-100 " data-bs-toggle="modal" data-bs-target="#modalformPoste" style="height: 60px">
        Ajouter un Poste &rarr;
    </button>
    <hr>
  </div>
</div>

  <!--Modal pour ajouter un nouveau Poste -->

<div class="modal fade" id="modalformPoste" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%" style="max-width: 2000px">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ajout d'un Poste</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('createPoste')}}">
          @csrf
          <p class="lead">Informations sur le Poste:</p> 
          <div class="container">
              <label for="Fonction" class="form-label">Fonction du Poste:</label>
              <input type="text" class="form-control" id="Fonction" name="Fonction">

              <label for="AdresseLieuTravail" class="form-label">Adresse du lieu du Poste:</label>
              <input type="text" class="form-control" id="AdresseLieuTravail" name="AdresseLieuTravail">

              <label for="Salaire" class="form-label">Salaire du Poste:</label>
              <input type="text" class="form-control" id="Salaire" name="Salaire">

              <label for="Desc" class="form-label">Description:</label>
              <textarea class="form-control" id="Desc" name="Desc"></textarea>
          </div>
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

<!--Catch De Succès -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="toastSuccess" class="toast text-bg-success" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <strong class="me-auto">Alert</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      @if(session()->has('success'))
      {{session('success')}}
      @endif
    </div>
  </div>
</div>

<!--Catch D'erreur  -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="toastError" class="toast " role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <strong class="me-auto">Alert</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      @if ($errors->any())
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      @endif
    </div>
  </div>
</div>

<!--Body-->
<div class="row" style="--bs-gutter-x:0.75rem;--bs-gutter-y:10">
  @foreach($postes as $poste)
  <div class="col-3 ">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{$poste->Fonction}}</h5>
        <h6 class="card-subtitle mb-1 text-body-secondary">ID:{{$poste->idPoste}}</h6>
        <p class="card-text">Lieu de Travail: {{$poste->AdresseLieuTravail}}<br>Salaire:{{$poste->Salaire}}</p>
        @if($poste->Desc)
        <h6 class="card-subtitle mb-1 text-body-secondary">Description:</h6>
        <p class="text-body-secondary">{{$poste->Desc}}</p>
        @endif
        
      <a class="float-end btn btn-success" href=""><img src="/bootstrap-icons/icons/pencil.svg" style="height: 80%"> </a> 
      <form action="/ResponsableRH/Poste/{{$poste->idPoste}}/delete" method="POST">
        @csrf
        @method('delete')
      <button class="float-end btn btn-danger"><img src="/bootstrap-icons/icons/x-lg.svg" style="height: 80%"> </button>
      </form>
      </div>
    </div>
  </div>
  @endforeach
</div>





  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
      const toastSuccess = document.getElementById('toastSuccess');
      const toastError = document.getElementById('toastError');

        // Vérifier si la session contient un message de succès
        @if(session()->has('success'))
            // Sélectionner le toast et le montrer
            var bsToast = new bootstrap.Toast(toastSuccess);
            bsToast.show();
        @endif
        // Vérifier si la session contient un message d'erreur 
        @if ($errors->any())
            // Sélectionner le toast et le montrer
            var bsToast = new bootstrap.Toast(toastError);
            bsToast.show();
        @endif        
        
    });
               
</script>
  