@extends('layout')
@section('title', 'Dashboard')
@section('content')

<!-- La Navbar -->
@include('navbar')

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-body">

            <!-- Partie située en bas de la navbar -->
            <h6 class="text-center text-body-secondary my-4" style="text-decoration: underline">Services Rapides:</h6>
            <div class="row justify-content-center mb-4">
                <div class="col-12 d-flex justify-content-around">
                    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalAddJob">
                        <i class="bi bi-plus-lg"></i> Ajouter une offre d'emploi
                    </button>
                    <a href="{{ route('ListeEmploye') }}" class="btn btn-success btn-lg">
                        <i class="bi bi-people"></i> Voir les employés
                    </a>
                    <button type="button" class="btn btn-info btn-lg" data-bs-toggle="modal" data-bs-target="#modalAddTask">
                        <i class="bi bi-card-checklist"></i> Ajouter une tâche
                    </button>
                    <button type="button" class="btn btn-info btn-lg" data-bs-toggle="modal" data-bs-target="#modalAddAnnonce">
                        <i class="bi bi-card-checklist"></i> Ajouter une Annonce
                    </button>
                </div>
            </div>
            <hr>

            <!-- Widgets et graphiques pour des statistiques rapides -->
            <div class="row text-center">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Nombre d'employés</h5>
                            <p class="display-4">{{ $nombreEmployes }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Offres d'emploi actives</h5>
                            <p class="display-4">{{ $nombreOffresEmploi }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Nombre de poste </h5>
                            <p class="display-4">{{ $nombrePostes }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphiques -->
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <canvas id="emploisParDepartement"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <canvas id="demandespartype"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="toastSuccess" class="toast text-bg-success" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <strong class="me-auto">Alert</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        @if(session()->has('success'))
            {{ session('success') }}
        @endif
    </div>
</div>

<div id="toastError" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <strong class="me-auto">Alert</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        @if ($errors->any() || session('error'))
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <p>{{ session('error') }}</p>
        @endif
    </div>
</div>
<!-- Modal pour ajouter une offre d'emploi -->
<div class="modal fade" id="modalAddJob" tabindex="-1" aria-labelledby="modalAddJobLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajout d'une offre d'emploi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('storeoffreemploi') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="poste" class="form-label">Poste</label>
                        <select name="poste" class="form-select">
                            <option value="">Sélectionner un poste</option>
                            @foreach($postes as $poste)
                                <option value="{{ $poste->idPoste }}">{{ $poste->Fonction }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="departement" class="form-label">Département</label>
                        <select name="departement" class="form-select">
                            <option value="">Sélectionner un département</option>
                            @foreach($departements as $departement)
                                <option value="{{ $departement->idDepartement }}">{{ $departement->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="typecontrat" class="form-label">Type de Contrat</label>
                        <select name="typecontrat" class="form-select">
                            <option value="">Sélectionner un type de contrat</option>
                            @foreach($typecontrats as $typecontrat)
                                <option value="{{ $typecontrat->idTypeContrat }}">{{ $typecontrat->NomTypeContrat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="CompetenceRequise" class="form-label">Compétence Requise</label>
                        <input type="text" class="form-control" id="CompetenceRequise" name="CompetenceRequise">
                    </div>
                    <div class="mb-3">
                        <label for="Commentaire" class="form-label">Commentaire</label>
                        <textarea class="form-control" id="Commentaire" name="Commentaire" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour ajouter une tâche -->
<div class="modal fade" id="modalAddTask" tabindex="-1" aria-labelledby="modalAddTaskLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajout d'une tâche</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('creerTache')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="TitreTache" class="form-label">Titre de la Tâche</label>
                        <input type="text" class="form-control" id="titre" name="titre">
                    </div>
                    <div class="mb-3">
                        <label for="DescriptionTache" class="form-label">Description</label>
                        <textarea class="form-control" id="Description" name="Description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                      <select id="employe" name="employe" class="form-select">
                        <option value="">Sélectionner un Employé</option>
                        @foreach($employés as $employe)
                            <option value="{{ $employe->idEmploye }}">Nom:{{ $employe->nom }} Poste: {{$employe->poste->Fonction}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="mb-3">
                        <label for="DateEcheance" class="form-label">Date d'échéance</label>
                        <input type="date" class="form-control" id="DateEcheance" name="DateEcheance">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal pour ajouter une tâche -->
<div class="modal fade" id="modalAddAnnonce" tabindex="-1" aria-labelledby="modalAddTaskLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajout d'une tâche</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('creerAnnonce')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="Titre" class="form-label">Titre de l'annonce </label>
                        <input type="text" class="form-control" id="Titre" name="titre">
                    </div>
                    <div class="mb-3">
                        <label for="texte" class="form-label">Texte</label>
                        <textarea class="form-control" id="Description" name="texte" rows="3"></textarea>
                    </div>
                   
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@extends('script')
@section('scripts')
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
        @if ($errors->any() || session('error'))
            // Sélectionner le toast et le montrer
            var bsToast = new bootstrap.Toast(toastError);
            bsToast.show();
        @endif 
    });

    $(document).ready(function () {
        $('#home').addClass('nav-link disabled');
        
        // Données pour les graphiques
        const employesParDepartement = @json($employesParDepartement);
        const demandespartype = @json($demandespartype);

        // Graphique Emplois par Département
        const ctx1 = document.getElementById('emploisParDepartement').getContext('2d');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: Object.keys(employesParDepartement),
                datasets: [{
                    label: 'Nombre d\'employés',
                    data: Object.values(employesParDepartement),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true                        
                    }
                }
            }
        });

        // Graphique Tâches par Statut
        const ctx2 = document.getElementById('demandespartype').getContext('2d');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: Object.keys(demandespartype),
                datasets: [{
                    label: 'Nombre de Demande',
                    data: Object.values(demandespartype),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    });
</script>
@endsection
@endsection
