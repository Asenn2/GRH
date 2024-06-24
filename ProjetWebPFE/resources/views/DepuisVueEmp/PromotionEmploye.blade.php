@extends('layout')
@section('title','Login')
@section('content')

<!--La Navbar  -->

@include('navbarEmp')



  <div class="pt-4">
    <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="" class="btn btn-outline-info ms-3   ">
      Requete Promotions &rarr;
    </button>
  </div>

  <!--Body-->
  <div class="container mt-2">
    <div class="card shadow-lg w-100">
      <div class="card-body">
  <div class="row" style="--bs-gutter-x:0.75rem;--bs-gutter-y:10">
    @foreach($promotions as $promotion)
    <div class="col-4 ">
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
      </div>
    </div>
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
    @if($demandePromotion->status=="Accepté")
  <li class="list-group-item text-success">{{ $demandePromotion->promotion->poste->Fonction }} &rarr; {{$demandePromotion->status}} </li>
  @elseif($demandePromotion->status=="Refusé")
  <li class="list-group-item text-danger">{{ $demandePromotion->promotion->poste->Fonction }} &rarr; {{$demandePromotion->status}} </li>
@elseif($demandePromotion->status=="En cours")
<li class="list-group-item text-secondary">{{ $demandePromotion->promotion->poste->Fonction }} &rarr; {{$demandePromotion->status}} </li>
  @endif
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

@extends('script')
@section('scripts')

<script>
          $(document).ready(function () {
        $('#Promotion').addClass('nav-link disabled');
    });
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
@endsection
@endsection