<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg d-print-none " style="background-color: rgb(86,127,167)">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"><img src="{{asset('5422484.png')}}"alt="Logo" style="height: 40px;"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link " id="home" aria-current="page" href="{{route('ResponsableRH')}}">Home</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Employés
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item " id="emp" href="{{route('ListeEmploye')}}">Liste</a></li>
                  <li><a class="dropdown-item " id="contrat" href="{{route('ListeContrat')}}">Contrat</a></li>
                  <li><a class="dropdown-item" id="candidature" href="{{route('ListeCandidature')}}">Candidature</a></li>
                  <li><a class="dropdown-item " id="poste" href="{{route('ListePoste')}}">Postes</a></li>
                  <li><a class="dropdown-item " id="conge" href="{{route('ListeConge')}}">Congé</a></li>
      
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Carrières
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" id="promo" href="{{route('ListePromotion')}}">Promotion</a></li>
                  <li><a class="dropdown-item  " id="ellig" href="{{route('ListeElligible')}}">Liste Elligible </a></li>
                  <li><a class="dropdown-item " id="form" href="{{route('ListeFormation')}}">Formation</a></li>
      
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="dep" href="{{route('ListeDepartement')}}">Départements</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Stages
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item " id="stage" href="/ResponsableRH/Stage">Gestion de Stages</a></li>
                  <li><a class="dropdown-item" id="demstage" href="{{route('ListeDemandeStage')}}">Demande de Stage</a></li>
                </ul>
              </li>
            </ul>
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <form action="{{route('logout')}}" method="post">
                  @csrf
                  @method('delete')
                  <button><img src="/bootstrap-icons/icons/door-closed-fill.svg" alt="Logo" style="height: 40px"></button>
                </form>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    
</body>
</html>