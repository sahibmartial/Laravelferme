@extends('layout.app')
@section('title')
<title>FERME-MAYA</title>
@endsection
@section('contenu')
<h1>Menu Achats :</h1>
@include('layout.partials.navachats')
@endsection

@section('retour')
<a href="/ferme">Retour</a>
@endsection