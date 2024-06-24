@extends('layout')
@section('title','Login')
@section('content')

<!--La Navbar  -->

<nav class="navbar navbar-expand-lg" style="background-color: rgb(86,127,167)">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('login')}}"><img src="{{asset('5422484.png')}}"alt="Logo" style="height: 40px;"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
     
        <ul class="navbar-nav ms-auto  mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active"  aria-current="page" href="{{route('ListStage')}}">Retour aux stages disponibles</a>
          </li>       
         
        </ul>
        
      
    </div>
</nav>  
      <div class="text-center mt-2">
    <h4 class=" text-uppercase font-weight-bold" style="color: #7b7b7b">       Formulaire de Demande de Stage 
    </h4>
</div>
<div class="container d-flex justify-content-center">
  <div class="card shadow-lg w-25">
    <div class="card-body">
<form action="{{route('ajouterDemandeStage',['id'=>$id])}}" method="Post" enctype="multipart/form-data">
    @csrf
    <div class=" mb-1">
        <label for="nom" class="form-label">Nom:</label>
        <input type="text" class="form-control" id="nom" name="nom" value="">
        @error('nom')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
      </div>
      <div class=" mb-1">
        <label for="prenom" class="form-label">Prénom:</label>
        <input type="text" class="form-control" id="prenom" name="prenom">
      </div>

      <div class=" mb-1">
        <label for="Mail" class="form-label">Mail:</label>
        <input type="Mail" class="form-control" id="Mail" name="Mail">
      </div>
      <div class="mb-3">
        <label for="Cv" class="form-label">Cv (Fichier PDF) :</label>
        <input class="form-control form-control-sm" id="Cv" name="Cv" type="file">
      </div>
      <div class="mb-3">
        <label for="Motivation" class="form-label">Motivation:</label>
        <textarea class="form-control" id="Motivation" name="Motivation"></textarea>
      </div>
      <div class="card-footer d-flex justify-content-center">
      <button type="submit" class="btn btn-outline-success">
        Postuler
    </button>
      </div>
</form>
</div>
  </div>
</div>
