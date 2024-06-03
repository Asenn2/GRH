@extends('layout')
@section('title','Login')
@section('content')

        <!--La navbar  -->

        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">GRH</a>
              <ul class="navbar-nav ms-auto  mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="{{route('ListeOffreEmploi1')}}">Espace candidature</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" aria-current="page" href="{{route('ListStage')}}">Espace Stage</a>
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
              <caption class="text-body-secondary text-center" >Stages Disponible:</caption>
              <thead>
                <tr class="table-primary">
                  <th scope="col">Type</th>
                  <th scope="col">Objectif</th>
                  <th scope="col">Département</th>
                 <th>Description</th>
                 <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($stages as $stage)
                <tr>
                  <th scope="row"><a href="">{{$stage->typestage->NomTypeStage}}</a></th>
                  <td><a href="">{{$stage->Objectif}}</a></td>
                  <td><a href="">{{$stage->departement->nom}}</a></td>
                  <td>
                    {{$stage->Desc}}
                  </td>
                  <td>
                    <a href="{{route('StageForm',['id'=>$stage->idStage])}}">Contacter </a>
                  </td>
                </tr>
               @endforeach
              </tbody>
            </table>
          </div>
          <!--Modal a Propos -->
    
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">A propos de l'entreprise...</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row ">
                    <div class="col border-end">
                        <p class="lead">Informations :</p>
                    </div>
                    <div class="col border-end">
                        <p class="lead">Objectif :</p>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
              
            </div>
          </div>
        </div>
    </div>