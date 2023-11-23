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
<h1>Les départements : </h1>
<h6>Vous pouvez gérer les départements :</h6>
</div>
<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal_add_depart" id="show_modal">
        <i class="fa fa-plus" title="add"></i> Ajouter département
</button>
<table id="student-datatable" class="table table-striped table-hover table-highlight table-checkable" cellspacing="0">
    <thead>
    <tr class="title">
            <th>ID</th>
            <th>Nom</th>
            <th>Nombre des professions</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($departs as $depart)
            <tr class="table-light">
                <td>{{$depart->id_depart}}</td>
                <td>{{$depart->nom_depart}}</td>
                <td>{{$depart->professions_count}}</td>
                <td>
                    <form action="{{ route('delete_departement', $depart->id_depart) }}" method="POST" id="delete-form-{{ $depart->id_depart }}">
                        @csrf
                        @method('DELETE')
                    </form>        
                    <button type="submit" class="btn btn-default delete-student-btn" data-depart-id="{{ $depart->id_depart }}">
                        <i class="fa fa-trash" title="supprimer"></i>
                    </button>
                    <button type="submit" class="btn btn-default edit-student-btn" data-depart-id="{{ $depart->id_depart }}" data-depart-nom="{{ $depart->nom_depart }}" data-bs-toggle="modal" data-bs-target="#myModal_edit_depart">
                        <i class="fa fa-edit" title="edit"></i>
                    </button>
                </td>
            </tr>
        @endforeach 
    </tbody>
</table>
<!-- modal ajouter -->
<div class="modal" id="myModal_add_depart" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ajouter département </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
            <div class="modal-body">
                    <h3>Remplir les champs suivants :</h3>
                    <!-- Form Wrapper -->
                    <form name="registration-form" id="msform" method="POST" action="{{route('add_departement')}}" role="form" >
                        @csrf
                        <input type="text" name="nom" class="myform-control" id="nom" placeholder="Nom de département"  />
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="upd" name="add">
       </form>
      </div>
    </div>
  </div>
</div>
<!-- modal editer -->
<div class="modal" id="myModal_edit_depart" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editer département </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
            <div class="modal-body">
                    <h3>Remplir les champs suivants :</h3>
                    <!-- Form Wrapper -->
                    <form name="registration-form" id="msform" method="POST" action="{{route('edit_departement')}}" role="form" >
                        @csrf
                        <input name="iddepart" id="iddepart" style="display :none;" value="">
                        <input type="text" name="nom" class="myform-control" id="nom_depart" placeholder="Nom de département"  value=""/>
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
    $(document).on("click", ".btn", function () {
        
        var id = $(this).data('depart-id');
        var nom = $(this).data('depart-nom')
        $("#nom_depart").val(nom);
        $("#iddepart").val(id);
      
    });
  $(document).on("click", ".delete-student-btn", function () {
    const departID = $(this).data('depart-id');
    const deleteForm = $(`#delete-form-${departID}`);

    if (confirm('Are you sure you want to delete this record?')) {
        deleteForm.submit();
    }
});
</script>
@endsection