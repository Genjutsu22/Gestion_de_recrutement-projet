@extends('master.layout-candidat')
@section('style')
<link rel="stylesheet" href = "{{asset('assets/styles/candidat/demandes.css')}}"> 
@endsection
@section('title')
Mes demandes d'emploi
@endsection
@section('content')
@php
    $length = count($offres);
@endphp

<div class="container-1">
<div class="title">
<h1>Les demandes d'emploi :</h1>
<p >Ici vous pouvez voir votre demandes ! </p>
</div>
    
    <div class="row">
      <div class="col-12">
        <h3 class="float-left">Mes demandes  </h3>
        
      </div>
    </div>
    @if($length == null)
      <p class="rec">Pas des demandes pour le moment !</p>
    @endif

    <div id="posts" class="row mt-4">
        @foreach($offres as $offre)
           
          
            <div class="item col-12 mb-3">
                <div class="card rounded shadow border-0" style="background-color: {{ $offre->accepted === null ? '#ffbeba' : ($offre->accepted == 1 ? '#9dff9d' : '#e94151') }};">
                            <div class="card-body p-3">
                                    <a href="#" class="text-dark">
                                        <h3>{{ $offre->nom_profession }}</h3>
                                    </a>
                                    <p><h6>Département : {{ $offre->nom_departement }}</h6></p>
                                    <p class="text-muted small">Type : {{ $offre->type_emploi }}</p>
                                    <p class="text-muted small">Date d'entretien : {{$offre->date_entretien === null ? '-------' : \Carbon\Carbon::parse($offre->date_entretien)->format('Y-m-d') }}</p>
                            </div>
                            <div class="icons">
                                    @if($offre->accepted == '1')
                                        <i class="fas fa-check-double fa-lg fa-circle" title="accepter"></i>
                                    @elseif($offre->accepted == '0')
                                        <i class="fa fa-times-circle fa-lg" title="refuser"></i>
                                    @elseif($offre->accepted === null)
                                        <i class="fa fa-clock fa-lg" title="en attend"></i>
                                    @endif
                            </div>
                            <div class="icon-delete">
                            @if($offre->accepted === null)
                            <a href="{{ route('delete_demande')}}"
                                 onclick="event.preventDefault();
                                document.getElementById('delete-form').submit();" > <i class="fa fa-trash-o icon" title="delete"> </i> &nbsp;Annuler demande</a>
                           </div>
                            <form id="delete-form" action="{{ route('delete_demande') }}" method="POST" style="display: none;">
                             @csrf
                             <input type="hidden" name="idoffre" value="{{ $offre->id_offre }}">
                            </form>
                            @endif
                            </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
<br><br><br><br>

      


<script>
   $(document).ready(function() {
   
    event.preventDefault();
    $('#posts .item').addClass('col-12');
    $('#posts img').addClass('d-none');
    $('#grid').removeClass('active');
    $('#list').addClass('active');
    $('.btns').css('margin-left','0 !important');
 
 
});
</script>
@endsection