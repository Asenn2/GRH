@extends('layout')
@section('title','Login')
@section('content')

<!--La Navbar  -->

@include('navbar')




<div class="container mt-4">
  <div class="card shadow-lg w-100">
    <div class="row g-0">

        <!--Liste De Candidatures -->
<div class="card-body">
  
    <table class="table caption-top" >
      <caption class="text-center" >Liste de Candidature:</caption>
      <thead>
        <tr class="table-primary">
          <th scope="col">Mail</th>
          <th scope="col">Département</th>
          <th scope="col">Nom Candidat</th>
          <th scope="col">Poste concerné </th>
          <th scope="col">Type de contrat</th>
          <th scope="col">Cv</th>
          <th scope="col">Motivation</th>
          
          <th colspan="2"> </th>
        </tr>
      </thead>
      <tbody>
        @foreach($candidatures as $candidature)
        <tr class="candidature-{{$candidature->idCandidature}}">
            <td class="mail">
              {{$candidature->candidat->Mail}}
            </td>
            <td class="Departement">
              {{$candidature->offreEmploi->departement->nom}}
            </td>
            <td class="nom">
              {{$candidature->candidat->nom}}
            </td>
            <td class="fonction">
              {{$candidature->offreEmploi->poste->Fonction}}
            </td>
            <td class="nomtypecontrat">
              {{$candidature->offreemploi->typecontrat->NomTypeContrat}}
            </td>
            <td class="Cv">            
              <a class="text-decoration-dotted-line border-bottom border-dark pb-1 font-italic text-success afficherCv"  data-cv="{{ url('storage/' . $candidature->candidat->Cv) }}" data-bs-toggle="modal" data-bs-target="#modalformContratFile" href="">
                Afficher &rarr;
              </a>
            </td>
            <td >
              <a href="" data-bs-toggle="modal" data-bs-target="#modalformMotivation{{$candidature->idCandidature}}" >Motivation</a>
            </td>
          @if($candidature->status=="En cours")
            <td>
              <a class="btn btn-primary" role="button" href="{{ route('proposerRendezVous',['mail'=>$candidature->candidat->Mail,'id'=>$candidature->idCandidature]) }}">Proposez Rendez-vous</a>
            </td>
          @else
          <td>
           <p class="text-success">Rendez-vous déja envoyé</p> 
          </td> 
          @endif 
            <td>        
              <form action="/Candidature/{{$candidature->idCandidature}}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger" >Refuser</button>
              </form>
            </td>
        </tr>
                <!--Modal pour chaque Motivation-->
                <div class="modal fade" id="modalformMotivation{{$candidature->idCandidature}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%" style="max-width: 2000px">
                  <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Lettre De Motivation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                      
                  <p>{{$candidature->Motivation}} </p>
                
                          </div>
                
                
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                
                            </div>
                
                      </div>
                </div>
        @endforeach
      </tbody>
    </table>
</div>
  </div>
</div>
<!--Modal pour afficher le Cv -->

<div class="modal fade" id="modalformContratFile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cv</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<iframe class="pdfViewer" width="100%" height="600" frameborder="0" ></iframe>
      </div>
    </div>
</div>
</div>
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
@extends('script')
@section('scripts')
<script>
    //Catch des succès et erreurs
    document.addEventListener('DOMContentLoaded', function () {
      const toastSuccess = document.getElementById('toastSuccess');
      const toastError = document.getElementById('toastError');

        @if(session()->has('success'))

            var bsToast = new bootstrap.Toast(toastSuccess);
            bsToast.show();

        @endif

        @if ($errors->any())

            var bsToast = new bootstrap.Toast(toastError);
            bsToast.show();

    @endif        
    $('#candidature').addClass('nav-link disabled');

    $('.afficherCv').on('click', function(event) {
      event.preventDefault();
        var cv = $(this).data('cv');
        console.log(cv); 
        $('.pdfViewer').attr('src',cv);
    });
});
         
</script>
@endsection