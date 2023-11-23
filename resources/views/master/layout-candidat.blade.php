<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('style')
    <script src="https://kit.fontawesome.com/876d7409f1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href = "{{asset('assets/styles/candidat/head.css')}}"> 
    <link rel="stylesheet" href = "{{asset('assets/styles/candidat/footer.css')}}"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href = "https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <link rel="icon" href="{{asset('assets/images/logo.png')}}"  type="image/png">
    <title> @yield('title')</title>
</head>
<body>  

@if(session('error'))
    <div class="alert alert-danger custom-alert" style="display:none; text-align:center; z-index:100;">
        <i class="fas fa-exclamation-circle"></i>   <strong>{{session('error')}}</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>
@elseif(session('success'))
     <div class="alert alert-success custom-alert" role="alert" style="display:none; text-align:center; z-index:100;">
        <i class="fas fa-check-circle"></i>   <strong>{{session('success')}}</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div> 
  
@endif
<header class="custom-header">
     <a href="/" alt="">
     <img src="{{asset('assets/images/logo1.png')}}" class="im_logo" href="/">
     </a>
       
        <ul class="ma_list">
            <li class="ele"><a href="{{route('/')}}" alt="Accueil" class="first">Accueil</a></li>
            <li class="ele"><a href="{{route('profile')}}" alt="Mon compte">Mon compte</a></li>
            <li class="ele"><a href="{{route('offres')}}" alt="Les offres">Les offres</a></li>
            <li class="ele"><a href="{{route('demandes')}}" alt="Mes demandes de candidatures">Mes demandes de candidatures</a></li>
            <li class="ele"><a href="{{route('changer_passe')}}" alt="Changer de mot de passe">Changer de mot de passe</a></li>
            <li class="ele">
            <a href="{{ route('logout')}}"
                 onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();" > <i class="fas fa-power-off"></i></a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
            </form>
            </li>
        </ul>
    </header>
@yield('content') 

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
    // Scroll event
    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('header.custom-header').addClass('scrolled');
        } else {
            $('header.custom-header').removeClass('scrolled');
        }
    });

    // Show alert and set timeout for fading out

});

document.addEventListener('DOMContentLoaded', function () {
var alertElement = document.querySelector(".custom-alert");
    if (alertElement) {
        alertElement.style.display = 'block';
        setTimeout(function() {
            alertElement.style.opacity = '0';
            setTimeout(function() {
                alertElement.style.display = 'none';
            }, 500); 
        }, 5000);
    }
});
</script>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>
</html>