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
            <li><a class="dropdown-item disabled " href="{{route('ListeConge')}}">Congé</a></li>

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

<div class="container">
  <div class="row  mt-1 justify-content-center">
  <div class="col-2 border rounded">
    <button type="button" class="btn-lg  btn-primary w-100 my-1 " data-bs-toggle="modal" data-bs-target="#modalformConge" style="height: 60px">
      <img src="/bootstrap-icons/icons/plus.svg" style="height: 80%"> 
      Congé Annuel
    </button>
    <a  class="float-end text-decoration-none  pb-1 font-italic text-muted" data-bs-toggle="modal" data-bs-target="#modalformType">
      Ajouter un type...&rarr;</a> 
  </div>
  </div>
</div>

    <!--Modal pour créer un type de Congé-->

    <div class="modal fade" id="modalformType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%" style="max-width: 2000px">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ajout d'un Type de Congé</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{route('createTypeConge')}}">
              @csrf
              <p class="lead">Informations Type de Congé:</p> 
              <div class="row">
                 
                  <label for="NomType" class="form-label">Nom Type de Congé :</label>
                  <input type="text" class="form-control" id="NomType" name="NomType">

                  <label for="Desc" class="form-label">Description:</label>
                  <textarea class="form-control" id="Desc" name="Desc"></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-secondary"  data-bs-toggle="modal" data-bs-target="#modalformTypeListe" >Supprimer un Type</button>
                <button type="submit" class="btn btn-primary">
                    Ajouter
                </button>
              </div>
            </form>              
          </div>
          </div>
        </div>
    </div>
      <!--Modal pour afficher Type de Stage-->

<div class="modal fade" id="modalformTypeListe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%" style="max-width: 2000px">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Type de Congé</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
      <table class="table">
        <thead>
          <tr class="table-primary">
      
            <th scope="col">idTypeCongé</th>
            <th scope="col">Nom du Type</th>
            <th scope="col">Description</th>
            <th colspan=""></th>
          </tr>
        </thead>
        <tbody>
          @foreach($typeconges as $typeconge)
          <tr class="typeconge-{{$typeconge->idTypeConge}}">
            <td class="idTypeConge">{{$typeconge->idTypeConge}}</td>
            <td class="NomTypeConge">{{$typeconge->NomTypeconge}}</td>
            <td class="Desc">{{$typeconge->Desc}}</td>
      
            <td>
              <form action="{{route('deleteTypeConge',['typeconge'=> $typeconge])}}" class="pt-2" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-link text-decoration-none border-bottom border-dark pb-1 font-italic text-danger">
                    Delete &rarr;
                </button>
            </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      
      
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      
                  </div>
              
            </div>
          </div>
</div>    

    <!--Modal pour créer un Conge-->

    <div class="modal fade" id="modalformConge" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%" style="max-width: 2000px">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ajout d'un Congé</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{route('createCongeAnnuel')}}">
              @csrf
              <p class="lead">Informations sur le Congé Annuel:</p> 
              <div class="container">

                
              <label for="NomConge" class="form-label">Nom du Conge:</label>
              <input type="text" class="form-control" id="NomConge" name="NomConge">

              <label for="DateDebut" class="form-label">Date Debut(Y-m-d):</label>
              <input type="date" class="form-control" id="DateDebut" name="DateDebut">

              <label for="DateFin" class="form-label">Date Fin(Y-m-d):</label>
              <input type="date" class="form-control" id="DateFin" name="DateFin">
    
    
                  <label for="Desc" class="form-label">Description:</label>
                  <textarea class="form-control" id="Desc" name="Desc"></textarea>
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
    </div>

    <!--Button pour afficher les congés annuels-->

<div class="container mt-5">
    <div class="row justify-content-center" >
      <div class="col-6">
  <div class="card" style="width: 100%">
    <div class="card-body">
      <div id="calendar" style="width: 100%">
      </div>
    </div>
  </div>
  </div>
  <div class="col-5">
    <button type="button" class="btn-lg btn-primary " data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Afficher les Congé</button>
  </div>
  </div>
</div>

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

    <!--les 3 tables pour la gestion des demandes-->

<div class="container" id="EncoursTable" style="display: none">
  <table class="table caption-top" >
    <thead>
      <tr class="table-primary">

        <th scope="col">idConge</th>
        <th scope="col">Type du Conge</th>
        <th scope="col">Date de Debut</th>
        <th scope="col">Date de Fin</th>
        <th scope="col">Description</th>
        <th colspan="2">Opérations</th>
      </tr>
    </thead>
    <tbody>
      @foreach($conges as $conge)
      @if($conge->status=='En cours')
      <tr class="contrat-{{$conge->idConge}}">
        <td class="idConge">{{$conge->idConge}}</td>
        <td class="TypeConge">{{$conge->typeconge->NomTypeConge}}</td>
        <td class="DateDebut">{{$conge->DateDebut}}</td>
        <td class="DateFin">{{$conge->DateFin}}</td>
        <td class="Description">{{$conge->Description}}</td>
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

        <th scope="col">idConge</th>
        <th scope="col">Type du Conge</th>
        <th scope="col">Date de Debut</th>
        <th scope="col">Date de Fin</th>
        <th scope="col">Description</th>
        <th colspan="2">Opérations</th>
      </tr>
    </thead>
    <tbody>
      @foreach($conges as $conge)
      @if($conge->status=='Accepte')
      <tr class="contrat-{{$conge->idConge}}">
        <td class="idConge">{{$conge->idConge}}</td>
        <td class="TypeConge">{{$conge->typeconge->NomTypeConge}}</td>
        <td class="DateDebut">{{$conge->DateDebut}}</td>
        <td class="DateFin">{{$conge->DateFin}}</td>
        <td class="Description">{{$conge->Description}}</td>
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

        <th scope="col">idConge</th>
        <th scope="col">Type du Conge</th>
        <th scope="col">Date de Debut</th>
        <th scope="col">Date de Fin</th>
        <th scope="col">Description</th>
        <th colspan="2">Opérations</th>
      </tr>
    </thead>
    <tbody>
      @foreach($conges as $conge)
      @if($conge->status=='Refusé')
      <tr class="contrat-{{$conge->idConge}}">
        <td class="idConge">{{$conge->idConge}}</td>
        <td class="TypeConge">{{$conge->typeconge->NomTypeConge}}</td>
        <td class="DateDebut">{{$conge->DateDebut}}</td>
        <td class="DateFin">{{$conge->DateFin}}</td>
        <td class="Description">{{$conge->Description}}</td>
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

    <!--Liste des Congés annuels-->

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Liste Des congés</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
   <ul class="list-group list-group-flush">
    @foreach($conges as $conge)
  <li class="list-group-item">{{$conge->NomConge}} : {{$conge->DateDebut}} &rarr; {{$conge->DateFin}} </li>
  @endforeach
  </ul>
  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
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
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          events: [
                    @foreach($conges as $conge)
                        {
                            title: '{{ $conge->NomConge }}',
                            start: '{{ $conge->DateDebut }}',
                            end: '{{ $conge->DateFin }}',
                        },
                    @endforeach
                ],
          eventClassNames: 'text-center fs-7'       // Convertit les congés en format JSON pour FullCalendar
        })
        calendar.render()
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