@extends('layout')

@section('title', 'User Management')

@section('content')

        <!--La navbar  -->

        <nav class="navbar navbar-expand-lg " style="background-color: rgb(86,127,167)">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">GRH</a>
              <ul class="navbar-nav ms-auto  mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="{{route('ListeOffreEmploi1')}}">Espace candidature</a>
                </li>
                <li class="nav-item ">
                  <a href="#" class="nav-link active" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    A propos
                  </a>
                </li>
                <li class="nav-item">
                  <form action="{{route('logout')}}" method="post">
                    @csrf
                    @method('delete')
                    <button><img src="/bootstrap-icons/icons/door-closed-fill.svg" style="height: 80%"></button>
                  </form>
                </li>
              </ul>
            </div>
        </nav>
<div class="container mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card border rounded">
                <div class="card-header" style="background-color: rgb(86,127,167)">
                    <h1 class="h4">User Management</h1>
                </div>
                <div class="card-body">
                    <button type="button" class="btn  btn-primary " data-bs-toggle="modal" data-bs-target="#modalformUser" >
                        Ajouter un utilisateur &rarr;
                    </button>
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Employé</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->idlogin_table }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->password }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>{{ $user->idEmploye }}</td>
                                    <td>
                                        <a href="{{ route('adminEditForm', ['id' => $user->idlogin_table]) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('adminDelete', ['id' => $user->idlogin_table]) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

  <!--Modal pour ajouter un nouveau Poste -->

  <div class="modal fade" id="modalformUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%" style="max-width: 2000px">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ajout d'un Utilisateur</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{route('adminCreate')}}">
            @csrf
            <p class="lead">Informations sur l'Utilisateur:</p> 
            <div class="container">
                <label for="email" class="form-label">Email:</label>
                <input type="text" class="form-control" id="email" name="email">
  
                <label for="password" class="form-label">Password:</label>
                <input type="text" class="form-control" id="password" name="password">
  
                <label for="role" class="form-label">Role:</label>
                <input type="text" class="form-control" id="role" name="role">
  
                <label for="id" class="form-label">Employé (iD):</label>
                <input class="form-control" id="id" name="id"/>
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
@endsection
