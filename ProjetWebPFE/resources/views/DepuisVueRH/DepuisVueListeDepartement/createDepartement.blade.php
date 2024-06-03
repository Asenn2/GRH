@extends('layout')
@section('title', 'Login')
@section('content')

<div class="container border border-2 rounded mt-5 m-auto py-5">
    <div class="text-center">
        <h1 class="display-3 text-uppercase font-weight-bold" style="color: #7b7b7b">            {{ isset($dep) ? 'Modification d\'un Departement' : ' Creation d\'un Departement' }}
        </h1>
    </div>
    <form action="{{isset($departement) ? route('modifierDepartement',['dep'=> $departement]) : route('storeDepartement')   }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{ isset($departement) ? method_field('put') : method_field('post') }}

        <div class="row">
            <div class="col-3">
                <label for="photo">Image :</label>
                <input type="file" name="photo" id="photo">
            </div>
            <div class="col-9">
                <div class="float-end">
                    <label for="nom" class="form-label">Nom </label> 
                    <input type="text" class="form-control" id="nom" name="nom" value="{{ isset($departement) ? $departement->nom : '' }}">
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <label for="Description" class="form-label">Description:</label>
            <textarea class="form-control" id="Description" name="Description">{{ isset($departement) ? $departement->Desc : '' }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">
            {{ isset($departement) ? 'Modifier' : 'Ajouter' }}
        </button>
    </form>
</div>
@endsection
