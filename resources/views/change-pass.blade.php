@extends('master.layout')
@section('style')
<link rel="stylesheet" href = "{{asset('assets/styles/change-pass.css')}}"> 
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection
@section('title')
   Changer mot de passe
@endsection
@section('content')


<div class="container-1 ">
<div class="wrapper">
<h1>Changer votre mot de passe</h1>
  <div class="container">
    <div class="col-left">
      <div class="page-text">
        <h2><img src="{{asset('assets/images/logo1.png')}}" ></h2>
        <p>
          La sécurité de votre compte est bien assuré. Sur cette page, vous pouvez citer un nouveau mot de passe à votre compte.

        </p>
      </div>
    </div>
    <div class="col-right">
      <div class="page-form">
        <h2>Changer votre mot de passe</h2>
        <form action="{{route('login')}}" method="Post" >
          @csrf
          <p> 
            <input type="password" name="nvpass" placeholder="Mot de passe" required>
          </p>
          <p>
            <input type="password" name="conpass" placeholder="Confirmation " required>
          </p>
          <p>
            <input class="btn" type="submit" value="Modifier" />
          </p>
         
        </form>
      </div>
    </div>
  </div> 
</div>
</div>
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
@endsection