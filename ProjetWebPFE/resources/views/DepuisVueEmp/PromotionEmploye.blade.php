@extends('layout')
@section('title','Login')
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
              <a class="nav-link disabled" aria-current="page" href="{{ route("PromotionEmploye",['id'=>$employe->idEmploye]) }}">Promotions</a>
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



  <div class="pt-4">
    <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="" class="btn btn-info ms-3   ">
      Requete Promotions &rarr;
    </button>
  </div>

  <!--Body-->
  <div class="row" style="--bs-gutter-x:0.75rem;--bs-gutter-y:10">
    @foreach($promotions as $promotion)
    <div class="col-3 ">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{$promotion->poste->Fonction}}</h5>
          <h5 class="card-subtitle mb-1 text-body-secondary text-center text-decoration-underline">Critère pour promotion: </h5>
          <h6 class="card-subtitle mb-1 text-body-secondary mt-1">Formation:</h6>
          @if($promotion->Formation)
          <p class="card-text">Nom de la Formation: {{$promotion->formation->NomFormation}}<br>Date de la formation :{{$promotion->formation->DateFormation}}</p>
          @else
          <p class="card-text" style="color: grey">Aucune formation nécessaire</p>
          @endif
  @if(!in_array($promotion->idPromotion, $demandesenvoye))
  <a class="btn btn-primary" href="{{route('DemandePromotion',['id'=>$employe->idEmploye,'idP'=>$promotion->idPromotion])}}" role="button">Demande d'évaluation</a>
@else
  <p class="text-success">Demande déja envoyée</p>
@endif
</div>
      </div>
    </div>
    @endforeach
</div>

        <!--Liste des Promotions-->

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Informations sur Promotions</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <h6 class="text-decoration-none border-bottom border-dark pb-1 font-italic text-muted">A propos</h6>
    <p>Chaque Promotion nécessite une evaluation qui sera géré par le RH et peut nécessiter une Formation.</p>
   <ul class="list-group list-group-flush mt-2">
    @foreach($demandesPromotion as $demandePromotion)
  <li class="list-group-item">{{ $demandePromotion->promotion->poste->Fonction }} &rarr; {{$demandePromotion->status}} </li>
  @endforeach
  </ul>
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