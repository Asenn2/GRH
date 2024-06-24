@extends('layout')
@section('title', 'Liste des Départements')
@section('content')

@include('navbar')

<!-- Section pour afficher les messages de succès et d'erreur -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="toastSuccess" class="toast text-bg-success" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Alert</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            @if(session()->has('success'))
                {{ session('success') }}
            @endif
        </div>
    </div>

    <div id="toastError" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Alert</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            @if ($errors->any() || session('error'))
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <p>{{ session('error') }}</p>
            @endif
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col">
            <h4 class="text-center">Départements:</h4>
        </div>
    </div>

    <div class="row">
        <div class="col text-end">
            <a href="{{ route('createDepartement') }}" class="btn btn-outline-success">
                Ajouter un Département
            </a>
        </div>
    </div>
</div>

<!-- Les Departements -->
<div class="container mt-4">
    <div class="row">
        @foreach($departements as $departement)
            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="card-title">{{ $departement->nom }}</h2>
                        <p class="card-text">{{ $departement->Desc }}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                      <a href="{{route('InfoDepartement',['id'=>$departement->idDepartement])}}" class="text-decoration-none text-info">
                        Plus d'information.. 
                    </a>
                        <a href="{{ route('Departement.edit', ['departement' => $departement]) }}" class="text-decoration-none text-success">
                            Editer 
                        </a>
                        <form action="{{ '/ResponsableRH/Departement/' . $departement->idDepartement }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-link text-decoration-none text-danger">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>



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
    });
    $(document).ready(function () {
        $('#dep').addClass('nav-link disabled');
    });
</script>
@endsection
@endsection