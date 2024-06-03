@extends('layout')
@section('title', 'Login')
@section('content')

<div class="container mt-5 m-auto py-5 border border-2 rounded">
    @if($departement->photo != null)
    <div class="row">
        <div class="col-md-4">        <img src="{{ asset($departement->photo) }}">
        </div>
    </div>
    @endif
    <div class="row">
        <p class="text-end display-2" style="color: #7b7b7b"> Nom: {{$departement->nom}}</p>
    </div>
    <div class="row"> <p class="display-5">Description:</p></div>

    <div class="row"><p>{{$departement->Desc}} . <br></p></div>
    <hr>
    <p class="display-3 fst-italic text-decoration-underline text-center" style="color: #7b7b7b">Info sur le département :</p>
    <p class="display-5 fst-italic" style="font-family:  Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif"><strong>Les Employés :</strong></p>
    <p class=" pb-1 font-italic text-muted">(Nombre d'Employés Présent : {{$nbr}} ) </p>     

    @foreach($employes as $employe)
    <div class="card bg-info bg-opacity-10 mb-2 ">
        <div class="card-body CardEmploye">
            <span class="fs-3 fw-medium">Nom:</span>
            <span class="" style="font-size:x-large;">{{ $employe->nom }}</span><br>
            <span class="fs-3 fw-medium">Prénom:</span>
            <span class="" style="font-size:x-large;">{{ $employe->prenom }}</span>
            <div class="row text-end">
                <span class="fs-3 fw-medium">Poste:</span>
                <span class="" style="font-size:x-large;">{{ $employe->poste->Fonction }}</span>
            </div>
        </div>
    </div>
@endforeach


</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  
/* $(document).ready(function() {

   
    $('#search').on('submit', function() {
        event.preventDefault();
    var query = $('#searchInput').val();
    $.ajax({
        url: '{{ route("employes.searchInDepartement") }}',
        type: 'POST',
        data: {_token: '{{ csrf_token() }}',query: query},
        success: function(response) {
            var Card = $('#CardEmploye');
            Card.textContent ='';
            $.each(response, function(index, employe) {
                console.log(Card);
                var row = '<span class="fs-3 fw-medium">Nom:</span>  <span class="" style="font-size:x-large;">'+employe.nom+' </span><br>' +
                          '<span class="fs-3 fw-medium">Prénom:</span>  <span class="" style="font-size:x-large;" >'+employe.prenom+'</span>' +
                          '<div class="row text-end">' +  
                              '<span class="fs-3 fw-medium">Poste:</span> <span class="" style="font-size:x-large;" >'+employe.nom + '</span>' +
                          '</div>';
                Card.append(row);
            });
        }
    });
});


});*/


</script>