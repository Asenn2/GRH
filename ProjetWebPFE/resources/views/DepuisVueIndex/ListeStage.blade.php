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

        <nav class="navbar navbar-expand-lg" style="background-color: rgb(86,127,167)">
            <div class="container-fluid">
              <a class="navbar-brand" href="{{route('login')}}"><img src="{{asset('5422484.png')}}"alt="Logo" style="height: 40px;"></a>
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

        <div class="container d-flex justify-content-center mt-4">
          <div class="card shadow-lg">
            <div class="card-body">
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
                  <th scope="row">{{$stage->typestage->NomTypeStage}}</th>
                  <td>{{$stage->Objectif}}</td>
                  <td>{{$stage->departement->nom}}</td>
                  <td>
                    {{$stage->Desc}}
                  </td>
                  <td>
                    <a class="btn btn-outline-success" href="{{route('StageForm',['id'=>$stage->idStage])}}">Contacter </a>
                  </td>
                </tr>
               @endforeach
              </tbody>
            </table>
          </div>
          </div>
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