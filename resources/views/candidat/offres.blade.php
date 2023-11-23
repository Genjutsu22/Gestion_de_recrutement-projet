@extends('master.layout-candidat')
@section('style')
<link rel="stylesheet" href = "{{asset('assets/styles/candidat/offres.css')}}"> 
@endsection
@section('title')
Offres d'emploi
@endsection
@section('content')
@php
    $length = count($offres);
@endphp

<div class="container-1">
<div class="title">
<h1>Les offres d'emploi :</h1>
<p >Ici vous pouvez voir et postuler des offres d'emploi ! </p>
</div>
    
    <div class="row">
      <div class="col-12">
        <h3 class="float-left">La liste des offres </h3>
        <div class="btn-group float-right">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label id="list" class="btn btn-outline-dark active">
              <input type="radio" name="layout" id="layout1" checked> List
              </label>
              <label id="grid" class="btn btn-outline-dark">
              <input type="radio" name="layout" id="layout2" > Grid
              </label>
            </div>
        </div>
      </div>
    </div>
    @if($length == null)
      <p class="rec">Pas des offres pour le moment !</p>
    @endif

    <div id="posts" class="row mt-4">
        @foreach($offres as $offre)
        
            <div class="item col-12 mb-3">
                <div class="card rounded shadow border-0">
                    <a href="#">
                        <img class="w-100 d-none" style="height: 300px; object-fit: cover; border-top-right-radius: 5px; border-top-left-radius: 5px;" src="{{asset('assets/images/pexels-fauxels-3184465.jpg')}}" alt="" />
                    </a>
                    <div class="card-body p-3">
                    <form  action="{{ route('postuler') }}" method="post">
                      @csrf
                       <input type="hidden" name="idoffre" value="{{ $offre->id_offre }}">
                        <a href="#" class="text-dark"><h3> {{ $offre->nom_profession }}</h3></a>
                        <p><h6>Département : {{ $offre->nom_departement }}</h6></p>
                        <p class="text-muted small">Type : {{ $offre->type_emploi }}</p>
                        <p class="text-muted small">Publier par Admin, {{ \Carbon\Carbon::parse($offre->date_pub)->format('Y-m-d') }}</p>
                        <div class="btns">
                        <a href="{{ url('download_offre', $offre->details) }}" target="_blank" class="txt">Details</a>
                        <button type="submit" onclick="submitForm('{{ $offre->id_offre }}')" class="custom-btn btn-12"><span>Click!</span><span>Apply!</span></button>
                        </div>
                      </form>
                      </div>  
                </div>
            </div>
        @endforeach
    </div>

</div>
<br><br><br><br>

      


<script>
   $(document).ready(function() {
    $('#posts .item').removeClass('col-12');
    $('#posts .item').addClass('col-4');
    $('#posts img').removeClass('d-none');
    $('#list').removeClass('active');
    $('#grid').addClass('active');

  $('#list').click(function(event){
    event.preventDefault();
    $('#posts .item').addClass('col-12');
    $('#posts img').addClass('d-none');
    $('#grid').removeClass('active');
    $('#list').addClass('active');
    $('.btns').css('margin-left','0 !important');
  });

  $('#grid').click(function(event){
    event.preventDefault();
    $('#posts .item').removeClass('col-12');
    $('#posts .item').addClass('col-4');
    $('#posts img').removeClass('d-none');
    $('#list').removeClass('active');
    $('#grid').addClass('active');
  });
});
</script>
@endsection