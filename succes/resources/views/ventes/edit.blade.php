@extends('base')
@section('title')
<title>VENTE</title>
@stop

@section('content')
<div class="text-center mt-4">
@include('shared.vente_edit')
<hr>
<p><a href="{{route('vente')}}">Listing Vente</a></p>
</div>
@stop


