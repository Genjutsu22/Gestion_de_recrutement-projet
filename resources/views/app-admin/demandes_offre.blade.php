@extends('master.layout-admin')
@section('style')
<link href="https://fonts.googleapis.com/css2?family=Lobster&family=Roboto:ital,wght@0,400;0,900;1,300;1,400&display=swap" rel="stylesheet">
<link href="{{asset('assets/styles/admin/sidebar.css')}}" rel="stylesheet" />
<link href="{{asset('assets/styles/admin/offres.css')}}" rel="stylesheet" />
<link href="{{asset('assets/styles/admin/home_admin.css')}}" rel="stylesheet" />
<script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <!-- jQuery -->
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

<!-- Bootstrap CSS (5.2.0) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">

<!-- DataTables Core JS -->
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- DataTables Bootstrap 5 JS -->
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js"></script>

<!-- DataTables Bootstrap 5 CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<script>    
$(document).ready(function() {
    $('#student-datatable').DataTable();
});
</script>
@endsection
@section('title')
Admin
@endsection
 
@section('content')
<div class="title">
<h1>Les demandes d'emploi de {{$offre[0]->nom_prof}} {{$offre[0]->nom_depart}} : </h1>
<h6>Ici, Vous pouvez gérer les demandes d'emploi :</h6>
</div>
<table id="student-datatable" class="table table-striped table-hover table-highlight table-checkable" cellspacing="0">
    <thead>
    <tr class="title">
                <th >CIN</th>
                <th >Nom</th>
                <th >Prénom</th>
                <th >ville</th>
                <th>CV</th>
                <th>Lettre de motivation</th>
                <th >Accepter/refuser</th>
        </tr>
    </thead>
    <tbody>
@foreach($demandes as $demande)
  <tr class="table-light">
    <th>{{$demande->cin}}</th>
    <th>{{$demande->nom}}</th>
    <th>{{$demande->prenom}}</th>
    <th>{{$demande->adresse}}</th>
    <th>
  @if ($demande->cv)
    <a href="{{ url('app-admin/home/download_offre', $demande->cv) }}" download>
      <button class="btn btn-dark"><i class="fa fa-download"></i></button>
    </a>
  @else
    --------------
  @endif
</th>
<th>
  @if ($demande->lettre_motiv)
    <a href="{{ url('app-admin/home/download_offre', $demande->lettre_motiv) }}" download>
      <button class="btn btn-dark"><i class="fa fa-download"></i></button>
    </a>
  @else
    --------------
  @endif
</th>
    <th>
    <form action="{{route('app-admin/home/refuse_offre',$demande->id_candidat)}}" method="post" id="refuse-form-{{$demande->id_candidat}}">
            @csrf
        <input name="idoffre" id="idoffre_ref" style="display :none;" value="">
    </form>
   
    <button type="submit" class="btn btn-default accept-offre" data-candidat-id="{{$demande->id_candidat}}" data-offre-id="{{$offre[0]->id_offre}}" data-bs-toggle="modal" data-bs-target="#myModal_add_date"><i class="fa fa-check-circle" title="accepter"></i></button>
    <button type="submit" class="btn btn-default refuse-offre" data-candidat-id="{{$demande->id_candidat}}" data-offre-id="{{$offre[0]->id_offre}}" ><i class="fa fa-times-circle" title="refuser"></i></button>      
    
  
   
    
    </th>
  </tr>
@endforeach 
</tbody>
</table>
<div class="modal" id="myModal_add_date" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Date entretien </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
            <div class="modal-body">
                    <h3>Remplir les champs suivants :</h3>
                    <!-- Form Wrapper -->
                    <form name="registration-form" id="msform" method="POST" action="{{route('app-admin/home/accepter_offre')}}" role="form">
                        @csrf
                        <span>Date d'entretien</span>
                        <input name="idoffre" id="idoffre" style="display :none;" value="">
                        <input name="idcandidat" id="idcandidat" style="display :none;" value="">
                        <input type="date" name="date_entretien" id="date_entrtien" required>
            </div>          
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="upd" name="add">
       </form>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).on("click", ".accept-offre", function () {
        var idcandidat = $(this).data('candidat-id');
        var idoffre = $(this).data('offre-id');
        $("#idoffre").val(idoffre);
        $("#idcandidat").val(idcandidat); 
    });
    $(document).on("click", ".refuse-offre", function () {
    var idoffre = $(this).data('offre-id');
    var idcandidat = $(this).data('candidat-id');
    $("#idoffre_ref").val(idoffre);
    $("#refuse-form-" + idcandidat).submit();
})
</script>
@endsection