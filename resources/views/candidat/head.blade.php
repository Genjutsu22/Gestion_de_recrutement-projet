<header class="custom-header">
     <a href="/" alt="">
     <img src="{{asset('assets/images/logo1.png')}}" class="im_logo" href="/">
     </a>
       
        <ul class="ma_list">
            <li class="ele"><a href="\" alt="Accueil" class="first">Accueil</a></li>
            <li class="ele"><a href="" alt="Mon compte">Mon compte</a></li>
            <li class="ele"><a href="" alt="Les offres">Les offres</a></li>
            <li class="ele"><a href="" alt="Mes demandes de candidatures">Mes demandes de candidatures</a></li>
            <li class="ele"><a href="" alt="Changer mot de passe">Changer mot de passe</a></li>
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
