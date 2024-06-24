@extends('layout')
@section('title','Login')
@section('content')

<!--La Navbar  -->

@include('navbar')


  <!--Partie situé en bas de la navbar  -->
 <br>
<div class="row justify-content-center">
  <div class="col-2">
    <button type="button" class="btn  btn-outline-success w-100 " data-bs-toggle="modal" data-bs-target="#modalformFormation" style="height: 60px">
        Ajouter une Formation &rarr;
    </button>
    <hr>
  </div>
</div>

  <!--Modal pour ajouter une nouvelle formation  -->

<div class="modal fade" id="modalformFormation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%" style="max-width: 2000px">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ajout d'une Formation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('CreateFormation')}}">
          @csrf
          <p class="lead">Informations sur la Formation:</p> 
          <div class="container">
              <label for="NomFormation" class="form-label">Nom de la Formation:</label>
              <input type="text" class="form-control" id="NomFormation" name="NomFormation">

              <label for="DureeHeure" class="form-label">Durée de la Formation  ( en Heure ):</label>
              <input type="text" class="form-control" id="DureeHeure" name="DureeHeure">

              <label for="Format" class="form-label">Format de la Formation:</label>
              <input type="text" class="form-control" id="Format" name="Format">

              <label for="DateFormation" class="form-label">Date de la Formation:</label>
              <input type="date" class="form-control" id="DateFormation" name="DateFormation">

              <label for="Objectif" class="form-label">Objectif:</label>
              <textarea class="form-control" id="Objectif" name="Objectif"></textarea>
              <select name="Departement" class="form-select">
                <option value="">Sélectionner un Departement</option>
                @foreach($Departements as $Departement)
                    <option value="{{ $Departement->idDepartement }}">Nom:{{ $Departement->nom }}</option>
                @endforeach
            </select>
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
  <!--Modal pour modifier un Formation -->

  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%" style="max-width: 2000px">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modification d'une Formation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" id="editFormation" action="{{route('modifierFormation',['id' => 0])}}">
            @csrf
            @method('put')
            <p class="lead">Informations sur le Formation:</p> 
            <div class="container">
              <label for="NomFormation" class="form-label">Nom de la Formation:</label>
              <input type="text" class="form-control" id="NomFormationedit" name="NomFormation">

              <label for="DureeHeure" class="form-label">Durée de la Formation  ( en Heure ):</label>
              <input type="text" class="form-control" id="DureeHeureedit" name="DureeHeure">

              <label for="Format" class="form-label">Format de la Formation:</label>
              <input type="text" class="form-control" id="Formatedit" name="Format">

              <label for="DateFormation" class="form-label">Date de la Formation:</label>
              <input type="date" class="form-control" id="DateFormationedit" name="DateFormation">

              <label for="Objectif" class="form-label">Objectif:</label>
              <textarea class="form-control" id="Objectifedit" name="Objectif"></textarea>
            </div>
        </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary">
                    Modifier
                </button>
              </div>
          </form>
        </div>
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

<!--Body-->
<h5 class="text-center">Formations Disponibles:</h5>
<div class="container mt-2">
  <div class="card shadow-lg w-100">
    <div class="card-body">
  <div class="row" style="--bs-gutter-x:0.75rem;--bs-gutter-y:10">
    @foreach($formations as $formation)
    <div class="col-4 d-flex ">
      <div class="card w-100">
        <div class="card-body">
          <h5 class="card-title">{{$formation->NomFormation}}</h5>
          <p class="card-text">Durée de Formation: {{$formation->DureeHeure}}H<br>Format:{{$formation->Format}}</p>
  <p class="card-text" style="color: red">Date de Formation : {{$formation->DateFormation}}!</p>
  <h6 class="card-subtitle mb-1 text-body-secondary">Objectif:</h6>
  <p class="text-body-secondary">{{$formation->Objectif}}</p>
  <div class="card-footer mt-auto">
    <div class="d-flex justify-content-between">
  <a class="float-end btn btn-outline-success editlink"data-bs-toggle="modal" data-bs-target="#editModal" data-formation="{{$formation}}" ><img src="/bootstrap-icons/icons/pencil.svg" style="height: 60%">Modifier </a> 
  <form action="/ResponsableRH/Formation/{{$formation->idFormation}}/delete" method="POST">
          @csrf
          @method('delete')
        <button class="btn btn-outline-danger"><img src="/bootstrap-icons/icons/x-lg.svg" style="height: 80%">Supprimer </button>
        </form>
    </div>
  </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
    </div>
  </div>
</div>

<!--les 3 boutons pour la gestion des demandes-->
<br>
<h5 class="text-center">Demandes de Formation:</h5>
<div class="row justify-content-center">
  <div class="col-6">
<div class="container mt-2">
  <div class="card shadow-lg w-100">
    <div class="card-body">
      <div class="row  justify-content-center mt-2" >
        <div class="col-3">
          <button type="button" id="Encoursbtn" class="btn btn-outline-secondary" >Afficher les demandes en cours ...</button>
        </div>
        <div class="col-3">
          <button type="button" id="Acceptebtn" class="btn btn-outline-success">Afficher les demandes acceptées.           
            <img src="/bootstrap-icons/icons/check.svg" style="height: 80%"> 
          </button>
        </div>
        <div class="col-3">
          <button type="button" id="Refusebtn" class="btn btn-outline-danger">Afficher les demandes refusées.           
            <img src="/bootstrap-icons/icons/x-lg.svg" style="height: 80%"> 
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<div class="container mt-2">
  <div class="card shadow-lg w-100">
    <div class="card-body">
