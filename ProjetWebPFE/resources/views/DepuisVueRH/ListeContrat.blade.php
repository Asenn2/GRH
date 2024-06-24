@extends('layout')
@section('title','Login')
@section('content')

<!--La Navbar  -->

@include('navbar')


<!--Partie situé en bas de la navbar  -->
<br>
<div class="row justify-content-center mt-1 ">
    <div class="col-2 mx-1 p-0" >
      <button type="button" class="btn  btn-outline-success w-100 p-0  " data-bs-toggle="modal" data-bs-target="#modalformContrat" style="height: 50px">
        <img src="/bootstrap-icons/icons/plus.svg" style="height: 80%"> 
          Un Contrat 
      </button>
    </div>
</div>


<!--Bouton pour ajouter un type -->

<div class="pt-4 d-flex justify-content-center ">
  <a  class="text-center text-decoration-none border-bottom border-dark pb-1 font-italic text-muted" data-bs-toggle="modal" data-bs-target="#modalformType">
    Ajouter un type...&rarr;
  </a>  
</div>

<!--Modal pour ajouter un contrat a la table  -->

<div class="modal fade" id="modalformContrat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%" style="max-width: 2000px">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ajout d'un Contrat</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{route('createContrat')}}">
            @csrf
            <p class="lead">Informations Contrat CDD:</p> 
            <div class="row">
              <div class="col border-end">
                <select name="employe_id" class="form-select">
                  <option value="">Sélectionner un employé</option>
                  @foreach($employes as $employe)
                      <option value="{{ $employe->idEmploye }}">Id:{{ $employe->idEmploye }} Nom:{{ $employe->nom }}</option>
                  @endforeach
              </select>              
              
              
                <label for="DebutContrat" class="form-label">Date DateDebutContrat(Y-m-d):</label>
                <input type="date" class="form-control" id="DebutContrat" name="DebutContrat">
                <label for="DateFinContrat" class="form-label">Date DateFinContrat(Y-m-d):</label>
                <input type="date" class="form-control" id="DateFinContrat" name="DateFinContrat">
              </div>

            </div>
              
            <div class="row">
              <b class="mb-3">Poste:</b>
                <select name="poste_id" class="form-select mb-2">
                  <option value="">Sélectionner un poste</option>
                  @foreach($postes as $poste)
                      <option value="{{ $poste->idPoste }}">Nom:{{ $poste->Fonction }}</option>
                  @endforeach
              </select>

                  
            </div>
            <div class="row">
              <b class="mb-3">Condition de Travail:</b>
              @foreach($avantages as $avantage)
              <div class="form-check">
                  <input type="checkbox" class="form-check-input" name="avantages[]" value="{{ $avantage->idAvantage }}">
                  <label class="form-check-label">{{ $avantage->nom }}</label>
              </div>
          @endforeach
            </div>
              <div class="row">
                <b class="mb-3">Congé:</b>
                
                  <label for="soldeCG" class="form-label">Nombre de jours de congé payé par an:</label>
                  <input type="text" class="form-control" id="soldeCG" name="soldeCG">
                  
                
              </div>
              <div class="row">
                <b class="mb-3">Résiliation:</b>
                <label for="dateResiliation" class="form-label">Date Resiliation:</label>
                <input type="date" class="form-control" id="dateResiliation" name="dateResiliation">

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

<!--Modal pour ajouter un Type de Contrat a la table  -->

<div class="modal fade" id="modalformType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%" style="max-width: 2000px">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ajout d'un Contrat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('createTypeContrat')}}">
          @csrf
          <p class="lead">Informations Type de Contrat:</p> 
          <div class="row">

            
            
              <label for="NomTypeContrat" class="form-label">Nom Type de Contrat :</label>
              <input type="text" class="form-control" id="NomTypeContrat" name="NomTypeContrat">
            
            
            
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



<!--Modal pour afficher la liste des types -->

