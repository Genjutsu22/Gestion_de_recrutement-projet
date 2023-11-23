@extends('master.layout-candidat')
@section('style')

<link rel="stylesheet" href = "{{asset('assets/styles/candidat/home.css')}}"> 

@endsection
@section('title')
   Home
@endsection
@section('content')

<div class="container-1">
  
@if(isset($data))
<div class="text-area">
<p class="ttl">Bienvenue, <br>{{ $data["nom"] }} {{$data["prenom"]}}</p>
<p class="txt">Dans votre espace candidature, vous pouvez naviguez en utilisant les liens en haut !</p>
<a class="custom-btn btn-13" onclick="scrollToTag()"><span class="fas fa-arrow-down"></span></a>
</div>
@endif
</div>
<img src="{{asset('assets/images/people.png')}}" class="bg-img">
<br><br>
<div class="faq" id="faq">
        
  <div class="faq__logo__holder">
  <div class="faq__logo">
    <img src="https://bobmatyas.github.io/fm-faq-accordion/images/illustration-woman-online-mobile.svg"  class="faq__logo__image hidden-lg">
    <img src="https://bobmatyas.github.io/fm-faq-accordion/images/illustration-box-desktop.svg" alt="" class="faq__logo__image visible-lg">
  </div>
  </div>
  
  <div class="faq__holder">
  <h1 class="faq__heading">FAQ</h1>
 
  <details class="faq__detail">
      <summary  class="faq__summary"><span class="faq__question">Qu'est-ce que l'application "Gestion Recrutement" ?</span></summary>
      <p class="faq__text">Cette application facilite la gestion des demandes d'emploi au sein d'une entreprise.</p>
  </details>

  <details class="faq__detail">
    <summary  class="faq__summary"><span class="faq__question">Quel est le nombre maximum de candidatures que je peux déposer ?</span></summary>
    <p class="faq__text">Vous pouvez postuler à tout emploi compatible avec les informations que vous fournissez dans votre CV et votre lettre de motivation.</p>
  </details>  

  <details class="faq__detail">
    <summary  class="faq__summary"><span class="faq__question">Comment réinitialiser mon mot de passe ?</span></summary>
    <p class="faq__text">Cliquez sur "Mot de passe oublié" à partir de la page de connexion ou sur "Changer de mot de passe" à partir de votre page de profil.</p>
    <p class="faq__text">Un lien de réinitialisation vous sera envoyé par courriel.</p>
  </details>  
  
  <details class="faq__detail">
    <summary  class="faq__summary"><span class="faq__question">Puis-je résilier mon abonnement ?</span></summary>
    <p class="faq__text">Oui ! Envoyez-nous un message et nous traiterons votre demande sans poser de questions.</p>
  </details> 
  
  <details class="faq__detail">
    <summary  class="faq__summary"><span class="faq__question">Fournissez-vous un soutien supplémentaire ?</span></summary>
    <p class="faq__text">L'assistance par courrier électronique est disponible 24 heures sur 24 et 7 jours sur 7. Les lignes téléphoniques sont ouvertes pendant les heures normales de bureau.</p>
  </details>   

</div>
</div> 
  

<script>
    function scrollToTag() {
        var targetElement = document.getElementById('faq');
        if (targetElement) {
            $('html, body').animate({
                scrollTop: $(targetElement).offset().top
            }, 10); 
        }
    }
</script>
@endsection

