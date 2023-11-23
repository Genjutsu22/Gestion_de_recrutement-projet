@extends('master.layout')
@section('title')
  registration
@endsection
@section('style')
<link href="https://fonts.googleapis.com/css2?family=Lobster&family=Roboto:ital,wght@0,400;0,900;1,300;1,400&display=swap" rel="stylesheet">
<link href="{{asset('assets/styles/registration.css')}}" rel="stylesheet" />

@endsection
@section('content')
<form id="msform" method="Post" action="{{route('register_candidat')}}" enctype="multipart/form-data">
@csrf
  <h1>Crée Votre Compte</h1> 
  <!-- progressbar -->
  <ul id="progressbar">
    <li class="active">Informations login</li>
    <li>Informations personnelles</li>
    <li>Cv et Lettre de motivation</li>
  </ul>
  <!-- fieldsets -->
  <fieldset>
    <h2 class="fs-title">Informations login</h2>
    <h3 class="fs-subtitle">Step 1</h3>
    <input type="text" name="email" placeholder="Email *" required/>
    @error('email')
    <div class="text-danger" >{{$message}}</div>
    @enderror
    <input type="password" name="password" placeholder="Password *" required/>
    @error('password')
    <div class="text-danger" >{{$message}}</div>
    @enderror
    <input type="password" name="confirm-password" placeholder="Confirm Password *" required/>
    @error('confirm-password')
    <div class="text-danger" >{{$message}}</div>
    @enderror
    <input type="button" name="next" class="next action-button" value="Next" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Informations personnelles</h2>
    <h3 class="fs-subtitle">Step 2</h3>
    <input type="text" name="nom" placeholder="Nom *" required/>
    <input type="text" name="prenom" placeholder="Prénom *" required/>
    <input type="text" name="cin" placeholder="CIN *"required/>
    @error('cin')
    <div class="text-danger" >{{$message}}</div>
    @enderror
    <input type="text" name="adresse" placeholder="Adresse *"required/>
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="button" name="next" class="next action-button" value="next" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Cv et Lettre de motivation*</h2>
    <h3 class="fs-subtitle">Step 3</h3>
    <span>CV*</span>
<div class="file-upload">
    <div class="file-select">
        <div class="file-select-button" id="fileName1">Choose File</div>
        <div class="file-select-name" >No file chosen...</div>
        <input type="file" name="cv" class="chooseFile fileInput1">
    </div>
</div>

<span>Lettre de motivation*</span>
<div class="file-upload">
    <div class="file-select">
        <div class="file-select-button" id="fileName2">Choose File</div>
        <div class="file-select-name" >No file chosen...</div>
        <input type="file" name="lettre_motiv" class="chooseFile fileInput2">
    </div>
</div>
    <input type="button" name="previous" class="previous action-button" value="Previous" required/>
    <input type="submit" class="submit action-button" name="signup" value="submit"/>
  </fieldset>
</form>



<div class="foot"> 
<svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
<defs>
<path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
</defs>
<g class="parallax">
<use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7"></use>
<use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)"></use>
<use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)"></use>
<use xlink:href="#gentle-wave" x="48" y="7" fill="#fff"></use>
</g>
</svg>
<div class="content flex">
    <ul>
      <li><p class="text-foot ">Gestion recrutement © 2023  &nbsp; &nbsp; &nbsp; Abdallah Oubella - ESTG</p></li>
  </ul>
</div>
</div> 
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="{{asset('assets/scripts/registration.js')}}"></script>

@endsection