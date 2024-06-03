@extends('layout')
@section('title','Login')
@section('content')

<!--La Navbar  -->

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">GRH</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('ResponsableRH')}}">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Employés
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item " href="{{route('ListeEmploye')}}">Liste</a></li>
            <li><a class="dropdown-item " href="{{route('ListeContrat')}}">Contrat</a></li>
            <li><a class="dropdown-item " href="{{route('ListeCandidature')}}">Candidature</a></li>
            <li><a class="dropdown-item " href="{{route('ListePoste')}}">Postes</a></li>
            <li><a class="dropdown-item " href="{{route('ListeConge')}}">Congé</a></li>

          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Carrières
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item  " href="{{route('ListePromotion')}}">Promotion</a></li>
            <li><a class="dropdown-item " href="{{route('ListeFormation')}}">Formation</a></li>

          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="{{route('ListeDepartement')}}">Départements</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Stages
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item " href="/ResponsableRH/Stage">Gestion de Stages</a></li>
            <li><a class="dropdown-item" href="#">Demande de Stage</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>



  <div class="text-center">
    <h1 class="display-3 text-uppercase font-weight-bold" style="color: #7b7b7b">Departements:</h1>
  </div>

  <div class="pt-4">
    <a href="{{route('createDepartement')}}" class="text-decoration-none border-bottom border-dark pb-1 font-italic text-muted">
      Ajouter un Département &rarr;
    </a>
  </div>

  <div class="w-100 py-5">

<div class="container">
<div class="row">
  @foreach($departements as $departement)
  <div class="row">

    <!--Tester si il y a une photo pour changer la structure--> 
    @if($departement->photo != null)
    <div class="row">
    <div class="col-md-6">
    <img src="{{ asset($departement->photo) }}">
    </div>
          <div class="col-md-6">
              <div class="float-end">
                  <a class="text-decoration-dotted-line border-bottom border-dark pb-1 font-italic text-success" href="{{route('Departement.edit',['departement' => $departement])}}">
                      Edit &rarr;
                  </a>
                  <form action="/ResponsableRH/Departement/{{$departement->idDepartement}}" class="pt-2" method="POST">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-link text-decoration-none border-bottom border-dark pb-1 font-italic text-danger">
                          Delete &rarr;
                      </button>
                  </form>
              </div>
              <h2 class="display-4 mt-0" style="color: #7b7b7b"><a href="/Departement/info/{{$departement->idDepartement}}">{{$departement->nom}}</a></h2>
              <p class="text-muted lead py-3">{{$departement->Desc}}</p>
          </div>
      </div>
        @else
      <div class="col-md-6">
        <h2 class="display-4 mt-0" style="color: #7b7b7b"><a href="/Departement/info/{{$departement->idDepartement}}">{{$departement->nom}}</a></h2>
        <p class="text-muted lead py-3">{{$departement->Desc}}</p>
        </div>
      <div class="col-md-6">
      <div class="float-end">
      <a class="text-decoration-dotted-line border-bottom border-dark pb-1 font-italic text-success" href="{{route('Departement.edit',['departement' => $departement])}}">
          Edit &rarr;
      </a>
      <form action="/ResponsableRH/Departement/{{$departement->idDepartement}}" class="pt-2" method="POST">
          @csrf
          @method('delete')
          <button type="submit" class="btn btn-link text-decoration-none border-bottom border-dark pb-1 font-italic text-danger">
              Delete &rarr;
          </button>
      </form>
        </div>
      </div>



      @endif

          <hr class="mt-4 mb-4">
          
            @endforeach
  </div>

      </div>
    
      </div>
  </div>



@endsection
  