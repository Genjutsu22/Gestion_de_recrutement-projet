@extends('master.layout')
@section('style')

<link rel="stylesheet" href = "{{asset('assets/styles/candidat/home.css')}}"> 
<link rel="stylesheet" href = "{{asset('assets/styles/candidat/head.css')}}"> 
@endsection
@section('title')
   Home
@endsection
@section('content')

<div class="container-1">
@include('candidat.head')
@if(isset($data))
<div class="text-area">
<p class="ttl">Bienvenue, <br>{{ $data[1] }} {{$data[2]}}</p>
<p class="txt">Dans votre espace candidature, vous pouvez naviguez en utilisant les liens en haut !</p>
<button type="button" class="custom-btn btn-13">À propos <span class="fas fa-arrow-down"></span></button>
</div>
@endif
</div>
<img src="{{asset('assets/images/people.png')}}" class="bg-img">
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
<script>
  $(document).ready(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('header.custom-header').addClass('scrolled');
        } else {
            $('header.custom-header').removeClass('scrolled');
        }
    });
});
</script>
@endsection

