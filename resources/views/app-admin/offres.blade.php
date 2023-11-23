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
@php 
$types = [
    "Emploi à temps plein",
    "Emploi à temps partiel",
    "Contrat à durée déterminée",
    "Contrat à durée indéterminée",
    "Travail temporaire",
    "Stage"
];
@endphp
<div class="title">
<h1>Les offres d'emploi : </h1>
<h6>Ici, Vous pouvez gérer les offres d'emploi :</h6>
</div>
<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal_add_offre" id="show_modal">
        <i class="fa fa-plus" title="add"></i> Ajouter offre d'emploi
</button>
<table id="student-datatable" class="table table-striped table-hover table-highlight table-checkable" cellspacing="0">
    <thead>
    <tr class="title">
                <th >#</th>
                <th >Département</th>
                <th >Profession</th>  
                <th >Date de Publication</th>
                <th >Detail </th>
                <th >Type d'emploi </th>
                <th>Etat</th>
                <th > Actions </th>
        </tr>
    </thead>
    <tbody>
    @foreach($offres as $offre)
  <tr class="table-light">
    <th>{{$offre->id_offre}}</th>
    <th>{{$offre->nom_depart}}</th>
    <th>{{$offre->nom_prof}}</th>
    <th>{{ \Carbon\Carbon::parse($offre->date_pub)->format('Y-m-d') }}</th>
    <th><a href="{{url('app-admin/home/download_offre',$offre->details) }}" download>
  <button class="btn btn-dark"><i class="fa fa-download"></i></button>
</a></th>
    <th>{{$offre->type_emploi}}</th>
    <th>
    <div class="icons">
                                    @if($offre->termine == '1')
                                    <i class="fa fa-times-circle fa-lg" title="Terminé"></i>
                                    @elseif($offre->termine == '0')
                                    <i class="fa fa-clock fa-lg" title="Non terminé"></i>
                                    @endif
                            </div>
    </th>
    <th>
    <form action="{{route('delete_offre',$offre->id_offre)}}" method="post" id="delete-form-{{$offre->id_offre}}">
            @csrf
            @method('DELETE')
    </form>
    <form action="{{ route('app-admin/home/demandes', $offre->id_offre) }}" method="get" id="show-form-{{ $offre->id_offre }}">
          @csrf
    </form>
    <form action="{{ route('offre_inactive', $offre->id_offre) }}" method="post" id="inactive-form-{{ $offre->id_offre }}">
          @csrf
    </form>
    <button type="button" class="btn btn-default edit-offre-btn"  data-offre-id="{{$offre->id_offre}}"
    data-prof-id="{{$offre->id_prof}}"
    data-offre-details="{{$offre->details}}"
    data-type="{{$offre->type_emploi}}"
    data-bs-toggle="modal" data-bs-target="#myModal_edit_offre"><i class="fa fa-edit" title="modifier"></i></button>            
    <button type="submit" class="btn btn-default delete-student-btn" data-id-offre="{{$offre->id_offre}}"><i class="fa fa-trash" title="supprimer"></i></button>
    <button type="submit" class="btn btn-default show-student-btn"  data-id-offre="{{$offre->id_offre}}" ><i class="fa fa-eye" title="voir les demandes"></i></button>
    <button type="submit" class="btn btn-default inactive-offre-btn" data-id-offre="{{$offre->id_offre}}"><i class="fas fa-ban" title="terminer l'offre"></i> </button>
    </th>
  </tr>
@endforeach 
    </tbody>
