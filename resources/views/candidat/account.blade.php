@extends('master.layout-candidat')
@section('style')
<link rel="stylesheet" href = "{{asset('assets/styles/candidat/profile.css')}}"> 
@endsection
@section('title')
Profile
@endsection
@section('content')
@error('email')
<div id="alert" class="alert alert-danger" style="display:none; text-align:center; z-index:100;">
<i class="fas fa-exclamation-circle"></i>   <strong> {{$message}}</strong> 
</div>
@enderror
<div class="container-1">
  <div class="title">
<h1>Mon profile</h1>
<p >Ici vous pouvez voir et modifier vos informations ! </p>
</div>
<div class="mycard">
  <div class="ds-top"></div>
  <div class="avatar-holder">
    <img src="{{asset('assets/images/logo1.png')}}" >
  </div>
 
  <div class="name">
    <a>{{$data["nom"]}}&nbsp; {{$data["prenom"]}}</a>
    <p><span>Cin : </span>{{$data["cin"]}}</p>
    <p><span>Email : </span>{{$data["email"]}}</p>
    <p><span>Adresse : </span>{{$data["adresse"]}}</p>
    <p><span>CV : </span><a href="{{ url('download_offre', $data['cv']) }}" target="_blank" class="dwnld">Download&nbsp;<i class="fa fa-download"></i></a></p>
    <p><span>Lettre de motivation : </span><a href="{{ url('download_offre', $data['lmv']) }}" target="_blank" class="dwnld">Download &nbsp;<i class="fa fa-download"></i></a></p>
  </div>
  <div class="button">
    <a  class="btn" data-bs-toggle="modal" data-bs-target="#myModal_add_candidat"
    data-cin="{{$data['cin']}}" data-nom="{{$data['nom']}}"
    data-prenom="{{$data['prenom']}}" data-adresse="{{$data['adresse']}}"
    data-cv="{{$data['cv']}}" data-lmv="{{$data['lmv']}}" data-email="{{$data['email']}}">Modifier <i class="fas fa-edit"></i></a>
  </div>
  </div> 
</div>
<div class="modal" id="myModal_add_candidat" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modification des données </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
            <div class="modal-body">
                    <h3>Remplir les champs suivants :</h3>
                    <!-- Form Wrapper -->
                    <form name="registration-form" id="msform" method="POST" action="{{route('edit_candidat')}}" role="form" enctype="multipart/form-data">
                        @csrf
                        <input name="idcandidat" id="idcandidat" style="display :none;" value="{{$data['id_candidat']}}">
                        <input type="text" name="cin" class="myform-control" id="cin" placeholder="CIN" value="" />
                        @error('cin')
                        <div class="text-danger" >{{$message}}</div>
                        @enderror
                        <input type="text" name="nom" class="myform-control" id="nom" placeholder="Nom" value="" />
                        <input type="text" name="prenom" class="myform-control" id="prenom" placeholder="Prénom" value="" />
                        <input type="email" name="email" class="myform-control" id="email" placeholder="Email Address" value=""  />
                        @error('email')
                        <div class="text-danger" >{{$message}}</div>
                        @enderror
                        <input type="text" name="adresse" class="myform-control" id="adresse" placeholder="Adresse" value=""  />
                        <span>CV : <input type="file" name="cv" class="choose-file" placeholder="cv" id="cv" value="" /></span>
                        <span>Lettre de motivation : <input type="file" name="lmv" class="choose-file"  id="lmv"  value="" /></span>
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="upd" name="update">
       </form>
      </div>
    </div>
  </div>
</div>
</div>



<script>
    $('.choose-file').on('change input', function () {
	
    var filename = $(this).val();
    var ext = filename.split('.').pop().toLowerCase();
    
    if (/^\s*$/.test(filename)) {
        // File input is empty
    } else if ($.inArray(ext, ['pdf', 'doc', 'docx']) == -1) {
        alert("Only PDF and Word files are allowed!");
        $(this).val("");
    }
});
    $(document).on("click", ".btn", function () {
        var adresse = $(this).data('adresse');
        var nom = $(this).data('nom');
        var prenom = $(this).data('prenom');
        var cin = $(this).data('cin');
        var email = $(this).data('email');
        var cv = $(this).data('cv');
        var lmv = $(this).data('lmv');
        $("#adresse").val(adresse);
        $("#nom").val(nom);
        $("#prenom").val(prenom);
        $("#cin").val(cin);
        $("#email").val(email);
        $("#cv").val(cv);
        $("#lmv").val(lmv); 
    });
</script>
@endsection




