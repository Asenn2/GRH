@extends('layout')
@section('title','Login')
@section('content')

<!--La Navbar  -->

@include('navbar')


  <!--Partie situé en bas de la navbar  -->
<br>
<div class="row justify-content-center ">
  <div class="col-3 ">
    <button type="button" class="btn  btn-outline-success w-100" data-bs-toggle="modal" data-bs-target="#modalform" style="height: 50px">
      <img src="/bootstrap-icons/icons/person-add.svg" style="height: 80%"> 
        Ajouter un employé
    </button>    

  </div>
</div>

  <!--Modal qui s'ouvre a l'appui de ajouter un employé pour ajouter un employé a la table dans la base de donnée  -->

  <div class="modal fade" id="modalform" tabindex="-1" aria-labelledby="modalform" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ajout d'un employé</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{route('storeemploye')}}" >
            @csrf 
            <p class="lead">Informations personnelles:</p>
            <div class="row">
              <div class="col mb-1">
                <label for="mail" class="form-label">mail</label>
                <input type="mail" class="form-control" id="mail" name="mail" value="">
              </div>
              <div class="col mb-1">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="">
              </div>
              <div class="col mb-1">
                <label for="prenom" class="form-label">Prénom:</label>
                <input type="text" class="form-control" id="prenom" name="prenom">
              </div>
            </div>
            <div class="row">
              <div class="col mb-1">
                <label for="sexe" class="form-label">Sexe:</label>
                <input type="text" class="form-control" id="sexe" name="sexe">
              </div>
              <div class="col mb-1">
                <label for="LieuNaiss" class="form-label">Lieu Naissance:</label>
                <input type="text" class="form-control" id="LieuNaiss" name="LieuNaiss">
              </div>
            </div>
            <div class="row">
              <div class="col mb-1">
                <label for="DateNaiss" class="form-label">Date Naissance:</label>
                <input type="date" class="form-control" id="DateNaiss" name="DateNaiss">
              </div>
              <div class="col mb-1">
                <label for="Num" class="form-label">Num:</label>
                <input type="text" class="form-control" id="Num" name="Num">
              </div>
              <div class="col mb-1">
                <label for="Adresse" class="form-label">Adresse:</label>
                <input type="text" class="form-control" id="Adresse" name="Adresse">
              </div>
            </div>
                                    <hr>
            <p class="lead">Informations professionnelles:</p>

              <div class="row">
                <b class="mb-3">Poste:</b>
                <select name="poste_id" class="form-select">
                  <option value="">Sélectionner un Poste</option>
                  @foreach($postes as $poste)
                      <option value="{{ $poste->idPoste }}">Fonction:{{ $poste->Fonction }}</option>
                  @endforeach
              </select>
              </div>
              <div class="row">
                <b class="mb-3">Departement:</b>
                <select name="departement_id" class="form-select">
                  <option value="">Sélectionner un Departement</option>
                  @foreach($Departements as $Departement)
                      <option value="{{ $Departement->idDepartement }}">Nom:{{ $Departement->nom }}</option>
                  @endforeach
              </select>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary" id="ajouterEmployeBtn">Ajouter</button> <!-- Utilisation d'un bouton ordinaire pour empêcher la soumission du formulaire -->
            </div>
          </form>
            </div>
          
        </div>
        

    
        
      </div>
  </div>
 
  
