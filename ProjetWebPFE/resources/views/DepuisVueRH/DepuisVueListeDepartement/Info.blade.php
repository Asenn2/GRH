@extends('layout')
@section('title', 'Info & Statistiques Département')
@section('content')

<!-- La Navbar -->
@include('navbar')

<div class="container mt-4">
    <a href="#" class="btn btn-outline-secondary mb-2 " onclick="history.back()">Annuler</a>

    <div class="card shadow-lg">
        <div class="card-body">

            <!-- Widgets pour des statistiques rapides -->
            <div class="row text-center">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Nombre total d'employés</h5>
                            <p class="display-4">{{$nbremployes}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Nombre d'employés actifs</h5>
                            <p class="display-4">{{$nbremployesActifs}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Nombre de Stage en cours</h5>
                            <p class="display-4">{{$nbrStageActifs}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphiques -->
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4">
                    <h4 class="text-center">Status des Employés</h4>
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <canvas id="employeeStatusChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 mb-4">
                    <h4 class="text-center">Opportunité</h4>
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <canvas id="nbrtype"></canvas>
                        </div>
                    </div>
                </div>
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
        const nbremployesActifs = @json($nbremployesActifs);
        const nbrtype = @json($nbrtype);

        // Graphique Emplois par Département
        var ctx1 = document.getElementById('employeeStatusChart').getContext('2d');
        var employeeStatusChart = new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: ['Actifs', 'Inactifs'],
                datasets: [{
                    data: [{{$nbremployesActifs}}, {{$nbremployes - $nbremployesActifs}}],
                    backgroundColor: ['#36A2EB', '#FF6384']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });

        // Graphique Tâches par Statut
        const ctx2 = document.getElementById('nbrtype').getContext('2d');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: Object.keys(nbrtype),
                datasets: [{
                    label: 'Opportunité',
                    data: Object.values(nbrtype),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
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
