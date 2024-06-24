@extends('layout')

@section('title', 'Demande de Congé')

@section('content')
@include('navbarEmp')

<!-- Catch de succès -->
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
    @elseif(session('error'))
    <p>{{session('error')}}</p>

    @endif
  </div>
  </div>
</div>

<section class="container mt-4">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header text-white" style="background-color: rgb(86,127,167)">
          <h4>Demande de Congé</h4>
        </div>
        <div class="card-body">
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
                    <option value="">Sélectionner un Type de Congé </option>
                    @foreach($typeConges as $typeConge)
                        <option value="{{ $typeConge->idTypeConge }}">{{ $typeConge->NomTypeConge }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
              <label for="Description" class="form-label">Description</label>
              <textarea class="form-control" id="Description" name="Description" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-outline-primary">Envoyer la demande</button>
            <button type="button" class="btn btn-outline-secondary float-end" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Suivi des Requêtes</button>

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
          @if($conge->status=="Refusé")
            <li class="list-group-item list-group-item-danger mb-2">
              <strong>Type de Congé:</strong> {{ $conge->typeConge->NomTypeConge }}<br>
              <strong>Date de début:</strong> {{ $conge->DateDebut }}<br>
              <strong>Date de fin:</strong> {{ $conge->DateFin }}<br>
              <strong>Status:</strong> {{ $conge->status }}
            </li>
            @elseif($conge->status=="Accepté")
            <li class="list-group-item list-group-item-success mb-2">
              <strong>Type de Congé:</strong> {{ $conge->typeConge->NomTypeConge }}<br>
              <strong>Date de début:</strong> {{ $conge->DateDebut }}<br>
              <strong>Date de fin:</strong> {{ $conge->DateFin }}<br>
              <strong>Status:</strong> {{ $conge->status }}
            </li>
            @elseif($conge->status=="En cours")
            <li class="list-group-item list-group-item-secondary mb-2">
              <strong>Type de Congé:</strong> {{ $conge->typeConge->NomTypeConge }}<br>
              <strong>Date de début:</strong> {{ $conge->DateDebut }}<br>
              <strong>Date de fin:</strong> {{ $conge->DateFin }}<br>
              <strong>Status:</strong> {{ $conge->status }}
            </li>
          @endif  
          @endforeach
        </ul>
      @endif
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
          @endif    });
        $(document).ready(function () {
        $('#DemConge').addClass('nav-link disabled');
    });
</script>
@endsection
  @endsection
