@extends('layout')
@section('title','Accueil')
@section('content')

<!--La Navbar  -->

@include('navbarEmp')

<!-- Section d'annonces -->
<section class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-body">
  <h2 class="mb-4">Annonces</h2>
  <div class="row">
    @foreach($annonces as $annonce)
    <div class="col-md-4 mb-4">
      <div class="card text-bg-danger shadow-lg">
        <div class="card-body">
          <div class="card-header">
          <h5 class="card-title">{{$annonce->titre}}</h5>
        </div>
          <p class="card-text mb-3">{{$annonce->texte}}.</p>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <h2 class="mb-4">Tableau de bord</h2>
  <div class="row">
    <div class="col-md-6">
      <div class="card shadow-lg mb-4">
        <div class="card-body">
          <h5 class="card-title">Tâches à accomplir</h5>
          <ul class="list-group">
            @foreach($taches as $tache)
            <li class="list-group-item list-group-item-info"> &rarr; {{$tache->Description }}</li>
            @endforeach
          </ul>
        </div>
      </div>
      <h5 class="mb-4">Gestion de présence</h5>
      <div class="card shadow-lg mb-4">
        <div class="card-body">
          @if($employe->Etat=="Actif")
          <form action="{{route('PresenceEmploye',['id'=>$employe->idEmploye,'action'=>'devientPlusPresent'])}}" method="post">
            @csrf
            @method('put')
          <button type="submit" class="btn btn-outline-danger">Je ne suis plus présent</button>
          </form>
          @elseif($employe->Etat=="Inactif")
          <form action="{{route('PresenceEmploye',['id'=>$employe->idEmploye,'action'=>'devientPresent'])}}" method="post">
            @csrf
            @method('put')
          <button type="submit" class="btn btn-outline-success">Je suis présent</button>
        </form>
@endif
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card shadow-lg mb-4">
        <div class="card-body">
          <h5 class="card-title">Calendrier des Congés</h5>
          <div class="row">
            <div class="col-3 mb-1">
              Congé Personnel:
              <div class="text-bg-primary p-3"></div>
            </div>
            <div class="col-3 mb-1">
              Congé Annuel:
              <div class="text-bg-dark p-3"></div>
            </div>
            <div class="col-6 d-flex justify-content-end">            
          <button type="button" class="btn btn-outline-info float-end mb-2 " data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Afficher les Congé</button>
        </div>
        </div>
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
        <b>Congé Annuel :</b>
        @foreach($conges as $conge)
        @if($conge->TypeConge==1)
      <li class="list-group-item">{{$conge->NomConge}} : {{$conge->DateDebut}} &rarr; {{$conge->DateFin}} </li>
      @endif
      @endforeach
      <hr>
      <b class="mt-1">Mes Congé :</b>
      @foreach($conges as $conge)
      @if(!($conge->TypeConge==1))
      <li class="list-group-item"> {{$conge->DateDebut}} &rarr; {{$conge->DateFin}} </li>
      @endif
      @endforeach
      </ul>
      </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
<script>
      $(document).ready(function () {
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
                            @if($conge->TypeConge == '1')  // Condition pour le type de congé
                    classNames: 'text-center bg-black fs-7' 
                            @endif
                        },
                    @endforeach
                ],
          eventClassNames: 'text-center  fs-7' 
      // Convertit les congés en format JSON pour FullCalendar
        })
        calendar.render()
      });
      $(document).ready(function () {
        $('#home').addClass('nav-link disabled');
    });


               
</script>
@endsection
