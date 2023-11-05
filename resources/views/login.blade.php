@extends('master.layout')
@section('style')
<link href="https://fonts.googleapis.com/css2?family=Lobster&family=Roboto:ital,wght@0,400;0,900;1,300;1,400&display=swap" rel="stylesheet">
<link href="{{asset('assets/styles/style_login.css')}}" rel="stylesheet" />
@endsection
@section('title')
Login
@endsection
 
@section('content')
<div class="side"></div>
<div class="container">
   <section id="formHolder">
      <div class="row">
         <!-- Brand Box -->
         <div class="col-sm-6 brand">
           <img src="">
            <div class="heading">
               <p>Connectez-vous<br> pour accéder à votre espace </p>
            </div>
         </div>
         <!-- Form Box -->
         <div class="col-sm-6 form">
                <!-- Signup Form -->
            <div class="login form-peice ">
            <form class="login-form" role="form"  action="{{route('login')}}" method="post">
            @csrf
               <p>Saisir votre adress email et mot de passe</p>
                  <div class="form-group">
                     <label for="loginemail">Email</label>
                     <input type="email" name="email" id="loginemail" class="email "required>
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="loginPassword">Mot de passe</label>
                     <span class="error"></span>
                     <input type="password" name="password" id="loginPassword" class="email" required>
                     <span class="error"></span>
                  </div>

                  <div class="CTA">
                     <input type="submit" value="Login" name="login" id="submit">
                     <a href="#" class="switch">Mot de passe oublié</a>
                  </div>
                  <span>Pas de compte ? <a href="{{ route('register') }}" class="signup">Sign Up</a></span>
               </form>
             
            </div>
            <!-- End Signup Form -->
            <!-- Login Form -->
  <div class="signup form-peice switched">
   
   <form class="signup-form" action="{{ route('login') }}" method="post">
  @csrf
    <p>Saisir votre adresse email</p>
    <div class="form-group">
        <label for="email">Adresse Email</label>
        <input type="email" name="semail" id="email" class="email" required>
        <span class="error"></span>
    </div>
    <div class="CTA">
        <input type="submit" value="Vérifier" name="forget" id="submit">
        <a href="#" class="switch">Retour à la page de connexion</a>
    </div>
     </form>
</div>
<script src="{{asset('assets/scripts/login_script.js')}}"></script>
@endsection

