@extends('layout')
@section('title','Login')
@section('content')

        <!--La navbar  -->

        <nav class="navbar navbar-expand-lg bg-body-tertiary">
          <div class="container-fluid">
            <a class="navbar-brand" href="#">GRH</a>
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

<div class="container">
  <table class="table caption-top" >
    <caption class="text-body-secondary text-center" >Offre d'Emploi Disponible:</caption>
    <thead>
      <tr class="table-primary">
        <th scope="col">Contrat</th>
        <th scope="col">Poste</th>
        <th scope="col">Département</th>
       <th>Commentaire</th>
       <th scope="col">Compétence Requise</th>
       <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($offres as $offre)
      <tr>
        <th scope="row"><a href="">{{$offre->typecontrat->NomTypeContrat}}</a></th>
        <td><a href="">{{$offre->poste->Fonction}}</a></td>
        <td><a href="">{{$offre->idDepartement}}</a></td>
        <td>
          {{$offre->CompetenceRequise}}
        </td>
        <td>{{$offre->Commentaire}}</td>
        <td>
          <a href="{{route('PostulerForm',['id'=>$offre->idOffreEmploi])}}">Postuler </a>
        </td>
      </tr>
     @endforeach
    </tbody>
  </table>
</div>
