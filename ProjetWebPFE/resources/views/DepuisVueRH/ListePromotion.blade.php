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
            <li><a class="dropdown-item" href="{{route('ListeCandidature')}}">Candidature</a></li>
            <li><a class="dropdown-item " href="{{route('ListePoste')}}">Postes</a></li>
            <li><a class="dropdown-item " href="{{route('ListeConge')}}">Congé</a></li>

          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Carrières
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item disabled " href="{{route('ListePromotion')}}">Promotion</a></li>
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
    <div class="col-2" >
      <button type="button" class="btn  btn-primary w-100 " data-bs-toggle="modal" data-bs-target="#modalformPromotion" style="height: 60px">
          Ajouter une Promotion  &rarr;
      </button>
      <hr>
    </div>
  </div>

  <div class="modal fade" id="modalformPromotion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%" style="max-width: 2000px">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ajout d'une Promotion </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{route('CreatePromotion')}}">
            @csrf
            <p class="lead">Informations sur le Promotion:</p> 
            <div class="container">            
                  <select name="poste_id" class="form-select">
              <option value="">Sélectionner le poste visé:</option>
              @foreach($postes as $poste)
                  <option value="{{ $poste->idPoste }}">Id:{{ $poste->idPoste }} Nom:{{ $poste->Fonction }}</option>
              @endforeach
          </select>
          <select name="formation_id" class="form-select">
            <option value="">Sélectionner le formation visé:</option>
            @foreach($formations as $formation)
                <option value="{{ $formation->idFormation }}">Id:{{ $formation->idFormation }} Nom:{{ $formation->NomFormation }}</option>
            @endforeach
        </select>
  
                <label for="Commentaire" class="form-label">Commentaire:</label>
                <textarea class="form-control" id="Commentaire" name="Commentaire"></textarea>
            </div>
        </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary">
                    Ajouter
                </button>
              </div>
          </form>
        </div>
      </div>
  </div>  

  <div class="pt-4">
    <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" class="text-decoration-none border-bottom border-dark pb-1 font-italic ">
      Infos sur les Promotions &rarr;
    </button>
  </div>

  <h5 class="text-center">Demandes d'évaluation:</h5>

    <!--les 3 boutons pour la gestion des demandes-->

    <div class="row  justify-content-center mt-2" >
      <div class="col-3">
        <button type="button" id="Encoursbtn" class="btn btn-secondary">Afficher les demandes en cours ...</button>
      </div>
      <div class="col-3">
        <button type="button" id="Acceptebtn" class="btn btn-success">Afficher les demandes acceptées.           
          <img src="/bootstrap-icons/icons/check.svg" style="height: 80%"> 
        </button>
      </div>
      <div class="col-3">
        <button type="button" id="Refusebtn" class="btn btn-danger">Afficher les demandes refusées.           
          <img src="/bootstrap-icons/icons/x-lg.svg" style="height: 80%"> 
        </button>
      </div>
    </div>
    
    
    <div class="container" id="EncoursTable" style="display: none">
      <table class="table caption-top" >
        <thead>
          <tr class="table-primary">
    
            <th scope="col">idDemande</th>
            <th scope="col">Promotion</th>
            <th scope="col">Employé</th>
            <th scope="col">Status</th>
            <th colspan="2">Opérations</th>
          </tr>
        </thead>
        <tbody>
          @foreach($DemandePromotions as $DemandePromotion)
          @if($conge->status=='En cours')
          <tr class="DemandePromotion-{{$DemandePromotion->idDemandePromotion}}">
            <td class="idDemandePromotion">{{$DemandePromotion->idDemandePromotion}}</td>
            <td class="Promotion">{{$DemandePromotion->promotion->NomPromotion}}</td>
            <td class="Employé">{{$DemandePromotion->employe->idEmploye}}</td>
            <td class="Status">{{$DemandePromotion->status}}</td>
            <td>
              <a class="text-decoration-dotted-line border-bottom border-dark pb-1 font-italic text-success" href="">
                Approuver &rarr;
            </a>
            </td>
            <td>
              <form action="#" class="pt-2" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-link text-decoration-none border-bottom border-dark pb-1 font-italic text-danger">
                    Refuser &rarr;
                </button>
            </form>
            </td>
          </tr>
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="container" id="AccepteTable" style="display: none">
      <table class="table caption-top" >
        <thead>
          <tr class="table-primary">
    
            <th scope="col">idDemande</th>
            <th scope="col">Promotion</th>
            <th scope="col">Employé</th>
            <th scope="col">Status</th>
            <th colspan="2">Opérations</th>
          </tr>
        </thead>
        <tbody>
          @foreach($DemandePromotions as $DemandePromotion)
          @if($conge->status=='En cours')
          <tr class="DemandePromotion-{{$DemandePromotion->idDemandePromotion}}">
            <td class="idDemandePromotion">{{$DemandePromotion->idDemandePromotion}}</td>
            <td class="Promotion">{{$DemandePromotion->promotion->NomPromotion}}</td>
            <td class="Employé">{{$DemandePromotion->employe->idEmploye}}</td>
            <td class="Status">{{$DemandePromotion->status}}</td>
            <td>
                <button type="button" class="btn btn-link text-decoration-none border-bottom border-dark pb-1 font-italic text-danger">
                    Refuser &rarr;
                </button>
            </td>
          </tr>
          
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="container" id="RefuseTable" style="display: none">
      <table class="table caption-top" >
        <thead>
          <tr class="table-primary">
    
            <th scope="col">idDemande</th>
            <th scope="col">Promotion</th>
            <th scope="col">Employé</th>
            <th scope="col">Status</th>
            <th colspan="2">Opérations</th>
          </tr>
        </thead>
        <tbody>
          @foreach($DemandePromotions as $DemandePromotion)
          @if($conge->status=='En cours')
          <tr class="DemandePromotion-{{$DemandePromotion->idDemandePromotion}}">
            <td class="idDemandePromotion">{{$DemandePromotion->idDemandePromotion}}</td>
            <td class="Promotion">{{$DemandePromotion->promotion->NomPromotion}}</td>
            <td class="Employé">{{$DemandePromotion->employe->idEmploye}}</td>
            <td class="Status">{{$DemandePromotion->status}}</td>
            <td>
              <a class="text-decoration-dotted-line border-bottom border-dark pb-1 font-italic text-success" href="">
                Approuver &rarr;
            </a>
            </td>
          </tr>
          
          @endif
          @endforeach
        </tbody>
      </table>
    </div> 

        <!--Liste des Promotions-->

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Informations sur Promotions</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <h6 class="text-decoration-none border-bottom border-dark pb-1 font-italic text-muted">A propos</h6>
    <p>Chaque Promotion nécessite une evaluation qui sera géré par le RH et peut nécessiter une Formation.</p>
   <ul class="list-group list-group-flush mt-2">
    @foreach($promotions as $promotion)
  <li class="list-group-item">{{$promotion->NomPromotion}} : {{$promotion->formation->NomFormation}} &rarr;  </li>
  @endforeach
  </ul>
  </div>
