@extends('layout')
@section('title', 'Informations Personnelles')
@section('content')

<!--La Navbar  -->
@include('navbarStagiaire')

<!-- Section Informations Personnelles et Professionnelles -->
<section class="container mt-4">
  <div class="row">
    <div class="col-md-12">
      <div class="accordion" id="accordionInformations">
        <!-- Informations Personnelles -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="background-color: rgb(86,127,167); color: white;">
              Informations Personnelles
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionInformations">
            <div class="accordion-body">
              <div class="row mb-3">
                <div class="col-md-6">
                  <h5>Nom:</h5>
                  <p>{{ $stagiaire->NomStagiaire }}</p>
                </div>
                <div class="col-md-6">
                  <h5>Prénom:</h5>
                  <p>{{ $stagiaire->PrenomStagiaire }}</p>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-6">
                  <h5>Email:</h5>
                  <p>{{ $stagiaire->Mail }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Informations Professionnelles -->
        <div class="accordion-item mt-3">
          <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="background-color: rgb(86,127,167); color: white;">
              Informations Professionnelles
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionInformations">
            <div class="accordion-body">
              <div class="row mb-3">
                <div class="col-md-6">
                  <h5>Type du Stage:</h5>
                  <p>{{ $stagiaire->stage->typestage->NomTypeStage }}</p>
                </div>
                <div class="col-md-6">
                  <h5>Objectif du Stage:</h5>
                  <p>{{ $stagiaire->stage->Objectif }}</p>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-6">
                  <h5>Debut du Stage:</h5>
                  <p>{{ $stagiaire->DebutStage }}</p>
                </div>
                <div class="col-md-6">
                  <h5>Fin du Stage:</h5>
                  <p>{{  $stagiaire->FinStage }}</p>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-6">
                  <h5>Manager</h5>
                  <p>{{$stagiaire->manager->nom}} {{$stagiaire->manager->prenom}}</p>
                  <p>{{$stagiaire->manager->mail}}</p>
              </div>
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
