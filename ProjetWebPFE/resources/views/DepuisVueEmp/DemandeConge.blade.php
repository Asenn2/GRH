<!-- resources/views/demande-conge.blade.php -->
@extends('layout')

@section('title', 'Demande de Congé')

@section('content')
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
          <a class="nav-link disabled" aria-current="page" href="{{ route("DemandeConge",['id'=>$employe->idEmploye]) }}">Demande de Congé</a>
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

<section class="container mt-4">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header text-white" style="background-color: rgb(153,0,204)">
          <h4>Demande de Congé</h4>
        </div>
        <div class="card-body">
          @if(session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif

          <form action="{{route('createDemandeConge',['id'=>$employe->idEmploye]) }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="date_debut" class="form-label">Date de début</label>
              <input type="date" class="form-control" id="DateDebut" name="DateDebut" required>
            </div>
            <div class="mb-3">
              <label for="date_fin" class="form-label">Date de fin</label>
              <input type="date" class="form-control" id="DateFin" name="DateFin" required>
            </div>
            <div class="mb-3">
                <select name="typeConge_id" class="form-select">
                    <option value="">Sélectionner un Type </option>
                    @foreach($typeConges as $typeConge)
                        <option value="{{ $typeConge->idTypeConge }}">Id:{{ $typeConge->idTypeConge }} Nom:{{ $typeConge->NomTypeConge }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
              <label for="Description" class="form-label">Description</label>
              <textarea class="form-control" id="Description" name="Description" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer la demande</button>
            <button type="button" class="btn btn-secondary float-end" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Suivi des Requêtes</button>

          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasRightLabel">Suivi des Requêtes</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <!-- Include your tracking logic here -->
      @if($conges->isEmpty())
        <p>Aucune requête trouvée.</p>
      @else
        <ul class="list-group">
          @foreach($conges as $conge)
            <li class="list-group-item">
              <strong>Type de Congé:</strong> {{ $conge->typeConge->NomTypeConge }}<br>
              <strong>Date de début:</strong> {{ $conge->DateDebut }}<br>
              <strong>Date de fin:</strong> {{ $conge->DateFin }}<br>
              <strong>Status:</strong> {{ $conge->status }}
            </li>
          @endforeach
        </ul>
      @endif
    </div>
  </div>
@endsection
