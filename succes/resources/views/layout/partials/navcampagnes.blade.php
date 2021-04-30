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
<h3 class="text-center mt-2 mb-2">Board Campagne</h3>
<nav class="text-center">	
  <fieldset>
	
	  
	      <input type="button" onclick="window.location.href = 'campagnes';" target="_blink" value="Campagne"/>
	      <input type="button" onclick="window.location.href = 'vaccins';" target="_blink" value="Vaccin"/>
	      <input type="button" onclick="window.location.href = 'pertes';" target="_blink" value="Pertes"/>
	      <input type="button" onclick="window.location.href = 'ventes';" target="_blink" value="Vente"/>
	       
    </fieldset>
</nav>
<p class="text-center mt-2"><a href="/ferme"> Board</a> </p>
@stop



