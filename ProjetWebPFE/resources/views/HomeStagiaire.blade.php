@extends('layout')

@section('title', 'Accueil Stagiaire')

@section('content')
@include('navbarStagiaire')

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-body">
            <!-- Progression du Stage -->
            <div class="row mb-4">
                <div class="col-12">
                    <h4>Progression de votre Stage</h4>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $stagiaire->progression }}%;" aria-valuenow="{{ $stagiaire->progression }}" aria-valuemin="0" aria-valuemax="100">{{ $stagiaire->progression }}%</div>
                    </div>
                    <p class="text-muted mt-2">Progression basée sur la complétion des tâches assignées.</p>
                </div>
            </div>

            <!-- Section pour les tâches assignées -->
            <div class="row mb-4">
                <div class="col-12">
                    <h5>Tâches Assignées</h5>
                    <ul class="list-group">
                        @forelse ($tacheStage as $tache)
                            <li class="list-group-item">
                                {{$tache->contenu}} 
                            </li>
                        @empty
                            <li class="list-group-item">Aucune tâche assignée pour le moment.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Autres sections ici... -->
</div>

@endsection