<div class="modal fade" id="modalformTypeListe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%" style="max-width: 2000px">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Liste des Type de Contrat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
  <table class="table">
    <thead>
      <tr class="table-primary">

        <th scope="col">idTypeContrat</th>
        <th scope="col">Nom du Type</th>
        <th scope="col">Description</th>
        <th colspan=""></th>
      </tr>
    </thead>
    <tbody>
      @foreach($typecontrats as $typecontrat)
      <tr class="typecontrat-{{$typecontrat->idTypeContrat}}">
        <td class="idTypeContrat">{{$typecontrat->idTypeContrat}}</td>
        <td class="NomTypeContrat">{{$typecontrat->NomTypeContrat}}</td>
        <td class="Desc">{{$typecontrat->Desc}}</td>

        <td>
          <form action="{{route('deleteTypeContrat',['typecontrat'=> $typecontrat])}}" class="pt-2" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-link text-decoration-none border-bottom border-dark pb-1 font-italic text-danger">
                Supprimer &rarr;
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



<!--Body-->

<div class="container mt-4">
  <div class="card shadow-lg w-100">

        <!--Liste De Contrats -->
<div class="card-body">
          <table class="table caption-top" id="ContratTable" >
            <caption class="text-body-secondary" >Liste des contrats :</caption>    
            <thead>
              <tr class="table-primary">
                <th scope="col"></th>
    
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">statut</th>
                <th scope="col">Avantage</th>
                <th scope="col">Type de Contrat</th>
                <th scope="col">Debut Contrat</th>
                <th scope="col">Fin Contrat</th>
                <th scope="col">Délai Resiliation</th>
                <th scope="col">Operations</th>
              </tr>
            </thead>
            <tbody>
              @foreach($contrats as $contrat)
              <tr class="contrat-{{$contrat->idContrat}}">
                <td>              <a class="text-decoration-dotted-line border-bottom border-dark pb-1 font-italic text-success afficherContrat"  data-bs-toggle="modal" data-bs-target="#modalformContratFile" data-id-contrat="{{$contrat->idContrat}}" href="">
                  Afficher &rarr;
              </a>
                </td>
                <td class="idContrat">{{$contrat->employe->nom}}</td>
                <td class="Employe">{{$contrat->employe->prenom}}</td>
                <td class="statut">{{$contrat->status}}</td>
                <td class="Avantage">
                  <ul class="list-group">
                  @foreach($contrat->avantages as $avantage)
                  <li class="list-group-item">{{ $avantage->nom }}</li>
              @endforeach
            </ul> 
    
                </td>
                <td class="Type">{{$contrat->typeContrat->NomTypeContrat}}</td>
                <td class="Debut">{{$contrat->Debut}}</td>
                <td class="Fin">{{$contrat->Fin}}</td>
                <td class="DelaiResiliation">{{$contrat->DateResiliation}}</td>
                <td>
                  <form action="/ResponsableRH/Contrat/{{$contrat->idContrat}}/delete" class="pt-2" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-link text-decoration-none border-bottom border-dark pb-1 font-italic text-danger">
                        Supprimer &rarr;
                    </button>
                </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
</div>
</div>
<!--Modal pour afficher le contrat -->

<div class="modal fade" id="modalformContratFile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Contrat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<iframe class="pdfViewer" width="100%" height="600" frameborder="0" ></iframe>
      </div>
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

@extends('script')
@section('scripts')
<script>
  
$(document).ready(function() {

        $('#contrat').addClass('nav-link disabled');
    $('.afficherContrat').on('click', function(event) {
        event.preventDefault();

        var contratId = $(this).data('id-contrat');
        $.ajax({
            url: '{{ route("wordtopdf", ":id") }}'.replace(':id', contratId),
            type: 'GET',
            success: function(response) {
                // La route du Pdf
                var pdfUrl = response.pdfpathurl;

                // console.log("URL du PDF :", pdfUrl); pour tester !

                $('.pdfViewer').attr('src', pdfUrl);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
   


    

});
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
        
    });

</script>
@endsection
@endsection