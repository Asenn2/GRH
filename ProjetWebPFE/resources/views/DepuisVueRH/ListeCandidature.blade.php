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
            <li><a class="dropdown-item disabled" href="{{route('ListeCandidature')}}">Candidature</a></li>
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
          <a class="nav-link" href="{{route('ListeDepartement')}}">Départements</a>
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
<!--Partie situé en bas de la navbar  -->

<div class="row justify-content-center">
    <div class="col-3" >
    
  
      <!--Catch d'erreur -->
  
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
  
      <!--Catch de succes -->
      <div>
        @if(session()->has('success'))
          <div class="alert alert-success">
            {{session('success')}}
          </div>
        @endif    
      </div>      
  
    </div>

</div>




<div class="container-fluid">
  <div class="row mt-1">
    <!-- Cv PDF -->
    <div class="col-6">
      <iframe id="pdfViewer" src="" width="100%" height="600" frameborder="0"></iframe>
    </div>
    <div class="col-6">
      <!--Liste des candidatures  -->

<table class="table caption-top" >
  <caption class="text-center" >Liste de Candidature:</caption>
  <thead>
    <tr class="table-primary">
      <th scope="col">id</th>
      <th scope="col">Mail</th>
      <th scope="col">Id OffreEmploi</th>
      <th scope="col">Nom Candidat</th>
      <th scope="col">Poste concerné </th>
      <th scope="col">Type de contrat</th>
      <th scope="col">Cv</th>
      <th scope="col">Motivation</th>
      
      <th colspan="2"> </th>
    </tr>
  </thead>
  <tbody>
    @foreach($candidatures as $candidature)
    <tr class="candidature-{{$candidature->idCandidature}}">
        <td class="idcandidature">{{$candidature->idCandidature}}</td>
        <td class="mail">

                {{$candidature->candidat->Mail}}

        </td>
        <td class="idOffreEmploi">{{$candidature->offreEmploi->idOffreEmploi}}</td>
        <td class="nom">

                {{$candidature->candidat->nom}}

        </td>
        <td class="fonction">{{$candidature->offreEmploi->poste->Fonction}}</td>
        <td class="nomtypecontrat">{{$candidature->offreemploi->typecontrat->NomTypeContrat}}</td>
        <td class="Cv">            
          <a class="text-decoration-dotted-line border-bottom border-dark pb-1 font-italic text-success afficherCv"  data-id-candidat="{{$candidature->Candidat->idCandidat}}" href="">
            Afficher &rarr;
          </a>
        </td>
        <td ><a href="" data-bs-toggle="modal" data-bs-target="#modalformMotivation{{$candidature->idCandidature}}" >Motivation</a></td>
       <!--Modal pour chaque Motivation-->
        <div class="modal fade" id="modalformMotivation{{$candidature->idCandidature}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%" style="max-width: 2000px">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Lettre De Motivation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
               
          <p>{{$candidature->Motivation}} </p>
        
                  </div>
        
        
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        
                    </div>
        
              </div>
        </div>

        <td><a class="btn btn-primary" role="button" href="">Proposez Rendez-vous</a></td>
        <td>        <form action="/Candidature/{{$candidature->idCandidature}}" method="POST">
          @csrf
          @method('delete')
          <button type="submit" class="btn btn-danger" href="">Refuser</button></td>
        </form>
    </tr>
    @endforeach


  </tbody>
</table>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
  $(document).ready(function() {
    $('.afficherCv').on('click', function(event) {
        event.preventDefault();

        var candidatId = $(this).data('id-candidat');
        console.log(candidatId);
        $.ajax({
            url: '{{ route("afficher_cv", ":id") }}'.replace(':id', candidatId),
            type: 'GET',
            success: function(response) {
                // La route du Pdf
                var pdfUrl = response.pdfpathurl;

                // console.log("URL du PDF :", pdfUrl); pour tester !

                $('#pdfViewer').attr('src', pdfUrl);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
   
 


});
</script>