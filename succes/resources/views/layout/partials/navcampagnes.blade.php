@extends('base')
@section('title')
<title>FERME-MAYA</title>
@endsection
@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<p class="text-center mt-2"><a href="/ferme"> Board</a> </p>
<div class="card text-center">
  <div class="card-header">
    Ma Campagne en cours
  </div>
  <div class="card-body">
    <h5 class="card-title">Activités:</h5>
  <p class="card-text">
	<nav class="text-center">	
      <fieldset> 
	      <input type="button" class="btn btn-primary" onclick="window.location.href = 'campagnes';" target="_blink" value="Campagne"/>
	      <input type="button" class="btn btn-primary" onclick="window.location.href = 'vaccins';" target="_blink" value="Vaccin"/>
	      <input type="button" class="btn btn-primary" onclick="window.location.href = 'pertes';" target="_blink" value="Pertes"/>
	      <input type="button" class="btn btn-primary" onclick="window.location.href = 'ventes';" target="_blink" value="Vente"/>
         <input type="button" class="btn btn-primary" onclick="window.location.href = 'maladies';" target="_blink" value="Maladies"/>
	       
      </fieldset>
   </nav>
 </p>
    <a href="#" class="btn btn-primary">My Campagne</a>
  </div>
  <div class="card-footer text-muted">
    Team-MAYA, une team à votre disposition pour vous aider à digitaliser votre secteur d'activité.
  </div>
</div>
@stop



