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
            <li><a class="dropdown-item disabled" href="/ResponsableRH/Stage">Gestion de Stages</a></li>
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

  <!--Partie situé en bas de la navbar  -->

<div class="row justify-content-center">
    <div class="col-1" >
      <button type="button" class="btn  btn-primary w-100 " data-bs-toggle="modal" data-bs-target="#modalformStage" style="height: 60px">
          Ajouter un Stage &rarr;
      </button>
      <hr>
    </div>
</div>

    <!--Lien pour ajout d'un Type-->

<div class="pt-1 d-flex justify-content-center ">
    <a  class="text-center text-decoration-none border-bottom border-dark pb-1 font-italic text-muted" data-bs-toggle="modal" data-bs-target="#modalformType">
        Ajouter un type...&rarr;</a>  
</div>

    <!--Modal pour créer un type de Stage-->

  <div class="modal fade" id="modalformType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%" style="max-width: 2000px">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ajout d'un Type de Stage</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{route('createTypeStage')}}">
            @csrf
            <p class="lead">Informations Type de Stage:</p> 
            <div class="row">
  
              
              
                <label for="NomType" class="form-label">Nom Type de Stage :</label>
                <input type="text" class="form-control" id="NomType" name="NomType">
              
              
              
                <label for="Desc" class="form-label">Description:</label>
                <textarea class="form-control" id="Desc" name="Desc"></textarea>
  
  
  
            </div>
  
  
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


      <!--Modal pour afficher Type de Stage-->

<div class="modal fade" id="modalformTypeListe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%" style="max-width: 2000px">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Type de Stage</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
  <table class="table">
    <thead>
      <tr class="table-primary">
  
        <th scope="col">idTypeStage</th>
        <th scope="col">Nom du Type</th>
        <th scope="col">Description</th>
        <th colspan=""></th>
      </tr>
    </thead>
    <tbody>
      @foreach($typestages as $typestage)
      <tr class="typecontrat-{{$typestage->idTypeStage}}">
        <td class="idTypeStage">{{$typestage->idTypeStage}}</td>
        <td class="NomTypeStage">{{$typestage->NomTypeStage}}</td>
        <td class="Desc">{{$typestage->Desc}}</td>
  
        <td>
          <form action="{{route('deleteTypeStage',['typestage'=> $typestage])}}" class="pt-2" method="POST">
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

    <!--Modal pour créer un Stage-->

  <div class="modal fade" id="modalformStage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%" style="max-width: 2000px">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ajout d'un Stage</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{route('createStage')}}">
            @csrf
            <p class="lead">Informations sur le Poste:</p> 
            <div class="container">
                <div class="row">                
                    <select name="typestage_id" disabled id="typestage_id" class="form-select" >
                    <option value="">Sélectionner un type de Stage</option>
                    @foreach($typestages as $typestage)
                        <option value="{{ $typestage->idTypeStage }}">Id:{{ $typestage->idTypeStage }} Nom:{{ $typestage->NomTypeStage }}</option>
                    @endforeach
                </select>
                <div class="row mt-1">
                    <input class="form-check-input" type="checkbox" name="disable" id="disable"  onchange="toggleLink()" checked>
                    <a id="addTypeLink" class="text-center text-decoration-none border-bottom border-dark pb-1 font-italic text-muted w-50 " role="button" aria-disabled="false" data-bs-toggle="modal" data-bs-target="#modalformType">Ajouter un type...&rarr;</a>

                  </div>
            </div>
                <label for="Objectif" class="form-label">Objectif:</label>
                <input type="text" class="form-control" id="Objectif" name="Objectif">
  
                <select name="departement_id" class="form-select mt-3" id="Departement">
                    <option value="">Sélectionner un Département</option>
                    @foreach($departements as $departement)
                        <option value="{{ $departement->idDepartement }}">Id:{{ $departement->idDepartement }} Nom:{{ $departement->nom}}</option>
                    @endforeach
                </select>
  
                <label for="Desc" class="form-label">Description:</label>
                <textarea class="form-control" id="Desc" name="Desc"></textarea>
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

    <!--Modal pour edit un Stage-->
  <div class="modal fade" id="modalformStageEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%" style="max-width: 2000px">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modification d'un Stage</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="#"id="formModifierStage">
            @csrf
            @method('put')
            <p class="lead">Informations sur le Poste:</p> 
            <div class="container">
                <div class="row">                
                    <select name="typestage_id"  id="typestage_idEdit" class="form-select" >
                    <option value="">Sélectionner un type de Stage</option>
                    @foreach($typestages as $typestage)
                        <option value="{{ $typestage->idTypeStage }}">Id:{{ $typestage->idTypeStage }} Nom:{{ $typestage->NomTypeStage }}</option>
                    @endforeach
                </select>

            </div>
                <label for="Objectif" class="form-label">Objectif:</label>
                <input type="text" class="form-control" id="ObjectifEdit" name="Objectif">
  
                <select name="departement_id" class="form-select mt-3" id="DepartementEdit">
                    <option value="">Sélectionner un Département</option>
                    @foreach($departements as $departement)
                        <option value="{{ $departement->idDepartement }}">Id:{{ $departement->idDepartement }} Nom:{{ $departement->nom}}</option>
                    @endforeach
                </select>
  
                <label for="Desc" class="form-label">Description:</label>
                <textarea class="form-control" id="DescEdit" name="Desc"></textarea>
            </div>
        </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary" id="modifierStageBtn">
                    Modifier
                </button>
              </div>
          </form>
        </div>
      </div>
  </div>  

  <!--Body-->
