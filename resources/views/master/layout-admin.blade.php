<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('style')
    <script src="https://kit.fontawesome.com/876d7409f1.js" crossorigin="anonymous"></script>
  
    <link rel="icon" href="{{asset('assets/images/logo.png')}}"  type="image/png">
    <title> @yield('title')</title>
</head>
<body>  

@if(session('error'))
<div id="alert" class="alert alert-danger" style="display:none; text-align:center; z-index:100;">
<i class="fas fa-exclamation-circle"></i>   <strong> {{session('error')}}</strong> 
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
</div>
@elseif(session('success'))
    <div id="alert" class="alert alert-success" style="display:none; text-align:center; color:black;  z-index:100;">
        <i class="fas fa-check-circle"></i>   <strong>{{session('success')}}</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>
@endif

<div class="wrapper">
        <aside id="sidebar">
            <div class="h-100">
                <div class="sidebar-logo">
                <img src="{{asset('assets/images/logo1.png')}}" class="im_logo">
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Tools & Components
                    </li>
                    <li class="sidebar-item">
                        <a href="{{route('app-admin/home')}}" class="sidebar-link">
                            <i class="fas fa-users"></i>
                            Candidats
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#pages"
                            aria-expanded="false" aria-controls="pages">
                            <i class="fa-solid fa-sliders pe-2"></i>
                            Tables
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="{{route('app-admin/home/departements')}}" class="sidebar-link"><i class="fas fa-building"></i> &nbsp;List Départements</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{route('app-admin/home/professions')}}" class="sidebar-link"><i class="fas fa-briefcase"></i> &nbsp;List Professions</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{route('app-admin/home/offres')}}" class="sidebar-link"> <i class="fas fa-file-alt"></i> &nbsp;List Offres d'emploi</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#auth"
                            aria-expanded="false" aria-controls="auth">
                            <i class="fa fa-gear "></i>
                            Paramètres
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                                <a href="{{route('change_passe_page')}}" class="sidebar-link"><i class="fas fa-lock"></i> &nbsp;Change password</a>
                        </li>
                        <li class="sidebar-item">
                    <a href="{{ route('logout_admin')}}"
                 onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();" class="sidebar-link" id="logout"> <i class="fas fa-power-off"></i>&nbsp; Log Out </a>
                    <form id="logout-form" action="{{ route('logout_admin') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <!-- Button for sidebar toggle -->
                <button class="btn" type="button" data-bs-theme="dark">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1>Gestion de recrutement</h1>
            </nav>
            @yield('content') 
        </div>
    </div>
    

<script>
        const toggler = document.querySelector(".btn");
            toggler.addEventListener("click",function(){
            document.querySelector("#sidebar").classList.toggle("collapsed");
            document.querySelector(".main").classList.toggle("collapsed");
                });
     $('a.profile').on('click', function () {
        location.reload(true);
    });
    $(document).ready(function(){
        $("#alert").show();
     });
     setTimeout(function() {
        $("#alert").fadeOut();
     }, 5000);
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>
</html>