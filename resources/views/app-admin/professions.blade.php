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
<h1>Les professions : </h1>
<h6>Vous pouvez gérer les professions :</h6>
</div>
<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal_add_prof" id="show_modal">
        <i class="fa fa-plus" title="add"></i> Ajouter profession
</button>
<table id="student-datatable" class="table table-striped table-hover table-highlight table-checkable" cellspacing="0">
    <thead>
    <tr class="title">
            <th>#</th>
            <th>Nom</th>
            <th>Nombre de profession</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($profs as $prof)
            <tr class="table-light">
                <td>{{$prof->id_prof}}</td>
                <td>{{$prof->nom_prof}}</td>
                <td>{{$prof->nom_depart}}</td>
                <td>
                    <form action="{{ route('delete_profession', $prof->id_prof) }}" method="POST" id="delete-form-{{ $prof->id_prof }}">
                        @csrf
                        @method('DELETE')
                    </form>        
                    <button type="submit" class="btn btn-default delete-student-btn" data-prof-id="{{ $prof->id_prof }}">
                        <i class="fa fa-trash" title="supprimer"></i>
                    </button>
                    <button type="submit" class="btn btn-default edit-student-btn" data-prof-id="{{ $prof->id_prof }}" data-prof-nom="{{ $prof->nom_prof }}" data-bs-toggle="modal" data-bs-target="#myModal_edit_prof">
                        <i class="fa fa-edit" title="edit"></i>
                    </button>
                </td>
            </tr>
        @endforeach 
    </tbody>
</table>
<!-- modal ajouter -->
<div class="modal" id="myModal_add_prof" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ajouter profession </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
            <div class="modal-body">
                    <h3>Remplir les champs suivants :</h3>
                    <!-- Form Wrapper -->
                    <form name="registration-form" id="msform" method="POST" action="{{route('add_profession')}}" role="form" >
                        @csrf
                        <input type="text" name="nom" class="myform-control" id="nom" placeholder="Nom de profession"  />
                        <select class="form-select" aria-label="Default select example" name="depart_id">
                                <option disabled selected>Select département</option>
                                @foreach($departs as $depart)
                                <option value="{{$depart->id_depart}}">{{$depart->nom_depart}}</option>
                                @endforeach
                        </select>
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
<div class="modal" id="myModal_edit_prof" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editer profession </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
            <div class="modal-body">
                    <h3>Remplir les champs suivants :</h3>
                    <!-- Form Wrapper -->
                    <form name="registration-form" id="msform" method="POST" action="{{route('edit_profession')}}" role="form" >
                        @csrf
                        <input name="id_prof" id="idprof" style="display :none;" value="">
                        <input type="text" name="nom" class="myform-control" id="nom_prof" placeholder="Nom de profession"  value=""/>
                        <select class="form-select" aria-label="Default select example" id="depart" name="depart_id">
                                @foreach($departs as $depart)
                                <option value="{{$depart->id_depart}}">{{$depart->nom_depart}}</option>
                                @endforeach
                        </select>
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
        
        var id = $(this).data('prof-id');
        var nom = $(this).data('prof-nom')
        $("#nom_prof").val(nom);
        $("#idprof").val(id);
      
    });
  $(document).on("click", ".delete-student-btn", function () {
    const profID = $(this).data('prof-id');
    const deleteForm = $(`#delete-form-${profID}`);

    if (confirm('Are you sure you want to delete this record?')) {
        deleteForm.submit();
    }
});
</script>
@endsection