</table>
<!-- modal ajouter -->
<div class="modal" id="myModal_add_offre" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ajouter offre </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
            <div class="modal-body">
                    <h3>Remplir les champs suivants :</h3>
                    <!-- Form Wrapper -->
                    <form name="registration-form" id="msform" method="POST" action="{{route('add_offre')}}" role="form" enctype="multipart/form-data">
                        @csrf
                        <select class="form-select" aria-label="Default select example" name="prof_id">
                                <option disabled selected>Select profession</option>
                                @foreach($profs as $prof)
                                <option value="{{$prof->id_prof}}">{{$prof->nom_prof}}</option>
                                @endforeach
                        </select>
                        <br>
                        <select class="form-select" aria-label="Default select example" name="type_emploi">
                                <option disabled selected>Select type d'emploi</option>
                                @foreach($types as $type)
                                <option value="{{$type}}">{{$type}}</option>
                                @endforeach
                        </select>
                        <br>
                        <span>Details d'emploi</span>
                          <div class="file-upload">
                              <div class="file-select">
                                  <div class="file-select-button" id="fileName2">Choose File</div>
                                  <div class="file-select-name" >No file chosen...</div>
                                  <input type="file" name="details" class="chooseFile fileInput2">
                              </div>
                          </div>
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
<div class="modal" id="myModal_edit_offre" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editer département </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
            <div class="modal-body">
                    <h3>Remplir les champs suivants :</h3>
                    <!-- Form Wrapper -->
                    <form name="registration-form" id="msform" method="POST" action="{{route('edit_offre')}}" role="form" enctype="multipart/form-data" >
                        @csrf
                        <input name="idoffre" id="idoffre" style="display :none;" value="">
                        <select class="form-select" aria-label="Default select example" name="prof_id" id="nom_prof">
                                @foreach($profs as $prof)
                                <option value="{{$prof->id_prof}}">{{$prof->nom_prof}}</option>
                                @endforeach
                        </select>
                        <br>
                        <select class="form-select" aria-label="Default select example" name="type_emploi" id="type_emploi">
                                @foreach($types as $type)
                                <option value="{{$type}}">{{$type}}</option>
                                @endforeach
                        </select>
                        <br>
                        <span>Details d'emploi</span>
                          <div class="file-upload">
                              <div class="file-select">
                                  <div class="file-select-button" id="fileName2">Choose File</div>
                                  <div class="file-select-name" >No file chosen...</div>
                                  <input type="file" name="details" class="chooseFile fileInput2" id="details" value="">
                              </div>
                          </div>
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
        var id_prof = $(this).data('prof-id');
        var id_offre = $(this).data('offre-id');
        var details = $(this).data('offre-details');
        var type = $(this).data('type');
        $("#nom_prof").val(id_prof);
        $("#type_emploi").val(type);
        $("#idoffre").val(id_offre);
        $("#details").val(details);
    });
    $(document).on("click", ".show-student-btn", function () {
        var offreID = $(this).data('id-offre');
        var showForm = $(`#show-form-${offreID}`);
        showForm.submit();
    });
    $(document).on("click", ".delete-student-btn", function () {
    const offreID = $(this).data('id-offre');
    const deleteForm = $(`#delete-form-${offreID}`);

    // Check if you want to confirm the action (optional)
    if (confirm('Are you sure you want to delete this record?')) {
        deleteForm.submit();
    }
    });
    $(document).ready(function () {
        $(document).on("click", ".inactive-offre-btn", function () {
            const idOffre = $(this).data('id-offre');
            const inactiveForm = $(`#inactive-form-${idOffre}`);
            
            // Check if you want to confirm the action (optional)
            if (confirm('Are you sure you want to terminate this offer?')) {
                inactiveForm.submit();
            }
        });
    });

 
$('.chooseFile').bind('change', function () {
		var input = $(this);
		var filename = input.val();
		
		var fileSelectName = input.closest('.file-select').find('.file-select-name');
	
		if (filename.trim() !== "") {
			var ext = filename.split('.').pop().toLowerCase();
	
			if ($.inArray(ext, ['pdf', 'doc', 'docx']) !== -1) {
				input.closest('.file-upload').addClass('active');
				txt = filename.replace("C:\\fakepath\\", "");
				fileSelectName.text(txt);
				// fileSelectName.css('margin-top', '-42px');
				// if (txt.length >10) {
				// 	fileSelectName.css('margin-left', '40%');
				// }
			} else {
				input.closest('.file-upload').removeClass('active');
				fileSelectName.text("No file chosen...");
				alert("Only PDF and Word files are allowed!");
				input.val("");
			}
		} else {
			input.closest('.file-upload').removeClass('active');
			fileSelectName.text("No file chosen...");
		}
	
	});

</script>
@endsection