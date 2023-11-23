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
<h1>Changer mot de passe </h1>
<h6>Ici, Vous pouvez changer votre mot de passe</h6>
</div>
<div class="container-2">
<div class="form-pass">
<form name="changepass-form" id="msform" method="POST" action="{{route('change_passe')}}" role="form">
@csrf
    <fieldset>
      <legend>Remplir les champs !</legend>
      <input type="password" name="oldpass" class="myform-control" id="oldpass" placeholder="Ancien mot de passe*" value="" required/>
      @error('oldpass')
      <div class="text-danger" >{{$message}}</div>
     @enderror
      <input type="password" name="nvpass" class="myform-control" id="nvpass" placeholder="Nouveau mot de passe*" value="" required/>
      @error('nvpass')
      <div class="text-danger" >{{$message}}</div>
     @enderror
      <input type="password" name="conpass" class="myform-control" id="conpass" placeholder="Confirmez le mot de passe*" value="" required/>
      @error('conpass')
    <div class="text-danger" >{{$message}}</div>
    @enderror
      <button type="submit" class="custom-btn btn-13">Changer</button>
    </fieldset>
</form>
</div> 
  
</div>
@endsection