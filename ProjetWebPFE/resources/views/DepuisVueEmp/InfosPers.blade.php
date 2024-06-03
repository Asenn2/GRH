@extends('layout')
@section('title', 'Informations Personnelles')
@section('content')

<!--La Navbar  -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand disabled" href="{{route('InfosPers', ['id' => $employe->idEmploye] )}}"><img src="/bootstrap-icons/icons/file-earmark-person.svg" style="height: 100%"> {{$employe->nom}}  {{ $employe->prenom }}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route("EmployeHome", ['id' => $employe->idEmploye]) }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route("DemandeConge",['id'=>$employe->idEmploye]) }}">Demande de Congé</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route("FormationEmploye",['id'=>$employe->idEmploye]) }}">Formations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route("PromotionEmploye",['id'=>$employe->idEmploye]) }}">Promotions</a>
          </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">
            <img src="/bootstrap-icons/icons/door-closed-fill.svg" style="height: 80%">
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Section Informations Personnelles -->
<section class="container mt-4">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header  text-white" style="background-color: rgb(153,0,204)">
          <h4>Informations Personnelles</h4>
        </div>
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-md-6">
              <h5>Nom:</h5>
              <p>{{ $employe->nom }}</p>
            </div>
            <div class="col-md-6">
              <h5>Prénom:</h5>
              <p>{{ $employe->prenom }}</p>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <h5>Email:</h5>
              <p>{{ $employe->mail }}</p>
            </div>
            <div class="col-md-6">
              <h5>Téléphone:</h5>
              <p>{{ $employe->Num }}</p>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <h5>Adresse:</h5>
              <p>{{ $employe->Adresse }}</p>
            </div>
            <div class="col-md-6">
              <h5>Poste:</h5>
              <p>{{ $employe->poste->Fonction }}</p>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <h5>Département:</h5>
              <p>{{ $employe->departement->nom }}</p>
            </div>
            <div class="col-md-6">
              <h5>Date d'embauche:</h5>
              <p>{{ $employe->dateEmb }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white py-0 mt-auto">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-5 ms-2">
        <h5 class="mb-3">Liens rapides</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="text-white">Accueil</a></li>
          <li><a href="#" class="text-white">Services</a></li>
          <li><a href="#" class="text-white">Contact</a></li>
          <li><a href="#" class="text-white">À propos</a></li>
        </ul>
      </div>
      <div class="col-md-5 ms-auto">
        <h5 class="mb-3">Contact</h5>
        <p>
          <i class="bi bi-geo-alt-fill"></i> 123 Rue de l'Entreprise, Ville, Pays<br>
          <i class="bi bi-telephone-fill"></i> +123 456 7890<br>
          <i class="bi bi-envelope-fill"></i> email@example.com
        </p>
      </div>
    </div>
    <div class="text-center mb-auto">
      <p>&copy; 2024 Nom de l'Entreprise. Tous droits réservés.</p>
    </div>
  </div>
</footer>
