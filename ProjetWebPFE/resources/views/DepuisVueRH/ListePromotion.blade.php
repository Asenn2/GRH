@extends('layout')
@section('title','Login')
@section('content')

<!--La Navbar  -->

@include('navbar')


  <!--Partie situé en bas de la navbar  -->
<br>
<h5 class="text-center mt-3">Tableau de Bord:</h5>
<div class="container">
    <div class="card shadow-lg">
      <div class="row mx-2 my-2 justify-content-between">
        <div class="col-2" >
          <button type="button" class="btn  btn-outline-primary w-100 " data-bs-toggle="modal" data-bs-target="#modalformPromotion">
              Ajouter une Promotion  &rarr;
          </button> 
        </div>
          <div class="col-2">
            <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" class="btn btn-outline-info w-100">
              Infos sur les Promotions &rarr;
            </button>   
          </div>
          <div class="col-2">
            <button type="button" id="Encoursbtn" class="btn btn-outline-secondary">Afficher les demandes en cours ...</button>
          </div>
          <div class="col-2">
            <button type="button" id="Acceptebtn" class="btn btn-outline-success">Afficher les demandes acceptées.           
              <img src="/bootstrap-icons/icons/check.svg" style="height: 80%"> 
            </button>
          </div>
          <div class="col-2">
            <button type="button" id="Refusebtn" class="btn btn-outline-danger">Afficher les demandes refusées.           
              <img src="/bootstrap-icons/icons/x-lg.svg" style="height: 80%"> 
            </button>
          </div>
      </div>
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
        <select name="Departement" class="form-select">
          <option value="">Sélectionner un Departement</option>
          @foreach($Departements as $Departement)
              <option value="{{ $Departement->idDepartement }}">Nom:{{ $Departement->nom }}</option>
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


  <h5 class="text-center mt-3">Demandes d'évaluation:</h5>

    <!--les 3 boutons pour la gestion des demandes-->
    <div class="container mt-2">
      <div class="card shadow-lg w-100">
        <div class="card-body">
    
    
    <div class="container" id="EncoursTable" style="display: block">
      <table class="table caption-top" >
        <thead>
          <tr class="table-primary">
    
            <th scope="col">Poste Visé</th>
            <th scope="col">Nom Employé</th>
            <th scope="col">Prénom Employé</th>
            <th scope="col">Status</th>
            <th colspan="2">Opérations</th>
          </tr>
        </thead>
        <tbody>
          @foreach($DemandePromotions as $DemandePromotion)
          @if($DemandePromotion->status=='En cours')
          <tr class="DemandePromotion-{{$DemandePromotion->idDemandePromotion}}">
            <td class="Promotion">{{$DemandePromotion->promotion->poste->Fonction}}</td>
            <td class="NomEmployé">{{$DemandePromotion->employe->nom}}</td>
            <td class="PrenomEmployé">{{$DemandePromotion->employe->prenom}}</td>
            <td class="Status">{{$DemandePromotion->status}}</td>
            <td>
              <a class="btn btn-outline-success" href="{{route('modifierDPromotion',['DemandePromotion'=>$DemandePromotion,'action'=>'Approuver'])}}">
                Approuver &rarr;
            </a>
            </td>
            <td>
              <a class="btn btn-outline-danger" href="{{route('modifierDPromotion',['DemandePromotion'=>$DemandePromotion,'action'=>'Refuser'])}}">
                Refuser &rarr;
            </a>
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
    
            <th scope="col">Poste Visé</th>
            <th scope="col">Nom Employé</th>
            <th scope="col">Prénom Employé</th>
            <th scope="col">Status</th>
            <th colspan="2">Opérations</th>
          </tr>
        </thead>
        <tbody>
          @foreach($DemandePromotions as $DemandePromotion)
          @if($DemandePromotion->status=='Accepté')
          <tr class="DemandePromotion-{{$DemandePromotion->idDemandePromotion}}">
            <td class="Promotion">{{$DemandePromotion->promotion->poste->Fonction}}</td>
            <td class="NomEmployé">{{$DemandePromotion->employe->nom}}</td>
            <td class="PrenomEmployé">{{$DemandePromotion->employe->prenom}}</td>
            <td class="Status">{{$DemandePromotion->status}}</td>
            <td>
              <a class="btn btn-outline-danger" href="{{route('modifierDPromotion',['DemandePromotion'=>$DemandePromotion,'action'=>'Refuser'])}}">
                Refuser &rarr;
            </a>
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
    
            <th scope="col">Poste Visé</th>
            <th scope="col">Nom Employé</th>
            <th scope="col">Prénom Employé</th>
            <th scope="col">Status</th>
            <th colspan="2">Opérations</th>
          </tr>
        </thead>
        <tbody>
          @foreach($DemandePromotions as $DemandePromotion)
          @if($DemandePromotion->status=='Refusé')
          <tr class="DemandePromotion-{{$DemandePromotion->idDemandePromotion}}">
            <td class="Promotion">{{$DemandePromotion->promotion->poste->Fonction}}</td>
            <td class="NomEmployé">{{$DemandePromotion->employe->nom}}</td>
            <td class="PrenomEmployé">{{$DemandePromotion->employe->prenom}}</td>
            <td class="Status">{{$DemandePromotion->status}}</td>
            <td>
              <a class="btn btn-outline-success" href="{{route('modifierDPromotion',['DemandePromotion'=>$DemandePromotion,'action'=>'Approuver'])}}">
                Approuver &rarr;
            </a>
            </td>
          </tr>
          
          @endif
          @endforeach
        </tbody>
      </table>
    </div> 
        </div>
      </div>
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
  <li class="list-group-item">{{$promotion->poste->Fonction}} &rarr; {{$promotion->commentaire}}   </li>
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
      @elseif(session('error'))
      <p>{{session('error')}}</p>

      @endif
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
  $(document).ready(function () {
        $('#promo').addClass('nav-link disabled');
    });             
</script>
@endsection
@endsection