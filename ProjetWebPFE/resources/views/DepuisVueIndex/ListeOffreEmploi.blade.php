@extends('layout')
@section('title','Login')
@section('content')
@section('style')
body{
  background-image: url('/m.jpg');
  background-size: cover; background-position: center; background-repeat: no-repeat;
}

@endsection
        <!--La navbar  -->

        <nav class="navbar navbar-expand-lg "style="background-color: rgb(86,127,167)">
          <div class="container-fluid">
            <a class="navbar-brand" href="{{route('login')}}"><img src="{{asset('5422484.png')}}"alt="Logo" style="height: 40px;"></a>
            <ul class="navbar-nav ms-auto  mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link disabled" aria-current="page" href="{{route('ListeOffreEmploi1')}}">Espace candidature</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('ListStage')}}">Espace Stage</a>
              </li>
              <li class="nav-item ">
                <a href="#" class="nav-link active" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  A propos
                </a>
              </li>
            </ul>
          </div>
      </nav>     

<div class="container mt-3">
  <div class="card shadow-lg w-100">
    <div class="card-body">
  <table class="table caption-top" >
    <caption class="text-body-secondary text-center" >Offre d'Emploi Disponible:</caption>
    <thead>
      <tr class="table-primary">
        <th scope="col">Contrat</th>
        <th scope="col">Poste</th>
        <th scope="col">Département</th>
        <th scope="col">Salaire Prévu</th>
       <th >Commentaire</th>
       <th scope="col">Compétence Requise</th>
       <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($offres as $offre)
      <tr>
        <th scope="row">{{$offre->typecontrat->NomTypeContrat}}</th>
        <td>{{$offre->poste->Fonction}}</td>
        <td>{{$offre->departement->nom}}</td>
        <td>{{$offre->poste->Salaire}} Dhs</td>
        <td>{{$offre->Commentaire}}</td>
        <td>
          {{$offre->CompetenceRequise}}
        </td>
        <td>
          <a class="btn btn-outline-success" href="{{route('PostulerForm',['id'=>$offre->idOffreEmploi])}}">Postuler </a>
        </td>
      </tr>
     @endforeach
    </tbody>
  </table>
</div>
  </div>
</div>
