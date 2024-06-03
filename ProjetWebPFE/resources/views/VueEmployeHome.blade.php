@extends('layout')
@section('title','Accueil')
@section('content')

<!--La Navbar  -->

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand disabled" href="{{route('InfosPers', ['id' => $employe->idEmploye] )}}"><img src="/bootstrap-icons/icons/file-earmark-person.svg" style="height: 100%"> {{$employe->nom}}  {{ $employe->prenom }}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link disabled" aria-current="page" href="{{ route("EmployeHome", ['id' => $employe->idEmploye]) }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route("DemandeConge",['id'=>$employe->idEmploye]) }}">Demande de Congé</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route("FormationEmploye",['id'=>$employe->idEmploye]) }}">Formations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route("PromotionEmploye",['id'=>$employe->idEmploye]) }}">Promotions</a>
          </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">
            <img src="/bootstrap-icons/icons/door-closed-fill.svg" style="height: 80%">
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Section d'annonces -->
<section class="container mt-4">
  <h2 class="mb-4">Annonces</h2>
  <div class="row">
    @foreach($annonces as $annonce)
    <div class="col-md-4 mb-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{$annonce->titre}}</h5>
          <p class="card-text">{{$annonce->texte}}.</p>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <h2 class="mb-4">Tableau de bord</h2>
  <div class="row">
    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-body">
          <h5 class="card-title">Tâches à accomplir</h5>
          <ul class="list-group">
            @foreach($taches as $tache)
            <li class="list-group-item"> &rarr; {{$tache->contenu }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-body">
          <h5 class="card-title">Calendrier</h5>
          <p>Calendrier des congés.</p>
          <button type="button" class="btn-lg btn-primary float-end " data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Afficher les Congé</button>
          <div class="card" style="width: 100%">
            <div class="card-body">
              <div id="calendar" style="width: 100%">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white py-0 mt-auto">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-5 ms-2">
        <h5 class="mb-3">Liens rapides</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="text-white">Accueil</a></li>
          <li><a href="#" class="text-white">Services</a></li>
          <li><a href="#" class="text-white">Contact</a></li>
          <li><a href="#" class="text-white">À propos</a></li>
        </ul>
      </div>
      <div class="col-md-5 ms-auto">
        <h5 class="mb-3">Contact</h5>
        <p>
          <i class="bi bi-geo-alt-fill"></i> 123 Rue de l'Entreprise, Ville, Pays<br>
          <i class="bi bi-telephone-fill"></i> +123 456 7890<br>
          <i class="bi bi-envelope-fill"></i> email@example.com
        </p>
      </div>
    </div>
    <div class="text-center mb-auto">
      <p>&copy; 2024 Nom de l'Entreprise. Tous droits réservés.</p>
    </div>
  </div>
</footer>
    <!--Liste des Congés annuels-->

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Liste Des congés</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
       <ul class="list-group list-group-flush">
        @foreach($conges as $conge)
        @if($conge->TypeConge==1)
        <b>Congé Annuel :</b>
      <li class="list-group-item">{{$conge->NomConge}} : {{$conge->DateDebut}} &rarr; {{$conge->DateFin}} </li>
      @else
      <b>Mes Congé :</b>
      <li class="list-group-item"> {{$conge->DateDebut}} &rarr; {{$conge->DateFin}} </li>
      @endif
      @endforeach
      </ul>
      </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
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
        @if ($errors->any())
            // Sélectionner le toast et le montrer
            var bsToast = new bootstrap.Toast(toastError);
            bsToast.show();
        @endif        
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          events: [
                    @foreach($conges as $conge)
                        {
                            title: '{{ $conge->NomConge }}',
                            start: '{{ $conge->DateDebut }}',
                            end: '{{ $conge->DateFin }}',
                        },
                    @endforeach
                ],
          eventClassNames: 'text-center fs-7'       // Convertit les congés en format JSON pour FullCalendar
        })
        calendar.render()
      });



               
</script>
@endsection