<div class="container mt-3" id="EncoursTable" style="display: block">
  <table class="table caption-top" >
    <thead>
      <tr class="table-primary">

        <th scope="col">Formation</th>
        <th scope="col">Nom Employé</th>
        <th scope="col">Prénom Employé</th>
        <th scope="col">Status</th>
        <th colspan="2">Opérations</th>
      </tr>
    </thead>
    <tbody>
      @foreach($DemandeFormations as $DemandeFormation)
      @if($DemandeFormation->status=='En cours')
      <tr class="DemandePromotion-{{$DemandeFormation->idDemandeFormation}}">
        <td class="Promotion">{{$DemandeFormation->formation->NomFormation}}</td>
        <td class="NomEmployé text-info">{{$DemandeFormation->employe->nom}}</td>
        <td class="PrénomEmployé text-info">{{$DemandeFormation->employe->prenom}}</td>
        <td class="Status">{{$DemandeFormation->status}}</td>
        <td>
          <a class="btn btn-outline-success" href="{{route('modifierDemandeFormation',['DemandeFormation'=>$DemandeFormation,'action'=>'Approuver'])}}">
            Approuver &rarr;
        </a>
        </td>
        <td>
          <a class="btn btn-outline-danger" href="{{route('modifierDemandeFormation',['DemandeFormation'=>$DemandeFormation,'action'=>'Refuser'])}}">
            Refuser &rarr;
        </a>
        </td>
      </tr>
      @endif
      @endforeach
    </tbody>
  </table>
</div>
<div class="container mt-3" id="AccepteTable" style="display: none">
  <table class="table caption-top" >
    <thead>
      <tr class="table-primary">

        <th scope="col">Formation</th>
        <th scope="col">Nom Employé</th>
        <th scope="col">Prénom Employé</th>
        <th scope="col">Status</th>
        <th colspan="2">Opérations</th>
      </tr>
    </thead>
    <tbody>
      @foreach($DemandeFormations as $DemandeFormation)
      @if($DemandeFormation->status=='Accepté')
      <tr class="DemandeFormation-{{$DemandeFormation->idDemandeFormation}}">
        <td class="Formation">{{$DemandeFormation->formation->NomFormation}}</td>
        <td class="NomEmployé text-info">{{$DemandeFormation->employe->nom}}</td>
        <td class="PrenomEmployé text-info">{{$DemandeFormation->employe->prenom}}</td>
        <td class="Status">{{$DemandeFormation->status}}</td>
        <td>
          <a class="btn btn-outline-danger" href="{{route('modifierDemandeFormation',['DemandeFormation'=>$DemandeFormation,'action'=>'Refuser'])}}">
            Refuser &rarr;
        </a>
        </td>
      </tr>
      
      @endif
      @endforeach
    </tbody>
  </table>
</div>
<div class="container mt-3" id="RefuseTable" style="display: none">
  <table class="table caption-top" >
    <thead>
      <tr class="table-primary">

        <th scope="col">Formation</th>
        <th scope="col">Nom Employé</th>
        <th scope="col">Prenom Employé</th>
        <th scope="col">Status</th>
        <th colspan="2">Opérations</th>
      </tr>
    </thead>
    <tbody>
      @foreach($DemandeFormations as $DemandeFormation)
      @if($DemandeFormation->status=='Refusé')
      <tr class="DemandeFormation-{{$DemandeFormation->idDemandeFormation}}">
        <td class="Formation">{{$DemandeFormation->formation->NomFormation}}</td>
        <td class="NomEmployé text-info">{{$DemandeFormation->employe->nom}}</td>
        <td class="PrenomEmployé text-info">{{$DemandeFormation->employe->prenom}}</td>
        <td class="Status">{{$DemandeFormation->status}}</td>
        <td>
          <a class="btn btn-outline-success" href="{{route('modifierDemandeFormation',['DemandeFormation'=>$DemandeFormation,'action'=>'Approuver'])}}">
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
        $('.editlink').on('click', function() {
            var formation = $(this).data('formation');

            console.log(formation);
            $('#NomFormationedit').val(formation.NomFormation);
            $('#DateFormationedit').val(formation.DateFormation);
            $('#DureeHeureedit').val(formation.DureeHeure);
            $('#Formatedit').val(formation.Format);
            $('#Objectifedit').val(formation.Objectif);

        });       
        $('.editlink').on('click', function() {
            // Récupérer l'ID de l'employé à partir de l'attribut data-poste
            var formation = $(this).data('formation');
            
            // Mettre à jour l'action du formulaire avec l'ID de l'employé
            var formAction = '{{ route("modifierFormation", ["id" => ":id"]) }}';
            formAction = formAction.replace(':id', formation.idFormation);
            $('#editFormation').attr('action', formAction);
        });
        $(document).ready(function () {
            $('#form').addClass('nav-link disabled');
        });               
</script>
@endsection
@endsection
  