<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<!--La Navbar  -->

<nav class="navbar navbar-expand-lg" style="background-color: rgb(86,127,167)">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{route('InfosStagiaire', ['id' => $stagiaire->idStagiaire] )}}"><img src="/bootstrap-icons/icons/file-earmark-person.svg" alt="Logo" style="height: 40px"> {{$stagiaire->NomStagiaire}}  {{ $stagiaire->PrenomStagiaire }}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" id="home" aria-current="page" href="{{ route("homeStagiaire", ['id' =>  $stagiaire->idStagiaire]) }}">Acceuil</a>
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