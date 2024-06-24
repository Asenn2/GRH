@extends('layout')
@section('title', 'Fiche d\'information de l\'employé')
@section('content')

<!--La Navbar  -->

@include('navbar')


<section class="container mt-4">
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-header" style="background-color: rgb(86,127,167); color: white;">
                    Informations Personnelles
                </div>
                <div class="card-body">
                    <h5 class="card-title">Nom:</h5>
                    <p class="card-text">{{ $employe->nom }}</p>
                    <h5 class="card-title">Prénom:</h5>
                    <p class="card-text">{{ $employe->prenom }}</p>
                    <h5 class="card-title">Email:</h5>
                    <p class="card-text">{{ $employe->mail }}</p>
                    <h5 class="card-title">Téléphone:</h5>
                    <p class="card-text">{{ $employe->Num }}</p>
                    <h5 class="card-title">Adresse:</h5>
                    <p class="card-text">{{ $employe->Adresse }}</p>
                    <h5 class="card-title">Date de Naissance:</h5>
                    <p class="card-text">{{ $employe->DateNaiss }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-header" style="background-color: rgb(86,127,167); color: white;">
                    Informations Professionnelles
                </div>
                <div class="card-body">
                    <h5 class="card-title">Poste:</h5>
                    <p class="card-text">{{ $employe->poste->Fonction }}</p>
                    <h5 class="card-title">Département:</h5>
                    <p class="card-text">{{ $employe->departement->nom }}</p>
                    <h5 class="card-title">Date d'embauche:</h5>
                    <p class="card-text">{{ $employe->dateEmb }}</p>
                    <h5 class="card-title">Salaire:</h5>
                    <p class="card-text">{{ $employe->poste->Salaire }}</p>
                    <h5 class="card-title">Contrat:</h5>
                    <p class="card-text">                  @foreach($employe->contrats as $contrat)
                        @if($contrat->typeContrat && $contrat->status=="En cours") 
                            <p>{{ $contrat->typeContrat->NomTypeContrat }}</p>
                        @else
                            <p>Aucun type de contrat trouvé.</p>
                        @endif
                    @endforeach       </p>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between">
      <a href="#" class="btn btn-outline-primary d-print-none" onclick="window.print()">Imprimer la fiche</a>
      <a href="{{route('AttestationTravail',['id'=>$employe->idEmploye])}}" class="btn btn-outline-info d-print-none" >Attestation de Travail</a>
      <a href="#" class="btn btn-secondary d-print-none" onclick="history.back()">Cancel</a>
  </div>
  @isset($file)
      adc
  @endisset

@extends('script')
@section('scripts')

@endsection
@endsection