<!--Modal qui s'ouvre a l'appui de edit pour modifier les données d'une ligne de la table  -->

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modifier un employé</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('employe.update', ['id' => 0])}}" id="EditEmployeForm">
          @csrf 
          @method('put')
          <p class="lead">Informations personnelles:</p>
          <div class="row">
            <div class="col mb-1">
              <label for="maill" class="form-label">mail</label>
              <input type="mail" class="form-control" id="mailedit" name="maill" value="">
            </div>
            <div class="col mb-1">
              <label for="nomm" class="form-label">Nom</label>
              <input type="text" class="form-control" id="nomedit" name="nomm" value="">
            </div>
            <div class="col mb-1">
              <label for="prenomm" class="form-label">Prénom:</label>
              <input type="text" class="form-control" id="prenomedit" name="prenomm">
            </div>
          </div>
          <div class="row">
            <div class="col mb-1">
              <label for="sexee" class="form-label">Sexe:</label>
              <input type="text" class="form-control" id="sexeedit" name="sexee">
            </div>
            <div class="col mb-1">
              <label for="LieuNaisss" class="form-label">Lieu Naissance:</label>
              <input type="text" class="form-control" id="LieuNaissedit" name="LieuNaisss">
            </div>
          </div>
          <div class="row">
            <div class="col mb-1">
              <label for="DateNaisss" class="form-label">Date Naissance(Y-m-d):</label>
              <input type="date" class="form-control" id="DateNaissedit" name="DateNaisss">
            </div>
            <div class="col mb-1">
              <label for="Numm" class="form-label">Num:</label>
              <input type="text" class="form-control" id="Numedit" name="Numm">
            </div>
            <div class="col mb-1">
              <label for="Adressee" class="form-label">Adresse:</label>
              <input type="text" class="form-control" id="Adresseedit" name="Adressee">
            </div>
          </div>
                                  <hr>

            <div class="row">
              <b class="mb-3">Poste:</b>
              <select id="posteedit" name="posteedit" class="form-select">
                <option value="">Sélectionner un Poste</option>
                @foreach($postes as $poste)
                    <option value="{{ $poste->idPoste }}">Id:{{ $poste->idPoste }} Fonction:{{ $poste->Fonction }}</option>
                @endforeach
            </select>
            </div>
            <div class="row">
              <b class="mb-3">Departement:</b>
              <select id="departementedit" name="departementedit" class="form-select">
                <option value="">Sélectionner un Departement</option>
                @foreach($Departements as $Departement)
                    <option value="{{ $Departement->idDepartement }}">Id:{{ $Departement->idDepartement }} Nom:{{ $Departement->nom }}</option>
                @endforeach
            </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-primary" id="modifierEmployeBtn">Modifier</button> <!-- Utilisation d'un bouton ordinaire pour empêcher la soumission du formulaire -->
          </div>
        </form>
          </div>
       
      </div>
      

      
      
    </div>
</div>


  <!-- Table pour afficher les employés -->

 <!-- Table pour afficher les employés -->
<div class="container mt-4">
 <div class="card shadow-lg">
  <div class="card-body ">
    <div id="app">
      <employee-table :employes="{{ json_encode($employes) }}"></employee-table>
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
@vite('resources/js/app.js')
<script>
      var employeId,url;
      var employeData;
      var nom,prenom,sexe,LieuNaiss,DateNaiss,Num,idContrat,idDepartement,idPoste ;
 
      $(document).ready(function () {

    //Ouvre le modal et remplis les champs du formulaire
    $('.edit-employe').on('click', function() {
       var  employe = $(this).data('employe');
                // Les données du formulaire se remplissent ici
                $('#mailedit').val(employe.mail);
                $('#nomedit').val(employe.nom);
                $('#prenomedit').val(employe.prenom);
                $('#sexeedit').val(employe.sexe);
                $('#LieuNaissedit').val(employe.LieuNaiss);
                $('#DateNaissedit').val(employe.DateNaiss);
                $('#Numedit').val(employe.Num);
                $('#Adresseedit').val(employe.Adresse);
                $('#departementedit').val(employe.idDepartement);
                $('#posteedit').val(employe.idPoste);

                var formulaire = $('#modalform');

                // Désactiver tous les champs du formulaire
                formulaire.find(':input').prop('disabled', true);

        // Mettre à jour l'action du formulaire avec l'ID de l'employé
        var formAction = '{{ route("employe.update", ["id" => ":id"]) }}';
        formAction = formAction.replace(':id', employe.idEmploye);
        $('#EditEmployeForm').attr('action', formAction);
    });
  });
   /* $('#modifierEmployeBtn').on('click', function() {
        // Effectuez la requête AJAX
        $.ajax({
            url: '/ResponsableRH/Employé/'+employeId+'/update',
            type: 'put', // Utilisation de la méthode PUT pour la modification
            data: $('#EditEmployeForm').serialize(), // Sérialisation des données du formulaire
            success: function(response) {
                // Affichez un message de succès à l'utilisateur
    
            },
            error: function(xhr, status, error) {
                // Gérer les erreurs ici
                console.error('Erreur lors de la modification des données de l\'employé :', error);
                console.log('XHR:', xhr);
                console.log('Status:', status);
                console.log('Error:', error);
            }
        });
   });*/

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
    $(document).ready(function () {
        $('#emp').addClass('nav-link disabled');
    });              
</script>
@endsection
@endsection
 