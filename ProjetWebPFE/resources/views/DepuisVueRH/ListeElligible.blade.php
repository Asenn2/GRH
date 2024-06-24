@extends('layout')
@section('title','Login')
@section('content')

<!--La Navbar  -->
@include('navbar')

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
    <div id="toastError" class="toast text-bg-danger " role="alert" aria-live="assertive" aria-atomic="true">
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

  <div class="container mt-5">
    <div class="card shadow-lg w-100">
      <div class="row g-0">
        <!-- Partie gauche : Admis Formation -->
        <div class="col-md-6 ">
          <div class="card-body">
            <h3 class="card-title">Admis à la Formation</h3>
            <ul class="list-group">
                @foreach($formations as $formation)
                    @if($formation->demandeF()->exists())
                        <li class="list-group-item list-group-item-info">{{ $formation->NomFormation }} &rarr; {{ $formation->DateFormation }}</li>
                        <ul>
                            @foreach($formation->demandeF as $demande)
                            @if($demande->status=="Accepté")
                                <li class="list-group-item">{{ $demande->employe->nom }} {{ $demande->employe->prenom }}</li>
                                @else
                                <li class="list-group-item">Aucun</li>
                            @endif
                              
                            @endforeach
                        </ul>
                    @endif
                @endforeach
            </ul>
          </div>
        </div>
        <!-- Partie droite : Admis Promotion -->
        <div class="col-md-6 ">
          <div class="card-body">
            <h3 class="card-title">Admis à la Promotion</h3>
            <ul>
                @foreach($promotions as $promotion)
                @if($promotion->demandepromotions()->exists())
                    <li class="list-group-item list-group-item-info">{{ $promotion->poste->Fonction }} </li>
                    <ul>
                        @foreach($promotion->demandepromotions as $demande)
                            @if($demande->status=="Accepté")
                            <li class="list-group-item">{{ $demande->employe->nom }} {{ $demande->employe->prenom }}</li>
                            @else
                            <li class="list-group-item">Aucun</li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            @endforeach
            </ul>
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
          @endif });
          $(document).ready(function () {
        $('#ellig').addClass('nav-link disabled');
    
      });          
</script>
@endsection
@endsection          