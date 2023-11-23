@extends('master.layout-candidat')
@section('style')
<link rel="stylesheet" href = "{{asset('assets/styles/candidat/change_motpasse.css')}}"> 
@endsection
@section('title')
Changer de mot de passe
@endsection
@section('content')
<div class="container-1">
<div class="title">
<h1>Changer de mot de passe</h1>
<p >Ici vous pouvez changer votre mot de passe. La saisie d'ancient mot de passe est obligatoire ! </p>
</div>
<h1>{{$candidat['nom']." ".$candidat['prenom']}}</h1>
<h6>Ici, vous pouvez changer votre mot de passe</h6>
<div class="container-2">
<div class="form-pass">
<form name="changepass-form" id="msform" method="POST" action="{{route('changepasse')}}" role="form">
@csrf
    <fieldset>
      <legend>Remplir les champs !</legend>
      <input name="idemploye" id="idemploye" style="display :none;" value="{{$candidat['id']}}">
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