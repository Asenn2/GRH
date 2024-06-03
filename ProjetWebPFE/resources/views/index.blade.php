@extends('layout')
@section('title','Login')
@section('content')
    
<!--Body -->

<div class="container-fluid">
  <div class="row">

    <!--Partie Gauche -->
    <div class="col-6 mx-0"  style="height:100%;">

        <!--La navbar du login -->

      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">GRH</a>
          <ul class="navbar-nav ms-auto  mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{route('ListeOffreEmploi1')}}">Espace candidature</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{route('ListStage')}}">Espace Stage</a>
            </li>
            <li class="nav-item ">
              <a href="#" class="nav-link active" data-bs-toggle="modal" data-bs-target="#exampleModal">
                A propos
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <!--Succès et formulaire -->
    
      <div class="container">
        <div class="row align-items-center justify-content-center"  style="min-height: 70vh;"> 
          <div class="col-6  ">

            <!--Catch de succès -->

            <div>
              @if(session()->has('success'))
                <div>
                  <div class="alert alert-success " role="alert">
                    <h4 class="alert-heading text-center">Well done!</h4>
                    <p>You successfully registred </p>
                                    <hr>
                    <p>Try to log in.</p>
                  </div>
                </div>
              @endif    
            </div>

            @if($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @if(session('error'))
            <div>
                {{ session('error') }}
            </div>
        @endif
            <!--Formulaire du login -->

            <div class="card " >
              <div class="card-header text-center">Login</div>
              <div class="card-body">
                <form method="POST" action="{{ route('loginPost') }}" style="margin-bottom: 14px;">
                  @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="email" name="email" placeholder="name@example.com">
                        <label for="mail">Email address</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <label for="password">Password</label>
                    </div>

                    <div class="form-group mb-0">
                      <button type="submit" class="btn btn-primary">
                        Login
                      </button>
                    </div>
                </form>
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>

    <!--Partie Droite -->

    <div class="col-md-6  " style="background-color:rgb(153,0,204) ;">
      <div class="d-flex text-center align-items-center justify-content-center" style="min-height: 100vh;">
        <img src="/PW/public/WhatsApp_Image_2024-03-25_at_22.01.39.jpeg" class="img-fluid rounded" alt="">
          <h1>Sys.GRH </h1>
      </div>
    </div>
  </div>
</div>   

<!--Modal a Propos -->
    
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">A propos de l'entreprise...</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row ">
                    <div class="col border-end">
                        <p class="lead">Informations :</p>
                    </div>
                    <div class="col border-end">
                        <p class="lead">Objectif :</p>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
              
            </div>
          </div>
        </div>
    </div>

@endsection