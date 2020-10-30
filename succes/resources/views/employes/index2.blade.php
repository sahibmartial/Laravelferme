@extends('layout.addmorealiments')
@section('title')
<title>Employe</title>
@endsection
@section('contenu') 
@include('shared.employe_autocomplete')
@stop
@section('retour')
<p><a href="/mean_masse"> Retour Masse</a></p>
@endsection
@section('footer')
@include('layout.partials.footer')
@stop
 