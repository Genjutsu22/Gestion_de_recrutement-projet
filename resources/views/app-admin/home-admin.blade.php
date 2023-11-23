@extends('master.layout-admin')
@section('style')
<link href="https://fonts.googleapis.com/css2?family=Lobster&family=Roboto:ital,wght@0,400;0,900;1,300;1,400&display=swap" rel="stylesheet">
<link href="{{asset('assets/styles/admin/sidebar.css')}}" rel="stylesheet" />
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
<h1>Les candidats : </h1>
<h6>Vous pouvez gérer les candidats :</h6>
</div>
<table id="student-datatable" class="table table-striped table-hover table-highlight table-checkable" cellspacing="0">
<thead>
<tr class="title">
                <th >CIN</th>
                <th >Nom</th>
                <th >Prenom</th>
                <th >Email</th>
                <th >Adresse</th>
                <th >Cv</th>
                <th >Lettre de motivation</th>
                <th >Actions</th>
            </tr>
</thead>
<tbody>
@foreach($candidats as $candidat)
  <tr class="table-light" >
    <th >{{$candidat->cin}}</th>
    <th>{{$candidat->nom}}</th>
    <th>{{$candidat->prenom}}</th>
    <th>{{$candidat->email}}</th>
    <th>{{$candidat->adresse}}</th>
    <th>
  @if ($candidat->cv)
    <a href="{{ url('app-admin/home/download_offre', $candidat->cv) }}" download>
      <button class="btn btn-dark"><i class="fa fa-download"></i></button>
    </a>
  @else
    --------------
  @endif
</th>
<th>
  @if ($candidat->lettre_motiv)
    <a href="{{ url('app-admin/home/download_offre', $candidat->lettre_motiv) }}" download>
      <button class="btn btn-dark"><i class="fa fa-download"></i></button>
    </a>
  @else
    --------------
  @endif
</th>
    <th>
    <form action="{{ route('delete_candidat', $candidat->id_candidat) }}" method="POST" id="delete-form-{{ $candidat->id_candidat }}">
    @csrf
    @method('DELETE')
</form>       
<button type="submit" class="btn btn-default delete-student-btn" data-personne-id="{{ $candidat->id_candidat }}">
    <i class="fa fa-trash" title="supprimer"></i>
</button>
    </th>
  </tr>
@endforeach 
</tbody>

</table>
<script>
  $(document).on("click", ".delete-student-btn", function () {
    const personneId = $(this).data('personne-id');
    const deleteForm = $(`#delete-form-${personneId}`);

    if (confirm('Are you sure you want to delete this record?')) {
        deleteForm.submit();
    }
});
</script>
@endsection