<div class="row" style="--bs-gutter-x:0.75rem;--bs-gutter-y:10">
  @foreach($stages as $stage)
  <div class="col-3 ">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{$stage->typestage->NomTypeStage}}</h5>
        <h6 class="card-subtitle mb-1 text-body-secondary">ID:{{$stage->idStage}}</h6>
        <p class="card-text">Objectif: {{$stage->Objectif}}<br>Departement:{{$stage->idDepartement}}</p>
        @if($stage->Desc)
        <h6 class="card-subtitle mb-1 text-body-secondary">Description:</h6>
        <p class="text-body-seconday">{{$stage->Desc}}</p>
        @endif
        
      <a class="float-end btn btn-success" id="modifierStage" data-bs-toggle="modal" data-bs-target="#modalformStageEdit" data-stage="{{$stage->idStage}}" ><img src="/bootstrap-icons/icons/pencil.svg" style="height: 80%"> </a> 
      <form action="{{route('deleteStage',['stage'=>$stage])}}" method="POST">
        @csrf
        @method('delete')
      <button class="float-end btn btn-danger"><img src="/bootstrap-icons/icons/x-lg.svg" style="height: 80%"> </button>
      </form>
      </div>
    </div>
  </div>
  @endforeach
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
        
    });
    function toggleLink() {
        var checkbox = document.getElementById("disable");
        var link = document.getElementById("addTypeLink");
        var typeselect = document.getElementById("typestage_id");

        if (checkbox.checked) {
            link.setAttribute("data-bs-toggle", "modal");
            link.classList.add("border-bottom");
            link.classList.add("text-decoration-none");
            link.classList.remove("text-decoration-line-through");
            typeselect.disabled=true;
        } else {
            link.setAttribute("data-bs-toggle","");
            link.classList.remove("border-bottom");
            link.classList.remove("text-decoration-none");
            link.classList.add("text-decoration-line-through");
            typeselect.disabled=false;
        }
    }     
    var stageId;
    var stage;
        //Ouvre le modal et remplis les champs du formulaire
        $('#modifierStage').on('click', function() {
        stageId = $(this).data('stage');
        $.ajax({
            url: '/ResponsableRH/Stage/' + stageId,
            type: 'GET',
            success: function(response) {
                // Les données du formulaire se remplissent ici
                $('#typestage_idEdit').val(response.Type);
                $('#ObjectifEdit').val(response.Objectif);
                $('#DepartementEdit').val(response.idDepartement);
                $('#DescEdit').val(response.Desc);
            },
            error: function(xhr, status, error) {
            }
        });

    });
    $('#modifierStageBtn').on('click', function() {
        var action;
        var action = "{{ route('editStage', ':stageId') }}".replace(':stageId', stageId);
        $('#formModifierStage').attr('action',action);
        console.log(action);
    });
</script>