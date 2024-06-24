@extends('layout')
@section('title','Login')
@section('content')

<!--La Navbar  -->

@include('navbarEmp')


 
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

<div class="pt-4">
  <div class="row">
    <div class="col-3">
  <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="" class="btn btn-outline-info ms-3   ">
    Requete Formations &rarr;
  </button>
    </div>
  </div>
</div>

<!--Body-->
<div class="container mt-2">
  <div class="card shadow-lg w-100">
    <div class="card-body">
  <div class="row" style="--bs-gutter-x:0.75rem;--bs-gutter-y:10">
        @foreach($formations as $formation)
        <div class="col-4 ">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{$formation->NomFormation}}</h5>
              <h6 class="card-subtitle mb-1 text-body-secondary">ID:{{$formation->idFormation}}</h6>
              <p class="card-text">Durée de Formation: {{$formation->DureeHeure}}H<br>Format:{{$formation->Format}}</p>
      <p class="card-text" style="color: red">Date de Formation : {{$formation->DateFormation}}!</p>
      <h6 class="card-subtitle mb-1 text-body-secondary">Objectif:</h6>
      <p class="text-body-secondary">{{$formation->Objectif}}</p>
      @if(!in_array($formation->idFormation, $demandesenvoye))
      <a class="btn btn-primary" href="{{route('DemandeFormation',['id'=>$employe->idEmploye,'idF'=>$formation->idFormation])}}" role="button">S'inscrire à la formation</a>
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
        <!--Liste des Demandes de Formations-->

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Mes demandes d'évalutions</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
           <ul class="list-group list-group-flush mt-2">
            @foreach($demandesformations as $demandesformation)
            @if($demandesformation->status=="Accepté")
          <li class="list-group-item text-success">{{$demandesformation->formation->NomFormation}}  &rarr; {{$demandesformation->status}}  </li>
          @elseif($demandesformation->status=="Refusé")
          <li class="list-group-item text-danger">{{$demandesformation->formation->NomFormation}}  &rarr; {{$demandesformation->status}}  </li>
          @elseif($demandesformation->status=="En cours")
          <li class="list-group-item text-secondary">{{$demandesformation->formation->NomFormation}}  &rarr; {{$demandesformation->status}}  </li>
          @endif
          @endforeach
          </ul>
          </div>
        </div>



        @extends('script')
        @section('scripts')
        <script>
                  $(document).ready(function () {
        $('#Formation').addClass('nav-link disabled');
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
                $(document).ready(function () {
                $('#Formation').addClass('nav-link disabled');
            });
        </script>
        @endsection

       
  