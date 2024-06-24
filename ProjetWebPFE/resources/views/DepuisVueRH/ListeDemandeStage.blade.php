@extends('layout')
@section('title','Login')
@section('content')

<!-- La Navbar -->

@include('navbar')


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

<!-- Carte principale -->
@foreach($DemandeStages as $DemandeStage)
@if($DemandeStage->status=="En cours")
<div class="container mt-5">
  <div class="card shadow-lg w-100">
    <div class="row g-0">
      <!-- Partie gauche : Infos candidat et stage -->
      <div class="col-md-6 d-flex flex-column">
        <div class="card-body ">
          <h3 class="card-title">Informations du Candidat</h3>
          <p class="card-text">
            <strong>Nom :</strong> {{ $DemandeStage->stagecandidat->nom }}<br>
            <strong>Prénom :</strong> {{ $DemandeStage->stagecandidat->prenom }}<br>
            <strong>Email :</strong> {{ $DemandeStage->stagecandidat->Mail }}<br>
          </p>
          <hr>
          <h4 class="card-title">Informations de Stage</h4>
          <p class="card-text">
            <strong>Type :</strong> {{ $DemandeStage->stage->typestage->NomTypeStage }}<br>
            <strong>Objectif :</strong> {{ $DemandeStage->stage->Objectif }} <br>
            <strong>Description :</strong> {{ $DemandeStage->stage->Desc }}<br>
            <strong>Département :</strong> {{ $DemandeStage->stage->departement->nom }}<br> 
          </p>
        </div>
        <div class="card-footer mt-auto">
          <div class="d-flex justify-content-between">
              <button type="button" class="btn btn-success"  data-bs-toggle="modal" id="modifierStageBtn" data-demande="{{$DemandeStage->idDemandeStage}}" data-bs-target="#modalformStage" >Accepter</button>
            <form action="{{route('modifierStageDemande',['id'=>$DemandeStage->idDemandeStage,'action'=>'Refuser'])}}" method="POST">
              @csrf
              <button type="submit" class="btn btn-danger">Refuser</button>
            </form>
          </div>
        </div>
      </div>
      <!-- Partie droite : CV en iframe -->
      <div class="col-md-6">
        <iframe class="float-end" id="pdfViewer" src="{{ url('storage/'.$DemandeStage->stagecandidat->Cv) }}" width="100%" height="600" frameborder="0"></iframe>
      </div>
    </div>
  </div>
</div>
@endif
@endforeach

<div class="modal" tabindex="-1" id="modalformStage">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Date du Stage</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
<form action="{{route('modifierStageDemande',['id'=>0,'action'=>'Accepter'])}}" id="modifierformS" method="post">
    @csrf
    
    <div class="row ">
        <div class="col mb-1">
    <label for="DateDebutStage" class="form-label">Date Debut(Y-m-d):</label>
    <input type="date" class="form-control" id="DateDebutStage" name="DateDebutStage">
</div>
<div class="col mb-1">
    <label for="DateFinStage" class="form-label">Date Fin(Y-m-d):</label>
    <input type="date" class="form-control" id="DateFinStage" name="DateFinStage">
</div>
    </div>
    
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary" >Sauver</button>  
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
    $('#modifierStageBtn').on('click', function() {
        var demandeS = $(this).data('demande');
        console.log(demandeS);

        var action = "{{ route('modifierStageDemande', ['action' => 'Accepter', 'id' => ':demandeS']) }}".replace(':demandeS', demandeS);
$('#modifierformS').attr('action', action);
});
});
$(document).ready(function () {
        $('#demstage').addClass('nav-link disabled');
    });
</script>
@endsection
@endsection