</div>
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
        @endif
      </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
      @if ($errors->any())
          // Sélectionner le toast et le montrer
          var bsToast = new bootstrap.Toast(toastError);
          bsToast.show();
      @endif       

      const Encoursbtn=document.getElementById('Encoursbtn');
        const Acceptebtn=document.getElementById('Acceptebtn');
        const Refusebtn=document.getElementById('Refusebtn');

        var Encourscontainer= document.getElementById('EncoursTable');
        var Acceptecontainer=document.getElementById('AccepteTable');
     var Refusecontainer = document.getElementById('RefuseTable');
     
        Encoursbtn.addEventListener('click', function() {

     if(Refusecontainer.style.display==='block'){
      Refusecontainer.style.display='none';
     }else if(Acceptecontainer.style.display==='block'){
      Acceptecontainer.style.display='none';
     }

    if (Encourscontainer.style.display === 'none') {
      Encourscontainer.style.display = 'block';
        window.scrollTo({
            top: Encourscontainer.offsetTop,
            behavior: 'smooth' // Pour une animation fluide du défilement
        });
    } else {
      Encourscontainer.style.display = 'none';
    }
  });

  Acceptebtn.addEventListener('click', function() {

     if(Refusecontainer.style.display==='block'){
      Refusecontainer.style.display='none';
     }else if(Encourscontainer.style.display==='block'){
      Encourscontainer.style.display='none';
     }
    if (Acceptecontainer.style.display === 'none') {
      Acceptecontainer.style.display = 'block';
        window.scrollTo({
            top: Acceptecontainer.offsetTop,
            behavior: 'smooth' // Pour une animation fluide du défilement
        });
    } else {
      Acceptecontainer.style.display = 'none';
    }
  });

  Refusebtn.addEventListener('click', function() {

      if(Encourscontainer.style.display==='block'){
        Encourscontainer.style.display='none';
      }else if(Acceptecontainer.style.display==='block'){
        Acceptecontainer.style.display='none';
      }
      if (Refusecontainer.style.display === 'none') {
        Refusecontainer.style.display = 'block';
          window.scrollTo({
              top: Refusecontainer.offsetTop,
              behavior: 'smooth' // Pour une animation fluide du défilement
          });
      } else {
        Refusecontainer.style.display = 'none';
      }
  });
  });
             
</script>