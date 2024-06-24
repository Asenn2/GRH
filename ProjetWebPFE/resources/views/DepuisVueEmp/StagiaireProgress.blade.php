@extends('layout')

@section('title', 'Gestion du Stagiaire')

@section('content')
@include('navbarEmp')

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-body">
            <!-- Progression du Stage -->
            <div class="row mb-4">
                <div class="col-12">
                    <h4>Progression du Stagiaire {{$stagiaire->NomStagiaire}} {{$stagiaire->PrenomStagiaire}}</h4>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $stagiaire->progression }}%;" aria-valuenow="{{ $stagiaire->progression }}" aria-valuemin="0" aria-valuemax="100">{{ $stagiaire->progression }}%</div>
                    </div>
                    <p class="text-muted mt-2">Progression basée sur la complétion des tâches assignées.</p>
                </div>
            </div>
            <!-- Bouton pour attribuer des tâches -->
            <div class="row mb-3">
                <div class="col-12">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#attribuerTacheModal">
                        Attribuer une Tâche
                    </button>
                </div>
            </div>

            <!-- Modal pour attribuer des tâches -->
            <div class="modal fade" id="attribuerTacheModal" tabindex="-1" aria-labelledby="attribuerTacheModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="attribuerTacheModalLabel">Attribuer une Nouvelle Tâche</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('attribuerTache',['idS'=> $stagiaire->idStagiaire,'id'=>$employe->idEmploye]) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="contenu" class="form-label">Contenu de la tâche</label>
                                    <textarea class="form-control" id="contenu" name="contenu" required></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Attribuer la Tâche</button>
                                </div>
                            </form>
                        </div>
                    </div>
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
                                    @if($tache->status=='Pas Encore')
                                    <div class="float-end">  
                                    <a  class="btn btn-outline-success" href="{{route('TacheStagiaireGestion',['id'=>$tache->id,'action'=>'Termine','idEmp'=>$employe->idEmploye])}}">Terminé</a>
                                    </div>
                                    @elseif($tache->status=='Termine') 
                                    <div class="float-end">  
                                    <a  class="btn btn-outline-danger" href="{{route('TacheStagiaireGestion',['id'=>$tache->id,'action'=>'Pas Encore','idEmp'=>$employe->idEmploye])}}">Pas Encore</a>
                                    </div>
                                        @endif
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
