@extends('layout')
@section('title', 'Login')
@section('content')

@include('navbar')
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
  
  <br>
  <h5 class="text-uppercase text-center font-weight-bold" style="color: #7b7b7b">{{ isset($dep) ? 'Modification d\'un Departement' : ' Creation d\'un Departement' }}
  </h5>
  <div class="container mt-5 d-flex justify-content-center ">
    <div class="card shadow-lg w-25">
      <div class="card-body">
    <form action="{{isset($departement) ? route('modifierDepartement',['dep'=> $departement]) : route('storeDepartement')   }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{ isset($departement) ? method_field('put') : method_field('post') }}

            <div class="mb-1">
                <label for="photo">Image :</label>
                <input type="file" name="photo" id="photo">
            </div>
            <div class="mb-1">
                    <label for="nom" class="form-label">Nom </label> 
                    <input type="text" class="form-control" id="nom" name="nom" value="{{ isset($departement) ? $departement->nom : '' }}">
            </div>
        <div class="mb-1">
            <label for="Description" class="form-label">Description:</label>
            <textarea class="form-control" id="Description" name="Description">{{ isset($departement) ? $departement->Desc : '' }}</textarea>
        </div>
        <div class="card-footer d-flex justify-content-between">
        <button type="submit" class="btn btn-outline-primary">
            {{ isset($departement) ? 'Modifier' : 'Ajouter' }}
        </button>
        <a href="#" class="btn btn-outline-secondary " onclick="history.back()">Cancel</a>
        </div>
    </form>
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
          @endif });
        $(document).ready(function () {
        $('#dep').addClass('nav-link disabled');
    });
</script>
@endsection
@endsection 