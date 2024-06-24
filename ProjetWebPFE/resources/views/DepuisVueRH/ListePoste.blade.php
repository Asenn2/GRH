@extends('layout')
@section('title','Login')
@section('content')

<!--La Navbar  -->

@include('navbar')


  <!--Partie situé en bas de la navbar  -->
<br>
<div class="row justify-content-center">
  <div class="col-1" >
    <button type="button" class="btn  btn-outline-success w-100 " data-bs-toggle="modal" data-bs-target="#modalformPoste" style="height: 60px">
        Ajouter un Poste &rarr;
    </button>
    <hr>
  </div>
</div>

  <!--Modal pour ajouter un nouveau Poste -->

<div class="modal fade" id="modalformPoste" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%" style="max-width: 2000px">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ajout d'un Poste</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('createPoste')}}">
          @csrf
          <p class="lead">Informations sur le Poste:</p> 
          <div class="container">
              <label for="Fonction" class="form-label">Fonction du Poste:</label>
              <input type="text" class="form-control" id="Fonction" name="Fonction">

              <label for="AdresseLieuTravail" class="form-label">Adresse du lieu du Poste:</label>
              <input type="text" class="form-control" id="AdresseLieuTravail" name="AdresseLieuTravail">

              <label for="Salaire" class="form-label">Salaire du Poste:</label>
              <input type="text" class="form-control" id="Salaire" name="Salaire">

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
  <!--Modal pour modifier un Poste -->

  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%" style="max-width: 2000px">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modification d'un Poste</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" id="editPoste" action="{{route('modifierPoste',['id' => 0])}}">
            @csrf
            @method('put')
            <p class="lead">Informations sur le Poste:</p> 
            <div class="container">
                <label for="Fonction" class="form-label">Fonction du Poste:</label>
                <input type="text" class="form-control" id="Fonctionedit" name="Fonctionedit">
  
                <label for="AdresseLieuTravail" class="form-label">Adresse du lieu du Poste:</label>
                <input type="text" class="form-control" id="AdresseLieuTravailedit" name="AdresseLieuTravailedit">
  
                <label for="Salaire" class="form-label">Salaire du Poste:</label>
                <input type="text" class="form-control" id="Salaireedit" name="Salaireedit">
  
                <label for="Desc" class="form-label">Description:</label>
                <textarea class="form-control" id="Descedit" name="Descedit"></textarea>
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
<div class="container mt-2">
  <div class="card shadow-lg w-100">
    <div class="card-body">
<div class="row" style="--bs-gutter-x:0.75rem;--bs-gutter-y:10">
  @foreach($postes as $poste)
  <div class="col-4 d-flex flex-column">
    <div class="card w-100">
      <div class="card-body">
        <h5 class="card-title">{{$poste->Fonction}}</h5>
        <p class="card-text">Lieu de Travail: {{$poste->AdresseLieuTravail}}<br>Salaire:{{$poste->Salaire}}</p>
        @if($poste->Desc)
        <h6 class="card-subtitle mb-1 text-body-secondary">Description:</h6>
        <p class="text-body-secondary">{{$poste->Desc}}</p>
        @endif
        <div class="card-footer mt-auto">
          <div class="d-flex justify-content-between">
      <a class="float-end btn btn-outline-success editlink" data-bs-toggle="modal" data-bs-target="#editModal" data-poste="{{$poste}}" >
        <img src="/bootstrap-icons/icons/pencil.svg" style="height: 60%">Modifier 
      </a> 
      <form action="/ResponsableRH/Poste/{{$poste->idPoste}}/delete" method="POST">
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
    </div></div></div>



@extends('script')
@section('scripts')
<script>
    //Catch des succès et erreurs
    document.addEventListener('DOMContentLoaded', function () {
      const toastSuccess = document.getElementById('toastSuccess');
      const toastError = document.getElementById('toastError');

        @if(session()->has('success'))

            var bsToast = new bootstrap.Toast(toastSuccess);
            bsToast.show();

        @endif

        @if ($errors->any())

            var bsToast = new bootstrap.Toast(toastError);
            bsToast.show();

        @endif        
        
    });





    $(document).ready(function () {
        $('#poste').addClass('nav-link disabled');
            //Remplis le formulaire par les données
    $('.editlink').on('click', function() {
        var poste = $(this).data('poste');

        $('#Fonctionedit').val(poste.Fonction);
        $('#AdresseLieuTravailedit').val(poste.AdresseLieuTravail);
        $('#Salaireedit').val(poste.Salaire);
        $('#Descedit').val(poste.Desc);

        var formAction = '{{ route("modifierPoste", ["id" => ":id"]) }}';
        formAction = formAction.replace(':id', poste.idPoste);
        $('#editPoste').attr('action', formAction);
    });
    });    
</script>
@endsection

@endsection
  